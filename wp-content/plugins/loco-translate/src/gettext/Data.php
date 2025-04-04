<?php

loco_require_lib('compiled/gettext.php');

/**
 * Wrapper for array forms of parsed PO data
 */
class Loco_gettext_Data extends LocoPoIterator implements JsonSerializable {

    /**
     * Normalize file extension to internal type
     * @param Loco_fs_File
     * @return string Normalized file extension "po", "pot" or "mo"
     * @throws Loco_error_Exception
     */
    public static function ext( Loco_fs_File $file ){
        $ext = rtrim( strtolower( $file->extension() ), '~' );
        if( 'po' === $ext || 'pot' === $ext || 'mo' === $ext ){
            // We could validate file location here, but file type restriction should be sufficient
            return $ext;
        }
        // translators: Error thrown when attempting to parse a file that is not PO, POT or MO
        throw new Loco_error_Exception( sprintf( __('%s is not a Gettext file','loco-translate'), $file->basename() ) );
    }


    /**
     * @param Loco_fs_File
     * @return Loco_gettext_Data
     */
    public static function load( Loco_fs_File $file ){
        $type = strtoupper( self::ext($file) );
        // catch parse errors so we can inform user of which file is bad
        try {
            if( 'MO' === $type ){
                return self::fromBinary( $file->getContents() );
            }
            else {
                return self::fromSource( $file->getContents() );
            }
        }
        catch( Loco_error_ParseException $e ){
            $path = $file->getRelativePath( loco_constant('WP_CONTENT_DIR') );
            Loco_error_AdminNotices::debug( sprintf('Failed to parse %s as a %s file; %s',$path,$type,$e->getMessage()) );
            throw new Loco_error_ParseException( sprintf('Invalid %s file: %s',$type,basename($path)) );
        }
    }


    /**
     * Like load but just pulls header, saving a full parse. PO only
     * @param Loco_fs_File
     * @return LocoPoHeaders
     * @throws InvalidArgumentException
     */
    public static function head( Loco_fs_File $file ){
        if( 'mo' === self::ext($file) ){
            throw new InvalidArgumentException('PO only');
        }
        $p = new LocoPoParser( $file->getContents() );
        $p->parse(0);
        return $p->getHeader();
    }


    /**
     * @param string assumed PO source
     * @return Loco_gettext_Data
     */
    public static function fromSource( $src ){
        $p = new LocoPoParser($src);
        return new Loco_gettext_Data( $p->parse() );
    }


    /**
     * @param string assumed MO bytes
     * @return Loco_gettext_Data
     */
    public static function fromBinary( $bin ){
        $p = new LocoMoParser($bin);
        return new Loco_gettext_Data( $p->parse() );
    }


    /**
     * Create a dummy/empty instance with minimum content to be a valid PO file.
     * @return Loco_gettext_Data
     */
    public static function dummy(){
        return new Loco_gettext_Data( [ ['source'=>'','target'=>'Language:'] ] );
    }


    /**
     * Ensure PO source is UTF-8. 
     * Required if we want PO code when we're not parsing it. e.g. source view
     * @param string
     * @return string
     */
    public static function ensureUtf8( $src ){
        $src = loco_remove_bom($src,$cs);
        if( ! $cs ){
            // read PO header, requiring partial parse
            try {
                $cs = LocoPoHeaders::fromSource($src)->getCharset();
            }
            catch( Loco_error_ParseException $e ){
                Loco_error_AdminNotices::debug( $e->getMessage() );
            }
        }
        return loco_convert_utf8($src,$cs,false);
    }


    /**
     * Compile messages to binary MO format
     * @return string MO file source
     * @throws Loco_error_Exception
     */
    public function msgfmt(){
        if( 2 !== strlen("\xC2\xA3") ){
            throw new Loco_error_Exception('Refusing to compile MO file. Please disable mbstring.func_overload'); // @codeCoverageIgnore
        }
        $mo = new LocoMo( $this, $this->getHeaders() );
        $opts = Loco_data_Settings::get();
        if( $opts->gen_hash ){
            $mo->enableHash();
        }
        if( $opts->use_fuzzy ){
            $mo->useFuzzy();
        }
        /*/ TODO optionally exclude .js strings
        if( $opts->purge_js ){
            $mo->filter....
        }*/
        return $mo->compile();
    }


    /**
     * Get final UTF-8 string for writing to file
     * @param bool whether to sort output, generally only for extracting strings
     * @return string
     */
    public function msgcat( $sort = false ){
        // set maximum line width, zero or >= 15
        $this->wrap( Loco_data_Settings::get()->po_width );
        // concat with default text sorting if specified
        $po = $this->render( $sort ? [ 'LocoPoIterator', 'compare' ] : null );
        // Prepend byte order mark only if configured
        if( Loco_data_Settings::get()->po_utf8_bom ){
            $po = "\xEF\xBB\xBF".$po;
        }
        return $po;
    }


    /**
     * Compile JED flavour JSON
     * @param string text domain for JED metadata
     * @param string source file that uses included strings
     * @return string
     */
    public function msgjed( $domain = 'messages', $source = '' ){
        $head = $this->getHeaders();
        $head['domain'] = $domain;
        $data = $this->exportJed();
        // Pretty formatting for debugging. Doing as per WordPress and always escaping Unicode.
        $json_options = 0;
        if( Loco_data_Settings::get()->jed_pretty ){
            $json_options |= loco_constant('JSON_PRETTY_PRINT') | loco_constant('JSON_UNESCAPED_SLASHES'); // | loco_constant('JSON_UNESCAPED_UNICODE');
        }
        // PO should have a date if localised properly
        return json_encode(  [
            'translation-revision-date' => $head['PO-Revision-Date'],
            'generator' => $head['X-Generator'],
            'source' => $source,
            'domain' => $domain,
            'locale_data' =>  [
                $domain => $data,
            ],
        ], $json_options );
    }


    /**
     * @return array
     */
    #[ReturnTypeWillChange]
    public function jsonSerialize(){
        $po = $this->getArrayCopy();
        // exporting headers non-scalar so js doesn't have to parse them
        try {
            $headers = $this->getHeaders();
            if( count($headers) && '' === $po[0]['source'] ){
                $po[0]['target'] = $headers->getArrayCopy();
            }
        }
        // suppress header errors when serializing
        // @codeCoverageIgnoreStart
        catch( Exception $e ){ }
        // @codeCoverageIgnoreEnd
        return $po;
    }


    /**
     * Create a signature for use in comparing source strings between documents
     * @return string
     */
    public function getSourceDigest(){
        $data = $this->getHashes();
        return md5( implode("\1",$data) );
    }

    
    /**
     * @param Loco_Locale
     * @param string[] custom headers
     * @return Loco_gettext_Data
     */
    public function localize( Loco_Locale $locale, array $custom = [] ){
        $date = gmdate('Y-m-d H:i').'+0000';
        // headers that must always be set if absent
        $defaults =  [
            'Project-Id-Version' => '',
            'Report-Msgid-Bugs-To' => '',
            'POT-Creation-Date' => $date,
        ];
        // headers that must always override when localizing
        $required =  [
            'PO-Revision-Date' => $date,
            'Last-Translator' => '',
            'Language-Team' => $locale->getName(),
            'Language' => (string) $locale,
            'Plural-Forms' => $locale->getPluralFormsHeader(),
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Content-Transfer-Encoding' => '8bit',
            'X-Generator' => 'Loco https://localise.biz/',
            'X-Loco-Version' => sprintf('%s; wp-%s', loco_plugin_version(), $GLOBALS['wp_version'] ),
        ];
        // Allow some existing headers to remain if PO was previously localized to the same language
        $headers = $this->getHeaders();
        $previous = Loco_Locale::parse( $headers->trimmed('Language') );
        if( $previous->lang === $locale->lang ){
            $header = $headers->trimmed('Plural-Forms');
            if( preg_match('/^\\s*nplurals\\s*=\\s*\\d+\\s*;\\s*plural\\s*=/', $header) ) {
                $required['Plural-Forms'] = $header;
            }
            if( $previous->region === $locale->region && $previous->variant === $locale->variant ){
                unset( $required['Language-Team'] );
            }
        }
        // set user's preferred Last-Translator credit if configured
        if( function_exists('get_current_user_id') && get_current_user_id() ){
            $prefs = Loco_data_Preferences::get();
            $credit = (string) $prefs->credit;
            if( '' === $credit ){
                $credit = $prefs->default_credit();
            }
            // filter credit with current user name and email
            $user = wp_get_current_user();
            $credit = apply_filters( 'loco_current_translator', $credit, $user->get('display_name'), $user->get('email') );
            if( '' !== $credit ){
                $required['Last-Translator'] = $credit;
            }
        }
        $headers = $this->applyHeaders($required,$defaults,$custom);
        // avoid non-empty POT placeholders that won't have been set from $defaults
        if( 'PACKAGE VERSION' === $headers['Project-Id-Version'] ){
            $headers['Project-Id-Version'] = '';
        }
        // finally allow headers to be modified via filter
        $replaced = apply_filters( 'loco_po_headers', $headers );
        if( $replaced instanceof LocoPoHeaders && $replaced !== $headers ){
            $this->setHeaders($replaced);
        }
        return $this->initPo();
    }


    /**
     * @param string
     * @return Loco_gettext_Data
     */
    public function templatize( $domain = '' ){
        $date = gmdate('Y-m-d H:i').'+0000'; // <- forcing UCT
        $defaults =  [
            'Project-Id-Version' => 'PACKAGE VERSION',
            'Report-Msgid-Bugs-To' => '',
        ];
        $required =  [
            'POT-Creation-Date' => $date,
            'PO-Revision-Date' => 'YEAR-MO-DA HO:MI+ZONE',
            'Last-Translator' => 'FULL NAME <EMAIL@ADDRESS>',
            'Language-Team' => '',
            'Language' => '',
            'Plural-Forms' => 'nplurals=INTEGER; plural=EXPRESSION;',
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Content-Transfer-Encoding' => '8bit',
            'X-Generator' => 'Loco https://localise.biz/',
            'X-Loco-Version' => sprintf('%s; wp-%s', loco_plugin_version(), $GLOBALS['wp_version'] ),
            'X-Domain' => $domain,
        ];
        $headers = $this->applyHeaders($required,$defaults);
        // finally allow headers to be modified via filter
        $replaced = apply_filters( 'loco_pot_headers', $headers );
        if( $replaced instanceof LocoPoHeaders && $replaced !== $headers ){
            $this->setHeaders($replaced);
        }
        return $this->initPot();
    }


    /**
     * @param string[] Required headers
     * @param string[] Default headers
     * @param string[] Custom headers
     * @return LocoPoHeaders
     */
    private function applyHeaders( array $required = [], array $defaults = [], array $custom = [] ){
        $headers = $this->getHeaders();
        // only set absent or empty headers from default list
        foreach( $defaults as $key => $value ){
            if( ! $headers[$key] ){
                $headers[$key] = $value;
            }
        }
        // add required headers with custom ones overriding
        if( $custom ){
            $required = array_merge( $required, $custom );
        }
        // TODO fix ordering weirdness here. required headers seem to get appended wrongly
        foreach( $required as $key => $value ){
            $headers[$key] = $value;
        }
        return $headers;
    }


    /**
     * Remap proprietary base path when PO file is moving to another location.
     * 
     * @param Loco_fs_File the file that was originally extracted to (POT)
     * @param Loco_fs_File the file that must now target references relative to itself
     * @param string vendor name used in header keys
     * @return bool whether base header was altered
     */
    public function rebaseHeader( Loco_fs_File $origin, Loco_fs_File $target, $vendor ){
        $base = $target->getParent();
        $head = $this->getHeaders();
        $key = $head->normalize('X-'.$vendor.'-Basepath');
        if( $key ){
            $oldRelBase = $head[$key];    
            $oldAbsBase = new Loco_fs_Directory($oldRelBase);
            $oldAbsBase->normalize( $origin->getParent() );
            $newRelBase = $oldAbsBase->getRelativePath($base);
            // new base path is relative to $target location 
            $head[$key] = $newRelBase;
            return true;
        }
        return false;
    }


    /**
     * Inherit meta values from header given, but leave standard headers intact.
     * @param LocoPoHeaders source header
     */
    public function inheritHeader( LocoPoHeaders $source ){
        $target = $this->getHeaders();
        foreach( $source as $key => $value ){
            if( 'X-' === substr($key,0,2) ) {
                $target[$key] = $value;
            }
        }
    }


    /**
     * @param string date format as Gettext states "YEAR-MO-DA HO:MI+ZONE"
     * @return int
     */
    public static function parseDate( $podate ){
        if( method_exists('DateTime','createFromFormat') ){
            $objdate = DateTime::createFromFormat('Y-m-d H:iO', $podate);
            if( $objdate instanceof DateTime ){
                return $objdate->getTimestamp();
            }
        }
        return strtotime($podate);
    }

} 

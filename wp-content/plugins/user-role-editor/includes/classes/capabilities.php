<?php
/**
 * Class to prepare full user capabilities list for URE editor
 *
 * @package    User-Role-Editor
 * @subpackage Admin
 * @author     Vladimir Garagulia <support@role-editor.com>
 * @copyright  Copyright (c) 2010 - 2021, Vladimir Garagulia
 **/
class URE_Capabilities {

    private static $instance = null;
    private $lib = null;
    private $built_in_wp_caps = null;
    
        
    public static function get_instance() {
        
        if ( self::$instance === null ) {            
            // new static() will work too
            self::$instance = new URE_Capabilities();
        }

        return self::$instance;
    }
    // end of get_instance()

    
    private function __construct() {
        
        $this->lib = URE_Lib::get_instance();
        $this->built_in_wp_caps = $this->lib->get_built_in_wp_caps();
        
    }
    // end of __construct()

    
    protected function convert_cap_to_readable( $cap_name ) {

        $cap_name = str_replace('_', ' ', $cap_name);
        $cap_name = ucfirst($cap_name);

        return $cap_name;
    }
    // convert_cap_to_readable

    
    protected function add_capability_to_full_caps_list( $cap_id, &$full_list ) {
        
        if ( isset( $full_list[$cap_id] ) ) {    // if capability was added already
            return;
        }
        
        $cap = array();
        $cap['inner'] = $cap_id;
        $cap['human'] = esc_html__( $this->convert_cap_to_readable( $cap_id ) , 'user-role-editor' );
        if ( isset( $this->built_in_wp_caps[$cap_id] ) ) {
            $cap['wp_core'] = true;
        } else {
            $cap['wp_core'] = false;
        }

        $full_list[$cap_id] = $cap;
    }
    // end of add_capability_to_full_caps_list()

    
    /**
     * Add capabilities from user roles save at WordPress database
     * 
     */
    protected function add_roles_caps( &$full_list ) {
        
        $roles = $this->lib->get_user_roles();
        foreach ( $roles as $role ) {
            // validate if capabilities is an array
            if ( !isset( $role['capabilities'] ) || !is_array( $role['capabilities'] ) ) {
                continue;
            }
            foreach ( array_keys( $role['capabilities'] ) as $cap ) {
                $this->add_capability_to_full_caps_list( $cap, $full_list );
            }            
        }
        
    }
    // end of add_roles_caps()

    
    /**
     * Add Gravity Forms plugin capabilities, if available
     * 
     */
    protected function add_gravity_forms_caps( &$full_list ) {
        
        if ( !class_exists( 'GFCommon' ) ) {
            return;
        }
        
        $gf_caps = GFCommon::all_caps();
        foreach ( $gf_caps as $gf_cap ) {
            $this->add_capability_to_full_caps_list( $gf_cap, $full_list );
        }        
        
    }
    // end of add_gravity_forms_caps()

    
    /**
     * Add bbPress plugin user capabilities (if available)
     */
    protected function add_bbpress_caps( &$full_list ) {
    
        $bbpress = $this->lib->get_bbpress();
        if ( !$bbpress->is_active() ) {
            return;
        }
                
        $caps = $bbpress->get_caps();
        foreach ( $caps as $cap ) {
            $this->add_capability_to_full_caps_list( $cap, $full_list );
        }
    }
    // end of add_bbpress_caps()
    
    
    /**
     * Provide compatibility with plugins and themes which define their custom user capabilities using 
     * 'members_get_capabilities' filter from Justin Tadlock Members plugin 
     * https://wordpress.org/plugins/members/
     * 
     */
    protected function add_members_caps( &$full_list ) {
        
        $custom_caps = array();
        $custom_caps = apply_filters( 'members_get_capabilities', $custom_caps );
        foreach ( $custom_caps as $cap ) {
           $this->add_capability_to_full_caps_list( $cap, $full_list );
        }        
        
    }
    // end of add_members_caps()

    
    /**
     * Add capabilities assigned directly to user, and not included into any role
     * 
     */
    protected function add_user_caps( &$full_list ) {

        $editor = URE_Editor::get_instance();
        $user = $editor->get('user_to_edit');
        $roles = $editor->get('roles');
        foreach( array_keys( $user->caps ) as $cap )  {
            if ( !isset( $roles[$cap] ) ) {   // it is the user capability, not role
                $this->add_capability_to_full_caps_list( $cap, $full_list );
            }
        }        
        
    }
    // end of add_user_caps()


    /**
     * Add built-in WordPress caps in case some of them were not included to the roles for some reason
     * 
     */
    protected function add_wordpress_caps( &$full_list ) {
                
        foreach ( array_keys( $this->built_in_wp_caps ) as $cap ) {
            $this->add_capability_to_full_caps_list( $cap, $full_list );
        }                
    }
    // end of add_wordpress_caps()

    
    protected function add_create_cap_to_admin( $post_type_name ) {
        global $wp_roles;
        
        $post_type = get_post_type_object( $post_type_name );
        if ( $post_type->cap->create_posts!=='edit_'. $post_type->name .'s' ) {   // 'create' capability is active
            if ( !isset( $wp_roles->role_objects['administrator']->capabilities[$post_type->cap->create_posts] ) ) {                
                $wp_roles->role_objects['administrator']->add_cap( $post_type->cap->create_posts, true );
            }
        }
        
    }
    // end of add_create_caps_to_admin()
    
    
    public static function add_cap_to_roles( $roles, $cap ) {
        
        if ( !is_array( $roles ) || count( $roles )==0 ) {
            return;
        }
        
        $wp_roles = wp_roles();        
        foreach( $roles as $role ) {
            if ( isset( $wp_roles->role_objects[$role] ) && 
                 !isset( $wp_roles->role_objects[$role]->capabilities[$cap] ) ) {
                $wp_roles->role_objects[$role]->add_cap( $cap, true );
            }
        }
        
    }
    // end of add_cap_to_roles()
    
    
    protected function add_custom_post_type_caps( &$full_list ) {
        
        $multisite = $this->lib->get( 'multisite' );
        // admin should be capable to edit any posts
        $cpt_editor_roles0 = !$multisite ? array('administrator') : array();                
        $capabilities = $this->lib->get_edit_post_capabilities();
        $post_types = get_post_types( array(), 'objects' );
        $_post_types = $this->lib->_get_post_types();
        // do not forget attachment post type as it may use the own capabilities set
        $attachment_post_type = get_post_type_object( 'attachment' );
        if ( $attachment_post_type->cap->edit_posts!=='edit_posts' ) {
            $post_types['attachment'] = $attachment_post_type;
        }
                
        foreach( $post_types as $post_type ) {
            if ( !isset( $_post_types[$post_type->name] ) ) {
                continue;
            }
            if ( !isset($post_type->cap) ) {
                continue;
            }
            $cpt_editor_roles = apply_filters( 'ure_cpt_editor_roles', $cpt_editor_roles0, $post_type->name );            
            foreach( $capabilities as $capability ) {
                if ( !isset( $post_type->cap->$capability ) ) {
                    continue;                    
                }    
                $cap_to_check = $post_type->cap->$capability;
                $this->add_capability_to_full_caps_list( $cap_to_check, $full_list );                
                self::add_cap_to_roles( $cpt_editor_roles, $cap_to_check );
            }                        
        }
        
        $wp_roles = wp_roles();
        if ( !$multisite && isset( $wp_roles->role_objects['administrator'] ) ) {
            // admin should be capable to create posts and pages
            foreach( array( 'post', 'page' ) as $post_type_name ) {
                $this->add_create_cap_to_admin( $post_type_name );
            }                        
        }   
        
    }
    // end of add_custom_post_type_caps()
    
            
    protected function add_custom_taxonomies_caps( &$full_list ) {
        
        $taxonomies = $this->lib->get_custom_taxonomies( 'objects' );
        if ( empty( $taxonomies ) ) {
            return;
        }
        
        $multisite = $this->lib->get( 'multisite' );
        // admin should be capable to edit any taxonomy
        $cpt_editor_roles0 = !$multisite ? array('administrator') : array();
        $caps_to_check = array('manage_terms', 'edit_terms', 'delete_terms', 'assign_terms');
        foreach( $taxonomies as $taxonomy ) {
            $cpt_editor_roles = apply_filters( 'ure_cpt_editor_roles', $cpt_editor_roles0, $taxonomy->name );
            foreach( $caps_to_check as $capability ) {
                $cap_to_check = $taxonomy->cap->$capability;
                $this->add_capability_to_full_caps_list( $cap_to_check, $full_list );                
                self::add_cap_to_roles( $cpt_editor_roles, $cap_to_check );
            }
        }
                
    }
    // end of add_custom_taxonomies_caps()
    
    
    /**
     * Add capabilities for URE permissions system in case some were excluded from Administrator role
     * 
     */
    protected function add_ure_caps( &$full_list ) {
        
        $key_cap = URE_Own_Capabilities::get_key_capability();
        if ( !current_user_can( $key_cap ) ) {    
            return;
        }
        $ure_caps = URE_Own_Capabilities::get_caps();
        foreach(array_keys($ure_caps) as $cap) {
            $this->add_capability_to_full_caps_list( $cap, $full_list );
        }
        
    }
    // end of add_ure_caps()
    
    
    // Under the single site WordPress installation administrator role should have all existing capabilities included
    protected function grant_all_caps_to_admin( $full_list ) {
        
        $multisite = $this->lib->get( 'multisite' );
        if ( $multisite ) {
            // There is a superadmin user under WP multisite, so single site administrator role may do not have full list of capabilities.
            return;
        }
        
        $wp_roles = wp_roles();
        if ( !isset( $wp_roles->role_objects['administrator'] ) ) {
            return;
        }
        
        // Use this filter as the last chance to stop this
        $grant = apply_filters('ure_grant_all_caps_to_admin', true );        
        if ( empty( $grant) ) {
            return;
        }
        
        $admin_role = $wp_roles->role_objects['administrator'];
        $updated = false;
        foreach( $full_list as $capability ) {
            $cap = $capability['inner'];
            if ( !$admin_role->has_cap( $cap ) ) {
                $admin_role->add_cap( $cap );
                $updated = true;
            }            
        }
        if ( $updated ) {   // Flush the changes to the database
            $use_db = $wp_roles->use_db;
            $wp_roles->use_db = true;
            $admin_role->add_cap('read');   // administrator always should can 'read'
            $wp_roles->use_db = $use_db;            
        }
    }
    // end of grant_all_caps_to_admin()
    
    
    public function init_full_list( $ure_object ) {
        
        $full_list = array();
        $this->add_roles_caps( $full_list );
        $this->add_gravity_forms_caps( $full_list );
        $this->add_bbpress_caps( $full_list );
        $this->add_members_caps( $full_list );
        if ($ure_object=='user') {
            $this->add_user_caps( $full_list );
        }        
        $this->add_wordpress_caps( $full_list );
        $this->add_custom_post_type_caps( $full_list );
        $this->add_custom_taxonomies_caps( $full_list );
        $this->add_ure_caps( $full_list );        
        asort( $full_list );        
        $full_list = apply_filters('ure_full_capabilites', $full_list );
        $this->grant_all_caps_to_admin( $full_list );        
        
        return $full_list;
    }
    // end of init_full_list();


    /**
     *  Build full capabilities list from all roles
     */
    private function get_full_caps_list_from_roles() {
        $wp_roles = wp_roles();
        // build full capabilities list from all roles
        $full_caps_list = array();
        foreach ( $wp_roles->roles as $role ) {
            // validate if capabilities is an array
            if ( isset( $role['capabilities'] ) && is_array( $role['capabilities'] ) ) {
                foreach ( $role['capabilities'] as $capability => $value ) {
                    if ( !isset( $full_caps_list[$capability] ) ) {
                        $full_caps_list[$capability] = true;
                    }
                }
            }
        }
        
        return $full_caps_list;
    }
    // end of get_full_caps_list_from_roles()
    
    
    /**
     * Returns array of WPBakery Visual Composer plugin capabilities 
     * extracted by 'vc_access_rules_' prefix
     */
    protected function get_visual_composer_caps($full_caps_list) {
        $caps = array();
        foreach( array_keys( $full_caps_list ) as $cap ) {
            if ( strpos( $cap, 'vc_access_rules_')!==false ) {
                $caps[$cap] = 1;
            }
        }
         
        return $caps;
    }
    // end of get_visual_composer_caps()
    
    
    /**
     * return the array of unused user capabilities
     * 
     * @global WP_Roles $wp_roles
     * @return array 
     */
    public function get_caps_to_remove() {
        
        $wp_roles = wp_roles();                               
        $full_caps_list = $this->get_full_caps_list_from_roles();
        $caps_to_exclude = $this->built_in_wp_caps;
        $ure_caps = URE_Own_Capabilities::get_caps();
        $visual_composer_caps = $this->get_visual_composer_caps($full_caps_list);
        $caps_to_exclude = array_merge($caps_to_exclude, $ure_caps, $visual_composer_caps);

        $caps_to_remove = array();
        $caps = array_keys( $full_caps_list );
        foreach ( $caps as $cap ) {
            if ( isset( $caps_to_exclude[$cap] ) ) {    // do not touch built-in WP caps, URE own caps and Visual Composer caps
                continue;
            }
            
            // check roles
            $cap_in_use = false;
            foreach ( $wp_roles->role_objects as $wp_role ) {
                if ( $wp_role->name === 'administrator' ) {
                    continue;
                }
                if ( $wp_role->has_cap( $cap ) ) {
                    $cap_in_use = true;
                    break;
                }                
            }
            if ( !$cap_in_use ) {
                $caps_to_remove[$cap] = 1;
            }            
        }   // foreach(...)

        return $caps_to_remove;
    }
    // end of get_caps_to_remove()
    
    
    /**
     * Prevent cloning of the instance of the *Singleton* instance.
     *
     * @return void
     */
    public function __clone() {
        throw new \Exception('Do not clone a singleton instance.');
    }
    // end of __clone()
    
    /**
     * Prevent unserializing of the *Singleton* instance.
     *
     * @return void
     */
    public function __wakeup() {
        throw new \Exception('Do not unserialize a singleton instance.');
    }
    // end of __wakeup()    
    
}
// end of URE_Capabilities class

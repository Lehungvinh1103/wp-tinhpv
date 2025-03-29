<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* store-pages.twig */
class __TwigTemplate_6c48200bdb153a6f210481097310d1ccb086528203b56e14c9cd37db26ccc859 extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"wcml-section wc-store-pages-section\">
    <div class=\"wcml-section-header\">
        <h3>
            ";
        // line 4
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "store_pages", []), "html", null, true);
        echo "
            <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 5
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "pages_trnsl", []));
        echo "\"></i>
        </h3>
    </div>
    <div class=\"wcml-section-content\">
        <ul class=\"wcml-status-list\">
            ";
        // line 10
        if ((($context["miss_lang"] ?? null) == "non_exist")) {
            // line 11
            echo "                <li>
                    <i class=\"otgs-ico-warning\"></i>
                    ";
            // line 13
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "not_created", []), "html", null, true);
            echo "
                </li>
                <li>
                    <a href=\"";
            // line 16
            echo \WPML\Core\twig_escape_filter($this->env, ($context["install_link"] ?? null), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "install", []), "html", null, true);
            echo "</a>
                </li>
            ";
        } elseif (        // line 18
($context["miss_lang"] ?? null)) {
            // line 19
            echo "                <form method=\"post\" action=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["request_uri"] ?? null), "html", null, true);
            echo "\">
                    ";
            // line 20
            echo $this->getAttribute(($context["nonces"] ?? null), "create_pages", []);
            echo "
                    <input type=\"hidden\" name=\"create_missing_pages\" value=\"1\"/>

                    ";
            // line 23
            if ($this->getAttribute(($context["miss_lang"] ?? null), "lang", [], "any", true, true)) {
                // line 24
                echo "                        <li>
                            <i class=\"otgs-ico-warning\"></i>
                            ";
                // line 26
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "not_exist", []), "html", null, true);
                echo "
                            <ul class=\"wcml-lang-list\">
                                ";
                // line 28
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["miss_lang"] ?? null), "lang", []));
                foreach ($context['_seq'] as $context["_key"] => $context["missed_lang"]) {
                    // line 29
                    echo "                                    <li>
                                        <span class=\"wpml-title-flag\">
                                            <img src=\"";
                    // line 31
                    echo \WPML\Core\twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_flag_url')->getCallable(), [$this->getAttribute($context["missed_lang"], "code", [])]), "html", null, true);
                    echo "\"
                                                 alt=\"";
                    // line 32
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["missed_lang"], "english_name", []));
                    echo "\">
                                        </span>
                                        ";
                    // line 34
                    echo \WPML\Core\twig_escape_filter($this->env, \WPML\Core\twig_capitalize_string_filter($this->env, $this->getAttribute($context["missed_lang"], "display_name", [])), "html", null, true);
                    echo "
                                    </li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['missed_lang'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                echo "                            </ul>

                            <button class=\"button-secondary aligncenter\" type=\"submit\" name=\"create_pages\">
                                ";
                // line 40
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "create_transl", []), "html", null, true);
                echo "
                            </button>
                        </li>
                    ";
            }
            // line 44
            echo "
                    ";
            // line 45
            if ($this->getAttribute(($context["miss_lang"] ?? null), "in_progress", [], "any", true, true)) {
                // line 46
                echo "                        <li>
                            <i class=\"otgs-ico-in-progress\"></i>
                            ";
                // line 48
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "translated_wpml", []), "html", null, true);
                echo "
                            <ul class=\"wcml-lang-list\">
                                ";
                // line 50
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["miss_lang"] ?? null), "in_progress", []));
                foreach ($context['_seq'] as $context["_key"] => $context["in_progress_pages"]) {
                    // line 51
                    echo "                                    <li>
                                        <span class=\"wpml-title-flag\">";
                    // line 52
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["in_progress_pages"], "page", []), "html", null, true);
                    echo "</span>
                                        <ul class=\"wcml-lang-list\">
                                            ";
                    // line 54
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["in_progress_pages"], "lang", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["miss_in_progress"]) {
                        // line 55
                        echo "                                                <li>
                                                    <span class=\"wpml-title-flag\">
                                                        <img src=\"";
                        // line 57
                        echo \WPML\Core\twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_flag_url')->getCallable(), [$this->getAttribute($context["miss_in_progress"], "code", [])]), "html", null, true);
                        echo "\"
                                                             alt=\"";
                        // line 58
                        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["miss_in_progress"], "english_name", []));
                        echo "\">
                                                    </span>
                                                    ";
                        // line 60
                        echo \WPML\Core\twig_escape_filter($this->env, \WPML\Core\twig_capitalize_string_filter($this->env, $this->getAttribute($context["miss_in_progress"], "display_name", [])), "html", null, true);
                        echo "
                                                </li>
                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['miss_in_progress'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 63
                    echo "                                        </ul>
                                    </li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['in_progress_pages'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 66
                echo "                            </ul>
                        </li>
                    ";
            }
            // line 69
            echo "                </form>
            ";
        } else {
            // line 71
            echo "                <li>
                    <i class=\"otgs-ico-ok\"></i>
                    ";
            // line 73
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "translated", []), "html", null, true);
            echo "
                </li>
            ";
        }
        // line 76
        echo "        </ul>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "store-pages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  209 => 76,  203 => 73,  199 => 71,  195 => 69,  190 => 66,  182 => 63,  173 => 60,  168 => 58,  164 => 57,  160 => 55,  156 => 54,  151 => 52,  148 => 51,  144 => 50,  139 => 48,  135 => 46,  133 => 45,  130 => 44,  123 => 40,  118 => 37,  109 => 34,  104 => 32,  100 => 31,  96 => 29,  92 => 28,  87 => 26,  83 => 24,  81 => 23,  75 => 20,  70 => 19,  68 => 18,  61 => 16,  55 => 13,  51 => 11,  49 => 10,  41 => 5,  37 => 4,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "store-pages.twig", "/home/nhatroca/namdumachine.com/wp-content/plugins/woocommerce-multilingual/templates/status/store-pages.twig");
    }
}

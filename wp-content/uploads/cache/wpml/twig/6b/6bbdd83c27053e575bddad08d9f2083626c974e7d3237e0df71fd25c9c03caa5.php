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

/* products.twig */
class __TwigTemplate_497f6daf597ce74456a4e76df0a7716cdeeced438dcf2be1d49141db2d7f803a extends \WPML\Core\Twig\Template
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
        echo "<form method=\"post\" action=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["request_uri"] ?? null));
        echo "\">

    ";
        // line 3
        echo ($context["auto_translate_container"] ?? null);
        echo "

    ";
        // line 5
        $this->loadTemplate("filter.twig", "products.twig", 5)->display(twig_array_merge($context, ($context["filter"] ?? null)));
        // line 6
        echo "
    <table class=\"widefat fixed wpml-list-table wp-list-table striped\" cellspacing=\"0\">
        <thead>
        <tr>
            <th scope=\"col\" class=\"column-thumb\">
\t\t\t\t\t\t<span class=\"wc-image wcml-tip\"
                              data-tip=\"";
        // line 12
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "image", []));
        echo "\">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "image", []), "html", null, true);
        echo "</span>
            </th>
            <th scope=\"col\" class=\"wpml-col-title ";
        // line 14
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "product_sorted", []), "html", null, true);
        echo "\">
                <a href=\"";
        // line 15
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "product", []));
        echo "\">
                    <span>";
        // line 16
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "product", []), "html", null, true);
        echo "</span>
                    <span class=\"sorting-indicator\"></span>
                </a>
            </th>
            <th scope=\"col\" class=\"wpml-col-languages\">
                ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages_flags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 22
            echo "                    <span title=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "name", []));
            echo "\">
\t\t\t\t\t\t\t<img src=\"";
            // line 23
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag_url", []), "html", null, true);
            echo "\" alt=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "name", []));
            echo "\"/>
\t\t\t\t\t\t</span>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "            </th>
            <th scope=\"col\"
                class=\"column-categories\">";
        // line 28
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "categories", []), "html", null, true);
        echo "</th>
            ";
        // line 29
        if ($this->getAttribute(($context["strings"] ?? null), "type", [])) {
            // line 30
            echo "                <th scope=\"col\" class=\"column-product_type\">
\t\t\t\t\t\t\t<span class=\"wc-type wcml-tip\"
                                  data-tip=\"";
            // line 32
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "type", []));
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "type", []), "html", null, true);
            echo "</span>
                </th>
            ";
        }
        // line 35
        echo "            <th scope=\"col\" id=\"date\" class=\"column-date ";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "date_sorted", []), "html", null, true);
        echo "\">
                <a href=\"";
        // line 36
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "date", []));
        echo "\">
                    <span>";
        // line 37
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "date", []), "html", null, true);
        echo "</span>
                    <span class=\"sorting-indicator\"></span>
                </a>
            </th>
        </tr>
        </thead>

        <tbody>
        ";
        // line 45
        if (twig_test_empty($this->getAttribute(($context["data"] ?? null), "products", []))) {
            // line 46
            echo "            <tr>
                <td colspan=\"6\" class=\"text-center\">
                    <strong>";
            // line 48
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "no_products", []), "html", null, true);
            echo "</strong>
                </td>
            </tr>
        ";
        } else {
            // line 52
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "products", []));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 53
                echo "                <tr>
                    <td class=\"thumb column-thumb\">
                        <a href=\"";
                // line 55
                echo $this->getAttribute($context["product"], "edit_post_link", []);
                echo "\">
                            <img width=\"150\" height=\"150\" src=\"";
                // line 56
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "post_thumbnail", []), "html", null, true);
                echo "\"
                                 class=\"wp-post-image original-image\" data-image-id=\"thumbnail-";
                // line 57
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", []), "html", null, true);
                echo "\">
                        </a>
                    </td>

                    ";
                // line 62
                echo "                    ";
                if ($this->getAttribute($context["product"], "has_image", [])) {
                    // line 63
                    echo "                        <img id=\"thumbnail-";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", []), "html", null, true);
                    echo "\" src=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "post_thumbnail", []), "html", null, true);
                    echo "\" class=\"mouse-hovered\">
                    ";
                }
                // line 65
                echo "
                    <td class=\"wpml-col-title  wpml-col-title-flag\">
                        ";
                // line 67
                if (($this->getAttribute($context["product"], "post_parent", []) != 0)) {
                    echo " &#8212; ";
                }
                // line 68
                echo "                        <strong>
                            ";
                // line 69
                if ( !$this->getAttribute(($context["data"] ?? null), "slang", [])) {
                    // line 70
                    echo "                                <span class=\"wpml-title-flag\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    // line 71
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "orig_flag_url", []), "html", null, true);
                    echo "\"/>
\t\t\t\t\t\t\t\t\t</span>
                            ";
                }
                // line 74
                echo "
                            <a href=\"";
                // line 75
                echo $this->getAttribute($context["product"], "edit_post_link", []);
                echo "\" title=\"";
                echo \WPML\Core\twig_escape_filter($this->env, strip_tags($this->getAttribute($context["product"], "post_title", [])), "html", null, true);
                echo "\">
                                ";
                // line 76
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "post_title", []), "html", null, true);
                echo "
                            </a>

                            ";
                // line 79
                if (($this->getAttribute($context["product"], "post_status", []) == "draft")) {
                    // line 80
                    echo "                                - <span class=\"post-state\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "draft", []), "html", null, true);
                    echo "</span>
                            ";
                }
                // line 82
                echo "
                            ";
                // line 83
                if (($this->getAttribute($context["product"], "post_status", []) == "private")) {
                    // line 84
                    echo "                                - <span class=\"post-state\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "private", []), "html", null, true);
                    echo "</span>
                            ";
                }
                // line 86
                echo "
                            ";
                // line 87
                if (($this->getAttribute($context["product"], "post_status", []) == "pending")) {
                    // line 88
                    echo "                                - <span class=\"post-state\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "pending", []), "html", null, true);
                    echo "</span>
                            ";
                }
                // line 90
                echo "
                            ";
                // line 91
                if (($this->getAttribute($context["product"], "post_status", []) == "future")) {
                    // line 92
                    echo "                                - <span class=\"post-state\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "future", []), "html", null, true);
                    echo "</span>
                            ";
                }
                // line 94
                echo "
                            ";
                // line 95
                if (($this->getAttribute(($context["data"] ?? null), "search", []) && ($this->getAttribute($context["product"], "post_parent", []) != 0))) {
                    // line 96
                    echo "                                | <span class=\"prod_parent_text\">
\t\t\t\t\t\t\t\t\t\t";
                    // line 97
                    echo \WPML\Core\twig_escape_filter($this->env, sprintf($this->getAttribute(($context["strings"] ?? null), "parent", []), $this->getAttribute($context["product"], "parent_title", [])), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t</span>
                            ";
                }
                // line 100
                echo "                        </strong>

                        <div class=\"row-actions\">
\t\t\t\t\t\t\t\t<span class=\"edit\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 104
                echo $this->getAttribute($context["product"], "edit_post_link", []);
                echo "\"
                                       title=\"";
                // line 105
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "edit_item", []));
                echo "\">";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "edit", []), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t</span> | <span class=\"view\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 107
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "view_link", []));
                echo "\"
                                       title=\"";
                // line 108
                echo \WPML\Core\twig_escape_filter($this->env, sprintf($this->getAttribute(($context["strings"] ?? null), "view_link", []), $this->getAttribute($context["product"], "post_title", [])));
                echo "\"
                                       target=\"_blank\">";
                // line 109
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "view", []), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t</span>
                        </div>

                    </td>

                    <td class=\"wpml-col-languages\">
                        ";
                // line 116
                echo $this->getAttribute($context["product"], "translation_statuses", []);
                echo "
                    </td>
                    <td class=\"column-categories\">
                        ";
                // line 119
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["product"], "categories_list", []));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 120
                    echo "                            <a href=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["category"], "href", []));
                    echo "\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", []), "html", null, true);
                    echo "</a>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 122
                echo "                    </td>
                    ";
                // line 123
                if ($this->getAttribute(($context["strings"] ?? null), "type", [])) {
                    // line 124
                    echo "                        <td class=\"column-product_type\">
\t\t\t\t\t\t\t\t<span class=\"product-type wcml-tip ";
                    // line 125
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "icon_class", []));
                    echo "\"
                                      data-tip=\"";
                    // line 126
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "icon_class", []));
                    echo "\"></span>
                        </td>
                    ";
                }
                // line 129
                echo "
                    <td class=\"column-date\">
                        ";
                // line 131
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["product"], "formated_date", []), "html", null, true);
                echo "

                        ";
                // line 133
                if (($this->getAttribute($context["product"], "post_status", []) == "publish")) {
                    // line 134
                    echo "                            <br>";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "published", []), "html", null, true);
                    echo "
                        ";
                } else {
                    // line 136
                    echo "                            <br>";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "modified", []), "html", null, true);
                    echo "
                        ";
                }
                // line 138
                echo "                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 141
            echo "        ";
        }
        // line 142
        echo "        </tbody>
    </table>

    <input type=\"hidden\" id=\"upd_product_nonce\" value=\"";
        // line 145
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["nonces"] ?? null), "upd_product", []));
        echo "\"/>
    <input type=\"hidden\" id=\"get_product_data_nonce\" value=\"";
        // line 146
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["nonces"] ?? null), "get_product_data", []));
        echo "\"/>

    ";
        // line 148
        $this->loadTemplate("pagination.twig", "products.twig", 148)->display(twig_array_merge($context, ($context["pagination"] ?? null)));
        // line 149
        echo "</form>";
    }

    public function getTemplateName()
    {
        return "products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  402 => 149,  400 => 148,  395 => 146,  391 => 145,  386 => 142,  383 => 141,  375 => 138,  369 => 136,  363 => 134,  361 => 133,  356 => 131,  352 => 129,  346 => 126,  342 => 125,  339 => 124,  337 => 123,  334 => 122,  323 => 120,  319 => 119,  313 => 116,  303 => 109,  299 => 108,  295 => 107,  288 => 105,  284 => 104,  278 => 100,  272 => 97,  269 => 96,  267 => 95,  264 => 94,  258 => 92,  256 => 91,  253 => 90,  247 => 88,  245 => 87,  242 => 86,  236 => 84,  234 => 83,  231 => 82,  225 => 80,  223 => 79,  217 => 76,  211 => 75,  208 => 74,  202 => 71,  199 => 70,  197 => 69,  194 => 68,  190 => 67,  186 => 65,  178 => 63,  175 => 62,  168 => 57,  164 => 56,  160 => 55,  156 => 53,  151 => 52,  144 => 48,  140 => 46,  138 => 45,  127 => 37,  123 => 36,  118 => 35,  110 => 32,  106 => 30,  104 => 29,  100 => 28,  96 => 26,  85 => 23,  80 => 22,  76 => 21,  68 => 16,  64 => 15,  60 => 14,  53 => 12,  45 => 6,  43 => 5,  38 => 3,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "products.twig", "/home/nhatroca/namdumachine.com/wp-content/plugins/woocommerce-multilingual/templates/products-list/products.twig");
    }
}

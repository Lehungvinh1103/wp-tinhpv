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

/* menus-wrap.twig */
class __TwigTemplate_068141ff61b505f31e3b5de10fc02e81413483a3ed7b43f97543ad31003d4135 extends \WPML\Core\Twig\Template
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
        echo "<div class=\"wrap\">
    <h1>";
        // line 2
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "title", []), "html", null, true);
        echo "</h1>
    <nav class=\"wcml-tabs wpml-tabs\">
        <a class=\"nav-tab ";
        // line 4
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "products", []), "active", []), "html", null, true);
        echo "\" href=\"";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "products", []), "url", []), "html", null, true);
        echo "\">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "products", []), "title", []), "html", null, true);
        echo "</a>
        ";
        // line 5
        if (($context["can_operate_options"] ?? null)) {
            // line 6
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["menu"] ?? null), "taxonomies", []));
            foreach ($context['_seq'] as $context["key"] => $context["taxonomy"]) {
                // line 7
                echo "                ";
                if ($this->getAttribute($context["taxonomy"], "is_translatable", [])) {
                    // line 8
                    echo "                    <a class=\"js-tax-tab-";
                    echo \WPML\Core\twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo " nav-tab ";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["taxonomy"], "active", []), "html", null, true);
                    echo "\" href=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["taxonomy"], "url", []), "html", null, true);
                    echo "\"
                       title=\"";
                    // line 9
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["taxonomy"], "title", []), "html", null, true);
                    echo "\">
                        ";
                    // line 10
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["taxonomy"], "name", []), "html", null, true);
                    echo "
                        ";
                    // line 11
                    if (($this->getAttribute($context["taxonomy"], "translated", []) == false)) {
                        echo "<i class=\"otgs-ico-warning\"></i>";
                    }
                    // line 12
                    echo "                    </a>
                ";
                }
                // line 14
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['taxonomy'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "            ";
            if ($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "custom_taxonomies", []), "show", [])) {
                // line 16
                echo "                <a class=\"nav-tab tax-custom-taxonomies ";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "custom_taxonomies", []), "active", []), "html", null, true);
                echo "\"
                   href=\"";
                // line 17
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "custom_taxonomies", []), "url", []), "html", null, true);
                echo "\">
                    ";
                // line 18
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "custom_taxonomies", []), "name", []), "html", null, true);
                echo "
                    ";
                // line 19
                if (($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "custom_taxonomies", []), "translated", []) == false)) {
                    echo "<i class=\"otgs-ico-warning\"></i>";
                }
                // line 20
                echo "                </a>
            ";
            }
            // line 22
            echo "            <a class=\"nav-tab tax-product-attributes ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "attributes", []), "active", []), "html", null, true);
            echo "\" href=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "attributes", []), "url", []), "html", null, true);
            echo "\">
                ";
            // line 23
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "attributes", []), "name", []), "html", null, true);
            echo "
                ";
            // line 24
            if (($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "attributes", []), "translated", []) == false)) {
                echo "<i class=\"otgs-ico-warning\"></i>";
            }
            // line 25
            echo "            </a>
            ";
            // line 26
            if ($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "is_translatable", [])) {
                // line 27
                echo "                <a class=\"js-tax-tab-product_shipping_class nav-tab ";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "active", []), "html", null, true);
                echo "\"
                   href=\"";
                // line 28
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "url", []), "html", null, true);
                echo "\"
                   title=\"";
                // line 29
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "title", []), "html", null, true);
                echo "\">";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "name", []), "html", null, true);
                echo "
                    ";
                // line 30
                if (($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "shipping_classes", []), "translated", []) == false)) {
                    echo "<i class=\"otgs-ico-warning\"></i>";
                }
                // line 31
                echo "                </a>
            ";
            }
            // line 33
            echo "        ";
        }
        // line 34
        echo "
        ";
        // line 35
        if (($context["can_manage_options"] ?? null)) {
            // line 36
            echo "            <a class=\"nav-tab ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "settings", []), "active", []), "html", null, true);
            echo "\" href=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "settings", []), "url", []), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "settings", []), "name", []), "html", null, true);
            echo "</a>
        ";
        }
        // line 38
        echo "        ";
        if (($context["can_operate_options"] ?? null)) {
            // line 39
            echo "            <a class=\"nav-tab ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "multi_currency", []), "active", []), "html", null, true);
            echo "\"
               href=\"";
            // line 40
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "multi_currency", []), "url", []), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "multi_currency", []), "name", []), "html", null, true);
            echo "</a>
            <a class=\"nav-tab ";
            // line 41
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "slugs", []), "active", []), "html", null, true);
            echo "\" href=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "slugs", []), "url", []), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "slugs", []), "name", []), "html", null, true);
            echo "</a>
        ";
        }
        // line 43
        echo "        ";
        if (($context["can_manage_options"] ?? null)) {
            // line 44
            echo "            <a class=\"nav-tab ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "status", []), "active", []), "html", null, true);
            echo "\" href=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "status", []), "url", []), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "status", []), "name", []), "html", null, true);
            echo "</a>
            ";
            // line 45
            if ($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "troubleshooting", []), "active", [])) {
                // line 46
                echo "                <a class=\"nav-tab troubleshooting ";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "troubleshooting", []), "active", []), "html", null, true);
                echo "\"
                   href=\"";
                // line 47
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "troubleshooting", []), "url", []), "html", null, true);
                echo "\">";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["menu"] ?? null), "troubleshooting", []), "name", []), "html", null, true);
                echo "</a>
            ";
            }
            // line 49
            echo "        ";
        }
        // line 50
        echo "    </nav>

    <div class=\"wcml-wrap\">
        ";
        // line 53
        echo ($context["content"] ?? null);
        echo "
    </div>

    ";
        // line 56
        if ($this->getAttribute(($context["rate"] ?? null), "on", [])) {
            // line 57
            echo "        <div class=\"wcml-wrap wcml-notice otgs-is-dismissible\">
            <p>";
            // line 58
            echo $this->getAttribute(($context["rate"] ?? null), "message", []);
            echo "</p>
            <button class=\"notice-dismiss hide-rate-block\" data-setting=\"rate-block\">
                <span class=\"screen-reader-text\">";
            // line 60
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["rate"] ?? null), "hide_text", []), "html", null, true);
            echo "</span>
            </button>
            ";
            // line 62
            echo $this->getAttribute(($context["rate"] ?? null), "nonce", []);
            echo "
        </div>
    ";
        }
        // line 65
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "menus-wrap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  258 => 65,  252 => 62,  247 => 60,  242 => 58,  239 => 57,  237 => 56,  231 => 53,  226 => 50,  223 => 49,  216 => 47,  211 => 46,  209 => 45,  200 => 44,  197 => 43,  188 => 41,  182 => 40,  177 => 39,  174 => 38,  164 => 36,  162 => 35,  159 => 34,  156 => 33,  152 => 31,  148 => 30,  142 => 29,  138 => 28,  133 => 27,  131 => 26,  128 => 25,  124 => 24,  120 => 23,  113 => 22,  109 => 20,  105 => 19,  101 => 18,  97 => 17,  92 => 16,  89 => 15,  83 => 14,  79 => 12,  75 => 11,  71 => 10,  67 => 9,  58 => 8,  55 => 7,  50 => 6,  48 => 5,  40 => 4,  35 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "menus-wrap.twig", "/home/nhatroca/namdumachine.com/wp-content/plugins/woocommerce-multilingual/templates/menus-wrap.twig");
    }
}

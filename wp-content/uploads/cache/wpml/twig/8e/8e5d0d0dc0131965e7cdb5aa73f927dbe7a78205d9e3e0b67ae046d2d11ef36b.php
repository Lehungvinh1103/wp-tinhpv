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

/* pagination.twig */
class __TwigTemplate_6ee02e2890f0f2e850d9f89685cda07061b089bfc1f41815369fb52bc20895de extends \WPML\Core\Twig\Template
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
        if (($context["display"] ?? null)) {
            // line 2
            echo "    <div class=\"tablenav bottom clearfix\">
        <div class=\"tablenav-pages\">
            <span class=\"displaying-num\">";
            // line 4
            echo \WPML\Core\twig_escape_filter($this->env, sprintf($this->getAttribute(($context["strings"] ?? null), "items", []), ($context["products_count"] ?? null)), "html", null, true);
            echo "</span>
            <span class=\"pagination-links\">
\t\t\t\t";
            // line 6
            if (($context["show"] ?? null)) {
                // line 7
                echo "                    <a class=\"first-page ";
                if ((($context["pn"] ?? null) == 1)) {
                    echo " disabled ";
                }
                echo "\"
                       href=\"";
                // line 8
                echo \WPML\Core\twig_escape_filter($this->env, ($context["pagination_first"] ?? null), "html", null, true);
                echo "\"
                       title=\"";
                // line 9
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "first", []));
                echo "\">&laquo;</a>

                    <a class=\"prev-page ";
                // line 11
                if ((($context["pn"] ?? null) == 1)) {
                    echo " disabled ";
                }
                echo "\"
                       href=\"";
                // line 12
                echo \WPML\Core\twig_escape_filter($this->env, ($context["pagination_prev"] ?? null), "html", null, true);
                echo "\"
                       title=\"";
                // line 13
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "previous", []));
                echo "\">&lsaquo;</a>

                    <span class=\"paging-input\">
\t\t\t\t\t\t<label for=\"current-page-selector\" class=\"screen-reader-text\">
\t\t\t\t\t\t\t";
                // line 17
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "select", []), "html", null, true);
                echo "
\t\t\t\t\t\t</label>
\t\t\t\t\t\t<input class=\"current-page\" id=\"current-page-selector\"
                               title=\"";
                // line 20
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "current", []));
                echo "\"
                               type=\"text\" name=\"paged\" value=\"";
                // line 21
                echo \WPML\Core\twig_escape_filter($this->env, ($context["pn"] ?? null), "html", null, true);
                echo "\" size=\"2\">
\t\t\t\t\t\t&nbsp;";
                // line 22
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "of", []), "html", null, true);
                echo "&nbsp;
\t\t\t\t\t\t<span class=\"total-pages\">";
                // line 23
                echo \WPML\Core\twig_escape_filter($this->env, ($context["last"] ?? null), "html", null, true);
                echo "</span>
\t\t\t\t\t</span>

                    <a class=\"next-page ";
                // line 26
                if ((($context["pn"] ?? null) == ($context["last"] ?? null))) {
                    echo " disabled ";
                }
                echo "\"
                       href=\"";
                // line 27
                echo \WPML\Core\twig_escape_filter($this->env, ($context["pagination_next"] ?? null), "html", null, true);
                echo "\"
                       title=\"";
                // line 28
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "next", []));
                echo "\">&rsaquo;</a>

                    <a class=\"last-page ";
                // line 30
                if ((($context["pn"] ?? null) == ($context["last"] ?? null))) {
                    echo " disabled ";
                }
                echo "\"
                       href=\"";
                // line 31
                echo \WPML\Core\twig_escape_filter($this->env, ($context["pagination_last"] ?? null), "html", null, true);
                echo "\"
                       title=\"";
                // line 32
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "last", []));
                echo "\">&raquo;</a>
                ";
            }
            // line 34
            echo "\t\t\t</span>
        </div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "pagination.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 34,  127 => 32,  123 => 31,  117 => 30,  112 => 28,  108 => 27,  102 => 26,  96 => 23,  92 => 22,  88 => 21,  84 => 20,  78 => 17,  71 => 13,  67 => 12,  61 => 11,  56 => 9,  52 => 8,  45 => 7,  43 => 6,  38 => 4,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "pagination.twig", "/home/nhatroca/namdumachine.com/wp-content/plugins/woocommerce-multilingual/templates/products-list/pagination.twig");
    }
}

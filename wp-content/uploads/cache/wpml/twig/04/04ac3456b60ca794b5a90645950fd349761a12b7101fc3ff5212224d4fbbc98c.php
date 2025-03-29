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

/* custom-files.twig */
class __TwigTemplate_ab0f14aa30b60df4ff71b08c7d3a580ce26b918ee7bc0df300dacfa9475f1374 extends \WPML\Core\Twig\Template
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
        if (($context["is_variation"] ?? null)) {
            // line 2
            echo "<tr>
    <td>
        ";
        }
        // line 5
        echo "
        <div class=\"wcml-downloadable-options\">

            <input type=\"checkbox\" name=\"wcml_file_path_option[";
        // line 8
        echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\"
                   id=\"wcml_file_path_option\" ";
        // line 9
        if (($context["sync_custom"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " />
            <label for=\"wcml_file_path_option\">";
        // line 10
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "use_custom", []), "html", null, true);
        echo "</label>

            <ul ";
        // line 12
        if (twig_test_empty(($context["sync_custom"] ?? null))) {
            echo " style=\"display: none\"";
        }
        echo ">
                <li>
                    <input type=\"radio\" name=\"wcml_file_path_sync[";
        // line 14
        echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\" value=\"auto\"
                            ";
        // line 15
        if (((($context["sync_custom"] ?? null) == "auto") || twig_test_empty(($context["sync_custom"] ?? null)))) {
            echo " checked=\"checked\"";
        }
        // line 16
        echo "                           id=\"wcml_file_path_sync_auto\"/>
                    <label for=\"wcml_file_path_sync_auto\">";
        // line 17
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "use_same", []), "html", null, true);
        echo "</label>
                </li>
                <li>
                    <input type=\"radio\" name=\"wcml_file_path_sync[";
        // line 20
        echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\" value=\"self\"
                            ";
        // line 21
        if ((($context["sync_custom"] ?? null) == "self")) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_file_path_sync_self\"/>
                    <label for=\"wcml_file_path_sync_self\">";
        // line 22
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "separate", []), "html", null, true);
        echo "</label>
                </li>
            </ul>
            <p></p>
            ";
        // line 26
        echo ($context["nonce"] ?? null);
        echo "
        </div>

        ";
        // line 29
        if (($context["is_variation"] ?? null)) {
            // line 30
            echo "    </td>
</tr>
";
        }
    }

    public function getTemplateName()
    {
        return "custom-files.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 30,  106 => 29,  100 => 26,  93 => 22,  87 => 21,  83 => 20,  77 => 17,  74 => 16,  70 => 15,  66 => 14,  59 => 12,  54 => 10,  48 => 9,  44 => 8,  39 => 5,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom-files.twig", "/home/nhatroca/namdumachine.com/wp-content/plugins/woocommerce-multilingual/templates/custom-files.twig");
    }
}

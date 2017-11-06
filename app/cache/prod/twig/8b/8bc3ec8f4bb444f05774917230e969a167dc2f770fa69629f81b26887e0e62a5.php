<?php

/* PrestaShopBundle:Admin/Product/Include:form_custom_fields.html.twig */
class __TwigTemplate_374d4a175182a50e00c19d42e221205a86e52de04f04982629eefccfced74242 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 25
        echo "<div class=\"row\">
    ";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "id_customization_field", array()), 'widget');
        echo "
  <div class=\"col-md-3\">
    <fieldset class=\"form-group\">
      <label class=\"form-control-label\">";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "label", array()), "vars", array()), "label", array()), "html", null, true);
        echo "</label>
      ";
        // line 30
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "label", array()), 'errors');
        echo "
      ";
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "label", array()), 'widget');
        echo "
    </fieldset>
  </div>
  <div class=\"col-md-3\">
    <fieldset class=\"form-group\">
      <label class=\"form-control-label\">";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "type", array()), "vars", array()), "label", array()), "html", null, true);
        echo "</label>
      ";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "type", array()), 'errors');
        echo "
      ";
        // line 38
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "type", array()), 'widget');
        echo "
    </fieldset>
  </div>
  <div class=\"col-md-1\">
    <fieldset class=\"form-group\">
      <label class=\"form-control-label\">&nbsp;</label>
      <a class=\"btn btn-block delete\" ><i class=\"material-icons\">delete</i></a>
    </fieldset>
  </div>
  <div class=\"col-md-4\">
    <fieldset class=\"form-group\">
      <div>
        <label class=\"form-control-label\">&nbsp;</label>
      </div>
      <div class=\"required-custom-field\">
        ";
        // line 53
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "require", array()), 'widget', array("switch" => "tiny"));
        echo "
      </div>
    </fieldset>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "PrestaShopBundle:Admin/Product/Include:form_custom_fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 53,  52 => 38,  48 => 37,  44 => 36,  36 => 31,  32 => 30,  28 => 29,  22 => 26,  19 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "PrestaShopBundle:Admin/Product/Include:form_custom_fields.html.twig", "C:\\xampp\\htdocs\\mebooks\\src\\PrestaShopBundle/Resources/views/Admin/Product/Include/form_custom_fields.html.twig");
    }
}

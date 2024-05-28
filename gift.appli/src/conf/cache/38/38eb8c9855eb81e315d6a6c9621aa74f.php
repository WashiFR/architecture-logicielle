<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* FormNewBoxView.twig */
class __TwigTemplate_855880847208c3d036256fae19e948f3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "SkeletonView.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("SkeletonView.twig", "FormNewBoxView.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "    <h1>Créer une nouvelle Box</h1>
    <form action=\"../box/create\" method=\"post\">
        <label for=\"libelle\">Libellé</label>
        <input type=\"text\" name=\"libelle\" id=\"libelle\">
        <label for=\"description\">Description</label>
        <textarea name=\"description\" id=\"description\"></textarea>
        <label for=\"montant\">Montant</label>
        <input type=\"number\" name=\"montant\" id=\"montant\">
        <button type=\"submit\">Créer</button>
    </form>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "FormNewBoxView.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "FormNewBoxView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\FormNewBoxView.twig");
    }
}
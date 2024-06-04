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

/* FormNewCategorieView.twig */
class __TwigTemplate_6e5be28b71340acf41a13dfc7c925409 extends Template
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
        $this->parent = $this->loadTemplate("SkeletonView.twig", "FormNewCategorieView.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "    <h1>Créer une nouvelle catégorie</h1>
    <form action=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categories.create"), "html", null, true);
        yield "\" method=\"post\">
        <label for=\"libelle\">Libellé</label>
        <input type=\"text\" name=\"libelle\" id=\"libelle\">
        <label for=\"description\">Description</label>
        <textarea name=\"description\" id=\"description\"></textarea>
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
        return "FormNewCategorieView.twig";
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
        return array (  54 => 5,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "FormNewCategorieView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\FormNewCategorieView.twig");
    }
}

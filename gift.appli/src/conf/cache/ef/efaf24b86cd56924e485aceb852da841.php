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

/* HeaderView.twig */
class __TwigTemplate_01ee2221382ef0a0db122ab38f50e76a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        yield "<header>
    <h1>Gift Appli</h1>
    <nav>
        <ul>
            <li><a href=";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("home"), "html", null, true);
        yield ">Accueil</a></li>
            <li><a href=";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categories"), "html", null, true);
        yield ">Catégories</a></li>
            <li><a href=";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestations"), "html", null, true);
        yield ">Prestations</a></li>
            ";
        // line 8
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["globals"] ?? null), "user_role", [], "any", false, false, false, 8) == 100)) {
            // line 9
            yield "                <li><a href=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categories.create"), "html", null, true);
            yield ">Créer Catégorie</a></li>
            ";
        }
        // line 11
        yield "            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["globals"] ?? null), "user_role", [], "any", false, false, false, 11) == null)) {
            // line 12
            yield "                <li><a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("signin"), "html", null, true);
            yield "\">Se connecter</a></li>
            ";
        } else {
            // line 14
            yield "                <li><a href=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("box.create"), "html", null, true);
            yield ">Créer Box</a></li>
                <li><a href=";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("boxes"), "html", null, true);
            yield ">Mes Box</a></li>
                <li><a href=\"";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("signout"), "html", null, true);
            yield "\">Se déconnecter</a></li>
            ";
        }
        // line 18
        yield "        </ul>
    </nav>
</header>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "HeaderView.twig";
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
        return array (  87 => 18,  82 => 16,  78 => 15,  73 => 14,  67 => 12,  64 => 11,  58 => 9,  56 => 8,  52 => 7,  48 => 6,  44 => 5,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "HeaderView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\HeaderView.twig");
    }
}

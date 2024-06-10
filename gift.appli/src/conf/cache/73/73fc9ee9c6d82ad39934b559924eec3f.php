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

/* PrestationByIdView.twig */
class __TwigTemplate_cef3efd1481f848604596a644d933474 extends Template
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
        $this->parent = $this->loadTemplate("SkeletonView.twig", "PrestationByIdView.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["prestations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["prestation"]) {
            // line 5
            yield "        <h1>Prestation : ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "libelle", [], "any", false, false, false, 5), "html", null, true);
            yield "</h1>
        ";
            // line 6
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["globals"] ?? null), "user_role", [], "any", false, false, false, 6) == 100)) {
                // line 7
                yield "            <p><a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["edit"] ?? null), "url", [], "any", false, false, false, 7), "html", null, true);
                yield "\">Modifier</a></p>
        ";
            }
            // line 9
            yield "        <p>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "description", [], "any", false, false, false, 9), "html", null, true);
            yield "</p>
        <ul>
            <li>Unite : ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "unite", [], "any", false, false, false, 11), "html", null, true);
            yield "</li>
            <li>Tarif : ";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "tarif", [], "any", false, false, false, 12), "html", null, true);
            yield "€</li>
        </ul>
        <h2>Catégorie : <a href=\"";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["categorie"] ?? null), "url", [], "any", false, false, false, 14), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["categorie"] ?? null), "libelle", [], "any", false, false, false, 14), "html", null, true);
            yield "</a></h2>
        ";
            // line 15
            if ((($context["box_id"] ?? null) != null)) {
                // line 16
                yield "            <form action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestation.addToBox"), "html", null, true);
                yield "\" method=\"post\">
                <input type=\"hidden\" name=\"presta_id\" value=\"";
                // line 17
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "id", [], "any", false, false, false, 17), "html", null, true);
                yield "\">
                <input type=\"hidden\" name=\"box_id\" value=\"";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["box_id"] ?? null), "html", null, true);
                yield "\">
                <button type=\"submit\">Ajouter à la box</button>
            </form>
        ";
            }
            // line 22
            yield "        <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["globals"] ?? null), "img_dir", [], "any", false, false, false, 22), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prestation"], "img", [], "any", false, false, false, 22), "html", null, true);
            yield "\">
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prestation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "PrestationByIdView.twig";
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
        return array (  108 => 22,  101 => 18,  97 => 17,  92 => 16,  90 => 15,  84 => 14,  79 => 12,  75 => 11,  69 => 9,  63 => 7,  61 => 6,  56 => 5,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "PrestationByIdView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\PrestationByIdView.twig");
    }
}

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

/* EditPrestationView.twig */
class __TwigTemplate_7853c1394ebe28adc5bfb29405a32522 extends Template
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
        $this->parent = $this->loadTemplate("SkeletonView.twig", "EditPrestationView.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "    <h1>Modifier la prestation ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["prestation"] ?? null), "libelle", [], "any", false, false, false, 4), "html", null, true);
        yield " </h1>
    <form action=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["edit"] ?? null), "url", [], "any", false, false, false, 5), "html", null, true);
        yield "\" method=\"post\">
        <label for=\"libelle\">Libellé</label>
        <input type=\"text\" name=\"libelle\" id=\"libelle\" value=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["prestation"] ?? null), "libelle", [], "any", false, false, false, 7), "html", null, true);
        yield "\">
        <label for=\"description\">Description</label>
        <textarea name=\"description\" id=\"description\">
            ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["prestation"] ?? null), "description", [], "any", false, false, false, 10), "html", null, true);
        yield "
        </textarea>
        <label for=\"tarif\">Tarif</label>
        <input type=\"number\" name=\"tarif\" id=\"tarif\" value=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["prestation"] ?? null), "tarif", [], "any", false, false, false, 13), "html", null, true);
        yield "\">
        <label for=\"cat_id\">Catégorie</label>
        <select name=\"cat_id\" id=\"cat_id\">
            ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["categorie"]) {
            // line 17
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 17), "html", null, true);
            yield "\" ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 17) == CoreExtension::getAttribute($this->env, $this->source, ($context["prestation"] ?? null), "cat_id", [], "any", false, false, false, 17))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "libelle", [], "any", false, false, false, 17), "html", null, true);
            yield "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['categorie'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        yield "        </select>
        <button type=\"submit\">Modifier</button>
    </form>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "EditPrestationView.twig";
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
        return array (  98 => 19,  83 => 17,  79 => 16,  73 => 13,  67 => 10,  61 => 7,  56 => 5,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "EditPrestationView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\EditPrestationView.twig");
    }
}

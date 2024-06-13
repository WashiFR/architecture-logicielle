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
class __TwigTemplate_f1ecdc28ce99f14ba0d69b9d671e9583 extends Template
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
        // line 4
        yield "    <h1>Créer une nouvelle Box</h1>
    <form action=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("box.create"), "html", null, true);
        yield "\" method=\"post\">
        <label for=\"libelle\">Libellé</label>
        <input type=\"text\" name=\"libelle\" id=\"libelle\">
        <label for=\"description\">Description</label>
        <textarea name=\"description\" id=\"description\"></textarea>
        <label for=\"kdo\">KDO</label>
        <input type=\"checkbox\" name=\"kdo\" id=\"kdo\" value=\"1\">
        <div id=\"message_kdo_container\" style=\"display: none\">
            <label for=\"message_kdo\">Message KDO</label>
            <textarea name=\"message_kdo\" id=\"message_kdo\"></textarea>
        </div>
        <input type=\"hidden\" name=\"csrf\" value=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf"] ?? null), "html", null, true);
        yield "\">
        <button type=\"submit\">Créer</button>
    </form>

    <script>
        document.getElementById('kdo').addEventListener('change', function() {
            document.getElementById('message_kdo_container').style.display = this.checked ? 'block' : 'none';
        });
    </script>
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
        return array (  68 => 16,  54 => 5,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "FormNewBoxView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\FormNewBoxView.twig");
    }
}

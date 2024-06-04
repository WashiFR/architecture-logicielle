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

/* FooterView.twig */
class __TwigTemplate_6086b130bee905ef22e9d45f095c1283 extends Template
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
        yield "<footer>
    <p>JEANDIDIER Clément - SZEZCPANSKI Gaëtan - WEIER Loris</p>
</footer>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "FooterView.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array ();
    }

    public function getSourceContext()
    {
        return new Source("", "FooterView.twig", "C:\\wamp64\\www\\gift.appli\\src\\app\\views\\FooterView.twig");
    }
}

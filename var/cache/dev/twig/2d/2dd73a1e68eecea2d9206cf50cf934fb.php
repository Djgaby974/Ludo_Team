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
use Twig\TemplateWrapper;

/* base.html.twig */
class __TwigTemplate_fb8e4008109a4336f40ad21b181f7ae6 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'navbar' => [$this, 'block_navbar'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    
    ";
        // line 9
        yield "    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    
    ";
        // line 12
        yield "    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\" rel=\"stylesheet\">
    
    ";
        // line 15
        yield "    <link href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/app.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    
    ";
        // line 17
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 21
        yield "</head>
<body>
    ";
        // line 23
        yield from $this->unwrap()->yieldBlock('navbar', $context, $blocks);
        // line 78
        yield "
    ";
        // line 79
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 79, $this->source); })()), "flashes", [], "any", false, false, false, 79));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 80
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 81
                yield "            <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["type"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
                ";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['type'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        yield "
    ";
        // line 88
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 89
        yield "
    <footer class=\"footer mt-auto py-3 bg-light\">
        <div class=\"container text-center\">
            <span class=\"text-muted\"> 2025 LudoTeam - Tous droits réservés</span>
        </div>
    </footer>

    ";
        // line 97
        yield "    <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js\"></script>
    
    ";
        // line 101
        yield "    <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/app.js"), "html", null, true);
        yield "\"></script>
    
    ";
        // line 103
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 107
        yield "</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "LudoTeam";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 18
        yield "        ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('encore_entry_link_tags')->getCallable()("app"), "html", null, true);
        yield "
        <link rel=\"stylesheet\" href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/form-validation.css"), "html", null, true);
        yield "\">
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_navbar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar"));

        // line 24
        yield "        ";
        if ((!CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "request", [], "any", false, false, false, 24), "attributes", [], "any", false, false, false, 24), "get", ["_route"], "method", false, false, false, 24), ["app_login", "app_register"]) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "user", [], "any", false, false, false, 24))) {
            // line 25
            yield "        <nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
            <div class=\"container-fluid\">
                <a class=\"navbar-brand\" href=\"";
            // line 27
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
            yield "\">
                    <i class=\"fas fa-dice\"></i> LudoTeam
                </a>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                    <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 36
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
            yield "\">
                                <i class=\"fas fa-home me-1\"></i>Accueil
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 41
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_index");
            yield "\">
                                <i class=\"fas fa-calendar-alt me-1\"></i>Événements
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 46
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_game_index");
            yield "\">
                                <i class=\"fas fa-gamepad me-1\"></i>Jeux
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 51
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_search_events");
            yield "\">
                                <i class=\"fas fa-search me-1\"></i>Rechercher des événements
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 56
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_api_events");
            yield "\">
                                <i class=\"fas fa-code me-1\"></i>API Événements
                            </a>
                        </li>
                    </ul>
                    <div class=\"d-flex align-items-center\">
                        <div class=\"dropdown\">
                            <a href=\"#\" class=\"dropdown-toggle text-decoration-none\" id=\"userDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                ";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 64, $this->source); })()), "user", [], "any", false, false, false, 64), "prenom", [], "any", false, false, false, 64), "html", null, true);
            yield "
                            </a>
                            <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userDropdown\">
                                <li><a class=\"dropdown-item\" href=\"";
            // line 67
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
            yield "\">Mon profil</a></li>
                                <li><hr class=\"dropdown-divider\"></li>
                                <li><a class=\"dropdown-item\" href=\"";
            // line 69
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        ";
        }
        // line 77
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 103
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 104
        yield "        ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('encore_entry_script_tags')->getCallable()("app"), "html", null, true);
        yield "
        <script src=\"";
        // line 105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/form-validation.js"), "html", null, true);
        yield "\"></script>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  362 => 105,  357 => 104,  344 => 103,  322 => 88,  311 => 77,  300 => 69,  295 => 67,  289 => 64,  278 => 56,  270 => 51,  262 => 46,  254 => 41,  246 => 36,  234 => 27,  230 => 25,  227 => 24,  214 => 23,  201 => 19,  196 => 18,  183 => 17,  160 => 6,  147 => 107,  145 => 103,  139 => 101,  134 => 97,  125 => 89,  123 => 88,  120 => 87,  114 => 86,  104 => 82,  99 => 81,  94 => 80,  90 => 79,  87 => 78,  85 => 23,  81 => 21,  79 => 17,  73 => 15,  69 => 12,  65 => 9,  60 => 6,  53 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{% block title %}LudoTeam{% endblock %}</title>
    
    {# Bootstrap CSS #}
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    
    {# Font Awesome #}
    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\" rel=\"stylesheet\">
    
    {# Custom CSS #}
    <link href=\"{{ asset('css/app.css') }}\" rel=\"stylesheet\">
    
    {% block stylesheets %}
        {{ encore_entry_link_tags('app') }}
        <link rel=\"stylesheet\" href=\"{{ asset('css/form-validation.css') }}\">
    {% endblock %}
</head>
<body>
    {% block navbar %}
        {% if app.request.attributes.get('_route') not in ['app_login', 'app_register'] and app.user %}
        <nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
            <div class=\"container-fluid\">
                <a class=\"navbar-brand\" href=\"{{ path('app_home') }}\">
                    <i class=\"fas fa-dice\"></i> LudoTeam
                </a>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                    <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ path('app_home') }}\">
                                <i class=\"fas fa-home me-1\"></i>Accueil
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ path('app_event_index') }}\">
                                <i class=\"fas fa-calendar-alt me-1\"></i>Événements
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ path('app_game_index') }}\">
                                <i class=\"fas fa-gamepad me-1\"></i>Jeux
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ path('app_search_events') }}\">
                                <i class=\"fas fa-search me-1\"></i>Rechercher des événements
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ path('app_api_events') }}\">
                                <i class=\"fas fa-code me-1\"></i>API Événements
                            </a>
                        </li>
                    </ul>
                    <div class=\"d-flex align-items-center\">
                        <div class=\"dropdown\">
                            <a href=\"#\" class=\"dropdown-toggle text-decoration-none\" id=\"userDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                {{ app.user.prenom }}
                            </a>
                            <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userDropdown\">
                                <li><a class=\"dropdown-item\" href=\"{{ path('app_profile') }}\">Mon profil</a></li>
                                <li><hr class=\"dropdown-divider\"></li>
                                <li><a class=\"dropdown-item\" href=\"{{ path('app_logout') }}\">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {% endif %}
    {% endblock %}

    {% for type, messages in app.flashes %}
        {% for message in messages %}
            <div class=\"alert alert-{{ type }} alert-dismissible fade show\" role=\"alert\">
                {{ message }}
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        {% endfor %}
    {% endfor %}

    {% block body %}{% endblock %}

    <footer class=\"footer mt-auto py-3 bg-light\">
        <div class=\"container text-center\">
            <span class=\"text-muted\"> 2025 LudoTeam - Tous droits réservés</span>
        </div>
    </footer>

    {# Bootstrap JS et dépendances #}
    <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js\"></script>
    
    {# Custom JS #}
    <script src=\"{{ asset('js/app.js') }}\"></script>
    
    {% block javascripts %}
        {{ encore_entry_script_tags('app') }}
        <script src=\"{{ asset('js/form-validation.js') }}\"></script>
    {% endblock %}
</body>
</html>
", "base.html.twig", "C:\\wamp64\\www\\LudoTeam\\templates\\base.html.twig");
    }
}

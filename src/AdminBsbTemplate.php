<?php

namespace LaraSpells\Template\AdminBsb;

use LaraSpells\Generator\Commands\SchemaBasedCommand;
use LaraSpells\Generator\Generators\ControllerGenerator;
use LaraSpells\Generator\Generators\ViewCreateGenerator;
use LaraSpells\Generator\Generators\ViewEditGenerator;
use LaraSpells\Generator\Schema\Table;
use LaraSpells\Generator\Template;
use LaraSpells\Template\AdminBsb\Generators\FormModelControllerGenerator;
use LaraSpells\Template\AdminBsb\Generators\FormModelViewCreateGenerator;
use LaraSpells\Template\AdminBsb\Generators\FormModelViewEditGenerator;

class AdminBsbTemplate extends Template
{

    protected $authController = 'AuthController';
    protected $dashboardController = 'DashboardController';

    public function __construct(SchemaBasedCommand $command)
    {
        parent::__construct($command);
        $this->directory = realpath(__DIR__);
    }

    public function getSchemaResolver()
    {
        return new SchemaResolver;
    }

    public function beforeGenerateEachCrud(Table $table)
    {
        if (true === $table->get('form_model')) {
            $this->setGeneratorInstance(ControllerGenerator::class, new FormModelControllerGenerator($table));
            $this->setGeneratorInstance(ViewCreateGenerator::class, new FormModelViewCreateGenerator($table));
            $this->setGeneratorInstance(ViewEditGenerator::class, new FormModelViewEditGenerator($table));
        }
    }

    public function beforeGenerateCruds(array $tables)
    {
        $routeName = $this->getSchema()->getRouteName();
        $this->addConfigMenu($routeName.'dashboard', 'Dashboard', ['icon' => 'dashboard']);
        $this->addAuthRoutes();
        $this->addDashboardRoute();
        $this->generateAuthController();
        $this->generateDashboardController();
    }

    public function beforeReports()
    {
        // Write form-model configuration file if not exists
        $hasFormModel = (bool) array_filter($this->getSchema()->getTables(), function($table) {
            return (bool) $table->get('form_model');
        });

        $configPath = 'config/form-model.php';
        if ($hasFormModel && !$this->hasFile($configPath)) {
            $stub = file_get_contents(__DIR__.'/stubs/config.form-model.stub');
            $viewNamespace = $this->getSchema()->getViewNamespace();
            $configContent = $this->renderStub($stub, [
                'view_namespace' => $viewNamespace ? $viewNamespace.'::' : ''
            ]);
            $this->generateFile($configPath, $configContent);
        }
    }

    protected function addAuthRoutes()
    {
        $routePrefix = $this->getSchema()->getRoutePrefix();
        $routeGenerator = $this->getRouteCollector();
        $routeName = $this->getSchema()->getRouteName();
        $routeDomain = $this->getSchema()->getRouteDomain();

        if (!$this->hasRouteNamed($routeName.'auth.form-login')) {
            $group = $routeGenerator->addRouteGroup([
                'name' => $routeName.'auth.',
                'prefix' => $routePrefix.'/auth',
                'domain' => $routeDomain
            ]);

            $group->addRoute('get', 'login', $this->authController.'@showLoginForm', [
                'name' => 'form-login'
            ]);

            $group->addRoute('post', 'login', $this->authController.'@login', [
                'name' => 'login'
            ]);

            $group->addRoute('get', 'logout', $this->authController.'@logout', [
                'name' => 'logout'
            ]);

            $routeFormLogin = $routeName.'auth.form-login';
            $this->addSuggestion("Change your unauthenticated redirect url in 'app/Exceptions/Handler.php' to route('$routeFormLogin')");
        }
    }

    protected function addDashboardRoute()
    {
        $routePrefix = $this->getSchema()->getRoutePrefix();
        $routeGenerator = $this->getRouteCollector();
        $routeName = $this->getSchema()->getRouteName('dashboard');
        $routeDomain = $this->getSchema()->getRouteDomain();

        if (!$this->hasRouteNamed($routeName)) {
            $routeName = $this->getSchema()->getRouteName();
            $this->getRouteCollector()->addRoute('get', $routePrefix, $this->dashboardController.'@pageDashboard', [
                'name' => $routeName.'dashboard',
                'middleware' => 'auth',
                'domain' => $routeDomain
            ]);
        }
    }

    protected function generateAuthController()
    {
        $routePrefix = $this->getSchema()->getRoutePrefix();
        $routeName = $this->getSchema()->getRouteName(); 
        $controllerNamespace = $this->getSchema()->getControllerNamespace();
        $stub = file_get_contents(__DIR__.'/stubs/AuthController.stub');

        $result = $this->renderStub($stub, [
            'controller_namespace' => $controllerNamespace,
            'view_login' => $this->getSchema()->getView('auth.login'),
            'path_dashboard' => '/'.$routePrefix,
            'route_login' => $routeName.'auth.form-login'
        ]);

        $this->putController($this->authController, $result);
    }

    protected function generateDashboardController()
    {
        $stub = file_get_contents(__DIR__.'/stubs/DashboardController.stub');
        $controllerNamespace = $this->getSchema()->getControllerNamespace();

        $result = $this->renderStub($stub, [
            'controller_namespace' => $controllerNamespace,
            'view_dashboard' => $this->getSchema()->getView('dashboard.dashboard'),
        ]);

        $this->putController($this->dashboardController, $result);
    }

}

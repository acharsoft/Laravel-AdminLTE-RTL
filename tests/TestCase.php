<?php

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\GenericUser;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Routing\RouteCollection;
use acharsoft\LaravelAdminLte\AdminLte;
use acharsoft\LaravelAdminLte\Menu\Builder;
use acharsoft\LaravelAdminLte\Menu\ActiveChecker;
use acharsoft\LaravelAdminLte\Menu\Filters\GateFilter;
use acharsoft\LaravelAdminLte\Menu\Filters\HrefFilter;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use acharsoft\LaravelAdminLte\Menu\Filters\ActiveFilter;
use acharsoft\LaravelAdminLte\Menu\Filters\ClassesFilter;
use acharsoft\LaravelAdminLte\Menu\Filters\SubmenuFilter;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TestCase extends PHPUnit_Framework_TestCase
{
    private $dispatcher;

    private $routeCollection;

    protected function makeMenuBuilder($uri = 'http://example.com', GateContract $gate = null)
    {
        return new Builder([
            new HrefFilter($this->makeUrlGenerator($uri)),
            new ActiveFilter($this->makeActiveChecker($uri)),
            new SubmenuFilter(),
            new ClassesFilter(),
            new GateFilter($gate ?: $this->makeGate()),
        ]);
    }

    protected function makeActiveChecker($uri = 'http://example.com')
    {
        return new ActiveChecker($this->makeRequest($uri), $this->makeUrlGenerator($uri));
    }

    private function makeRequest($uri)
    {
        return Request::createFromBase(SymfonyRequest::create($uri));
    }

    protected function makeAdminLte()
    {
        return new AdminLte($this->getFilters(), $this->getDispatcher(), $this->makeContainer());
    }

    protected function makeUrlGenerator($uri = 'http://example.com')
    {
        return new UrlGenerator($this->getRouteCollection(), $this->makeRequest($uri));
    }

    protected function makeGate()
    {
        $userResolver = function () {
            return new GenericUser([]);
        };

        return new Gate($this->makeContainer(), $userResolver);
    }

    protected function makeContainer()
    {
        return new Illuminate\Container\Container();
    }

    protected function getDispatcher()
    {
        if (! $this->dispatcher) {
            $this->dispatcher = new Dispatcher;
        }

        return $this->dispatcher;
    }

    private function getFilters()
    {
        return [];
    }

    protected function getRouteCollection()
    {
        if (! $this->routeCollection) {
            $this->routeCollection = new RouteCollection();
        }

        return $this->routeCollection;
    }
}

<?php

namespace acharsoft\LaravelAdminLte\Events;

use acharsoft\LaravelAdminLte\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}

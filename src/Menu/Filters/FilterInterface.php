<?php

namespace acharsoft\LaravelAdminLte\Menu\Filters;

use acharsoft\LaravelAdminLte\Menu\Builder;

interface FilterInterface
{
    public function transform($item, Builder $builder);
}

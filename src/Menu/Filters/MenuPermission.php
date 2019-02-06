<?php

namespace acharsoft\LaravelAdminLte\Menu\Filters;


use acharsoft\LaravelAdminLte\Menu\Builder;
use acharsoft\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuPermission implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (auth ()->user ()==null || (isset($item['permission'])  && !$this->checkPermission($item['permission']))) {
            return false;
        }
        return $item;
    }


    public function checkPermission($permissions){
        $userAccess = $this->getMyPermission(auth()->user()->access_level);
        foreach ($permissions as $key => $value) {
            if($value == $userAccess){
                return true;
            }
        }
        return false;
    }


    public function getMyPermission($id)
    {
        switch ($id) {
            case 1:
                return 'master';
                break;
            case 2:
                return 'admin';
                break;
            default:
                return 'user';
                break;
        }
    }
}
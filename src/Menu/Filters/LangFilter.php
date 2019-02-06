<?php
/**
 * Created by PhpStorm.
 * User: PC1
 * Date: 1/26/2019
 * Time: 4:03 PM
 */

namespace acharsoft\LaravelAdminLte\Menu\Filters;

use acharsoft\LaravelAdminLte\Menu\Builder;
use acharsoft\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Contracts\Translation\Translator;

class LangFilter implements FilterInterface
{
    protected $langGenerator;

    public function __construct(Translator $langGenerator)
    {
        $this->langGenerator = $langGenerator;
    }

    public function transform($item, Builder $builder)
    {
        if (isset($item['header'])) {
            $item['header'] = $this->langGenerator->trans('message.'.$item['header']);
        }
        if (isset($item['text'])) {
            $item['text'] = $this->langGenerator->trans('message.'.$item['text']);
        }
        if (isset($item['title'])) {
            $item['title'] = $this->langGenerator->trans('message.'.$item['title']);
        }
        return $item;
    }
}
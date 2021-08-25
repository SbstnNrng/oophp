<?php

namespace Seb\SebTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class SebTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @return object
     */
    public function indexAction() : object
    {
        $page = $this->app->page;
        $page->add("textfilter/index");

        return $page->render([
            "title" => "SebTextFilter",
        ]);
    }
}

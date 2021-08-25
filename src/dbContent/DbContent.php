<?php

namespace Seb\dbContent;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class DbContent implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä'], 'a', $str);
        $str = str_replace('ö', 'o', $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function blogPathify($res)
    {
        $count = count($res) + 1;
        $path = "blogpost-".strval($count);
        return $path;
    }

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function pagePathify($res, $pagePath)
    {
        $path = $pagePath;
        foreach ($res as $row) {
            if ($row->path == $path) {
                $path = $path."-i";
            }
        }
        return $path;
    }

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function slugCheck($res, $inSlug)
    {
        $slug = $inSlug;
        foreach ($res as $row) {
            if ($row->slug == $slug) {
                $slug = $slug."-i";
            }
        }
        return $slug;
    }

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function filtersToString($markdown, $bbcode, $nl2br, $link)
    {
        $str = null;
        if ($bbcode) {
            $str = "bbcode";
        }
        if ($link && $str != "") {
            $str = $str . "," . "link";
        } elseif ($link) {
            $str = "link";
        }
        if ($markdown && $str != "") {
            $str = $str . "," . "markdown";
        } elseif ($markdown) {
            $str = "markdown";
        }
        if ($nl2br && $str != "") {
            $str = $str . "," . "nl2br";
        } elseif ($nl2br) {
            $str = "nl2br";
        }
        return $str;
    }

    /**
     * @param string $str the string to format as slug.
     * 
     * @return str the formatted slug.
     */
    public function filtersStrToArr($str)
    {
        $filterArray = explode(",", $str);
        return $filterArray;
    }
}

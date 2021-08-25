<?php

namespace Seb\dbContent;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class DbContentController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @return object
     */
    public function indexAction() : object
    {
        $response = $this->app->response;
        return $response->redirect("dbcontent/showall");
    }

    /**
     * @return object
     */
    public function showallAction() : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header");
        $page->add("dbcontent/showall", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function pagesAction() : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type = 'page' AND deleted IS NULL;
EOD;
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header");
        $page->add("dbcontent/pages", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function blogAction() : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type = 'post' AND deleted IS NULL
ORDER BY published DESC
;
EOD;
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header");
        $page->add("dbcontent/blog", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function adminAction() : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header");
        $page->add("dbcontent/admin", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function blogpostAction($slug) : object
    {
        $curSlug = $slug;
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE slug = '$curSlug'";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header2");
        $page->add("dbcontent/blogpost", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function pageAction($path) : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE path = '$path'";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header2");
        $page->add("dbcontent/page", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function createAction() : object
    {
        $page = $this->app->page;

        $page->add("dbcontent/header");
        $page->add("dbcontent/create");

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function createActionPost() : object
    {
        $request = $this->app->request;

        $dbContent = new DbContent();

        $inputTitle = $request->getPost("inputTitle");
        $inputType = $request->getPost("inputType");
        $inputData = $request->getPost("inputData");
        $markdown = $request->getPost("markdown");
        $bbcode = $request->getPost("bbcode");
        $nl2br = $request->getPost("nl2br");
        $link = $request->getPost("link");
        $filterStr = $dbContent->filtersToString($markdown, $bbcode, $nl2br, $link);
        $slugBefore = null;
        $slug = null;
        $path = null;
        $pagePath = null;

        $this->app->db->connect();

        if ($inputType == "post") {
            $sql = "SELECT * FROM content WHERE type = 'post';";
            $res = $this->app->db->executeFetchAll($sql);
            $slugBefore = $dbContent->slugify($inputTitle);
            $slug = $dbContent->slugCheck($res, $slugBefore);
            $path = $dbContent->blogPathify($res);
        } else {
            $pagePath = $dbContent->slugify($inputTitle);
            $sql = "SELECT * FROM content WHERE type = 'page';";
            $res = $this->app->db->executeFetchAll($sql);
            $path = $dbContent->pagePathify($res, $pagePath);
        }

        $sql = "INSERT INTO content (title, data, type, slug, path, filter) VALUES (?, ?, ?, ?, ?, ?);";
        $res = $this->app->db->executeFetchAll($sql, [$inputTitle, $inputData, $inputType, $slug, $path, $filterStr]);

        return $this->app->response->redirect("dbcontent/admin");
    }

    /**
     * @return object
     */
    public function deleteAction($id) : object
    {
        $this->app->db->connect();
        $sql = "UPDATE content SET deleted = CURRENT_TIMESTAMP, updated = null WHERE id = '$id';";
        $this->app->db->executeFetchAll($sql);

        return $this->app->response->redirect("dbcontent/admin");
    }

    /**
     * @return object
     */
    public function editActionGet($id) : object
    {
        $page = $this->app->page;

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = '$id'";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $res
        ];

        $page->add("dbcontent/header2");
        $page->add("dbcontent/edit", $data);

        return $page->render([
            "title" => "DbContent",
        ]);
    }

    /**
     * @return object
     */
    public function editActionPost($idn) : object
    {
        $request = $this->app->request;
        $dbContent = new DbContent();

        $id = $idn;
        $oldTitle = $request->getPost("oldTitle");
        $slug = $request->getPost("inputSlug");
        $path = $request->getPost("inputPath");
        $title = $request->getPost("inputTitle");
        $type = $request->getPost("inputType");
        $data = $request->getPost("inputData");
        $markdown = $request->getPost("markdown");
        $bbcode = $request->getPost("bbcode");
        $nl2br = $request->getPost("nl2br");
        $link = $request->getPost("link");
        $filterStr = $dbContent->filtersToString($markdown, $bbcode, $nl2br, $link);

        $this->app->db->connect();

        if ($oldTitle != $title) {
            if ($type == "post") {
                $sql = "SELECT * FROM content WHERE type = 'post';";
                $res = $this->app->db->executeFetchAll($sql);
                $slugBefore = $dbContent->slugify($title);
                if ($slugBefore != $slug) {
                    $slug = $dbContent->slugCheck($res, $slugBefore);
                }
            } else {
                if ($type == "page") {
                    $sql = "SELECT * FROM content WHERE type = 'page';";
                    $res = $this->app->db->executeFetchAll($sql);
                    $pagePath = $dbContent->slugify($title);
                    if ($pagePath != $path) {
                        $path = $dbContent->pagePathify($res, $pagePath);
                    }
                }
            }
        }

        if ($type == "post") {
            $sql = "UPDATE content SET title = '$title', data = '$data', slug = '$slug', filter = '$filterStr' WHERE id = '$id';";
        } else {
            $sql = "UPDATE content SET title = '$title', data = '$data', path = '$path', filter = '$filterStr' WHERE id = '$id';";
        }
        $res = $this->app->db->executeFetchAll($sql);

        return $this->app->response->redirect("dbcontent/admin");
    }
}

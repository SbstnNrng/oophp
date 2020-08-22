<?php

namespace Seb\Dice100;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Dice100Controller implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        $dice = new Game100();
        $this->app->session->set("dice", $dice);
        // init session to start game";
        return $this->app->response->redirect("dicegame/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        // echo "Some debugging information";
        $title = "Dice 100";

        //incoming variables

        $handVal = $this->app->session->get("handVal");
        $check = $this->app->session->get("check");

        $dice = $this->app->session->get("dice");

        $histogram = new Histogram();
        $histogram->injectData($dice);

        $data = [
            "handVal" => $handVal,
            "check" => $check,
            "playerScore" => $dice->getPlayerScore(),
            "computerScore" => $dice->getComputerScore(),
            "turnScore" => $dice->getTurnScore(),
            "serie" => $dice->getHistogramSerie(),
            "histogram" => $histogram->getAstext()
        ];

        $this->app->page->add("dicegame/play", $data);
        //$app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    
    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        // echo "Some debugging information";

        $doDice = $this->app->request->getPost("doDice");
        $doEnd = $this->app->request->getPost("doEnd");
        $doRestart = $this->app->request->getPost("doRestart");

        $dice = $this->app->session->get("dice");

        if ($doDice) {
            $handVal = $dice->rollDice();
            $this->app->session->set("handVal", $handVal);
            $check = $dice->checkScore();
            $this->app->session->set("check", $check);
        } elseif ($doEnd) {
            $dice->endTurn();
            $check = $dice->checkScore();
            $this->app->session->set("check", $check);
        } elseif ($doRestart) {
            $this->app->session->set("dice", null);
            $this->app->session->set("handVal", null);
            $this->app->session->set("check", null);
            $dice = new Game100();
            $this->app->session->set("dice", $dice);
        }

        return $this->app->response->redirect("dicegame/play");
    }
}

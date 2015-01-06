<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06.01.2015
 * Time: 15:32
 */

class CustomController extends BaseController{

    public function index(){

    }

    public function showHistory(){
        return View::make('custom.history', array());
    }

    public function showCustoms(){
        return View::make('custom.customs', array());
    }

    public function showCulture(){
        return View::make('custom.culture', array());
    }

    public function showHelp(){
        return View::make('custom.help', array());
    }

    public function showProblem(){
        return View::make('custom.problem', array());
    }

    public function showActionHistory(){
        return View::make('custom.action_history', array());
    }

}
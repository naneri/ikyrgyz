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
        return View::make('custom.'.Config::get('app.nation_name').'_history', array());
    }

    public function showCustoms(){
        return View::make('custom.'.Config::get('app.nation_name').'_customs', array());
    }

    public function showCulture(){
        return View::make('custom.'.Config::get('app.nation_name').'_culture', array());
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
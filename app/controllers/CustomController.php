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
        return $this->makeView('custom.'.Config::get('app.nation_name').'.history', array());
    }

    public function showCustoms(){
        return $this->makeView('custom.'.Config::get('app.nation_name').'.customs', array());
    }

    public function showCulture(){
        return $this->makeView('custom.'.Config::get('app.nation_name').'.culture', array());
    }

    public function showHelp(){
        return $this->makeView('custom.help', array());
    }

    public function showProblem(){
        return $this->makeView('custom.problem', array());
    }

    public function showActionHistory(){
        return $this->makeView('custom.action_history', array());
    }

}
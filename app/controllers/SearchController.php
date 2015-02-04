<?php

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /search
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
        
        public function searchPeople(){
            $users = User::all();
            return View::make('search.people', array('users' => $users));
        }
        
        public function postSearchPeople(){
            $where = "WHERE 1=1 ";
           
            if(Input::has('age-from')){
                $dateFrom = date((date('Y') - Input::get('age-from') - 1) . '-m-d');
                $where .= " AND `user_description`.`birthday` < '$dateFrom' ";
            }
            if (Input::has('age-to')) {
                $dateTo = date((date('Y') - Input::get('age-to')) . '-m-d');
                $where .= " AND `user_description`.`birthday` > '$dateTo' ";
            }
            if(Input::has('gender') && Input::get('gender') != 'other'){
                $gender = Input::get('gender');
                if(in_array($gender, array('male', 'female'))){
                    $where .= " AND `user_description`.`gender` = '$gender' ";
                }
            }
            
            $users = DB::connection('mysql_users')
                    ->select("select `users`.* "
                            . "from `users` "
                            . "inner join `user_description` on `user_description`.`user_id` = `users`.`id` "
                            . $where);
            $result['users'] = View::make('search.build.users', array('users' => $users))->render();
            return $result;
        }

}
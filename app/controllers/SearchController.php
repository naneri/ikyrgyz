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
            $users = $this->getUsers();
            return View::make('search.people', array('users' => $users));
        }
        
        public function postSearchPeople(){
            $users = $this->getUsers();
            $result['entries'] = View::make('search.build.users', array('users' => $users))->render();
            return $result;
        }
        
        private function getUsers(){
            $where = "WHERE 1=1 ";

            if (Input::has('age-from')) {
                $dateFrom = date((date('Y') - Input::get('age-from')) . '-m-d');
                $where .= " AND `user_description`.`birthday` <= '$dateFrom' ";
            }
            if (Input::has('age-to')) {
                $dateTo = date((date('Y') - Input::get('age-to') - 1) . '-m-d');
                $where .= " AND `user_description`.`birthday` >= '$dateTo' ";
            }
            if (Input::has('gender') && Input::get('gender') != 'other') {
                $gender = Input::get('gender');
                if (in_array($gender, array('male', 'female'))) {
                    $where .= " AND `user_description`.`gender` = '$gender' ";
                }
            }
            if (Input::has('search-text')) {
                $searchText = Input::get('search-text');
                $where .= " AND (`users`.`email` LIKE '%$searchText%' "
                        . "OR `user_description`.`first_name` LIKE '%$searchText%' "
                        . "OR `user_description`.`last_name` LIKE '%$searchText%') ";
            }

            $users = DB::connection('mysql_users')
                    ->select("select * "
                    . "from `users` "
                    . "inner join `user_description` on `user_description`.`user_id` = `users`.`id` "
                    . $where);
            
            return $users;
        }
        
        public function searchContent(){
            $content = $this->getContent();
            return View::make('search.content', array('content' => $content));
        }
        
        public function postSearchContent(){
            $search = Input::get('search-text');
            $stemmer = new SimpleStemmer();
            $content = $this->getContent();
            $result['entries'] = View::make('search.build.content', array('content' => $content))->render();//$stemmer->getArrayStemmedWords($search);
            return $result;
        }
        
        private function getContent(){
            $blogsWhere = " WHERE 1=1 ";
            $topicsWhere = " WHERE `topics`.`draft` = 0 ";
            $blogs = array();
            $topics = array();
            $blogsAdditionalColumns = ' , 0 as `is_topic` ';
            $topicsAdditionalColumns = ' , 1 as `is_topic` ';
            $isRelevantRight = false;

            if (Input::has('search-text')) {
                $searchText = Input::get('search-text');
                if(Input::get('sort') == 'relevant'){
                    $relevant = "MATCH (`title`,`description`) AGAINST ('$searchText' IN BOOLEAN MODE)";
                    $topicsAdditionalColumns .= ", $relevant as `relevant` ";
                    $blogsAdditionalColumns .= ", $relevant as `relevant` ";
                    $blogsWhere .= " AND " . $relevant;
                    $topicsWhere .= " AND " . $relevant;
                    $isRelevantRight = true;
                } else {
                    $blogsWhere .= " AND (`blogs`.`title` LIKE '%" . Input::get('search-text') . "%' OR `blogs`.`description` LIKE '%" . Input::get('search-text') . "%')";
                    $topicsWhere .= " AND (`topics`.`title` LIKE '%" . Input::get('search-text') . "%' OR `topics`.`description` LIKE '%" . Input::get('search-text') . "%')";
                }
            }

            if (in_array(Input::get('filter'), array('any', 'blog'))) {
                $blogs = DB::select(" select `blogs`.* "
                                . $blogsAdditionalColumns
                                . " from `blogs` "
                                . $blogsWhere);
            }
            if (in_array(Input::get('filter'), array('any', 'topic'))) {
                $topics = DB::select("select `topics`.* "
                                . $topicsAdditionalColumns
                                . "from `topics` "
                                . $topicsWhere);
            }
            
//            dd(DB::getQueryLog());

            $content = array_merge($blogs, $topics);
            if (Input::get('sort') == 'date') {
                usort($content, function($a, $b) {
                    return strtotime($a->created_at) - strtotime($b->created_at);
                });
            } elseif (Input::get('sort') == 'rating') {
                usort($content, function($a, $b) {
                    return $a->rating - $b->rating;
                });
            } elseif (Input::get('sort') == 'relevant' && $isRelevantRight){
                usort($content, function($a, $b) {
                    return $a->relevant - $b->relevant;
                });
            } else {
                usort($content, function($a, $b) {
                    return strtotime($a->created_at) - strtotime($b->created_at);
                });
            }
            $content = array_reverse($content);
            return $content;
        }

}

class SimpleStemmer{
    
    var $okonchaniya = "/(ый|ой|ая|ое|ые|ому|а|о|у|ы|у|ю|ёй|ём|ом|ем|е|ого|ему|и|ство|ых|ох|ия|ий|ь|я|он|ют|ат)$/i";

    public function stemWord($word){
        $stemedWord = preg_replace($this->okonchaniya, '', $word);
        return $stemedWord;
    }
    
    public function getArrayStemmedWords($words){
        $stemedWords = array();
        preg_match_all('/([a-zA-Zа-яА-Я]+)/u', $words, $wordsArray);
        for ($i = 0; $i < count($wordsArray[1]); $i++){
            $stemedWords[] = $this->stemWord($wordsArray[1][$i]);
        }
        return $stemedWords;
    }
    
}
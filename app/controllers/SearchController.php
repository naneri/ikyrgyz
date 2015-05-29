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
            $ageFrom = array('' => '');
            $ageTo = array('' => '');
            for($i = 14; $i <= 99; $i++){
                $ageFrom[$i] = $i;
                $ageTo[$i] = $i;
            }
            return View::make('search.people', compact('users', 'ageFrom', 'ageTo'));
        }
        
        public function postSearchPeople(){
            $users = $this->getUsers();
            $result['entries'] = View::make('search.build.users', array('users' => $users))->render();
            return $result;
        }
        
        private function getUsers(){
            $where = "WHERE `users`.`id` != ".Auth::id()." ";

            if (Input::has('country') && Input::get('country') != 0) {
                $countryId = Input::get('country');
                $where .= " AND ((`user_description`.`liveplace_country_id` = '$countryId'"
                        . " AND `user_description`.`liveplace_access` = 'all') "
                        . " OR (`user_description`.`birthplace_country_id` = '$countryId'"
                        . " AND `user_description`.`birthplace_access` = 'all')) ";
            }
            if (Input::has('city') && Input::get('city') != 0) {
                $cityId = Input::get('city');
                $where .= " AND ((`user_description`.`liveplace_city_id` = '$cityId'"
                        . " AND `user_description`.`liveplace_access` = 'all') "
                        . " OR (`user_description`.`birthplace_city_id` = '$cityId'"
                        . " AND `user_description`.`birthplace_access` = 'all')) ";
            }
            if (Input::has('age-from')) {
                $dateFrom = date((date('Y') - Input::get('age-from')) . '-m-d');
                $where .= " AND `user_description`.`birthday` <= '$dateFrom' "
                        . " AND `user_description`.`birthday_access` = 'all' ";
            }
            if (Input::has('age-to')) {
                $dateTo = date((date('Y') - Input::get('age-to') - 1) . '-m-d');
                $where .= " AND `user_description`.`birthday` >= '$dateTo' "
                    . " AND `user_description`.`birthday_access` = 'all' ";
            }
            if (Input::has('study') || Input::has('study_text')) {
                $where .= " AND (`profile_items`.`type` = 'study' ";
                if(Input::has('study')){
                    $where .= " AND `profile_items`.`value` like '%".Input::get('study')."%' ";
                }
                if (Input::has('study_text')) {
                    $where .= " AND `profile_items`.`value` like '%" . Input::get('study_text') . "%' ";
                }
                $where .= " AND `profile_items`.`access` = 'all') ";
            }
            if (Input::has('job') || Input::has('job_text')) {
                $where .= " AND (`profile_items`.`subtype` = 'job' ";
                if(Input::has('job')){
                    $where .= " AND `profile_items`.`value` like '%" . Input::get('job') . "%' ";
                }
                if (Input::has('job_text')) {
                    $where .= " AND `profile_items`.`value` like '%" . Input::get('job_text') . "%' ";
                }
                $where .= " AND `profile_items`.`access` = 'all') ";
            }
            if (Input::has('gender') && Input::get('gender') != 'other') {
                $gender = Input::get('gender');
                if (in_array($gender, array('male', 'female'))) {
                    $where .= " AND `user_description`.`gender` = '$gender' "
                    . " AND `user_description`.`gender_access` = 'all' ";
                }
            }
            if (Input::has('search-text')) {
                $searchText = Input::get('search-text');
                $searchTextConcat = str_replace(' ', '',$searchText);
                $where .= " AND (`user_description`.`first_name` LIKE '%$searchText%' "
                        . "OR `user_description`.`last_name` LIKE '%$searchText%' "
                        . "OR CONCAT(`last_name`, `first_name`) LIKE '%$searchTextConcat%' "
                        . "OR CONCAT(`first_name`, `last_name`) LIKE '%$searchTextConcat%') ";
            }

            $users = DB::connection('mysql_users')
                    ->select("select distinct `users`.*, `user_description`.*, `cities`.`name_ru` as `city`, `countries`.`name_ru` as `country`, `friends`.`status` as `friendStatus`, TIMESTAMPDIFF(YEAR, `birthday`, CURDATE()) AS `age` "
                    . "from `users` "
                    . "inner join `user_description` on `user_description`.`user_id` = `users`.`id` "
                    . "left outer join `countries` on `user_description`.`liveplace_country_id` = `countries`.`id` "
                    . "left outer join `cities` on `user_description`.`liveplace_city_id` = `cities`.`id` "
                    . "left outer join `profile_items` on `profile_items`.`user_id` = `users`.`id` "
                    . "left outer join `friends` on `user_one` = ".Auth::id()." and  `user_two` = `users`.`id` "
                    . $where);
            
            return $users;
        }
        
        public function searchContent(){
            $content = $this->getContent();
            return View::make('search.content', array('content' => $content, 'search_text' => Input::get('search-text')));
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
                $blogs = DB::select(" select `blogs`.*, `user_description`.* "
                            . $blogsAdditionalColumns
                            . " from `blogs` "
                            . " inner join `" . Config::get('database.connections.mysql_users.database') . "`.`user_description` on `user_description`.`user_id` = `blogs`.`user_id` "
                            . $blogsWhere);
            }
            if (in_array(Input::get('filter'), array('any', 'topic'))) {
                $topics = DB::select("select `topics`.*, `user_description`.*, COUNT(`topic_comments`.`id`) AS `comments_count`, `blogs`.`title` as `blog_name` "
                            . $topicsAdditionalColumns
                            . "from `topics` "
                            . "inner join `blogs` on `blogs`.`id` = `topics`.`blog_id` "
                            . "left outer join `topic_comments` on `topic_comments`.`topic_id` = `topics`.`id` "
                            . "inner join `".Config::get('database.connections.mysql_users.database')."`.`user_description` on `user_description`.`user_id` = `topics`.`user_id` "
                            . $topicsWhere
                            . " GROUP BY `topic_comments`.`topic_id` ");
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

    public function postSearchContentAjax(){
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

            $blogs = DB::select(" select `blogs`.*, `user_description`.* "
                . $blogsAdditionalColumns
                . " from `blogs` "
                . " inner join `" . Config::get('database.connections.mysql_users.database') . "`.`user_description` on `user_description`.`user_id` = `blogs`.`user_id` "
                . $blogsWhere
                . " LIMIT 5");

            $topics = DB::select("select `topics`.*, `user_description`.*, COUNT(`topic_comments`.`id`) AS `comments_count`, `blogs`.`title` as `blog_name` "
                . $topicsAdditionalColumns
                . "from `topics` "
                . "inner join `blogs` on `blogs`.`id` = `topics`.`blog_id` "
                . "left outer join `topic_comments` on `topic_comments`.`topic_id` = `topics`.`id` "
                . "inner join `".Config::get('database.connections.mysql_users.database')."`.`user_description` on `user_description`.`user_id` = `topics`.`user_id` "
                . $topicsWhere
                . " GROUP BY `topic_comments`.`topic_id` "
                . " LIMIT 5");
        }

        $content = array_merge($blogs, $topics);
        usort($content, function($a, $b) {
            return strtotime($a->created_at) - strtotime($b->created_at);
        });
        if (count($content)==0) return "";
        return View::make('search.build.ajax-content', array('content' => array_reverse($content)))->render();
    }

    public function postSearchPeopleAjax(){
        $where = "WHERE `users`.`id` != ".Auth::id()." ";

        if (Input::has('search-text')) {
            $searchText = Input::get('search-text');
            $searchTextConcat = str_replace(' ', '',$searchText);
            $where .= " AND (`user_description`.`first_name` LIKE '%$searchText%' "
                . "OR `user_description`.`last_name` LIKE '%$searchText%' "
                . "OR CONCAT(`last_name`, `first_name`) LIKE '%$searchTextConcat%' "
                . "OR CONCAT(`first_name`, `last_name`) LIKE '%$searchTextConcat%') "
                . " LIMIT 5";
        }

        $users = DB::connection('mysql_users')
            ->select("select distinct `users`.*, `user_description`.*, `cities`.`name_ru` as `city`, `countries`.`name_ru` as `country`, `friends`.`status` as `friendStatus`, TIMESTAMPDIFF(YEAR, `birthday`, CURDATE()) AS `age` "
                . "from `users` "
                . "inner join `user_description` on `user_description`.`user_id` = `users`.`id` "
                . "left outer join `countries` on `user_description`.`liveplace_country_id` = `countries`.`id` "
                . "left outer join `cities` on `user_description`.`liveplace_city_id` = `cities`.`id` "
                . "left outer join `profile_items` on `profile_items`.`user_id` = `users`.`id` "
                . "left outer join `friends` on `user_one` = ".Auth::id()." and  `user_two` = `users`.`id` "
                . $where);

        if (count($users)==0) return "";
        return View::make('search.build.ajax-users', array('users' => $users))->render();
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
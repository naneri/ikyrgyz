<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'AuthController@getLogin');

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('register', 'AuthController@getRegister');
Route::post('register', 'AuthController@postRegister');
Route::get('activate/{code}', 'AuthController@getActivate');

Route::group(array('before' => 'auth'),function(){    
    Route::get('main/index','MainController@index'); 
	Route::get('main/ajaxTopics/{page}','MainController@ajaxTopics');        
        Route::get('blog/create', 'BlogController@create');
	Route::post('blog/store', 'BlogController@store');
	Route::get('blog/all','BlogController@getAll');
        Route::get('blog/show/{id}', 'BlogController@show');
        Route::group(array('before' => 'blog_edit_permission'), function(){
            Route::get('blog/edit/{id}', 'BlogController@getEdit');
            Route::post('blog/edit/{id}', 'BlogController@postEdit');
            Route::get('blog/edit/{id}/users', 'BlogController@getEditUsers');
            Route::post('blog/edit/{id}/users', 'BlogController@postEditUsers');
        });
        Route::get('blog/{id}/read', 'BlogController@readBlog');
        Route::get('blog/{id}/reject', 'BlogController@rejectBlog');
        Route::get('blog/{id}/accept', 'BlogController@acceptInviteBlog');
        Route::get('blog/{id}/refollow', 'BlogController@refollowBlog');
        
        Route::get('profile/{email}/created/topics', 'BlogController@showPersonal');

        Route::get('profile/{id}', 'ProfileController@getShow')->where('id', '[0-9]+');
	Route::get('profile/edit', 'ProfileController@getEdit');
	Route::post('profile/edit', 'ProfileController@postEdit');
	Route::get('profile/friends', 'ProfileController@friends');
        
        Route::get('topic/show/{id}', 'TopicController@show');
	Route::get('topic/create', 'TopicController@create');
        Route::group(array('before' => 'topic_edit_permission'), function(){
            Route::get('topic/edit/{id}', 'TopicController@getEdit');
            Route::post('topic/edit/{id}', 'TopicController@postEdit');
        });
        Route::post('topic/update', 'TopicController@update');
        Route::post('topic/store', 'TopicController@store');
        Route::get('topic/drafts', 'TopicController@drafts');
        Route::post('upload', array('uses' => 'TopicController@uploadImage'));

        Route::get('people', 'PeopleController@index');
        Route::get('people/friendRequest/{id}', 'PeopleController@requestFriend');
        Route::get('people/removeFriend/{id}', 'PeopleController@removeFriend');
        Route::get('people/submitFriend/{id}', 'PeopleController@submitFriend');
        
        Route::post('message/send/{id}', 'MessageController@sendMessage');
        Route::get('message/all', 'MessageController@getAll');
        Route::get('message/show/{id}', 'MessageController@show');

        Route::get('custom/history', 'CustomController@showHistory');
        Route::get('custom/customs', 'CustomController@showCustoms');
        Route::get('custom/culture', 'CustomController@showCulture');
        Route::get('custom/help', 'CustomController@showHelp');
        Route::get('custom/problem', 'CustomController@showProblem');
        Route::get('custom/action_history', 'CustomController@showActionHistory');
        
        Route::get('search/people', 'SearchController@searchPeople');
        Route::post('search/people', 'SearchController@postSearchPeople');

        Route::resource('tags', 'TagsController');
        Route::resource('photos', 'PhotosController');
        
	Route::get('logout', 'AuthController@logout');

        if(Request::ajax()){
            Route::post('topic/comments/show', 'TopicCommentsController@showComments');
            Route::post('topic/comment/add', 'TopicCommentsController@postAdd');
            Route::post('topic/comment/delete', 'TopicCommentsController@postDelete');
            Route::post('topic/comment/restore', 'TopicCommentsController@postRestore');
            
            Route::post('vote/comment', 'VoteController@postVoteComment');
            Route::post('vote/topic', 'VoteController@postVoteTopic');
            Route::post('vote/blog', 'VoteController@postVoteBlog');
            Route::post('vote/user', 'VoteController@postVoteUser');
        }
});

Route::filter('blog_edit_permission', function($route){
    $blog = Blog::findOrFail($route->parameter('id'));
    if(!$blog->canEdit()){
        return View::make('error.permission', array('error' => 'You don\'t have enough permissions to do that.'));
    } 
});

Route::filter('topic_edit_permission', function($route) {
    $topic = Topic::findOrFail($route->parameter('id'));
    if (!$topic->canEdit()) {
        return View::make('error.permission', array('error' => 'You don\'t have enough permissions to do that.'));
    }
});

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


Route::get('locale/{locale}', 'BaseController@setLocale' );

Route::get('country-list', function(){
    return Country::all()->lists('name_ru');
});

Route::get('city-list/{id}', function($name){
    $country = Country::where('name_ru', $name)->first();
    return City::where('country_id',  $country->id)->lists('name_ru');
});

Route::group(array('before' => 'notauth'),function(){
    Route::get('/', 'AuthController@getLogin');
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::post('login/android', 'AndroidAuthController@postAndroidLogin');
    Route::get('login/fb', 'AuthController@loginWithFacebook');
    Route::get('login/vk', 'AuthController@loginWithVK');
    Route::get('login/google', 'AuthController@loginWithGoogle');
    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');
    Route::get('activate/{code}', 'AuthController@getActivate');
});
Route::group(array('before' => 'notauth'), function(){
    Route::post('android/myBlogIds', 'AndroidMainController@myBlogIds');
    Route::post('android/androidCreateNewTopic', 'AndroidMainController@androidCreateNewTopic');
    Route::post('android/androidCreateNewBlog', 'AndroidMainController@androidCreateNewBlog');
    Route::post('main/androidIndex', 'AndroidMainController@androidIndex');
    Route::post('main/index/androidNew', 'AndroidMainController@androidNewTopics');
    Route::post('main/index/androidTop', 'AndroidMainController@androidTopTopics');
    Route::post('main/androidAjaxTopics/{sort}/{page}', 'AndroidMainController@androidAjaxTopics');
});
Route::group(array('before' => 'auth'),function(){
    Route::get('profile/fill', 'ProfileController@getProfileFill');
    Route::post('profile/fill', 'ProfileController@postProfileFill');
    Route::get('logout', 'AuthController@logout');
});
Route::group(array('before' => 'auth|activated|no-description'),function(){
    Route::get('main/index','MainController@index');
    Route::get('main/index/{order}', 'MainController@index');
    Route::get('main/ajaxTopics','MainController@ajaxTopics');

    Route::get('country/{id}', function($id){ return Response::json(City::getCitiesByCountryId($id)); });

        Route::get('blog/create', 'BlogController@create');
	Route::post('blog/store', 'BlogController@store');
	Route::get('blog/all','BlogController@getAll');
        Route::get('blog/show/{id}', 'BlogController@show');
        Route::get('blog/showAjax/{id}/{page}', 'BlogController@showAjax');
        Route::group(array('before' => 'blog_edit_permission'), function(){
            Route::get('blog/edit/{id}', 'BlogController@getEdit');
            Route::post('blog/edit/{id}', 'BlogController@postEdit');
            Route::get('blog/edit/{id}/users', 'BlogController@getEditUsers');
            Route::post('blog/edit/{id}/users', 'BlogController@postEditUsers');
        });
        Route::get('blog/{id}/read', 'BlogController@readBlog');
        Route::get('blog/user/{id}/read', 'BlogController@readPersonalBlog');
        Route::get('blog/{id}/reject', 'BlogController@rejectBlog');
        Route::get('blog/{id}/accept', 'BlogController@acceptInviteBlog');
        Route::get('blog/{id}/refollow', 'BlogController@refollowBlog');
        Route::get('blog/ajaxBlogs/{page}', 'BlogController@ajaxBlogs');

        Route::get('group', 'GroupController@index');
        Route::get('group/show/{id}', 'GroupController@show');
        Route::get('group/create', 'GroupController@getCreate');
        Route::post('group/create', 'GroupController@postCreate');
        //Route::group(array('before' => 'group_edit_permission'), function(){
            //Route::get('group/edit/{id}', 'GroupController@getEdit');
          //  Route::post('group/edit/{id}', 'GroupController@postEdit');
        //});
        //Route::post('group/update', 'GroupController@update');

        Route::get('profile/{email}/created/topics', 'BlogController@showPersonal');

        Route::get('profile/{id}/photos', 'PhotoAlbumsController@photoAlbumIndex');
        Route::get('photoalbum/create', 'PhotoAlbumsController@create');
        Route::post('photoalbum/create', 'PhotoAlbumsController@store');
        Route::get('photoalbum/{id}', 'PhotoAlbumsController@show');
        Route::get('photo/{id}',  array('before' => 'can_view_photo', 'uses' => 'PhotosController@show'));
        Route::post('photoalbum/uploadCover', 'PhotoAlbumsController@uploadCover');
        Route::group(array('before' => 'photoalbum_edit_permission'), function(){
            Route::get('photoalbum/{id}/delete', 'PhotoAlbumsController@destroy');
            Route::get('photoalbum/{id}/edit', 'PhotoAlbumsController@edit');
            Route::post('photoalbum/{id}/edit', 'PhotoAlbumsController@update');
            Route::get('photoalbum/{id}/upload', 'PhotosController@create');
            Route::post('photoalbum/{id}/upload', 'PhotosController@store');
            Route::post('photoalbum/{id}/upload/setnames', 'PhotosController@setNames');
        });
        Route::group(array('before' => 'photo_edit_permission'), function(){
            Route::get('photo/{id}/delete', 'PhotosController@destroy');
            Route::get('photo/{id}/edit', 'PhotosController@edit');
            Route::post('photo/{id}/edit', 'PhotosController@update');
        });

        Route::get('profile/random', 'ProfileController@getRandom');
        Route::get('profile', 'ProfileController@showMyProfile');
        Route::get('profile/{userId}/ajaxTopics/{pageName}/{pageNumber}', 'ProfileController@ajaxTopics');
        Route::get('profile/{id}', 'ProfileController@getShow')->where('id', '[0-9]+');
        Route::get('profile/{page}', 'ProfileController@showMyProfile');
        Route::get('profile/{id}/{page}', 'ProfileController@getShow')->where('id', '[0-9]+');
	Route::get('profile/edit', 'ProfileController@getEdit');
	Route::post('profile/edit', 'ProfileController@postEdit');
	Route::get('profile/friends', 'ProfileController@friends');
    Route::get('profile/edit/account', 'ProfileController@getEditAccount');
    Route::post('profile/edit/account', 'ProfileController@postEditAccount');
    Route::get('profile/edit/main', 'ProfileController@getEditMain');
    Route::post('profile/edit/main', 'ProfileController@postEditMain');
    Route::post('profile/edit/avatar', 'ProfileController@postEditAvatar');
    Route::get('profile/edit/study', 'ProfileController@getEditStudy');
    Route::post('profile/edit/study/school', 'ProfileController@postStudySchool');
    Route::post('profile/edit/study/university', 'ProfileController@postStudyUniversity');
    Route::get('profile/edit/job', 'ProfileController@getEditJob');
    Route::post('profile/edit/job', 'ProfileController@postJob');
    Route::get('profile/edit/contact', 'ProfileController@getEditContact');
    Route::post('profile/edit/contact', 'ProfileController@postContact');
    Route::get('profile/edit/family', 'ProfileController@getEditFamily');
    Route::post('profile/edit/family/members', 'ProfileController@postFamilyMembers');
    Route::post('profile/edit/maritalStatus', 'ProfileController@postMaritalStatus');
    Route::get('profile/edit/additional', 'ProfileController@getEditAdditional');
    Route::post('profile/edit/aboutMe', 'ProfileController@postAboutMe');
    Route::post('profile/edit/additional', 'ProfileController@postAdditional');
    Route::get('profile/edit/access', 'ProfileController@getEditAccess');
    Route::post('profile/edit/access', 'ProfileController@postAccess');
    Route::post('profile/uploadAvatar', 'ProfileController@uploadAvatar');
    Route::get('profile/{id}/subscriptions/ajaxBlogs/{pageNum}', 'ProfileController@getAjaxSubscriptionBlogs');

    Route::get('topic/show/{id}', array('before' => 'topic.canview', 'uses' => 'TopicController@show'));
    Route::get('topic/create', 'TopicController@create');
    Route::get('topic/create/link', 'TopicController@createLink');
    Route::get('topic/create/fetch_og', 'TopicController@fetchOG');
    Route::get('topic/create/fetch_content', 'TopicController@fetchContent');

    Route::group(array('before' => 'topic_edit_permission'), function(){
            Route::get('topic/edit/{id}', 'TopicController@getEdit');
            Route::post('topic/edit/{id}', 'TopicController@postEdit');
            Route::get('topic/delete/{id}', 'TopicController@delete');
        });
    Route::post('topic/update', 'TopicController@update');
    Route::post('topic/store', 'TopicController@store');
    Route::get('topic/drafts', 'TopicController@drafts');
    Route::get('audio/create', 'AudioController@create');
    Route::post('upload', array('uses' => 'TopicController@uploadImage'));

        Route::get('people', 'PeopleController@index');
        Route::get('people/friendRequest/{id}', 'PeopleController@requestFriend');
        Route::get('people/removeFriend/{id}', 'PeopleController@removeFriend');
        Route::get('people/submitFriend/{id}', 'PeopleController@submitFriend');

        Route::get('message/all', 'MessageController@getAll');
        Route::get('message/show/{id}', 'MessageController@show');
        Route::get('messages/inbox/{filter}', 'MessageController@inbox');
        Route::get('messages/outbox', 'MessageController@outbox');
        Route::get('messages/contacts', 'MessageController@contacts');
        Route::get('messages/draft', 'MessageController@draft');
        Route::get('messages/blacklist', 'MessageController@blacklist');
        Route::post('messages/blacklist', 'MessageController@postBlacklist');
        Route::get('messages/trash', 'MessageController@trash');
        Route::get('messages/new', 'MessageController@newMessage');
        Route::post('messages/new', 'MessageController@postNewMessage');
        Route::post('messages/action', 'MessageController@postAction');
        Route::group(array('before' => 'message_edit_permission'), function(){
            Route::get('message/send/{id}', 'MessageController@sendMessageDraft');
            Route::get('message/edit/{id}', 'MessageController@editMessage');
            Route::get('message/delete/{id}', 'MessageController@deleteMessage');
        });

        Route::get('custom/history', 'CustomController@showHistory');
        Route::get('custom/customs', 'CustomController@showCustoms');
        Route::get('custom/culture', 'CustomController@showCulture');
        Route::get('custom/help', 'CustomController@showHelp');
        Route::get('custom/problem', 'CustomController@showProblem');
        Route::get('custom/action_history', 'CustomController@showActionHistory');

        Route::get('search/people', 'SearchController@searchPeople');
        Route::post('search/people', 'SearchController@postSearchPeople');
        Route::get('search/content', 'SearchController@searchContent');
        Route::post('search/content', 'SearchController@postSearchContent');

        Route::resource('tags', 'TagsController');
        Route::resource('photos', 'PhotosController');

	
    
    if(Request::ajax()){
        Route::post('topic/comments/sort', 'TopicCommentsController@sortComments');
        Route::post('topic/comment/add', 'TopicCommentsController@postAdd');
        Route::post('topic/comment/delete', 'TopicCommentsController@postDelete');
        Route::post('topic/comment/restore', 'TopicCommentsController@postRestore');

        Route::post('vote/comment', 'VoteController@postVoteComment');
        Route::post('vote/topic', 'VoteController@postVoteTopic');
        Route::post('vote/blog', 'VoteController@postVoteBlog');
        Route::post('vote/user', 'VoteController@postVoteUser');
        Route::post('vote/photo', 'VoteController@postVotePhoto');
        
        Route::post('favourite/topic', 'TopicController@postFavourite');
        Route::post('favourite/blog', 'BlogController@postFavourite');
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

Route::filter('message_edit_permission', function($route) {
    $message = Message::findOrFail($route->parameter('id'));
    if (!$message->canEdit()) {
        return Redirect::back()->with('message', [
            'type' => 'error',
            'text' => "You don't have enough permissions to do that."
            ]);
    }
});

Route::filter('photoalbum_edit_permission', function($route) {
    $photoAlbum = PhotoAlbum::findOrFail($route->parameter('id'));
    if (!$photoAlbum->canEdit()) {
        return Redirect::back()->with('message', [
            'type' => 'error',
            'text' => "You don't have enough permissions to do that."
            ]);
    }
});

Route::filter('photo_edit_permission', function($route) {
    $photo = Photo::findOrFail($route->parameter('id'));
    if (!$photo->canEdit()) {
        return Redirect::back()->with('message', [
            'type' => 'error',
            'text' => "You don't have enough permissions to do that."
            ]);
    }
});

Route::filter('can_view_photo', function($route){
    $photo = Photo::findOrFail($route->parameter('id'));
    if(!$photo->canView()){
        return Redirect::back()->with('message', [
            'type' => 'error',
            'text' => "You don't have enough permissions to do that."
            ]);
    }
});

Route::filter('topic.canview', function($route){
   $topic = Topic::findOrFail($route->parameter('id'));
   if(!$topic->blog->canView()){
       return Redirect::back()->with('message', [
            'type' => 'error',
            'text' => "You don't have enough permissions to do that."
            ]);
   }
});

<?php

namespace Niamiko\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{


 	public function register()
    {
        $this->app->bind(
            'Niamiko\Repositories\TopicRepositoryInterface',
            'Niamiko\Repositories\Eloquent\DbTopicRepository'
        );
        $this->app->bind(
            'Niamiko\Repositories\BlogRepositoryInterface',
            'Niamiko\Repositories\Eloquent\DbBlogRepository'
        );
        $this->app->bind(
            'Niamiko\Repositories\MessageRepositoryInterface',
            'Niamiko\Repositories\Eloquent\DbMessageRepository'
        );
        $this->app->bind(
            'Niamiko\Repositories\UserRepositoryInterface',
            'Niamiko\Repositories\Eloquent\DbUserRepository'
        );
    }

}
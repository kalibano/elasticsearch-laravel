<?php

namespace App\Providers;

use App\Repositories\SearchRepository;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;

use App\Repositories\ElasticsearchRepository;
use App\Repositories\EloquentSearchRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // $this->app->bind(SearchRepository::class, EloquentSearchRepository::class);
        $this->app->bind(SearchRepository::class, function ($app) {

            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            // dd(Config('services.search.enabled'));
            if (!Config('services.search.enabled')) {
                return new EloquentSearchRepository();
            }
            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });
        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

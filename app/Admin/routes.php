<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('helps', HelpsController::class);

    $router->resource('marketing', MarketingController::class);

    $router->group(['prefix' => 'bounty'], function ($router) {
        $router->resource('active', BountyController::class);
        $router->resource('done', BountyController::class);
        $router->resource('closed', BountyController::class);
    });

    $router->resource('bounty-claim', BountyClaimController::class);

    $router->resource('request-or-idea', RequestOrIdeaController::class);

    $router->resource('bounty-idea', BountyIdeaController::class);

    $router->resource('test-net-token', TestnetTokenController::class);

    $router->resource('site-text', SiteTextController::class);

    $router->resource('site-img', SiteImgController::class);

    $router->resource('dapp-info', DappInfoController::class);

    $router->group(['prefix' => 'custodian'], function ($router) {
        $router->resource('collaboration', CustodianCollaborationController::class);
        $router->resource('jobs', CustodianJobController::class);
        $router->resource('subscribe', CustodianSubscribeController::class);
    });
});

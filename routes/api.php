<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Api Doc
 */
Route::get('/doc', '\App\Api\Common\ApiDoc@index');

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'helps'], function ($api) {
            $api->get('all', 'HelpsController@index');
            $api->get('list/en', 'HelpsController@listEn');
            $api->get('list/cn', 'HelpsController@listCn');
            $api->get('{id}', 'HelpsController@show');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'marketing'], function ($api) {
            $api->get('all', 'MarketingController@index');
            $api->get('list/{type}', 'MarketingController@list');
            $api->get('{id}', 'MarketingController@show');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'bounty'], function ($api) {
            $api->get('all', 'BountyController@index');
            $api->get('{id}', 'BountyController@show');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'bounty-claim'], function ($api) {
            $api->get('list/in-progress', 'BountyClaimController@listInProgress');
            $api->get('list/done', 'BountyClaimController@listDone');
            $api->post('new', 'BountyClaimController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'request-or-idea'], function ($api) {
            $api->post('new', 'RequestOrIdeaController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'bounty-idea'], function ($api) {
            $api->post('new', 'BountyIdeaController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'test-net-token'], function ($api) {
            $api->post('new', 'TestNetTokenController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'site-text'], function ($api) {
            $api->get('all', 'SiteTextController@index');
            $api->get('list/en/{type}', 'SiteTextController@listEn');
            $api->get('list/cn/{type}', 'SiteTextController@listCn');
            $api->get('{id}', 'SiteTextController@show');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'site-img'], function ($api) {
            $api->get('all', 'SiteImgController@index');
            $api->get('list/en/{type}', 'SiteImgController@listEn');
            $api->get('list/cn/{type}', 'SiteImgController@listCn');
            $api->get('{id}', 'SiteImgController@show');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'dapp-info'], function ($api) {
            $api->get('all', 'DappInfoController@index');
            $api->get('list', 'DappInfoController@list');
            $api->get('{id}', 'DappInfoController@show');
            $api->post('new', 'DappInfoController@create');
            $api->post('upload', 'DappInfoController@uploadImg');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'custodian-collaboration'], function ($api) {
            $api->post('new', 'CustodianCollaborationController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'custodian-job'], function ($api) {
            $api->post('new', 'CustodianJobController@create');
        });
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'custodian-subscribe'], function ($api) {
            $api->post('new', 'CustodianSubscribeController@create');
        });
    });
});

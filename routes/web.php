<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// use App\Library\TwitterAPIExchange;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * FOLOWWING LINES ARE FOR TESTING PLAIN TWITTER API CONNECTION
 * I COMMENTED THEM OUT BUT YOU CAN BRING THEM BACK TO TEST YOUR API CONNECTION
 */

// $router->get('/twitter-test', function () use ($router) {

//     $settings = array(
//         'oauth_token' => env('TWITTER_ACCESS_TOKEN'),
//         'oauth_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
//         'consumer_key' => env('TWITTER_CONSUMER_KEY'),
//         'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
//     );

//     $url = 'https://api.twitter.com/1.1/search/tweets.json';
//     $getfield = '?q=trump';
//     $requestMethod = 'GET';
//     $twitter = new TwitterAPIExchange($settings);
//     return $twitter->setGetfield($getfield)
//         ->buildOauth($url, $requestMethod)
//         ->performRequest();
// });

// API route group (starts with '/api')
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');

    $router->post('login', 'AuthController@login');

    // START OF PROTECTED ROUTES
    // this is just a sample of protected profile route
    $router->get('profile', 'UserController@profile');

    // examples of simple rest api routing
    $router->get('users/list', 'UserController@list');
    $router->get('users/show/{id}', 'UserController@show');

    $router->post('twitter/analyse', 'TwitterController@analyse');

    $router->post('twitter/stats', 'TwitterController@stats');

    // END OF PROTECTED ROUTES
});

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Library\TwitterAPIExchange;

class TwitterController extends Controller
{

    private $settings;

    /**
     * Function to do get request to twitter
     *
     * @param String $url
     * @param String $fields
     * @return json
     */
    protected function getFromTwitter($url, $fields)
    {
        $twitter = new TwitterAPIExchange($this->settings);
        return $twitter->setGetfield($fields)
            ->buildOauth($url, 'GET')
            ->performRequest();
    }

    /**
     * Instantiate a new TwitterController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->settings = array(
            'oauth_token' => env('TWITTER_ACCESS_TOKEN'),
            'oauth_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
        );
    }
}

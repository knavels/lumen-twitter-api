<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\TwitterAPIExchange;

use App\Twitt;

class TwitterController extends Controller
{

    private $settings;
    private $searchUrl;

    /**
     * Function to do get request to twitter
     *
     * @param String $url
     * @param String $fields
     * @return json
     */
    protected function getFromTwitter($fields, $url = null)
    {
        if (!$url) $url = $this->searchUrl;
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
        $this->searchUrl = 'https://api.twitter.com/1.1/search/tweets.json';
    }


    /**
     * Search twitter for given search_query and saved tagged data in database
     *
     * @param Request $request
     * @return Response
     */
    public function analyse(Request $request)
    {
        // validate input data
        $this->validate($request, [
            'search_query' => 'required|string',
        ]);

        $search = $request->get('search_query');

        $results = json_decode($this->getFromTwitter('?q=' . $search))->statuses;

        $itemsToInsert = [];

        foreach ($results as $item) {
            $itemsToInsert[] = [
                "user_sceen_name" => $item->user->screen_name,
                "twitt_id" => $item->id,
                "twitt_url" => "https://twitter.com/" . $item->user->screen_name . "/status/" . $item->id,
                "twitt_text" => $item->text,
                "tag" => $search,
            ];
        }

        Twitt::insert($itemsToInsert);

        return response()->json([
            "message" => "data scraped and saved successfully!",
            "total" => count($results),
        ]);
    }


    /**
     * get given tags(string seperated by "|") and return back stats
     *
     * @param Request $request
     * @return Response
     */
    public function stats(Request $request)
    {
        // validate input data
        $this->validate($request, [
            'tags' => 'required|string',
        ]);

        $tags = explode("|", $request->get('tags'));

        $results = collect(Twitt::whereIn('tag', $tags)->get());

        $stats = [];

        foreach ($tags as $tag) {
            $stats[] = [
                $tag => $results->where('tag', $tag)->count(),
            ];
        }

        return response()->json(["stats" => $stats]);
    }
}

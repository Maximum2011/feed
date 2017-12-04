<?php
namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class PostService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPosts()
    {
        if (!Cache::has('posts')){
            $response = $this->client->get("https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=" . env('NEWS_API_KEY'));
            if (200 !== $response->getStatusCode()) {
                throw new \Exception("Status of post's request is no success. Current status:" . $response->getStatusCode());
            }
            $posts = json_decode($response->getBody())->articles;
            Cache::put('posts', $posts, 60);
        } else {
            $posts = Cache::get('posts');
        }
        return $posts;
    }

}
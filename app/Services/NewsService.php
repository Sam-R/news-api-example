<?php

namespace App\Services;

use App\Http\Clients\NewsClient;
use Illuminate\Support\Collection;

class NewsService
{
    private $client;

    public function __construct(NewsClient $client)
    {
        $this->client = $client;
    }

    public function headlines(): Collection
    {
        $response = $this->client->get('top-headlines?country=us');

        $body = json_decode((string) $response->getBody(), true);

        $collection = collect($body['articles'])->map(function($article) {
            return [
                'author' => $article['author'],
                'title' => $article['title'],
                'url' => $article['url']
            ];
        });

        return $collection;
    }
}

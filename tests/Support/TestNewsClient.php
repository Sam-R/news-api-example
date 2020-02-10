<?php

namespace Tests\Support;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use App\Http\Clients\NewsClient;
use GuzzleHttp\Psr7\Response;

trait TestNewsClient
{
    public function setTestNewsClient()
    {
        $this->mock_handler = new MockHandler();

        $client = new NewsClient([
            'handler' => HandlerStack::create($this->mock_handler)
        ]);

        $this->app->instance(NewsClient::class, $client);
    }

    public function mockSingleArticlesResponse():Response
    {
        return new Response(200, [], json_encode([
            'articles' => [
                'article' => [
                    'author' => 'authour',
                    'title' => 'title',
                    'url' => 'url'
                ]
            ]
        ]));
    }
}
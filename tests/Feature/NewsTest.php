<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\NewsService;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use App\Http\Clients\NewsClient;
use GuzzleHttp\Psr7\Response;
use Tests\Support\TestNewsClient;

class NewsTest extends TestCase
{
    use TestNewsClient;

    private $newsService;
    private $mock_handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setTestNewsClient();

        $this->newsService = app(NewsService::class);
    }

    public function testFetchingHeadlines()
    {
        $this->mock_handler->append($this->mockSingleArticlesResponse());

        $results = $this->newsService->headlines();

        $this->assertCount(1, $results);
    }
}

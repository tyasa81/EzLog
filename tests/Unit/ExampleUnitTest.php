<?php

namespace tyasa81\EzLoggable\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use tyasa81\EzLoggable\Tests\TestCase;

class ExampleUnitTest extends TestCase
{
    use DatabaseTransactions;

    protected function getOriginal($response)
    {
        /** @var \Illuminate\Http\Response $baseResponse */
        $baseResponse = $response->baseResponse;

        /** @var \Illuminate\View\View $original */
        return $baseResponse->original;
    }

    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}

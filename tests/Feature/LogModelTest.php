<?php

namespace tyasa81\EzLoggable\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use tyasa81\EzLoggable\EzLoggable;
use tyasa81\EzLoggable\Models\Log;
use tyasa81\EzLoggable\Repositories\LogRepository;
use tyasa81\EzLoggable\Tests\TestCase;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class LogModelTest extends TestCase
{
    use DatabaseTransactions;
    
    protected function getOriginal($response)
    {
        /** @var \Illuminate\Http\Response $baseResponse */
        $baseResponse = $response->baseResponse;

        /** @var \Illuminate\View\View $original */
        return $baseResponse->original;
    }

    /**
     * A basic test example.
     */
    public function test_log_model_can_be_created(): void
    {
        $log = Log::factory()->create();

        // Convert timestamps to the same format for comparison
        $logArray = $log->toArray();
        $logArray['created_at'] = $log->created_at->format('Y-m-d H:i:s');
        $logArray['updated_at'] = $log->updated_at->format('Y-m-d H:i:s');

        $this->assertDatabaseHas('logs', $logArray);
    }

    public function test_log_repository_can_create_log(): void
    {
        $logRepository = new LogRepository();
        $log = $logRepository->create(
            user_id: 88,
            loggable_type: "amet",
            loggable_id: 96,
            acted_by_type: "aliquam",
            acted_by_id: 5,
            action: "quaerat",
            column: "ut",
            before: "unde",
            after: "error",
        );
        
        // Convert timestamps to the same format for comparison
        $logArray = $log->toArray();
        $logArray['created_at'] = $log->created_at->format('Y-m-d H:i:s');
        $logArray['updated_at'] = $log->updated_at->format('Y-m-d H:i:s');

        $this->assertDatabaseHas('logs', $logArray);
    }

    
}

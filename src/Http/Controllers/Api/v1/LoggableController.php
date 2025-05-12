<?php

namespace tyasa81\EzLoggable\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use tyasa81\EzLoggable\Http\Controllers\Controller;
use tyasa81\EzLoggable\Services\LogServices;

class LoggableController extends Controller
{
    public function __construct(protected LogServices $logServices) {}

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        return $this->logServices->list(
            user_id: Auth::id(),
            date_start: $request->input('date_start'),
            date_end: $request->input('date_end'),
            timezone: $request->input('timezone'),
        );
    }
}

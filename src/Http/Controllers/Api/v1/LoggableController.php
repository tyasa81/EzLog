<?php

namespace tyasa81\EzLoggable\Http\Controllers\Api\v1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use tyasa81\EzLoggable\Contracts\LoggableMorphTypesProviderInterface;
use tyasa81\EzResponse\Responses\FailResponse;
use tyasa81\EzResponse\Responses\SuccessResponse;
use tyasa81\EzLoggable\Http\Controllers\Controller;
use tyasa81\EzLoggable\Repositories\LogRepository;
use tyasa81\EzLoggable\Services\LogServices;
use tyasa81\ShopSourceChannel\Models\SkuSourceChannel;

class LoggableController extends Controller
{
    public function __construct(protected LogServices $logServices) {
    }

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

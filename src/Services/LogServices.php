<?php

namespace tyasa81\EzLoggable\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use tyasa81\EzLoggable\Contracts\LoggableMorphTypesProviderInterface;
use tyasa81\EzLoggable\Repositories\LogRepository;
use tyasa81\EzResponse\Responses\SuccessResponse;

class LogServices
{
    protected $logRepository;

    public function __construct(protected LoggableMorphTypesProviderInterface $loggableMorphTypesProvider)
    {
        $this->logRepository = new LogRepository;
    }

    public function list(int $user_id, $date_start = '', $date_end = '', $timezone = '')
    {
        $loggableMorphTypes = $this->loggableMorphTypesProvider->getLoggableMorphTypes();
        $actedByMorphTypes = $this->loggableMorphTypesProvider->getActedByMorphTypes();
        $wheres = [
            ['user_id', $user_id],
        ];
        if ($date_start) {
            $date_start = Carbon::createFromFormat('Y-m-d', $date_start);
            if ($date_start > Carbon::now()->setTimezone($timezone)->subMonths(3)->startOfDay()) {
                $wheres[] = ['created_at', '>=', $date_start->startOfDay()->shiftTimezone($timezone)->utc()];
            }
        }
        if ($date_end) {
            $date_end = Carbon::createFromFormat('Y-m-d', $date_end);
            $wheres[] = ['created_at', '<=', $date_end->endOfDay()->shiftTimezone($timezone)->utc()];
        }
        // DB::enableQueryLog();
        $return = new SuccessResponse(data: $this->logRepository->paginate(wheres: $wheres,
            withs: [
                'loggable' => function (MorphTo $morphTo) use ($loggableMorphTypes) {
                    $morphTo->constrain($loggableMorphTypes);
                },
                'acted_by' => function (MorphTo $morphTo) use ($actedByMorphTypes) {
                    $morphTo->constrain($actedByMorphTypes);
                },
            ], orderBys: [
                ['created_at', 'desc'],
        ], perPage: 10));

        // print_r(DB::getQueryLog());
        // exit;
        return $return;
    }
}

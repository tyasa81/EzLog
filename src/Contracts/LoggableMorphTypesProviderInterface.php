<?php

namespace tyasa81\EzLoggable\Contracts;

interface LoggableMorphTypesProviderInterface
{
    // this is used in LoggableController to let the app decide what model relationship to return when calling a list of logs

    public function getLoggableMorphTypes(): array;
    // example:
    // return [
    //     SkuSourceChannel::class => function (Builder $query) {
    //         $query->with(["sku"]);
    //     }
    // ];

    public function getActedByMorphTypes(): array;
}

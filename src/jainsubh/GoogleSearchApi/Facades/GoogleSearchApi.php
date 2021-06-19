<?php

namespace jainsubh\GoogleSearchApi\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleSearchApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'jainsubh\GoogleSearchApi\GoogleSearchApi';
    }
}

<?php

namespace Services\Localization;

use Illuminate\Support\Facades\Facade;

class LocalizationFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'localization';
    }
}
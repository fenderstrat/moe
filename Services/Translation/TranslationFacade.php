<?php

namespace Services\Translation;

use Illuminate\Support\Facades\Facade;

class TranslationFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'translation';
    }
}
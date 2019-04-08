<?php

namespace Services\Table;

use Illuminate\Support\Facades\Facade;

class TableFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'table';
    }
}
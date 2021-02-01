<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FacadeService extends Facade
{
    protected static function getFacadeAccessor() {
        return 'GradesService';
    }
}
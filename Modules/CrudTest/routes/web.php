<?php

use Illuminate\Support\Facades\Route;
use Modules\CrudTest\app\Http\Controllers\CrudTestController;

    Route::resource('crudtests', CrudTestController::class)->names('crudtest');


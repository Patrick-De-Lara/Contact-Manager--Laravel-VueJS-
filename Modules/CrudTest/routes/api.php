<?php

use Illuminate\Support\Facades\Route;
use Modules\CrudTest\app\Http\Controllers\CrudTestController;
use Modules\CrudTest\app\Http\Controllers\CrudController;

Route::prefix('test')->group(function () {
    Route::apiResource('crudtests', CrudTestController::class)->names('crudtest');
    Route::get('contacts', [CrudController::class, 'showData']);
    Route::post('contacts', [CrudController::class, 'store']);
});

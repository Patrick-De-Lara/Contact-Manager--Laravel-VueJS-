<?php

use Illuminate\Support\Facades\Route;

// Redirect home to CrudTest module
Route::get('/', function () {
    return redirect('/crudtests');
});

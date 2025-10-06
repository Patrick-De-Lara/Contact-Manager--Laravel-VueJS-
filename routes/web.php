<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Redirect home to CrudTest module
Route::get('/', function () {
    return redirect('/crudtests');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Redirect home to CrudTest module
Route::get('/', function () {
    return redirect('/crudtests');
});

// Debug route to check storage (REMOVE IN PRODUCTION)
Route::get('/debug/storage', function () {
    $publicPath = public_path('storage');
    $storagePath = storage_path('app/public');
    
    return [
        'storage_link_exists' => is_link($publicPath),
        'storage_link_target' => is_link($publicPath) ? readlink($publicPath) : null,
        'public_path' => $publicPath,
        'storage_path' => $storagePath,
        'storage_files' => Storage::disk('public')->files('profile_images'),
        'storage_disk_config' => config('filesystems.disks.public'),
    ];
});

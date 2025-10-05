<?php

namespace Modules\CrudTest\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Modules\CrudTest\Database\Factories\ContactFactory;

class Contact extends Model
{
    use HasFactory;
    use CrudTrait;
    protected $table = 'contact';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_image',
    ];

    
}

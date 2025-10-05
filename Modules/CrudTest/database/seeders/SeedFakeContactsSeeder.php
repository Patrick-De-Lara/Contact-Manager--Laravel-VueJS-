<?php

namespace Modules\CrudTest\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CrudTest\app\Models\Contact;


class SeedFakeContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123-456-7890',
            'profile_image' => 'path/to/image.jpg',
        ]);
    }
}

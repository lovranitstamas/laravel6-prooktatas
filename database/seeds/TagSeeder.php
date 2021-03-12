<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //6. óra
        // $this->call(UsersTableSeeder::class);
        $tag = new Tag;
        $tag->name = "cimke #4";
        $tag->save();

    }
}

<?php

use Illuminate\Database\Seeder;
use App\Rating;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('Do not seed in production environment');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('ratings')->truncate();
        
        // Rating::create([
        //     'id'          => 1,
        //     'givenBy'     => 2,
        //     'givenTo'     => 3,
        //     'ratingValue' => 5
        // ]);

        Rating::create([
            'id'          => 2,
            'givenBy'     => 2,
            'givenTo'     => 4,
            'ratingValue' => 3
        ]);

        Rating::create([
            'id'          => 3,
            'givenBy'     => 2,
            'givenTo'     => 5,
            'ratingValue' => 4
        ]);

        Rating::create([
            'id'          => 4,
            'givenBy'     => 6,
            'givenTo'     => 5,
            'ratingValue' => 3
        ]);
        
        Rating::create([
            'id'          => 1,
            'givenBy'     => 6,
            'givenTo'     => 3,
            'ratingValue' => 5
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}

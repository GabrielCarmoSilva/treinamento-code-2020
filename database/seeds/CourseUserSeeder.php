<?php

use Illuminate\Database\Seeder;
use App\CourseUser;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CourseUser::class, 5)->create();
    }
}

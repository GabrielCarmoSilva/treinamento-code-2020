<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CourseUser;
use App\User;
use App\Course;
use Faker\Generator as Faker;

$factory->define(CourseUser::class, function (Faker $faker) {
    $users = User::all()->pluck('id')->toArray();
    $courses = Course::all()->pluck('id')->toArray();
    $user = $users[rand(1, (count($users) - 1))];
    $course = $courses[rand(1, (count($courses) - 1))];
    return [
        'user_id' => $user,
        'course_id' => $course,
    ];
});

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Database\Factories\AnswerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(3)->create()->each(function ($u) {
            $u->questions()
                ->saveMany(Question::factory(rand(1,5))->make())
                ->each(function ($q) {
                    $q->answers()->saveMany(Answer::factory(rand(1,5))->make());
                });
        });
    }
}

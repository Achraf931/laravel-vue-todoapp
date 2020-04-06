<?php

use Illuminate\Database\Seeder;

class TasksSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++)
        {
            $task = new \App\Task();
            $task->content = $faker->realText(50);
            $task->save();
        }
    }
}

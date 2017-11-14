<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             Post::create(['name' => 'Генеральный директор','salary' => 1000]);
             Post::create(['name' => 'Исполнительный директор','salary' => 900]);
             Post::create(['name' => 'Финансовый директор','salary' => 900]);
             Post::create(['name' => 'Директор департамента','salary' => 800]);
             Post::create(['name' => 'Начальник отдела','salary' => 700]);
             Post::create(['name' => 'Специалист отдела','salary' => 500]);
    }
}

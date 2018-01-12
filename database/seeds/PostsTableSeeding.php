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
             Post::create(['name' => 'Генеральный директор','salary' => 1000, 'post_priority' => 10]);
             Post::create(['name' => 'Исполнительный директор','salary' => 900, 'post_priority' => 20]);
             Post::create(['name' => 'Финансовый директор','salary' => 900, 'post_priority' => 30]);
             Post::create(['name' => 'Директор департамента','salary' => 800, 'post_priority' => 40]);
             Post::create(['name' => 'Начальник отдела','salary' => 700, 'post_priority' => 50]);
             Post::create(['name' => 'Специалист отдела','salary' => 500, 'post_priority' => 60]);
             Post::create(['name' => 'Секретарь-референт','salary' => 300, 'post_priority' => 70]);
    }
}

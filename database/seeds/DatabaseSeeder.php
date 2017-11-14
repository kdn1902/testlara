<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PostsTableSeeding::class);
         $this->call(DepartmentsTableSeeding::class);
         //$this->call(EmployeesTableSeeding::class);
    }
}

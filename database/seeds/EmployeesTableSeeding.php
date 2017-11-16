<?php

use Illuminate\Database\Seeder;
use App\Employee;
//use Faker\Generator as Faker;

class EmployeesTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $family_mas = ['Иванов','Петров','Сидоров','Морозов','Давыдов','Глушко','Семенов','Петренко','Глушко','Богданов','Стеценко','Захаров'];
	protected $name_mas = ['Иван', 'Петр','Сидор','Андрей','Давид','Дмитрий','Семен','Александр','Валерий','Артем','Вячеслав','Антон','Денис'];
	protected $otchestvo_mas = ['Иванович', 'Петрович','Сидорович','Андреевич','Давидович','Дмитриевич','Семенович','Александрович','Васильевич','Валериевич','Денисович']; 
	
    public function run()
    {
        $faker = Faker\Factory::create();
  		
  		//Директора
		for ($i = 1; $i < 4; $i++)
		{
			Employee::create(['lastname' => $this->family_mas[array_rand($this->family_mas)],
						  'firstname' => $this->name_mas[array_rand($this->name_mas)],
						  'otchestvo' => $this->otchestvo_mas[array_rand($this->otchestvo_mas)],
						  'post_id' => $i,  
						  'department_number' => 1,
						  'employment_date' => $faker->dateTimeBetween('-5 years'),
						  'birthday' => $faker->dateTimeBetween('-55 years', '-20 years'),
						  'phone' => $faker->phoneNumber,
						  'address' => $faker->address]);
		}

		//Директора департаментов
		$results = DB::table('departments')->whereBetween('department_number', [10, 99])->whereIn('department_number', function($q)
  		{
    			$q->select('department_parent')->from('departments');
		})->get();
		$departments = [];
		foreach ($results as $result)
		{
			$departments[] = $result->department_number;
			Employee::create(['lastname' => $this->family_mas[array_rand($this->family_mas)],
						  'firstname' => $this->name_mas[array_rand($this->name_mas)],
						  'otchestvo' => $this->otchestvo_mas[array_rand($this->otchestvo_mas)],
						  'post_id' => 4,  //Это директора департаментов 
						  'department_number' => $result->department_number,
						  'employment_date' => $faker->dateTimeBetween('-5 years'),
						  'birthday' => $faker->dateTimeBetween('-55 years', '-20 years'),
						  'phone' => $faker->phoneNumber,
						  'address' => $faker->address]);
		}
		
		//Начальники отделов в середине иерархии
		$results = DB::table('departments')->where('department_number', '>', 99)->whereIn('department_number', function($q)
  		{
    			$q->select('department_parent')->from('departments');
		})->get();
		$departments = [];
		foreach ($results as $result)
		{
			$departments[] = $result->department_number;
			Employee::create(['lastname' => $this->family_mas[array_rand($this->family_mas)],
						  'firstname' => $this->name_mas[array_rand($this->name_mas)],
						  'otchestvo' => $this->otchestvo_mas[array_rand($this->otchestvo_mas)],
						  'post_id' => 5,  //Это начальники отделов
						  'department_number' => $result->department_number,
						  'employment_date' => $faker->dateTimeBetween('-5 years'),
						  'birthday' => $faker->dateTimeBetween('-55 years', '-20 years'),
						  'phone' => $faker->phoneNumber,
						  'address' => $faker->address]);
		}
		
		//Отделы с подчиненными самые нижние в иерархии
  		$results = DB::table('departments')->whereNotIn('department_number', function($q)
  		{
    			$q->select('department_parent')->from('departments');
		})->get();
		$departments = [];
		foreach ($results as $result)
		{
			$departments[] = $result->department_number;
			Employee::create(['lastname' => $this->family_mas[array_rand($this->family_mas)],
						  'firstname' => $this->name_mas[array_rand($this->name_mas)],
						  'otchestvo' => $this->otchestvo_mas[array_rand($this->otchestvo_mas)],
						  'post_id' => 5,  //Это начальники отлелов 
						  'department_number' => $result->department_number,
						  'employment_date' => $faker->dateTimeBetween('-5 years'),
						  'birthday' => $faker->dateTimeBetween('-55 years', '-20 years'),
						  'phone' => $faker->phoneNumber,
						  'address' => $faker->address]);
		}
        for ($i=1; $i < 50000; $i++)
        {
			Employee::create(['lastname' => $this->family_mas[array_rand($this->family_mas)],
						  'firstname' => $this->name_mas[array_rand($this->name_mas)],
						  'otchestvo' => $this->otchestvo_mas[array_rand($this->otchestvo_mas)],
						  'post_id' => 6,  //Специалисты отделов
						  'department_number' => $departments[array_rand($departments)],
						  'employment_date' => $faker->dateTimeBetween('-5 years'),
						  'birthday' => $faker->dateTimeBetween('-55 years', '-20 years'),
						  'phone' => $faker->phoneNumber,
						  'address' => $faker->address]);
		}
    }
}

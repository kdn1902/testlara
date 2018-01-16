<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             Department::create(['name' => 'Дирекция','department_number'=>1,'department_parent'=>0]);
             Department::create(['name' => 'Финансовая дирекция','department_number'=>2,'department_parent'=>1]);
             Department::create(['name' => 'Исполнительная дирекция','department_number'=>3,'department_parent'=>1]);
             Department::create(['name' => 'Департамент ИТ технологий','department_number'=>4,'department_parent'=>3]);             
             Department::create(['name' => 'Юридический департамент','department_number'=>5,'department_parent'=>3]);
             Department::create(['name' => 'Транспортный департамент','department_number'=>6,'department_parent'=>3]);
             Department::create(['name' => 'Финансовый департамент','department_number'=>7,'department_parent'=>2]);
                          
             Department::create(['name' => 'Отдел разработки ПО','department_number'=>8,'department_parent'=>4]);
             Department::create(['name' => 'Отдел сопровождения','department_number'=>9,'department_parent'=>4]);         
             Department::create(['name' => 'Юридический отдел','department_number'=>10,'department_parent'=>5]);
             Department::create(['name' => 'ОВЭС','department_number'=>11,'department_parent'=>5]);
             Department::create(['name' => 'Отдел логистики','department_number'=>12,'department_parent'=>6]);
             Department::create(['name' => 'Отдел доставки','department_number'=>13,'department_parent'=>6]);
             Department::create(['name' => 'Бухгалтерия','department_number'=>14,'department_parent'=>7]);
                 
             Department::create(['name' => 'Отдел разработки бизнес ПО','department_number'=>15,'department_parent'=>8]);
             Department::create(['name' => 'Отдел разработки системного ПО','department_number'=>16,'department_parent'=>8]);
             Department::create(['name' => 'Отдел телекоммуникация и связи','department_number'=>17,'department_parent'=>9]);
             Department::create(['name' => 'Отдел мониторинга','department_number'=>18,'department_parent'=>9]);
             Department::create(['name' => 'Отдел технической поддержки','department_number'=>19,'department_parent'=>9]);
             Department::create(['name' => 'Отдел системного администрирования','department_number'=>20,'department_parent'=>9]);
             
             Department::create(['name' => 'Отдел разработки специализированного бизнес ПО','department_number'=>21,'department_parent'=>15]);
             Department::create(['name' => 'Отдел разработки приложений для баз данных','department_number'=>22,'department_parent'=>15]);                 Department::create(['name' => 'Отдел разработки ОС','department_number'=>23,'department_parent'=>16]);
             Department::create(['name' => 'Отдел разработки СУБД','department_number'=>24,'department_parent'=>16]);
             Department::create(['name' => 'Отдел голосовой связи','department_number'=>25,'department_parent'=>17]);
             Department::create(['name' => 'Отдел IP телефонии','department_number'=>26,'department_parent'=>17]);
             Department::create(['name' => 'Отдел мониторинга серверов','department_number'=>27,'department_parent'=>18]);
             Department::create(['name' => 'Отдел мониторинга ЛВС','department_number'=>28,'department_parent'=>18]);
             Department::create(['name' => 'Отдел поддержки оргтехники','department_number'=>29,'department_parent'=>19]);
             Department::create(['name' => 'Отдел поддержки пользователей','department_number'=>30,'department_parent'=>19]);
             Department::create(['name' => 'Отдел серверов','department_number'=>31,'department_parent'=>20]);
             Department::create(['name' => 'Отдел интернет технологий','department_number'=>32,'department_parent'=>20]);
                          
             Department::create(['name' => 'Водители','department_number'=>33,'department_parent'=>13]);
             Department::create(['name' => 'Ремонтные службы','department_number'=>34,'department_parent'=>13]);

             Department::create(['name' => 'Производственная бухгалтерия','department_number'=>35,'department_parent'=>14]);
             Department::create(['name' => 'Финансовая бухгалтерия','department_number'=>36,'department_parent'=>14]);
			 Department::create(['name' => 'Расчетный отдел','department_number'=>37,'department_parent'=>7]);

        
    }
}

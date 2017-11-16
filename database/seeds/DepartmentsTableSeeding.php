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
             
             Department::create(['name' => 'Департамент ИТ технологий','department_number'=>10,'department_parent'=>1]);
             Department::create(['name' => 'Отдел разработки ПО','department_number'=>100,'department_parent'=>10]);
             Department::create(['name' => 'Отдел сопровождения','department_number'=>101,'department_parent'=>10]);             
             Department::create(['name' => 'Отдел разработки бизнес ПО','department_number'=>1000,'department_parent'=>100]);
             Department::create(['name' => 'Отдел разработки системного ПО','department_number'=>1001,'department_parent'=>100]);
             Department::create(['name' => 'Отдел телекоммуникация и связи','department_number'=>1002,'department_parent'=>101]);
             Department::create(['name' => 'Отдел мониторинга','department_number'=>1003,'department_parent'=>101]);
             Department::create(['name' => 'Отдел технической поддержки','department_number'=>1004,'department_parent'=>101]);
             Department::create(['name' => 'Отдел системного администрирования','department_number'=>1005,'department_parent'=>101]);
             Department::create(['name' => 'Отдел разработки специализированного бизнес ПО','department_number'=>10001,'department_parent'=>1000]);
             Department::create(['name' => 'Отдел разработки приложений для баз данных','department_number'=>10002,'department_parent'=>1000]);      
             Department::create(['name' => 'Отдел разработки ОС','department_number'=>10003,'department_parent'=>1001]);
             Department::create(['name' => 'Отдел разработки СУБД','department_number'=>10004,'department_parent'=>1001]);
             Department::create(['name' => 'Отдел голосовой связи','department_number'=>10005,'department_parent'=>1002]);
             Department::create(['name' => 'Отдел IP телефонии','department_number'=>10006,'department_parent'=>1002]);
             Department::create(['name' => 'Отдел мониторинга серверов','department_number'=>10007,'department_parent'=>1003]);
             Department::create(['name' => 'Отдел мониторинга ЛВС','department_number'=>10008,'department_parent'=>1003]);
             Department::create(['name' => 'Отдел поддержки оргтехники','department_number'=>10009,'department_parent'=>1004]);
             Department::create(['name' => 'Отдел поддержки пользователей','department_number'=>10010,'department_parent'=>1004]);
             Department::create(['name' => 'Отдел серверов','department_number'=>10011,'department_parent'=>1005]);
             Department::create(['name' => 'Отдел интернет технологий','department_number'=>10012,'department_parent'=>1005]);
                          
             Department::create(['name' => 'Юридический департамент','department_number'=>20,'department_parent'=>1]);
             Department::create(['name' => 'Юридический отдел','department_number'=>201,'department_parent'=>20]);
             Department::create(['name' => 'ОВЭС','department_number'=>202,'department_parent'=>20]);
             
             Department::create(['name' => 'Транспортный департамент','department_number'=>30,'department_parent'=>1]);
             Department::create(['name' => 'Отдел логистики','department_number'=>301,'department_parent'=>30]);
             Department::create(['name' => 'Отдел доставки','department_number'=>302,'department_parent'=>30]);
             Department::create(['name' => 'Водители','department_number'=>3000,'department_parent'=>302]);
             Department::create(['name' => 'Ремонтные службы','department_number'=>3001,'department_parent'=>302]);
             
             Department::create(['name' => 'Финансовый департамент','department_number'=>40,'department_parent'=>1]);
             Department::create(['name' => 'Бухгалтерия','department_number'=>400,'department_parent'=>40]);
             Department::create(['name' => 'Производственная бухгалтерия','department_number'=>4001,'department_parent'=>400]);
             Department::create(['name' => 'Финансовая бухгалтерия','department_number'=>4002,'department_parent'=>400]);
			 Department::create(['name' => 'Расчетный отдел','department_number'=>401,'department_parent'=>40]);

        
    }
}

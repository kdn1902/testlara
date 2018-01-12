<?php
namespace App;

use Illuminate\Support\Facades\DB;

class MyFunctions {
	
/*	private $dsn;
	private $opt;
	private $pdo;*/
	private $jsonstr;
	
	public function __construct()
	{
/*		$this->dsn = "mysql:host=127.0.0.1;dbname=testlara";
		$this->opt = [ \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    				   \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ];
    	$this->pdo = new \PDO($this->dsn, 'root', '', $this->opt);*/
    	$this->jsonstr = "";
	}
	
	public function showTree($pid)
	{
		$this->calcTree2($pid);
		return $this->jsonstr;
	}
/*	
    private function calcTree($pid)
    {
    	$stmt = $this->pdo->prepare("select * from departments where department_parent=?");
    	$stmt->execute(array($pid));
		$zpt = "";
		while ($row = $stmt->fetch())
    	{
			$count = intval($this->pdo->query("select count(*) as count from departments where department_parent=" . $row['department_number'])->fetch()['count']);
			$stmt2 = $this->pdo->prepare("select employees.id, employees.lastname, employees.firstname, employees.otchestvo, posts.id as post_id, posts.name as dolgnost from employees, posts where posts.id = employees.post_id and employees.department_number=? order by post_id");
			$stmt2->execute(array($row['department_number']));
			$row2 = $stmt2->fetchAll();
			$this->jsonstr .= "{$zpt}{\"text\":\"{$row2[0]['lastname']} {$row2[0]['firstname']} {$row2[0]['otchestvo']} - {$row['name']} - {$row2[0]['dolgnost']}\",\"id\":\"{$row2[0]['id']}\",\"data\":{\"department_id\":\"{$row['department_number']}\", \"post_id\":\"{$row2[0]['post_id']}\"}";
			$zpt = ",";
			if ($count > 0 || count($row2) > 1)
			{
				$this->jsonstr .= ",\"children\": [";
				$this->calcTree($row['department_number']);
				$zpt2 = ($count > 0) ? "," : "";
				for ($i=1; $i < count($row2); $i++ )
				{
					$this->jsonstr .= "{$zpt2}{\"text\":\"{$row2[$i]['lastname']} {$row2[$i]['firstname']} {$row2[$i]['otchestvo']} - {$row['name']} - {$row2[$i]['dolgnost']}\",\"id\":\"{$row2[$i]['id']}\",\"data\":{\"department_id\":\"{$row['department_number']}\", \"post_id\":\"{$row2[$i]['post_id']}\"}}";
					$zpt2 =",";
				}
				$this->jsonstr .= "]}";
			}
		else
			$this->jsonstr .= "}";
    	}
    }
  */
    
    private function calcTree2($pid)
    {
		$zpt = "";
    	$results = DB::select( DB::raw("select * from departments where department_parent=?"), [$pid] );
    	foreach($results as $row)
    	{
    		$count = DB::select(DB::raw("select count(*) as count from departments where department_parent=" . $row->department_number))[0]->count;
    		$row2 =	DB::select(DB::raw("select employees.id, employees.lastname, employees.firstname, employees.otchestvo, posts.id as post_id, posts.name as dolgnost from employees, posts where posts.id = employees.post_id and employees.department_number=? order by post_priority"),[$row->department_number]);
/*    		$row2 =	DB::select(DB::raw("select employees.id, employees.lastname, employees.firstname, employees.otchestvo, posts.id as post_id, posts.name as dolgnost from employees, posts where posts.id = employees.post_id and employees.department_number=? order by post_id"),[$row->department_number]);*/

    		$opened = ($row2[0]->post_id < 4) ? ", \"state\":{opened:true}" : "";
			$this->jsonstr .= "{$zpt}{\"text\":\"{$row2[0]->lastname} {$row2[0]->firstname} {$row2[0]->otchestvo} - {$row->name} - {$row2[0]->dolgnost}\",\"id\":\"{$row2[0]->id}\",\"data\":{\"department_id\":\"{$row->department_number}\", \"post_id\":\"{$row2[0]->post_id}\"}{$opened}";
			
			$zpt = ",";
			if ($count > 0 || count($row2) > 1)
			{
				$this->jsonstr .= ",\"children\": [";
				$this->calcTree2($row->department_number);
				$zpt2 = ($count > 0) ? "," : "";
				for ($i=1; $i < count($row2); $i++ )
				{
					$this->jsonstr .= "{$zpt2}{\"text\":\"{$row2[$i]->lastname} {$row2[$i]->firstname} {$row2[$i]->otchestvo} - {$row->name} - {$row2[$i]->dolgnost}\",\"id\":\"{$row2[$i]->id}\",\"data\":{\"department_id\":\"{$row->department_number}\", \"post_id\":\"{$row2[$i]->post_id}\"}}";
					$zpt2 =",";
				}
				$this->jsonstr .= "]}";
			}
			else
			{
				$this->jsonstr .= "}";	
			}
    	}
	}
}
<?php
namespace App;

use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

Class EloquentVueTables
{

  public function get($model, Array $fields) {
    extract(Input::only('query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn', 'datefields'));
    $data = $model->select($fields);
    if (isset($query) && $query) {
//     $data = $byColumn==1?$this->filterByColumn($data, $query):
     $data = $this->filter($data, $query, $fields, $datefields);
   }
   $count = $data->count();
   $data->limit($limit)
   ->skip($limit * ($page-1));
   if (isset($orderBy)):
    $direction = $ascending==1?"ASC":"DESC";
    $data->orderBy($orderBy,$direction);
  endif;
  $results = $data->get()->toArray();
  return ['data'=>$results, 'count'=>$count];
}

/*
protected function filterByColumn($data, $query) {
  foreach ($query as $field=>$query):
    if (!$query) continue;
    if (is_string($query)) {
     $data->where($field,'LIKE',"%{$query}%");
   } else {
    $start = Carbon::createFromFormat('Y-m-d',$query['start'])->startOfDay();
    $end = Carbon::createFromFormat('Y-m-d',$query['end'])->endOfDay();
    $data->whereBetween($field,[$start, $end]);
  }
endforeach;
return $data;
}
*/
protected function filter($data, $query, $fields, $datefields) {
  foreach ($fields as $index=>$field)
  {
  	 // если поиск по числу или поиск не в поле даты, то добавляем в запрос
  	 // если строка и поле даты, то нет
   	 if( is_numeric($query) || (! in_array($field, $datefields)) )
     {
            $method = $index?"orWhere":"where";
    		$data->{$method}($field,'LIKE',"%{$query}%");
     }
  }
  return $data;
}

}
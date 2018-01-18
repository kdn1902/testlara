@extends('layouts.index')

@section('content')
    <div id="empl">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1">
        	<div class="panel panel-default">        	
               <div class="panel-body" >
                       <p id="status" class="text-success">Status</p>
                       <ul>
                       		<li><p class="text-danger">Ошибки</p></li>	
                       </ul>
        	    </div>
        	</div>
       		</div>
        </div>
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading">Сотрудник т.№ 
                    		<div class="pull-right">
                    			<button type="submit" name="addemployee" class="btn btn-primary btn-sm">Добавить сотрудника</button>
                    		</div>
                    </div>
                    <div class="panel-body">
                    <table class="table table-bordered">
   					<thead>
						<th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Дата рождения</th>
						<th>Номер телефона</th><th>Адрес</th>
					</thead>
					<tr>
					<td >
						<input class="form-control" name="lastname" />
					</td>
					<td>
						<input class="form-control" name="firstname" />
					</td>
					<td>
						<input class="form-control" name="otchestvo" />
					</td>
					<td>
						<input type="date" name="birthday" />
					</td>
					<td>
						<input class="form-control" name="phone" />
					</td>
					<td>
						<textarea class="form-control" name="address" ></textarea>
					</td>
				
					</tr>
                    </table>
                    </div>
                    </div>
            </div>
        </div>
                    

         <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                    <div class="panel-body">
                    <table class="table table-bordered">
   					<thead>
						<th>Должность</th><th>Отдел</th><th>Дата приема на работу</th><th>Зарплата</th>
					</thead>
					<tr>
					<td>
						<select name="curr_post" class="form-control">
  							<option>
    								Дирехтар
  							</option>
						</select>
					</td>
					<td>
						<select name="curr_depart" class="form-control">
  							<option>
    								Дирекция
  							</option>
						</select>
					</td>

					<td>
						<input type="date" name="employment_date" />
					</td>
					<td>
						<input type="radio" id="pers_salary" value="pers_salary" name="picked_salary" />
						<label for="pers_salary">Персональный оклад:&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="salary" />
						<br>
						<input type="radio" id="stat_salary" value="stat_salary" name="picked_salary" />
						<label for="stat_salary">Оклад согласно штатному расписанию</label>
					</td>
					</tr>
					</table>
				    </div>
			</div>
			</div>
		</div>                    
        
        
        <div class="row">
      		<div class="col-md-10 col-md-offset-1">
        		<div class="panel panel-default">
                    <div class="panel-heading">Загрузка фото</div>
                    <div class="panel-body">
	    		        <form enctype="multipart/form-data">
            				<input type="file" accept="image/*" name="image" />
            				<button type="button" class="btn btn-primary">Загрузить</button>
            				<br /><img src="src" />
        				</form>
	    			</div>
	    			</div>
    		</div>
	   	</div>
	
	<div id="bigFoto" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<img src="foto_url"></img>
			</div>
		</div>
	</div>
</div>



@endsection

@section('scripts')
<script src="/js/app.js"></script>
@endsection

@section('styles')

@endsection
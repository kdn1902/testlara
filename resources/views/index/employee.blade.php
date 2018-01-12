@extends('layouts.index')

@section('content')
    <div id="empl">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1" v-if="status || err" >
        	<div class="panel panel-default">        	
               <div class="panel-body" >
                       <p v-if="status" class="text-success">@{{ status }}</p>
                       <ul v-if="err">
                       		<li v-for="value in err"><p class="text-danger">@{{ value[0] }}</p></li>	
                       </ul>
        	    </div>
        	</div>
       		</div>
        </div>
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading">Сотрудник т.№ {{$empl["id"]}}
                    		<div class="pull-right">
                    			<button type="button" class="btn btn-primary btn-sm" @click.prevent="saveEmployee">Сохранить изменения</button>
                    		</div>
                    </div>
                    <div class="panel-body">
                    <table class="table table-bordered">
   					<thead>
						<th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Дата рождения</th>
						<th>Номер телефона</th><th>Адрес</th><th>Фото</th></th>
					</thead>
					<tr>
					<td @click.self = "is_lastname_view = ! is_lastname_view; ">
						<template v-if="is_lastname_view"  > @{{ lastname }} </template>
						<template v-else><input v-focus class="form-control" v-model="lastname" @blur="is_lastname_view = true" @keyup.13 = "is_lastname_view = true" />
            			</template>
					</td>
					<td @click.self = "is_firstname_view = ! is_firstname_view">
						<template v-if="is_firstname_view"> @{{ firstname }} </template>
						<template v-else><input v-focus class="form-control" v-model="firstname" @blur="is_firstname_view = true" @keyup.13 = "is_firstname_view = true" />
						</template>
					</td>
					<td @click.self = "is_otchestvo_view = ! is_otchestvo_view">
						<template v-if="is_otchestvo_view"> @{{ otchestvo }} </template>
						<template v-else><input  v-focus class="form-control" v-model="otchestvo"  @blur = "is_otchestvo_view = true" @keyup.13 = "is_otchestvo_view = true"/></template>
					</td>
					<td @click.self = "is_birthday_view = ! is_birthday_view">
						<template v-if="is_birthday_view"> @{{ birthday }}</template>
						<template v-else><mydatepicker :ddate="birthday" @changedate="changeBirthday"></mydatepicker></template>
					</td>
					<td @click.self = "is_phone_view = ! is_phone_view">
						<template v-if="is_phone_view"> @{{ phone }} </template>
						<template v-else><input  v-focus class="form-control" v-model="phone"  @blur = "is_phone_view = true" @keyup.13 = "is_phone_view = true"/></template>
					</td>
					<td @click.self = "is_address_view = ! is_address_view">
						<template v-if="is_address_view"> @{{ address }} </template>
						<template v-else><textarea  v-focus class="form-control" v-model="address" @blur = "is_address_view = true" @keyup.13 = "is_address_view = true" /></textarea></template>
					</td>
					<td>
						<template v-if="! has_foto">Нет фото</template>
						<template v-else>
									<a data-toggle="modal" data-target="#bigFoto">
								    <img v-bind:src="small_foto_url"></img></a>
								    <button type="button" class="btn btn-danger btn-xs" @click="dropFoto">Удалить фото</button>
						</template>	
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
					<td @click.self = "editPost">
						<template v-if="is_post_name_view"> @{{ curr_post.name }} </template>
						<template v-else>
						<select v-focus v-model="curr_post" class="form-control" @change = "is_post_name_view = true" @blur = "is_post_name_view = true">
  							<option v-for="post in posts" v-bind:value="{ id: post.id, name: post.name }">
    								@{{ post.name }}
  							</option>
						</select>
						</template>
					</td>
					<td @click.self = "editDepartment">
						<template v-if="is_department_name_view"> @{{ curr_depart.name }} </template>
						<template v-else>
						<select v-focus v-model="curr_depart" class="form-control" @change = "is_department_name_view = true"   @blur = "is_department_name_view = true">
  							<option v-for="depart in departments" v-bind:value="{ id: depart.department_number, name: depart.name }">
    								@{{ depart.name }}
  							</option>
						</select>
						</template>
					</td>

					<td @click.self = "is_employment_date_view = ! is_employment_date_view">
						<template v-if="is_employment_date_view"> @{{ employment_date }}</template>
						<template v-else><mydatepicker :ddate="employment_date" @changedate="changeEmploymentDate"></mydatepicker></template>
					</td>
					<td>
						<input type="radio" id="pers_salary" value="pers_salary" v-model="picked_salary" />
						<label for="pers_salary">Персональный оклад:&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="salary" v-model="salary" v-bind:disabled="salary_input_disabled" />
						<br>
						<input type="radio" id="stat_salary" value="stat_salary" v-model="picked_salary" />
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
            				<input type="file" accept="image/*" name="image" @change="changeFoto" />
            				<button type="button" class="btn btn-primary" @click="uploadFoto">Загрузить</button>
            				<br /><img v-bind:src="src" />
        				</form>
	    			</div>
	    			</div>
    		</div>
	   	</div>
	
	<div id="bigFoto" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<img v-bind:src="foto_url"></img>
			</div>
		</div>
	</div>
</div>



@endsection

@section('scripts')
<script src="/js/app.js"></script>

<script>

Vue.directive('focus', {
  inserted: function (el) {
    el.focus();
  }
})

new Vue({
   el: '#empl',
   data: {
   	 id: "{{$empl["id"]}}",
   	 is_lastname_view: true,
 	 lastname: "{{$empl["lastname"]}}",
   	 is_firstname_view: true,
 	 firstname: "{{$empl["firstname"]}}",
   	 is_otchestvo_view: true,
 	 otchestvo: "{{$empl["otchestvo"]}}",
 	 is_birthday_view: true,
 	 birthday: "{{$empl["birthday"]}}",
  	 is_employment_date_view: true,
 	 employment_date: "{{$empl["employment_date"]}}",
  	 is_post_name_view: true,
 	 curr_post:{ 
 	 	name:"{{$empl["post_name"]}}",
 	 	id: "{{$empl["post_id"]}}",
 	 },
  	 is_department_name_view: true,
  	 curr_depart:{
	 	 name: "{{$empl["department_name"]}}",
 		 id: "{{$empl["department_number"]}}",
	 },
   	 is_phone_view: true,
 	 phone: "{{$empl["phone"]}}",
   	 is_address_view: true,
 	 address: `{{$empl["address"]}}`,
 	 status: `{{ $empl["status"] }}`,
 	 small_foto: `{{ $empl["small_foto"] }}`,
 	 foto: `{{ $empl["foto"] }}`,
 	 posts: [],
 	 departments: [],
 	 err: null,
 	 image: null,
 	 content: null,
 	 salary: `{{ $empl["personal_salary"] }}`,
 	 picked_salary: `{{ $empl["picked_salary"] }}`,
    },
   computed: {
     salary_input_disabled: function (){
	     return this.picked_salary === "stat_salary" ? true : false;
	 },
   	 has_foto: function(){
 	 	 return this.small_foto == ""? false: true;
	 },
	 small_foto_url: function(){
	     return "/storage/" + this.small_foto;
	 },
	 foto_url: function(){
	 	 return "/storage/" + this.foto;
	 },
	 src: function() {
         if (this.content) {
            return this.content;
	     }
	 },
	 personal_salary: function(){
           	if(this.picked_salary == "pers_salary")  		
        	{
				return this.salary;
			}
			else
			{
				return null;	
			}
	 }
   },
   methods:{
   	 dropFoto: function(){
   	 	if (confirm("Вы хотите удалить фото?"))
   	 	{
   		 	axios.post('/dropfoto', {
   	 			id:this.id
   	 		})
			.then(response => {
				this.foto = response.data.foto;
				this.small_foto = response.data.small_foto;
        	})
        	.catch(error => {
        	    console.log(error);
        	})
    	}
	 },
   	 changeFoto: function(e) {
	 	e.preventDefault();
        this.image = e.target.files[0];
        let reader = new FileReader();
        reader.onload = this.onImageLoad;
        reader.readAsDataURL(this.image);
	 },
	 onImageLoad: function(e) {
        this.content = e.target.result;
     },
   	 uploadFoto: function() {
   	 	data = new FormData();
		data.append('image', this.image);
		data.append('id', this.id);
		axios.post('/upload', data)
			.then(response => {
				this.foto = response.data.foto;
				this.small_foto = response.data.small_foto;
        	})
        	.catch(error => {
        	    console.log(error);
        	})
	 },
  	 changeBirthday: function(newdata) {
   	 	this.birthday = newdata;
   	 },
   	 changeEmploymentDate: function(newdata) {
   	 	this.employment_date = newdata;
   	 },

  	saveEmployee: function(){
  		    console.log(this.picked_salary);
  		    console.log(this.salary);
  		 	axios.post('/setemployee', {
                department_number: this.curr_depart.id,
                post_id: this.curr_post.id,
                id: this.id,
                lastname: this.lastname,
                firstname: this.firstname,
                otchestvo: this.otchestvo,
                employment_date: this.employment_date,
                birthday: this.birthday,
                phone: this.phone,
                address: this.address,
			    personal_salary: this.personal_salary,
        		}
        	)
        	.then(response => {
        		this.err = null;
        	    this.status = response.data.status;
        	})
        	.catch(error => {
        		this.status = null;
        	    this.err = error.response.data.errors;
        	})
	},
	editPost: function(){
		if(this.is_post_name_view === true)
		{
			axios.get('/getposts')
			.then( response => {
  					   this.posts = response.data;
  			})
			.catch(error => {
    				console.log(error);
  			});
		}
		this.is_post_name_view = ! this.is_post_name_view;
	},
	editDepartment: function(){
		if(this.is_department_name_view === true)
		{
			axios.get('/getdepartments')
			.then( response =>  {
  					   this.departments = response.data;
  					   console.log(this.departments);
  			})
  			.catch(error => {
    				console.log(error);
  			});
		}
		this.is_department_name_view = ! this.is_department_name_view;
	}
  }
});
</script>
@endsection

@section('styles')

@endsection
@extends('layouts.index')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">Сотрудник</div>
                    <div class="panel-body">
                    <div id="empl">
                    <table class="table table-bordered">
					<thead>
						<th>№</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Должность</th><th>Отдел</th><th>Дата рождения</th>
						<th>Номер телефона</th><th>Адрес</th><th></th>
					</thead>
					<tr>
					<td>{{$empl["id"]}}</td>
					<td @click.self = "is_lastname_view = ! is_lastname_view">
						<template v-if="is_lastname_view"> @{{ lastname }} </template>
						<template v-else><input class="form-control" v-model="lastname"  @keyup.13 = "is_lastname_view = true"/></template>
					</td>
					<td @click.self = "is_firstname_view = ! is_firstname_view">
						<template v-if="is_firstname_view"> @{{ firstname }} </template>
						<template v-else><input class="form-control" v-model="firstname"  @keyup.13 = "is_firstname_view = true"/></template>
					</td>
					<td @click.self = "is_otchestvo_view = ! is_otchestvo_view">
						<template v-if="is_otchestvo_view"> @{{ otchestvo }} </template>
						<template v-else><input class="form-control" v-model="otchestvo"  @keyup.13 = "is_otchestvo_view = true"/></template>
					</td>
					<td @click.self = "editPost">
						<template v-if="is_post_name_view"> @{{ curr_post.name }} </template>
						<template v-else>
						<select v-model="curr_post" class="form-control" @change = "is_post_name_view = true">
  							<option v-for="post in posts" v-bind:value="{ id: post.id, name: post.name }">
    								@{{ post.name }}
  							</option>
						</select>
						</template>
					</td>
					<td @click.self = "editDepartment">
						<template v-if="is_department_name_view"> @{{ curr_depart.name }} </template>
						<template v-else>
						<select v-model="curr_depart" class="form-control" @change = "is_department_name_view = true">
  							<option v-for="depart in departments" v-bind:value="{ id: depart.id, name: depart.name }">
    								@{{ depart.name }}
  							</option>
						</select>
						</template>
					</td>
					
					<td @click.self = "is_birthday_view = ! is_birthday_view">
						<template v-if="is_birthday_view"> @{{ birthday }} </template>
						<template v-else><input class="form-control" v-model="birthday"  @keyup.13 = "is_birthday_view = true"/></template>
					</td>
					<td @click.self = "is_phone_view = ! is_phone_view">
						<template v-if="is_phone_view"> @{{ phone }} </template>
						<template v-else><input class="form-control" v-model="phone"  @keyup.13 = "is_phone_view = true"/></template>
					</td>
					<td @click.self = "is_address_view = ! is_address_view">
						<template v-if="is_address_view"> @{{ address }} </template>
						<template v-else><textarea class="form-control" v-model="address" @keyup.13 = "is_address_view = true" /></textarea></template>
					</td>
					<td><button type="button" class="btn btn-success" @click="saveEmployee">Сохранить</button></td>
					</tr>
					</table>
					</div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>

<script>
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
  	 is_post_name_view: true,
 	 curr_post:{ 
 	 	name:"{{$empl["post_name"]}}",
 	 	id: "{{$empl["post_id"]}}",
 	 },
  	 is_department_name_view: true,
  	 curr_depart:{
	 	 name: "{{$empl["department_name"]}}",
 		 id: "{{$empl["department_id"]}}",
	 },
   	 is_phone_view: true,
 	 phone: "{{$empl["phone"]}}",
   	 is_address_view: true,
 	 address: `{{$empl["address"]}}`,
 	 posts: [],
 	 departments: []
   },
   methods:{
  	saveEmployee: function(){
		console.log(this.curr_post.id + this.curr_post.name);
	},
	editPost: function(){
		if(this.is_post_name_view === true)
		{
			axios.get('/api/getposts')
  				.then( response =>  {
  					   this.posts = response.data;
  			})
  			.catch(function (error) {
    				console.log(error);
  			});
		}
		this.is_post_name_view = ! this.is_post_name_view;
	},
	editDepartment: function(){
		if(this.is_department_name_view === true)
		{
			axios.get('/api/getdepartments')
  				.then( response =>  {
  					   this.departments = response.data;
  			})
  			.catch(function (error) {
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
@extends('layouts.index')

@section('content')
    <div id="empl">
    
      @if ( isset($status) || count($errors) > 0 )
        <div class="row">
        	<div class="col-md-10 col-md-offset-1" >
        	<div class="panel panel-default">        	
               <div class="panel-body" >
               @if (!empty($status))
                       <p class="text-success">{{ $status }}</p>
               @endif
			   @if (count($errors) > 0)
  					<div class="alert alert-danger">
    				<ul>
    				@foreach ($errors->all() as $error)
      						<li><p class="text-danger">{{ $error }}</p></li>
    				@endforeach
    				</ul>
  					</div>
			   @endif
    			</div>
        	</div>
       		</div>
        </div>
		@endif
		        
        <form action="/newemployee" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading">Новый сотрудник 
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
						<input class="form-control" name="lastname"  id="lastname" value="{{ old('lastname') }}" />
					</td>
					<td>
						<input class="form-control" name="firstname" id="firstname" value="{{ old('firstname') }}" />
					</td>
					<td>
						<input class="form-control" name="otchestvo" id="otchestvo" value="{{ old('otchestvo') }}" />
					</td>
					<td>
						<mydatepicker :ddate="birthday" @changedate="changeBirthday"></mydatepicker>
						<input type="hidden" v-model="birthday" name="birthday"/>
					</td>
					<td>
						<input class="form-control" name="phone" id="phone" value="{{ old('phone') }} "/>
					</td>
					<td>
						<textarea class="form-control" name="address" id="address" >{{ old('address') }}</textarea>
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
						<select v-model="curr_postid" v-init:curr_postid="'{{ old('curr_post') }}'" class="form-control" name="curr_post" id="curr_post">
  							<option v-for="post in posts" v-bind:value="post.id">
    								@{{ post.name }}
  							</option>
						</select>
					</td>
					<td>
					   <select v-model="curr_departid" v-init:curr_departid="'{{ old('curr_depart') }}'" class="form-control" name="curr_depart" id="curr_depart">
  							<option v-for="depart in departments" v-bind:value="depart.department_number">
    								@{{ depart.name }}
  							</option>
						</select>
					</td>

					<td>
						<mydatepicker :ddate="employment_date" @changedate="changeEmploymentDate"></mydatepicker>
						<input type="hidden" v-model="employment_date" name="employment_date" />
					</td>
					<td>
						<input type="radio" id="pers_salary" value="pers_salary" v-model="picked_salary" name="pers_salary"/>
						<label for="pers_salary">Персональный оклад:&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="salary" v-init:salary="'{{ old('salary') }}'" v-model="salary" v-bind:disabled="salary_input_disabled" />
						<br>
						<input type="radio" id="stat_salary" value="stat_salary" v-model="picked_salary" name="stat_salary" />
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
            				<input type="file" accept="image/*" name="image" @change="changeFoto" />
            				<br /><img v-bind:src="src" />
	    			</div>
	    			</div>
    		</div>
	   	</div>
	    </form>

</div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>
<script>
	Vue.directive('init', {
  		bind: function(el, binding, vnode) {
    	vnode.context[binding.arg] = binding.value;
  	}
	});
	
	vm = new Vue({
   		el: '#empl',
   		data: {
				birthday: null,
				employment_date: null,
				posts: [],
 				departments: [],
 				curr_departid: null,
	 			curr_postid: null,
 	 			picked_salary: "stat_salary",
 	 			salary: null,
 	 			content: null,
 	 			image: null
			  },
		methods:{
		  	   changeBirthday: function(newdata) {
   	 		 		this.birthday = newdata;
   	 		 	},
   	 	  	   changeEmploymentDate: function(newdata) {
   	 				this.employment_date = newdata;
   	 			},
  	 		   get_department: function(){
					axios.get('/getdepartments')
					.then( response =>  {
  							this.departments = response.data;
  					})
  					.catch(error => {
    						console.log(error);
				  	});	
				},
				get_posts: function(){
					axios.get('/getposts')
					.then( response => {
  						   this.posts = response.data;
  					})
					.catch(error => {
    					console.log(error);
  					});	
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
     			}
		},
		mounted: function(){
			this.get_department();
			this.get_posts();
			this.birthday = (`{{ old('birthday') }}`.length > 0) ? `{{ old('birthday') }}` : new Date().toLocaleFormat('%Y-%m-%d');
			this.employment_date = (`{{ old('employment_date') }}`.length > 0) ? `{{ old('employment_date') }}` : new Date().toLocaleFormat('%Y-%m-%d');
		},
		computed: {
     		salary_input_disabled: function (){
	     		return this.picked_salary === "stat_salary" ? true : false;
	 		},
	 	 	src: function() {
         		if (this.content) return this.content;
	     	}
	 	}
    });   	

</script>
@endsection

@section('styles')

@endsection
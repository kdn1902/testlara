@extends('layouts.index')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">Сотрудники</div>
                    <div class="panel-body">
					<div id="serverpeople">
  							<v-server-table url="/getemployees" :columns="columns" :options="options">
  							<template slot="id" slot-scope="props">
    							<div>
      								<a :href=getemployee(props.row.id)> @{{props.row.id}}</a>
    							</div>
    						</template>
 							<template slot="birthday" slot-scope="props">
    							<div>
      								@{{ getdate(props.row.birthday) }}
    							</div>
    						</template>
 							<template slot="small_foto" slot-scope="props">
 								<template v-if="! has_foto(props.row.small_foto)">Нет фото</template>
								<template v-else><img v-bind:src="get_small_foto_url(props.row.small_foto)"></img></template>	
    						</template>
  							</v-server-table>
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
    el: "#serverpeople",
    data: {
        columns: ['id', 'lastname', 'firstname', 'otchestvo','birthday','small_foto'],
        options: {
        	headings:{
        		id: '№',
            	lastname: 'Фамилия',
              	firstname: 'Имя',
              	otchestvo: 'Отчество',
              	birthday: 'День рождения',
              	small_foto: 'Фото'
            },
			params: {
				datefields: ['birthday']
			},
        	requestFunction: function (data) 
			{
				return axios.get(this.url, {
					params: data
				}).catch(function (e){
					this.dispatch('error', e);
				}.bind(this));
			}
        },
        
    },
    methods:{
			getemployee: function(id)
			{
				return "/getemployee/" + id;
			},
			getdate: function(ddate)
			{
				var d = new Date(ddate);
				return d.toLocaleFormat('%d %b %Y')
			},
			has_foto: function(small_foto)
			{
				return small_foto === null? false: true;
			},
			get_small_foto_url: function(small_foto)
			{
				return "/storage/" + small_foto;
			}
    }
});	
</script>
@endsection

@section('styles')

@endsection
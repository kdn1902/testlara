@extends('layouts.index')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">Сотрудники</div>
                    <div class="panel-body">
					<div id="employees">
					  <form id="search">
    						Поиск <input name="query" v-model="searchQuery">
  					  </form>
  				      <employees 
  				        :data="gridData"
    					:columns="gridColumns"
    					:filter-key="searchQuery" >
  			 		  </employees>
					</div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>
<script>
var demo = new Vue({
  el: '#employees',
  data: {
    searchQuery: '',
    gridColumns: ['Имя', 'Зарплата'],
    gridData: [
      { "Имя" : "Chuck Norris", "Зарплата" : "10000" },
      { "Имя" : "Bruce Lee", "Зарплата" : "9000" },
      { "Имя" : "Jackie Chan", "Зарплата" : "7000" },
      { "Имя" : "Jet Li", "Зарплата" : "8000" }
    ]
  }
})
</script>
@endsection

@section('styles')

@endsection
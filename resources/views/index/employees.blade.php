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
  							</v-server-table>
					</div>
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
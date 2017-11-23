@extends('layouts.index')
@inject('showtree', 'App\MyFunctions')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dimon Example Component</div>
                    <div class="panel-body">
					<h1>Привет, мир!</h1>
					<div id="app">
					   	<example></example>
					</div>
					<div id="jstree"></div>	
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/jstree.min.js"></script>
<script type="text/javascript">
  $('#jstree').jstree({ 'core' : {
		"check_callback" : true,
		"data" :[ {!! $showtree->showTree(0) !!} ]
		},
		"plugins" : [ "dnd" ]
	});
  $('#jstree').on("changed.jstree", function (e, data) {
	  console.log(data.instance.get_node(data.selected[0]).id);
	  console.log(data.instance.get_node(data.selected[0]).data.department_id);
	  console.log(data.instance.get_node(data.selected[0]).data.post_id);
	  console.log(data.instance.get_node(data.selected[0]).text);
    });
</script>
<script src="/js/app.js"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/themes/default/style.min.css" />
@endsection

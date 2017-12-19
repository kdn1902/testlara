@extends('layouts.index')
@inject('showtree', 'App\MyFunctions')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">jsTree</div>
                    <div class="panel-body">
						<div id="jstree"></div>	
                    </div>
                </div>
            </div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>
<script type="text/javascript" src="/js/jstree.min.js"></script>
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
	  window.location = "/getemployee/" + data.instance.get_node(data.selected[0]).id;
    });
</script>
@endsection

@section('styles')
<link href="/css/jstree.min.css" rel="stylesheet">
@endsection

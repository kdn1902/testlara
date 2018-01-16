@extends('layouts.index')

@section('content')
    <div id="depts">
		<dept></dept>
	</div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>
<script>
	new Vue({
  		el: '#depts'
	})
</script>
@endsection

@section('styles')
@endsection
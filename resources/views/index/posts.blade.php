@extends('layouts.index')

@section('content')
    <div id="posts">
		<post></post>
	</div>
@endsection

@section('scripts')
<script src="/js/app.js"></script>
<script>
	new Vue({
  		el: '#posts'
	})
</script>
@endsection

@section('styles')
@endsection
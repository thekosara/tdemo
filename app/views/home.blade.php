@extends('layout.main')

@section('content')
	@if(Auth::check())
	<p>Hello,{{ Auth::user()->username }}.</p>
	@else
	<p>you are not signed in</p>
	@endif

	
@stop
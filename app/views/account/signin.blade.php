@extends('layout.main')

@section('content')
	<form action="{{URL::route('account-sign-in-post')}}" method="post">
		<div class="field">
			E-mail:<input type="text" name="email"{{(Input::old('email')) ? 'value="'.Input::old('email').'"':''}}?> 
			@if($errors->has('email')){{$errors->first('email')}}
			@endif
		</div>
		<div class="field">
			password:<input type="password" name="password"> @if($errors->has('password')){{$errors->first('password')}}
			@endif
		</div>
		<input type="submit" value ="sign in">
		{{ Form::token() }}

	</form>
@stop
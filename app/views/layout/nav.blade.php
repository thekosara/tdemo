<nav>
<ul>
<li><a href ="{{ URL::route('home')}}">Home</a></li>
@if(Auth::check())

@else
<li><a href="{{ URL::route('account-sign-in')}}">Sign in</a></li>
<li><a href ="{{ URL::route('account-create')}}">Create account</a></li>
@endif 

</ul>
</nav>
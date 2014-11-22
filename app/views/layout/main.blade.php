 <html>
<head>

	<title>Authentication system</title>
	</head>

	<body>
		@if (Session::has('global'))
		<p>{{Session::get('global') }}</p>
		@endif
		@include('layout.nav')
	@yield('content') 

	</body>


</html>
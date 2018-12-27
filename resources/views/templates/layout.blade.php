<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="_token"  content="{{ csrf_token() }}" />
	<title>{{ config('app.name', 'General Quiz site') }}</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Google font-awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<!-- fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	@if (! $notPartial)
	<link rel="stylesheet" type="text/css" href="css/master.css">
	@endif
	<!-- Google font -->
	<!-- font-family: 'Fjalla One', sans-serif; -->
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 

</head>
<body>
<div class="container custom-bg"
	style="background: url({{  asset('storage/icons/bg-ios.jpeg') }});">
	@if (! $notPartial) 
		@include ('templates.nav')
	@endif
	@yield('content')
	{{-- check if this page requires footer --}}
	@if (! $notPartial)
		@include ('templates.footer')
	@endif
</div><!-- container -->	

	<!-- Include js file -->
	<!-- let script tags from other views to be shown here in end of body tag -->
	@if (! $notPartial)
		<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous">
	  	</script>
		<script type="text/javascript">@yield ('scripts')</script>
		<script src="js/backend.js"></script>
		<script src="js/main.js"></script>
	@endif
</body>
</html>
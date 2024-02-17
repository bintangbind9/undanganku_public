    <link rel="shortcut icon" href="{{asset('assets/img/'.Constant::ICON)}}">
    <title>{{$template_category->name}} &mdash; {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</title>
    <meta name="description" content="{{$template_category->name}} {{$groom->name}} & {{$bride->name}} - Undangan Ajib {{$template->name}} Template by {{config('app.name')}}" />
	<meta name="keywords" content="{{config('app.name')}}, undangan, invitation, undangan ajib, undanganajib, free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="{{config('app.name')}}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
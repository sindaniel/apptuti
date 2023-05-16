

<title>@if(@$title){{ $title }} | @endif{{ config('app.name') }}</title>
<meta name="description" content="{{ @$description }}">
<meta property="og:description" content="{{ @$description }}" />
<meta property="og:title" content="{{ $title ?? config('app.name')}}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ request()->url() }}"/>
<meta property="og:image" content="" />
<meta name="twitter:image:src" content="">


<meta name="twitter:card" content="summary_large_image">

<meta name="twitter:title" content="{{ $title ?? config('app.name')}}">
<meta name="twitter:description" content="{{ @$description }}">



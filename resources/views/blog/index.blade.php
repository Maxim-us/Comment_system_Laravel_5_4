@extends('layouts.main_layout')

@section('content')

	@foreach($articles as $article)	
		<h2><a href="/blog/{{ $article->id }}">{{ $article->title }}</a></h2>
		<h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, {{ $article->created_at }}</h5>
		<p>{{ $article->article }}</p>
		<br><br>
		<hr>
	@endforeach

@stop
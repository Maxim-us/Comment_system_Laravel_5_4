@extends('layouts.single_layout')

@section('content')

<h2>{{ $article->title }}</h2>
<h5><span class="glyphicon glyphicon-time"></span> Post by John Doe, {{ $article->created_at }}</h5>
<h5><span class="label label-success">Lorem</span></h5><br>
<p>{{ $article->article }}</p>

@stop
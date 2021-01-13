@extends('layouts.app')
@section('title', 'Изменить автора')

@section('content')
    @include('authors.form', ['author' => $author])
@endsection


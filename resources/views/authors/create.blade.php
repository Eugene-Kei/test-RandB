@extends('layouts.app')
@section('title', 'Добавить автора')

@section('content')
    @include('authors.form', ['author' => $author])
@endsection


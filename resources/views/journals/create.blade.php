@extends('layouts.app')
@section('title', 'Добавить журнал')

@section('content')
    @include('journals.form', ['journal' => $journal, 'authors' => $authors])
@endsection


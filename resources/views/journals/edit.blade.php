@extends('layouts.app')
@section('title', 'Изменить журнал')

@section('content')
    @include('journals.form', ['journal' => $journal, 'authors' => $authors])
@endsection


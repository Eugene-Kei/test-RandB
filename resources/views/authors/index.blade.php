@php
    $isSortDesc = request()->get('sort_desc');
    $sortSymbol = $isSortDesc ? '&#9660;' : '&#9650;';
@endphp

@extends('layouts.app')

@section('title', 'Список авторов')

@section('content')
    <div class="flex justify-between items-center">
        <a
            class="btn-blue"
            href="{{ route('authors.create') }}"
            title="Добавить автора"
        >Добавить автора</a>
        <a
            class="text-blue-500"
            href="{{ route('authors.index', ['sort_desc' => !$isSortDesc]) }}"
        >
            Сортировать по фамилии {!! $sortSymbol !!}
        </a>
    </div>

    <div class="my-8 flex flex-col space-y-4">
        @forelse($authors as $author)
            <div class="card shadow-md w-full flex justify-between items-center">
                <div>
                    <p class="capitalize">
                        {{$author->last_name}}
                        {{$author->first_name}}
                        {{$author->middle_name}}
                    </p>
                    <p class="text-black text-opacity-50 text-sm">
                        Добавлен: {{$author->created_at->format('d.m.Y H:i')}}
                    </p>
                </div>
                <div>
                    <div class="flex justify-end space-x-2 items-center">
                        <a
                            href="{{ route('authors.show', $author->id) }}"
                            class="btn-blue small"
                        >журналы</a>
                        <a
                            href="{{ route('authors.edit', $author->id) }}"
                            class="btn-blue small"
                        >изменить</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn-red small"
                            >
                                удалить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert shadow-md">
                <p>Авторы не найдены</p>
            </div>
        @endforelse
    </div>

    {{$authors->appends(request()->except('page'))->links()}}
@endsection

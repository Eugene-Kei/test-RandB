@extends('layouts.app')

@section('title', 'Журналы автора')

@section('content')
    <div class="my-8 flex flex-col space-y-4">
        <div class="card shadow-md w-full flex justify-between items-center">
            <div>
                <p class="capitalize">
                    {{$author->last_name}}
                    {{$author->first_name}}
                    {{$author->middle_name}}
                </p>
            </div>
        </div>
    </div>

    <div class="my-8 flex flex-col space-y-4">
        @forelse($journals as $journal)
            <div class="card shadow-md w-full">
                @include('journals._journal', ['journal' => $journal])
                <div>
                    <div class="flex justify-end space-x-2 items-center">
                        <a
                            href="{{ route('journals.show', $journal->id) }}"
                            class="btn-blue small"
                        >смотреть</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert shadow-md">
                <p>Журналы не найдены</p>
            </div>
        @endforelse
    </div>

    {{$journals->links()}}
@endsection

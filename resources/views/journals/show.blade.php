@extends('layouts.app')

@section('title', 'Журнал ' . $journal->name)

@section('content')
    <div class="my-8 flex flex-col space-y-4">
        <div class="card shadow-md w-full">
            @include('journals._journal', ['journal' => $journal])
            <div>
                <div class="flex justify-end space-x-2 items-center">
                    <a
                        href="{{ route('journals.edit', $journal->id) }}"
                        class="btn-blue small"
                    >изменить</a>
                    <form action="{{ route('journals.destroy', $journal->id) }}" method="POST">
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
    </div>
@endsection

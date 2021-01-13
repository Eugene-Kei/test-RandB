@extends('layouts.app')

@section('title', 'Список журналов')

@section('content')
    <a
        class="btn-blue"
        href="{{ route('journals.create') }}"
        title="Добавить журнал"
    >Добавить журнал</a>

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
        @empty
            <div class="alert shadow-md">
                <p>Журналы не найдены</p>
            </div>
        @endforelse
    </div>
    {{$journals->links()}}
@endsection

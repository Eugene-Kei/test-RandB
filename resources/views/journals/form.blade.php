@php
    use App\Models\Journal;

    /** @var Journal $journal */
    $authorIdes = $journal->authors->modelKeys();
@endphp
<div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden max-w-5xl p-8">
    <div class="flex justify-center items-center">
        <div class="w-full">
            <form
                action="{{ $journal->id ? route('journals.update', ['journal' => $journal->id]) : route('journals.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="active-field @error('name') has-errors @enderror">
                    <label class="label" for="input-name">
                        Название*
                    </label>
                    <input
                        id="input-name"
                        type="text"
                        name="name"
                        class="input"
                        value="{{old('name', $journal?->name)}}"
                    >
                    <p class="error-msg">{{$errors->first('name')}}</p>
                </div>
                <div class="active-field @error('description') has-errors @enderror">
                    <label class="label" for="input-description">
                        Короткое описание
                    </label>
                    <textarea
                        id="input-description"
                        name="description"
                        class="input"
                    >{{old('description', $journal?->description)}}</textarea>
                    <p class="error-msg">{{$errors->first('description')}}</p>
                </div>
                <div class="active-field @error('published_at') has-errors @enderror">
                    <label class="label" for="input-published_at">
                        Дата публикации*
                    </label>
                    <input
                        id="input-published_at"
                        type="text"
                        name="published_at"
                        class="input"
                        value="{{old('published_at', $journal?->published_at?->format('Y-m-d'))}}"
                        placeholder="ГГГГ-ММ-ДД"
                    >
                    <p class="error-msg">{{$errors->first('published_at')}}</p>
                </div>
                <div class="active-field @error('authors') has-errors @enderror">
                    <label class="label" for="input-authors">
                        Авторы*
                    </label>
                    <select
                        id="input-authors"
                        name="authors[]"
                        class="input"
                        multiple
                    >
                        @forelse($authors as $author)
                            <option
                                value="{{$author->id}}"
                                @if(in_array($author->id, old('authors', $authorIdes)))
                                selected="selected"
                                @endif
                            >
                                {{$author->last_name}}
                                {{$author->first_name}}
                                {{$author->middle_name}}
                            </option>
                        @empty
                            <option value="">Необходимо добавить авторов</option>
                        @endforelse
                    </select>
                    <p class="error-msg">{{$errors->first('authors')}}</p>
                    <p class="text-black text-opacity-50 text-xs">Для выбора нескольких авторов, удерживайте Ctrl</p>
                </div>
                @if($journal->image_url)
                    <div class="w-36 h-36 pt-3 flex justify-center">
                        <img class="object-fill max-h-full max-w-full m-auto" src="{{$journal->image_url}}" alt="{{$journal->name}}">
                    </div>
                @endif
                <div class="active-field @error('image') has-errors @enderror">
                    <label class="label" for="input-image">
                        {{$journal->image ? 'Изменить картинку' : 'Картинка*'}}
                    </label>
                    <input id="input-image" type="file" class="h-full w-full" name="image" accept="jpg,png">
                    <p class="error-msg">{{$errors->first('image')}}</p>
                </div>
                <div>
                    <button type="submit" class="btn-blue">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden max-w-5xl p-8">
    <div class="flex justify-center items-center">
        <div class="w-full">
            <form
                action="{{ $author->id ? route('authors.update', ['author' => $author->id]) : route('authors.store') }}"
                method="POST"
            >
                @csrf
                <div class="active-field @error('last_name') has-errors @enderror">
                    <label class="label" for="input-last-name">
                        Фамилия*
                    </label>
                    <input
                        id="input-last-name"
                        type="text"
                        name="last_name"
                        class="input"
                        value="{{old('last_name', $author?->last_name)}}"
                    >
                    <p class="error-msg">{{$errors->first('last_name')}}</p>
                </div>
                <div class="active-field @error('first_name') has-errors @enderror">
                    <label class="label" for="input-first-name">
                        Имя*
                    </label>
                    <input
                        id="input-first-name"
                        type="text"
                        name="first_name"
                        class="input"
                        value="{{old('first_name', $author?->first_name)}}"
                    >
                    <p class="error-msg">{{$errors->first('first_name')}}</p>
                </div>
                <div class="active-field @error('middle_name') has-errors @enderror">
                    <label class="label" for="input-middle-name">
                        Отчество
                    </label>
                    <input
                        id="input-middle-name"
                        type="text"
                        name="middle_name"
                        class="input"
                        value="{{old('middle_name', $author?->middle_name)}}"
                    >
                    <p class="error-msg">{{$errors->first('middle_name')}}</p>
                </div>
                <div>
                    <button type="submit" class="btn-blue">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

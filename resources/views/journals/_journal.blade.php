<div>
    <div class="w-full">
        <img class="object-cover m-auto" src="{{$journal->image_url}}" alt="{{$journal->name}}">
    </div>
    <p class="capitalize text-lg py-4">
        {{$journal->name}}
    </p>
    <p class="text-sm pb-2">{{$journal->description}}</p>
    @if($journal->authors->isNotEmpty())
        <div class="text-sm pb-2">
            <div class="inline-block">Авторы:</div>
            <div class="divide-x divide-gray-500 inline-block">
                @foreach($journal->authors as $author)
                    @if(url()->current() === route('authors.show', $author->id))
                        <span class="divide-x px-1 text-black text-opacity-50">
                                            {{$author->last_name}}
                            {{$author->first_name}}
                                        </span>
                    @else
                        <a
                            href="{{ route('authors.show', $author->id) }}"
                            class="text-blue-500 divide-x px-1"
                        >
                            {{$author->last_name}}
                            {{$author->first_name}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <p class="text-black text-opacity-50 text-sm pb-2">
        Дата публикации: {{$journal->published_at->format('d.m.Y')}}
    </p>
    <p class="text-black text-opacity-50 text-sm">
        Добавлен: {{$journal->created_at->format('d.m.Y H:i')}}
    </p>
</div>

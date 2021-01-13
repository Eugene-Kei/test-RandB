<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $authorsQuery = Author::query();

        if (request()->get('sort_desc')) {
            $authorsQuery->orderBy('last_name', 'DESC');
        } else {
            $authorsQuery->orderBy('last_name');
        }

        return view('authors.index', ['authors' => $authorsQuery->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('authors.create', ['author' => new Author()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AuthorRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        $validatedAuthor = $request->validated();

        Author::query()->create($validatedAuthor);

        return redirect()->route('authors.index')
            ->with('success', 'Автор успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     *
     * @return View
     */
    public function show(Author $author)
    {
        $journals = $author->journals()->latest()->paginate();

        return view('authors.show', ['author' => $author, 'journals' => $journals]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     *
     * @return View
     */
    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     *
     * @return RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $validatedAuthor = $request->validated();

        if ($author->update($validatedAuthor)) {
            return redirect()->route('authors.index')
                ->with('success', 'Автор успешно изменен');
        } else {
            return redirect()->route('authors.index')
                ->with('error', 'Не удалось изменить автора');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Author $author)
    {
        if ($author->delete()) {
            return redirect()->route('authors.index')
                ->with('success', 'Автор успешно удален');
        } else {
            return redirect()->route('authors.index')
                ->with('error', 'Не удалось удалить автора');
        }
    }
}

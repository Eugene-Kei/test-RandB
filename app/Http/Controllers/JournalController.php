<?php

namespace App\Http\Controllers;

use App\Http\Requests\JournalStoreRequest;
use App\Http\Requests\JournalUpdateRequest;
use App\Models\Author;
use App\Models\Journal;
use App\services\JournalService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $journals = Journal::query()->latest()->paginate();

        return view('journals.index', ['journals' => $journals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('journals.create', ['journal' => new Journal(), 'authors' => $this->getAuthors()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JournalStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(JournalStoreRequest $request)
    {
        $journalService = new JournalService(new Journal, $request);

        if ($journalService->create()) {
            return redirect()->route('journals.index')
                ->with('success', 'Журнал успешно добавлен');
        } else {
            return redirect()->route('journals.index')
                ->with('success', 'Не удалось добавить журнал');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Journal $journal
     *
     * @return View
     */
    public function show(Journal $journal)
    {
        return view('journals.show', ['journal' => $journal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Journal $journal
     *
     * @return View
     */
    public function edit(Journal $journal)
    {
        return view('journals.edit', ['journal' => $journal, 'authors' => $this->getAuthors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JournalUpdateRequest $request
     * @param Journal $journal
     *
     * @return RedirectResponse
     */
    public function update(JournalUpdateRequest $request, Journal $journal)
    {
        $journalService = new JournalService($journal, $request);

        if ($journalService->update()) {
            return redirect()->route('journals.index')
                ->with('success', 'Журнал успешно изменен');
        } else {
            return redirect()->route('journals.index')
                ->with('error', 'Не удалось изменить журнал');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Journal $journal
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Journal $journal)
    {
        $image = $journal->image;
        if ($journal->delete()) {
            if ($image) {
                Storage::disk('image')->deleteDirectory(dirname($image));
            }
            return redirect()->route('journals.index')
                ->with('success', 'Журнал успешно удален');
        } else {
            return redirect()->route('journals.index')
                ->with('error', 'Не удалось удалить журнал');
        }
    }

    /**
     * @return Builder[]|Collection
     */
    private function getAuthors()
    {
        return Author::query()->orderBy('last_name')->orderBy('first_name')->limit(300)->get();
    }
}

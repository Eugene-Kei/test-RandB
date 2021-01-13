<?php


namespace App\services;


use App\Models\Journal;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JournalService
{
    public function __construct(protected Journal $journal, protected FormRequest $request)
    {
    }

    public function create(): bool
    {
        $validated = $this->request->validated();
        $imagePath = null;

        DB::beginTransaction();
        try {
            /** @var Journal $journal */
            $journal   = $this->journal->newQuery()->create($validated);
            $imagePath = $this->request->file('image')->storePublicly($journal->id, ['disk' => 'image']);
            $journal->update(['image' => $imagePath]);
            $journal->authors()->attach($validated['authors']);
            DB::commit();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            $this->deleteImageFromStorage($imagePath);

            return false;
        }
    }

    /**
     * Update Journal with image and relationships
     *
     * @return bool
     */
    public function update(): bool
    {
        $validated = $this->request->validated();
        $oldImage  = $this->journal->image;
        if (isset($validated['image'])) {
            $validated['image'] = $this->request->file('image')->storePublicly($this->journal->id, ['disk' => 'image']);
        }

        DB::beginTransaction();
        try {
            $this->updateAuthors();

            if ($this->journal->update($validated)) {
                DB::commit();
                if (isset($validated['image'])) {
                    $this->deleteImageFromStorage($oldImage);
                }

                return true;
            } else {
                DB::rollBack();
                $this->deleteImageFromStorage($validated['image']);

                return false;
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $this->deleteImageFromStorage($validated['image']);

            return false;
        }
    }

    /**
     * Update author relationships
     */
    protected function updateAuthors(): void
    {
        $validated = $this->request->validated();
        if (isset($validated['authors'])) {
            $newAuthorsIds = $validated['authors'];
            $oldAuthorsIds = $this->journal->authors()->pluck('author_id');
            if ($oldAuthorsIds) {
                $this->journal->authors()->wherePivotNotIn('author_id', $newAuthorsIds)->detach();
            }
            $this->journal->authors()->attach(array_diff($newAuthorsIds, $oldAuthorsIds->toArray()));
        }
    }

    /**
     * @param ?string $image
     *
     * @return bool
     */
    protected function deleteImageFromStorage(?string $image): bool
    {
        if (empty($image)) {
            return false;
        } else {
            return Storage::disk('image')->delete($image);
        }
    }
}

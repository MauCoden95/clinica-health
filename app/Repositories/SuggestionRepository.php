<?php

namespace App\Repositories;

use App\Models\Suggestion;
use Illuminate\Support\Collection;

class SuggestionRepository
{
    public function getByUserId(int $userId): Collection
    {
        return Suggestion::where('user_id', $userId)->get();
    }

    public function create(array $data): Suggestion
    {
        return Suggestion::create($data);
    }

    public function find(int $id): ?Suggestion
    {
        return Suggestion::find($id);
    }

    public function update(Suggestion $suggestion, array $data): bool
    {
        return $suggestion->update($data);
    }

    public function delete(Suggestion $suggestion): bool
    {
        return $suggestion->delete();
    }
}

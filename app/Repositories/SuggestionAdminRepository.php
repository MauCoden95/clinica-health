<?php

namespace App\Repositories;

use App\Models\Suggestion;

class SuggestionAdminRepository
{
    public function getAll()
    {
        return Suggestion::with(['user:id,name'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();
    }

    public function getCount()
    {
        return Suggestion::count();
    }

    public function findById($id)
    {
        return Suggestion::find($id);
    }

    public function delete($id)
    {
        return Suggestion::where('id', $id)->delete();
    }

    public function updateResponse($id, $response)
    {
        return Suggestion::where('id', $id)->update(['response' => $response]);
    }

    public function toggleUseful($id)
    {
        $suggestion = Suggestion::find($id);
        if ($suggestion) {
            $suggestion->update(['useful' => !$suggestion->useful]);
            return true;
        }
        return false;
    }

    public function getUsefulSuggestions()
    {
        return Suggestion::where('useful', 1)->get();
    }
}

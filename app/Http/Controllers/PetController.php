<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    //
    public function store(Request $request)
    {
        // 1. On vérifie que les données sont correctes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // 2. On crée l'animal lié à l'utilisateur connecté
        $request->user()->pets()->create($validated);

        // 3. On redirige vers le dashboard avec un message de succès
        return redirect()->back()->with('status', 'Animal ajouté avec succès !');
    }

    public function destroy(\App\Models\Pet $pet)
    {
        // On vérifie que l'animal appartient bien à l'utilisateur connecté
        if ($pet->user_id !== auth()->id()) {
            abort(403);
        }

        $pet->delete();

        return redirect()->back()->with('status', 'Animal supprimé !');
    }
}

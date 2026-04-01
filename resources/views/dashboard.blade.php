<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <h3 class="font-semibold text-lg mb-4 text-gray-800">🐾 Ajouter un nouvel animal</h3>
    
                        <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nom de l'animal</label>
                                <input type="text" name="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="Ex: Rex, Minou..." required>
                            </div>
        
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Type (Chien, Chat, Oiseau...)</label>
                                <input type="text" name="type" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="Ex: Chien" required>
                            </div>
        
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea name="description" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" rows="3" placeholder="Informations importantes..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Photo de l'animal</label>
                                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Enregistrer l'animal
                             </button>
                        </form>
                    </div>
                    <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4 text-gray-800">📋 Mes Animaux</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                         <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach(Auth::user()->pets as $pet)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pet->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pet->type }}</td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <details class="cursor-pointer">
                                                <summary class="text-indigo-600 font-medium">Lire la description...</summary>
                                                <p class="mt-2 text-gray-700 bg-gray-50 p-2 rounded border">
                                                    {{ $pet->description ?? 'Pas de description.' }}
                                                </p>
                                            </details>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('pets.destroy', $pet) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cet animal ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

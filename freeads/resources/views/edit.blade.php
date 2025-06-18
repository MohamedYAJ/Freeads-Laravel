@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="max-w-xl mx-auto p-8 mt-12 bg-white shadow-md rounded-2xl">
            <h3 class="text-center text-3xl font-bold text-gray-800 mb-8">Modifier l'annonce</h3>
            
            <form method="POST" action="{{ route('update', $ad->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="titre" class="block mb-1 text-sm font-semibold text-gray-700">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre', $ad->titre) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div>
                    <label for="description" class="block mb-1 text-sm font-semibold text-gray-700">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                        required>{{ old('description', $ad->description) }}</textarea>
                </div>

                <div>
                    <label for="prix" class="block mb-1 text-sm font-semibold text-gray-700">Prix (€)</label>
                    <input type="number" name="prix" value="{{ old('prix', $ad->prix) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-black hover:bg-gray-800 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection

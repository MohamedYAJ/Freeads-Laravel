@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="max-w-2xl mx-auto p-6 min-h-screen flex items-center justify-center bg-gray-100">
            <form method="POST" action="{{ route('annonce') }}" enctype="multipart/form-data"
                  class="w-full bg-white p-8 rounded-2xl shadow-lg space-y-6">
                <h3 class="text-center text-3xl font-bold text-gray-800 mb-4">Post an Ad</h3>

                @csrf

                <div>
                    <label for="titre" class="block mb-1 text-sm font-semibold text-gray-700">Titre</label>
                    <input type="text" name="titre"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                </div>

                <div>
                    <label for="description" class="block mb-1 text-sm font-semibold text-gray-700">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition"></textarea>
                </div>

                <div>
                    <label for="prix" class="block mb-1 text-sm font-semibold text-gray-700">Prix</label>
                    <input type="number" name="prix"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                </div>

                <div>
                    <label for="categories" class="block mb-1 text-sm font-semibold text-gray-700">Catégorie</label>
                    <select name="categories"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Vehicules">Véhicules</option>
                        <option value="Fournitures">Fournitures</option>
                        <option value="Vêtements">Vêtements</option>
                        <option value="Livres">Livres</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div>
                    <input type="file" name="photos[]" multiple accept="image/*"
                           class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="bg-black hover:bg-gray-800 text-white font-semibold py-2 px-8 rounded-lg transition duration-200">
                        Poster l’annonce
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection

@extends('layouts.app')  
@section('content')  
@if(Auth::check()) 

<!-- Search Filters -->
<div class="flex justify-center mt-10 px-4">
  <form action="{{ route('DisplayAds') }}" method="GET" class="bg-white p-6 rounded-xl shadow-md w-full max-w-5xl">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="flex flex-col">
        <label for="titre" class="text-sm font-medium text-gray-700 mb-1">Titre</label>
        <input class="border rounded-lg p-2 focus:ring focus:ring-sky-300" name="titre" value="{{ request('titre') }}" type="text">
      </div>

      <div class="flex flex-col">
        <label for="prix" class="text-sm font-medium text-gray-700 mb-1">Prix</label>
        <input class="border rounded-lg p-2 focus:ring focus:ring-sky-300" name="prix" type="number">
      </div>

      <div class="flex flex-col">
        <label for="categories" class="text-sm font-medium text-gray-700 mb-1">Catégorie</label>
        <select name="categories" class="border rounded-lg p-2 focus:ring focus:ring-sky-300">
          <option value="">Toutes</option>
          <option value="Vehicules">Véhicules</option>
          <option value="Fournitures">Fournitures</option>
          <option value="Vêtements">Vêtements</option>
          <option value="Livres">Livres</option>
          <option value="Autre">Autre</option>
        </select>
      </div>

      <div class="flex items-end">
        <button class="bg-black text-white rounded-lg p-2 w-full hover:bg-gray-800 transition" type="submit">Rechercher</button>
      </div>
    </div>
  </form>
</div>

<!-- Ads -->
@foreach ($ads as $ad)
  <div class="flex justify-center mt-10 px-4">
    <div class="bg-white shadow-md rounded-xl p-6 w-full max-w-4xl space-y-4">
      <h1 class="text-2xl font-bold text-gray-800">{{ $ad->titre }}</h1>
      <p class="text-gray-700">{{ $ad->description }}</p>
      <p class="text-lg font-semibold text-gray-900">{{ $ad->prix }} €</p>
      <p class="text-sm text-gray-600"><strong>Catégorie:</strong> {{ $ad->categories ?? 'Non spécifiée' }}</p>

      @if ($ad->photos->count())
        <div class="flex flex-wrap gap-4 mt-4">
          @foreach ($ad->photos as $photo)
            <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo" class="w-32 h-32 object-cover rounded-md border">
          @endforeach
        </div>
      @endif

      @if($ad->user_id == Auth::id())
        <div class="flex gap-3 mt-4">
          <form method="POST" action="{{ route('ads.destroy', $ad->id ) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition" type="submit">Supprimer</button>
          </form>
          <a href="{{ route('edit', $ad->id) }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg transition">Modifier</a>
        </div>
      @endif
    </div>
  </div>
@endforeach 

@endif 
@endsection

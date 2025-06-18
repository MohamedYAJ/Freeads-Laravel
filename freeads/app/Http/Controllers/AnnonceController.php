<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Annonce;
    use App\Models\Photos;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    class AnnonceController extends Controller
    {
        public function home(){
            return view('home');
        }
        
        public function annonce(Request $request)
        {
            $request->validate([
                'titre' => 'required',
                'description' => 'required',
                'prix' => 'required',
                'categories' => 'nullable|string',

                'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);

            $ads = Annonce::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'prix' => $request->prix,
                'categories' => $request->categories,

                'user_id' => Auth::id() 
            ]);
            
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                $maxPhotos = 7; 
                $count = min(count($photos), $maxPhotos);
                
                for ($i = 0; $i < $count; $i++) {
                    $photoPath = $photos[$i]->store('annonce_photos', 'public');
                    
                    Photos::create([
                        'path' => $photoPath,
                        'annonce_id' => $ads->id
                    ]);
                }
            }

            return redirect('/home')->with('success', 'Ad posted successfully!');
        }

        public function DisplayAds(Request $request){
            $query = Annonce::query();

            if($request->has('titre') && !empty($request->titre)){
                $query->where('titre', 'like', "%{$request->titre}%");
            }
            
            if($request->has('prix') && !empty($request->prix)){
                $query->where('prix', $request->prix);
            }
            if($request->has('categories') && !empty($request->categories)){
                $query->where('categories', $request->categories);
            } else {
                $query->orderBy('created_at', 'DESC');
            }
            
            $query->with('photos');
            $ads = $query->get();

            return view('ads', compact('ads'));
        }

        public function destroy($id){
            $ads = Annonce::findOrFail($id);

            if ($ads->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You can only delete your own ads!');
            }
            
            foreach ($ads->photos as $photo) {
                Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
            
            $ads->delete();
            
            return redirect()->back()->with('success', 'Ad deleted successfully!');
        }

        public function edit($id)
        {
            if (!Auth::check()) {
                return redirect('/login')->with('error', 'Please login first!');
            }

            $ad = Annonce::findOrFail($id);
            
            if ($ad->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You can only edit your own ads!');
            }
            
            return view('edit', compact('ad'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'titre' => 'required|string',
                'description' => 'required|string',
                'prix' => 'required|numeric',
            ]);

            $ad = Annonce::findOrFail($id);

            if ($ad->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You can only update your own ads!');
            }

            $ad->update([
                'titre' => $request->titre,
                'description' => $request->description,
                'prix' => $request->prix
            ]);

            return redirect()->route('DisplayAds')->with('success', 'Ad updated successfully!');
        }
    }
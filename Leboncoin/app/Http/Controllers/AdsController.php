<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Http\Requests\AdsFormRequest;
use Illuminate\Support\Facades\Storage; // utilisé pour la suppression des images stockées
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $ads = Ads::all();
        return view('ads.index', compact('ads'));
    }

    // public function index(Request $request)
    // {
    //     $category = $request->input('category');
    //     $location = $request->input('location');
    //     $minPrice = $request->input('min_price');
    //     $maxPrice = $request->input('max_price');
    //     $query = Ads::query();
    //     if ($category) {
    //         $query->where('category', $category);
    //     }
    //     if ($location) {
    //         $query->where('location', $location);
    //     }
    //     if ($minPrice) {
    //         $query->where('price', '>=', $minPrice);
    //     }
    //     if ($maxPrice) {
    //         $query->where('price', '<=', $maxPrice);
    //     }
    //     $ads = $query->get();

    //     return view('ads.index', compact('ads'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads.create_ad');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(AdsFormRequest $request)
    // {
    //     $data = $request->validated();

    //     $user = Auth::user();

    //     $ad = Ads::create($data);

    //     $ad->user_id = $user->id;

    //     $ad->save();

    //     return redirect('/create_ad')->with('message', 'Your ad were created successfuly.');
    // }
    public function store(AdsFormRequest $request)
{
    $data = $request->validated();

    $user = Auth::user();

    $ad = $user->ads()->create($data);

    return redirect('/create_ad')->with('message', 'Your ad were created successfuly.');
}



    /**
      * Display les ads dans home.
     */
    public function show(Request $request)
    {
        $category = $request->input('category');
        $location = $request->input('location');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $query = Ads::query();
        if ($category) {
            $query->where('category', $category);
        }
        if ($location) {
            $query->where('location', $location);
        }
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        $ads = $query->get();
        // Récupérez toutes les annonces de la base de données à partir du modèle "Ads"
        // $ads = Ads::all();

        // Passez les annonces à la vue 'welcome'
        return view('welcome', ['ads' => $ads]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($one_ad_id)
    {
        $one_ad = Ads::find($one_ad_id);
        return view('ads.edit_ad', compact('one_ad'));    
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsFormRequest $request, $one_ad_id)
    {
        $data = $request->validated();

        if ($request->hasFile('path')) {
            $imagePath = $request->file('path')->store('images', 'public');
            $data['path'] = $imagePath;
        }

        $one_ad = Ads::where('id', $one_ad_id)->update([
            'title' => $data['title'],
            'category' => $data['category'],
            'description' => $data['description'],
            'path' => $data['path'],
            'price' => $data['price'],
            'location' => $data['location']
        ]);

        return redirect('/dashboard')->with('message', 'Ad edited successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Supprimer une annonce de la base de données
     */
    public function delete($one_ad_id)
    {
        
    $one_ad = Ads::find($one_ad_id);

    if ($one_ad) {
        // Supprimer l'image de l'annonce
        Storage::delete('public/'.$one_ad->path);

        // Ca supprime l'annonce
        $one_ad->delete();

        return redirect('/dashboard')->with('message', 'Ad deleted successfully.');
    }

    return redirect('/dashboard')->with('message', 'Ad not found.');
    }


    public function showonead($one_ad_id)
{
    $ad = Ads::findOrFail($one_ad_id);

    return view('show_one_ad', compact('ad'));
}

    // public function dashboard()
    // {
    //     // user
    //     $user = Auth::user();
    
    //     // annonces de l'user
    //     $userAds = $user->ads;
    
    //     // Retourne la vue avec les annonces de l'user
    //     return view('dashboard', compact('userAds'));
    // }
    public function dashboard(Request $request)
{
    // user
    $user = Auth::user();

    // annonces de l'user
    $query = $user->ads();

    $category = $request->input('category');
    $location = $request->input('location');
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');

    if ($category) {
        $query->where('category', $category);
    }
    if ($location) {
        $query->where('location', $location);
    }
    if ($minPrice) {
        $query->where('price', '>=', $minPrice);
    }
    if ($maxPrice) {
        $query->where('price', '<=', $maxPrice);
    }

    $userAds = $query->get();

    // Retourne la vue avec les annonces de l'user
    return view('dashboard', compact('userAds'));
}

}



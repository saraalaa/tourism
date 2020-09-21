<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Http\Traits\CitiesTrait;
use App\Http\Traits\GalleryTrait;
use App\Http\Traits\ImageTrait;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    use ImageTrait, GalleryTrait, CitiesTrait;

    public function index()
    {
        // this function to return all offers paginated without relations details

        return OfferResource::collection(Offer::paginate(10));
    }

    public function store(StoreOfferRequest $request)
    {
        $validated = $request->validated();

        $storedImageName = $this->prepareImage($validated['image']);

        $offer = Offer::create($validated);
        $offer->image = asset('/image/' . $storedImageName);
        $offer->save();

        $this->createGalleryImages($validated, $offer);
        $this->createCities($validated, $offer);

        return new OfferResource($offer->load('galleries','cities.country'));
    }

    public function show(Offer $offer)
    {
        // this function to show specific offer with it relations details

        $offer->load('galleries','cities.country');
        return new OfferResource($offer);
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        // delete old image from folder if there are new image
        if ($request->hasFile('image'))
            Storage::disk('image')->delete(basename($offer->image));

        // update offer
        $validated = $request->validated();
        $offer->update($validated);

        // prepare image and save it
        if ($request->hasFile('image'))
        {
            $storedImageName = $this->prepareImage($validated['image']);
            $offer->image = asset('/image/' . $storedImageName);
            $offer->save();
        }

        // update gallery without deleting old gallery image just add the new images
        // (and if user want to delete image from gallery it will be in separate service to delete image by it's id)
        if ($request->has('gallery')) {
            $this->createGalleryImages($validated, $offer);
        }

        // update cities and it wont delete old cities just add cities and update already exist cities
        if ($request->has('cities')){
            $this->updateCities($validated , $offer);
        }

        return new OfferResource($offer->load('galleries','cities.country'));
    }
}

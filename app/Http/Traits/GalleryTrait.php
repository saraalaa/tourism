<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 9/21/2020
 * Time: 6:50 PM
 */

namespace App\Http\Traits;


trait GalleryTrait
{
    use ImageTrait;

    public function createGalleryImages($validated , $offer)
    {
        foreach ($validated['gallery'] as $gallery){
            $galleryImage = $this->prepareImage($gallery['image']);
            $galleryDB = $offer->galleries()->create($gallery);
            $galleryDB->image = asset('/image/' . $galleryImage);
            $galleryDB->save();
        }
    }
}
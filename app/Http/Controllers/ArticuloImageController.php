<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\ArticuloImage;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticuloImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Articulo $articulo)
    {
        $file = $request->file('file')->store('public/articulos');

        $url = Storage::url($file);

        $image = new Image();
        $image->path = $url;
        $image->save();

        $articuloImage = new ArticuloImage();
        $articuloImage->image_id = $image->id;
        $articuloImage->articulo_id = $articulo->id;
        $articuloImage->save();

        return $articuloImage;
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        $articulo->articulo_images = $articulo->articuloImage()->get()->each(function($i){
            $i->url = $i->image->urlImage();
        }); 
        $articulo->Categoria;
        $articulo->marca;
        return $articulo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticuloImage $articuloImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticuloImage $articuloImage)
    {
        $articuloImage->estado = 0;
        $articuloImage->save();
    }
}

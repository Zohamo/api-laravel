<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::select('id', 'artist', 'title', 'details', 'description', 'price', 'purchase_url', 'bandcamp_id', 'created_at', 'updated_at')
            ->where('out_of_stock', '=', 0)
            ->with('pictures')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }
}

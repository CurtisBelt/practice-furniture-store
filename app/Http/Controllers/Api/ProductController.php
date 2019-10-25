<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $product = Product::create($this->validateRequest());

        if (request()->has('fabrics')) {
            $product->fabrics()->createMany(request()->get('fabrics'));
        }
        return response($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $product->update($this->validateRequest());
        return response($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'collection_id' => 'exists:collections,id|nullable',
            'price' => 'numeric|nullable'
        ]);
    }
}

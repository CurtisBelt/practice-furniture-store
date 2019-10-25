<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Fabric;
use App\Http\Resources\FabricResource;
use App\Http\Controllers\Controller;

class FabricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        if ($product->exists) {
            return $product->fabrics()->get();
        }
        return FabricResource::collection(Fabric::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $fabric = Fabric::create($this->validateRequest());

        if ($product->exists) {
            $product->fabrics()->attach($fabric);
        }

        return response($fabric, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Fabric $fabric)
    {
        return new FabricResource($fabric);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Fabric $fabric
     * @return \Illuminate\Http\Response
     */
    public function update(Fabric $fabric)
    {
        $fabric->update($this->validateRequest());
        return response($fabric, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabric $fabric)
    {
        $fabric->delete();
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
            'description' => 'required'
        ]);
    }
}

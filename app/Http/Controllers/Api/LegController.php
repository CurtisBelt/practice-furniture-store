<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Leg;
use App\Http\Resources\LegResource;
use App\Http\Controllers\Controller;

class LegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        if ($product->exists) {
            return $product->legs()->get();
        }
        return LegResource::collection(Leg::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $leg = Leg::create($this->validateRequest());

        if ($product->exists) {
            $product->legs()->attach($leg);
        }

        return response($leg, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leg  $leg
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Leg $leg)
    {
        return new LegResource($leg);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Leg $leg
     * @return \Illuminate\Http\Response
     */
    public function update(Leg $leg)
    {
        $leg->update($this->validateRequest());
        return response($leg, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leg  $leg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leg $leg)
    {
        $leg->delete();
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

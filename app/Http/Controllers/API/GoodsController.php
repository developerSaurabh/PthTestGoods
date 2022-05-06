<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Resources\GoodsResource;
use Validator;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Gooods = Goods::all();
        return response(['goods' => GoodsResource::collection($Gooods)]); // Created by saurabh
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'type' => 'required|max:255',
            'number' => 'required|max:255',
        ]);

         if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
         }

        $goods = Goods::create($data);

        return response(['goods' => new GoodsResource($goods), 'message' => 'A new Good created successfully']); // created by saurabh
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
       return response(['goods' => new GoodsResource($goods)]); // created by saurabh
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'upc' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $goods->update($data);

        return response(['goods' => new GoodsResource($goods), 'message' => 'This Good has been updated successfully']);  //created by saurabh
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $goods)
    {
        $goods->delete();

        return response(['message' => 'Above Good has been deleted successfully']);
    }
}

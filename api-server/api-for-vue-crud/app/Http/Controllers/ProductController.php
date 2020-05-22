<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Products::get();

        return response()->json([
            "products" => $all,
            "error" => false,
            "message" => "All Products  Data"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('product/images'), $imageName);
        $obj = new Products();
        $obj->name = $request->name;
        $obj->category = $request->category;
        $obj->quantity = $request->quantity;
        $obj->price = $request->price;
//        $picture = $request->image->store('public/image');
        $obj->image = $imageName;
        $obj->description = $request->description;
        if($obj->save())
            return response()->json([
                "data" => $obj,
                "error" => false,
                "message" => "Product Stored Successfully"
            ]);
        else
            return response()->json([
                "error" => true,
                "message" => "Student Cannot be Stored!"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = new Products();
        $obj = $obj->find($id);

        return response()->json([
            "product" => $obj,
            "error" => false,
            "message" => "Student Data retrieved"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = new Products();
        $obj = $obj->find($id);

        return response()->json([
            "product" => $obj,
            "error" => false,
            "message" => "Student Data retrieved"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return response()->json([
        //     "id" => $id,
        //     "image"=> $request->image,
        //     "error" => true,
        //     "message" => "Student Update Error!"
        // ]);
        $obj = new Products();
        $obj = $obj->find($id);
        $deleted = 0;

        if($request->image == !null){
            $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('product/images'), $imageName);
        $obj->name = $request->name;
        $obj->category = $request->category;
        $obj->quantity = $request->quantity;
        $obj->price = $request->price;
//        $picture = $request->image->store('public/image');
        $obj->image = $imageName;
        $obj->description = $request->description;
        if($obj->save())
            return response()->json([
                "product" => $obj,
                "error" => false,
                "message" => "Product Updated Successfully"
            ]);
        else
            return response()->json([
                "error" => true,
                "message" => "Student Updated be Stored!"
            ]);
        }else{
                $obj->name = $request->name;
                $obj->category = $request->category;
                $obj->quantity = $request->quantity;
                $obj->price = $request->price;
        //        $picture = $request->image->store('public/image');
                $obj->description = $request->description;
                if($obj->save())
                    return response()->json([
                        "product" => $obj,
                        "error" => false,
                        "message" => "Product Updated Successfully"
                    ]);
                else
                    return response()->json([
                        "error" => true,
                        "message" => "Student Updated be Stored!"
                    ]);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $image_path = $product->image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
//            $a = 'coltese';

        }
        $product->delete();
        return response()->json([
            "error" => false,
            "message" => "Product Delete successfully!"
        ]);
    }
}

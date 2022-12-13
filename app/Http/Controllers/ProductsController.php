<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Psy\debug;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$products = Products::orderBy('name','asc')->get();
        return $this->getResponse200($products);*/
        $books = Products::all();
         
         return [
             "error" => false,
             "message" => "Successfull",
             "data" => $books
         ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $number = trim($request->number);
        $existNumber = Products::where("number", trim($request->number))->exists();
        if (!$existNumber) {
            $product = new Products();
            $product->number = $request->number;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->order_id = $request->order_id;
            $product->created = Carbon::now();
            $product->save();
           return $this->getResponse201("Product", "Created", $product);
        } else {
            return $this->getResponse500("Producto existente");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);

        return $this->getResponse200($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Products::find($id);
        if ($order){
            $number = trim($request->number);
            $numberExist = Products::where("number", $number)->first();
            $order->name = $request->name;    
            $order->number = $number;
                $order->description = $request->description;
                $order->price = $request->price;
                $order->modified = Carbon::now();
                $order->update();
                return $this->getResponse201("Order", "Updated", $order);
        } else {
            $response["message"] = "Not found";
        }

    }

    public function destroy($id)
    {
        if ($product = Products::find($id)) {
            $product -> delete();
        }
        return redirect()->away('http://127.0.0.1:5500/pages/productos/index.html');
    }

    
}

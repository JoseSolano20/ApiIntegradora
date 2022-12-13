<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();
         $orders = Orders::with('products')->get();
         return [
             "error" => false,
             "message" => "Successfull",
             "data" => $orders
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
        $existNumber = Orders::where("number", trim($request->number))->exists();
        if (!$existNumber) {
            $order = new Orders();
            $order->number = $number;
            $order->start_date = $request->start_date;
            $order->end_date = $request->end_date;
            $order->comments = $request->comments;
            $order->office_id = $request->office_id;
            $order->created = Carbon::now();
            $order->save();
            foreach ($request->products as $item) {
                $order->products()->attach($item);
            }
           return $this->getResponse201("Order", "Created", $order);
        } else {
            return $this->getResponse500();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Orders::find($id);
        if ($orders) {
            return $this->getResponse200($orders);
        }else{
            return $this->getResponse404();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $order = Orders::find($id);
            if ($order){
                $number = trim($request->number);
                $numberExist = Orders::where("number", $number)->first();
                    $order->number = $number;
                    $order->comments = $request->comments;
                    $order->modified = Carbon::now();
                    $order->update();
                    return $this->getResponse201("Order", "Updated", $order);
            } else {
                $response["message"] = "Not found";
            }



    }

    public function storeIn($idP, $idS){
        $ofor = new OfficeOrder();
        $ofor -> order_id = $idP;
        $ofor -> branch_offices_id = $idS;
        $ofor -> save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $order = Orders::find($id);
            if ($order) {
                $order->delete();
                
            }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Offices::all();
         $offices = Offices::with('orders', 'products')->get();
         return [
             "error" => false,
             "message" => "Successfull",
             "data" => $offices
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
        $name = trim($request->name);
        $existName = Offices::where("name", trim($request->name))->exists();
        if (!$existName) {
            $office = new Offices();
            $office->name = $name;
            $office->mobile = $request->mobile;
            $office->email = $request->email;
            $office->manager = $request->manager;
            $office->created = Carbon::now();
            $office->save();
           
           return $this->getResponse201("Office", "Created", $office);
        } else {
            return $this->getResponse500("Error");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Offices::find($id);
        if ($orders) {
            return $this->getResponse200($orders);
        }else{
            return $this->getResponse404();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function edit(Offices $offices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Offices::find($id);
        if ($order){
            $number = trim($request->name);
            $numberExist = Orders::where("name", $number)->first();
            $order->name = $request->name;
            $order->mobile = $request->mobile;
            $order->email = $request->email;
            $order->manager = $request->manager;
                $order->modified = Carbon::now();
                $order->update();
                return $this->getResponse201("Order", "Updated", $order);
        } else {
            $response["message"] = "Not found";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Offices::find($id);
        if ($order) {
            $order->delete();
            
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function index(Request $request)
    {
        return view('index', ['orders' => Order::all()]);
    }

    function create()
    {
        return view('form');
    }

    protected function rules()
    {
        return [
            'input' => 'required',
            'language' => 'required',
            'output' => 'required'
        ];
    }

    function store(Request $request)
    {
        $request->validate($this->rules());


        $order = new Order($request->except('_token','user_id'));
        $order->user_id =Auth::user()->id;

        $order->save();

        return redirect()->route('order.index');

    }

    function show(Order $order)
    {
        return view('show', ['order' => $order]);
    }

    function edit(Order $order)
    {
        return view('form',['order'=>$order]);
    }

    function update(Request $request, Order $order)
    {
        $rules = $this->rules();
        //

        $request->validate($rules);
        $data = $request->except('_token','_method');
        $order->fill($data);
        $order->save();
        return redirect()->route('order.show',$order);
    }

    function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index');
    }
}
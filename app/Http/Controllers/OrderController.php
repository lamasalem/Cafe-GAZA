<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DiningTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('diningTable')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.order.index', compact('orders'));
    }

    public function create()
    {
        $diningTables = DiningTable::all();
        return response()->view('cms.order.create', compact('diningTables'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Order_Date' => 'required|date',
            'Total_Amount' => 'required|numeric|min:0',
            'Payment_Method' => 'required|string',
            'Dining_Tables_ID' => 'required|exists:dining_tables,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $order = new Order();
            $order->Order_Date = $request->get('Order_Date');
            $order->Total_Amount = $request->get('Total_Amount');
            $order->Payment_Method = $request->get('Payment_Method');
            $order->Dining_Tables_ID = $request->get('Dining_Tables_ID');
            $order->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Order added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->view('cms.order.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $diningTables = DiningTable::all();
        return response()->view('cms.order.edit', compact('order', 'diningTables'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Order_Date' => 'required|date',
            'Total_Amount' => 'required|numeric|min:0',
            'Payment_Method' => 'required|string',
            'Dining_Tables_ID' => 'required|exists:dining_tables,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $order = Order::findOrFail($id);
            $order->Order_Date = $request->get('Order_Date');
            $order->Total_Amount = $request->get('Total_Amount');
            $order->Payment_Method = $request->get('Payment_Method');
            $order->Dining_Tables_ID = $request->get('Dining_Tables_ID');
            $order->save();

            return ['redirect' => route('orders.index')];
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }
}
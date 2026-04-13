<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'menuItem'])->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.order_detail.index', compact('orderDetails'));
    }

    public function create()
    {
        $orders = Order::all();
        $menuItems = MenuItem::all();
        return response()->view('cms.order_detail.create', compact('orders', 'menuItems'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Quantity' => 'required|integer|min:1',
            'Unit_Price' => 'required|numeric|min:0',
            'Notes' => 'nullable|string',
            'Orders_ID' => 'required|exists:orders,id',
            'Menu_Items_ID' => 'required|exists:menu_items,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $orderDetail = new OrderDetail();
            $orderDetail->Quantity = $request->get('Quantity');
            $orderDetail->Unit_Price = $request->get('Unit_Price');
            $orderDetail->Notes = $request->get('Notes');
            $orderDetail->Orders_ID = $request->get('Orders_ID');
            $orderDetail->Menu_Items_ID = $request->get('Menu_Items_ID');
            $orderDetail->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Order detail added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return response()->view('cms.order_detail.show', compact('orderDetail'));
    }

    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $menuItems = MenuItem::all();
        return response()->view('cms.order_detail.edit', compact('orderDetail', 'orders', 'menuItems'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Quantity' => 'required|integer|min:1',
            'Unit_Price' => 'required|numeric|min:0',
            'Notes' => 'nullable|string',
            'Orders_ID' => 'required|exists:orders,id',
            'Menu_Items_ID' => 'required|exists:menu_items,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $orderDetail = OrderDetail::findOrFail($id);
            $orderDetail->Quantity = $request->get('Quantity');
            $orderDetail->Unit_Price = $request->get('Unit_Price');
            $orderDetail->Notes = $request->get('Notes');
            $orderDetail->Orders_ID = $request->get('Orders_ID');
            $orderDetail->Menu_Items_ID = $request->get('Menu_Items_ID');
            $orderDetail->save();

            return ['redirect' => route('order-details.index')];
        }
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();
    }
}
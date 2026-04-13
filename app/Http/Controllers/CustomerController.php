<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.customer.index', compact('customers'));
    }

    public function create()
    {
        return response()->view('cms.customer.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => 'required|email|unique:customers,Email',
            'Password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $customer = new Customer();
            $customer->Email = $request->get('Email');
            $customer->Password = Hash::make($request->get('Password'));
            $customer->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Customer added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->view('cms.customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->view('cms.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Email' => 'required|email|unique:customers,Email,' . $id,
            'Password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $customer = Customer::findOrFail($id);
            $customer->Email = $request->get('Email');
            if ($request->get('Password')) {
                $customer->Password = Hash::make($request->get('Password'));
            }
            $customer->save();

            return ['redirect' => route('customers.index')];
        }
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }
}
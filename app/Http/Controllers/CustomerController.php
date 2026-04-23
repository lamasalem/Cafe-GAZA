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
        $customers = Customer::with('user')->get();

        return response()->view('cms.customer.index', compact('customers'));
    }

    public function create()
    {
        return response()->view('cms.customer.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        }

        $customer = new Customer();
        $customer->address = $request->get('address');
        $isSaved = $customer->save();

        if ($isSaved) {
            $customer->user()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'password' => Hash::make($request->get('password')),
                'role' => 'customer',
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إضافة الزبون بنجاح'
            ], 200);
        }

        return response()->json(['icon' => 'error', 'title' => 'فشلت الإضافة'], 400);
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
        $customer = Customer::with('user')->findOrFail($id);
        $userId = $customer->user ? $customer->user->id : null;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        }

        $customer->address = $request->get('address');
        $isSaved = $customer->save();

        if ($isSaved) {
            $userData = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->get('password'));
            }

            $customer->user()->update($userData);

            return response()->json(['icon' => 'success', 'title' => 'تم التعديل بنجاح!'], 200);
        }

        return response()->json(['icon' => 'error', 'title' => 'فشل التعديل'], 400);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->user) {
            $customer->user()->delete();
        }

        $isDeleted = $customer->delete();

        return response()->json([
            'icon' => $isDeleted ? 'success' : 'error',
            'title' => $isDeleted ? 'تم الحذف بنجاح' : 'فشل الحذف'
        ], $isDeleted ? 200 : 400);
    }
}
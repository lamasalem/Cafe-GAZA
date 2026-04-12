<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 1. عرض صفحة الجدول (Index)
    public function index()
    {
        $users = User::all();
        return view('cms.users.index', compact('users'));
    }

    // 2. عرض صفحة الإضافة (Create)
    public function create()
    {
        return view('cms.users.create');
    }

    // 3. تخزين المستخدم الجديد (Store) - AJAX
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,employee',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->errors()->first()], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح']);
    }

    // 4. عرض صفحة التعديل (Edit)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('cms.users.edit', compact('user'));
    }

    // 5. تحديث البيانات (Update) - AJAX
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'role' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->errors()->first()], 400);
        }else{ $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();}

       

        return ['redirect' => route('users.index')];
    }

    // 6. الحذف (Destroy) - AJAX
    public function destroy($id)
    {
        User::destroy($id);
     return redirect()->back();
    }
}
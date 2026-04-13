<?php

namespace App\Http\Controllers;

use App\Models\InternetSession;
use App\Models\Order;
use App\Models\InternetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternetSessionController extends Controller
{
    public function index()
    {
        $internetSessions = InternetSession::with(['order', 'internetService'])->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.internet_session.index', compact('internetSessions'));
    }

    public function create()
    {
        $orders = Order::all();
        $internetServices = InternetService::all();
        return response()->view('cms.internet_session.create', compact('orders', 'internetServices'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Start_Time' => 'required|date',
            'End_Time' => 'nullable|date',
            'Access_Code' => 'required|string',
            'Status' => 'required|in:active,expired,cancelled',
            'Orders_ID' => 'required|exists:orders,id',
            'Internet_Services_ID' => 'required|exists:internet_services,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $session = new InternetSession();
            $session->Start_Time = $request->get('Start_Time');
            $session->End_Time = $request->get('End_Time');
            $session->Access_Code = $request->get('Access_Code');
            $session->Status = $request->get('Status');
            $session->Orders_ID = $request->get('Orders_ID');
            $session->Internet_Services_ID = $request->get('Internet_Services_ID');
            $session->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Session added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $internetSession = InternetSession::findOrFail($id);
        return response()->view('cms.internet_session.show', compact('internetSession'));
    }

    public function edit($id)
    {
        $internetSession = InternetSession::findOrFail($id);
        $orders = Order::all();
        $internetServices = InternetService::all();
        return response()->view('cms.internet_session.edit', compact('internetSession', 'orders', 'internetServices'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Start_Time' => 'required|date',
            'End_Time' => 'nullable|date',
            'Access_Code' => 'required|string',
            'Status' => 'required|in:active,expired,cancelled',
            'Orders_ID' => 'required|exists:orders,id',
            'Internet_Services_ID' => 'required|exists:internet_services,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $session = InternetSession::findOrFail($id);
            $session->Start_Time = $request->get('Start_Time');
            $session->End_Time = $request->get('End_Time');
            $session->Access_Code = $request->get('Access_Code');
            $session->Status = $request->get('Status');
            $session->Orders_ID = $request->get('Orders_ID');
            $session->Internet_Services_ID = $request->get('Internet_Services_ID');
            $session->save();

            return ['redirect' => route('internet-sessions.index')];
        }
    }

    public function destroy($id)
    {
        $session = InternetSession::findOrFail($id);
        $session->delete();
    }
}
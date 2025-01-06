<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function sendMessage(Request $request)
    {
        $result = $this->firebase->sendSMS(
            // $request->phone_number,
            // $request->message
            +918905614295,
            "This is demo text for testing."
        );

        if ($result) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 500);
    }
}

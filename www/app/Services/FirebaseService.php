<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
   protected $messaging;

   public function __construct()
   {
      $factory = (new Factory)
         ->withServiceAccount(storage_path('app/firebase/marketastroscience-19c06-firebase-adminsdk-dkth3-ae29136934.json'))
         ->withDatabaseUri(config('services.firebase.database_url'));

      $this->messaging = $factory->createMessaging();
   }

   public function sendSMS($phoneNumber, $message)
   {
      try {
         $notification = Notification::create()
            ->withTitle('New Message')
            ->withBody($message);

         $message = CloudMessage::withTarget('token', $phoneNumber)
            ->withNotification($notification)
            ->withData(['type' => 'sms']);
         $this->messaging->send($message);

         return true;
      } catch (\Exception $e) {
         return false;
      }
   }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService {
    public function sendOrderEmail($order, $recipientEmail)
    {
        $data = [
            'order' => $order,
        ];

        Mail::send('emails.order', $data, function ($message) use ($recipientEmail) {
            $message->to($recipientEmail)
                ->subject('New Order Details');
        });
    }
}


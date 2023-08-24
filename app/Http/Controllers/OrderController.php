<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\EmailService;
use App\Services\OrderService;

class OrderController extends Controller {

    private OrderService $orderService;
    private EmailService $emailService;

    public function __construct(OrderService $orderService, EmailService $emailService)
    {
        $this->orderService = $orderService;
        $this->emailService = $emailService;
    }

    public function placeOrder(CreateOrderRequest $request)
    {
        $foreignAmount = $request->input('foreign_amount');
        $selectedCurrencyCode = $request->input('currency_code');

        $order = $this->orderService->createOrder($foreignAmount, $selectedCurrencyCode);

        if ($selectedCurrencyCode === 'EUR') {
            $recipientEmail = 'recipient@example.com'; // Replace with actual recipient's email
            $this->emailService->sendOrderEmail($order, $recipientEmail);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure user exists
            'car_id' => 'required|exists:cars,id',    // Ensure car exists
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        try {
            // Create the order
            $order = Order::create($validated);
            return response()->json($order, 201);  // Return the created order
        } catch (\Exception $e) {
            Log::error("Error creating order: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update(['payment_status' => 'paid']);
        return response()->json(['message' => 'Payment successful']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function markAsPaid(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        // Check if the order is already paid
        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Order is already marked as paid.'], 400);
        }

        // Update the payment status to 'paid' and the payment method to 'cash'
        $order->update([
            'payment_status' => 'paid',
            'payment_method' => 'cash',
        ]);

        return response()->json([
            'message' => 'Order has been marked as paid.',
            'order' => $order,
        ], 200);
    }
}

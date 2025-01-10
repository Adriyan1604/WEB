<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        return response()->json(Order::all());
    }

    // Menyimpan order baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Membuat order baru
        $order = Order::create($validated);

        // Mengembalikan response
        return response()->json($order, 201);
    }

    // Mengupdate order yang sudah ada
    public function update(Request $request, $id)
    {
        // Menemukan order berdasarkan ID
        $order = Order::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Mengupdate order
        $order->update($validated);

        // Mengembalikan response dengan data order yang diupdate
        return response()->json($order);
    }

    // Menghapus order
    public function destroy($id)
    {
        // Menemukan order berdasarkan ID
        $order = Order::findOrFail($id);

        // Menghapus order
        $order->delete();

        // Mengembalikan response
        return response()->json(['message' => 'Order deleted']);
    }
}

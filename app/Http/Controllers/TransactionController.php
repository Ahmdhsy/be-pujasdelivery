<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Store a new transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tenant_id' => 'required|exists:tenants,id',
            'gedung_id' => 'required|exists:gedungs,id',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.catatan' => 'nullable|string|max:255', // Validasi untuk catatan per item
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Simpan file bukti pembayaran
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

            // Hitung total harga
            $total = collect($validated['items'])->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            // Buat transaksi baru
            $transaction = Transaction::create([
                'user_id' => $validated['user_id'],
                'tenant_id' => $validated['tenant_id'],
                'gedung_id' => $validated['gedung_id'],
                'status' => 'pending',
                'total_price' => $total,
                'bukti_pembayaran' => $buktiPath,
            ]);

            // Simpan item transaksi
            foreach ($validated['items'] as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'catatan' => $item['catatan'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil dibuat.',
                'data' => $transaction->load('items'),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Gagal menyimpan transaksi', 'details' => $e->getMessage()], 500);
        }
    }
}
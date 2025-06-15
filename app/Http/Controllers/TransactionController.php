<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'tenant', 'gedung', 'items.menu'])
            ->orderBy('id', 'asc')
            ->get();
            
        return view('transaction.index', compact('transactions'));
    }
    
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
            'items.*.catatan' => 'nullable|string|max:255',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $total = collect($validated['items'])->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            $transaction = Transaction::create([
                'user_id' => $validated['user_id'],
                'tenant_id' => $validated['tenant_id'],
                'gedung_id' => $validated['gedung_id'],
                'status' => 'pending',
                'total_price' => $total,
                'bukti_pembayaran' => $buktiPath,
            ]);

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

    public function getCourierOngoingTransactions(Request $request)
    {
        try {
            $transactions = Transaction::whereIn('status', ['pending', 'diproses', 'pengantaran']) // Ubah dari ['diterima', 'diproses', 'dalam pengantaran']
                ->with(['items' => function ($query) {
                    $query->select('id', 'transaction_id', 'menu_id', 'quantity', 'price', 'subtotal', 'catatan');
                }])
                ->get();

            Log::debug('Raw transactions fetched: ', $transactions->toArray());

            if ($transactions->isEmpty()) {
                Log::info('No ongoing transactions found');
                return response()->json(['message' => 'No ongoing transactions found', 'data' => []], 200);
            }

            $mappedTransactions = $transactions->map(function ($transaction) {
                try {
                    Log::debug('Processing transaction: ', ['id' => $transaction->id, 'items_count' => $transaction->items->count()]);
                    $items = $transaction->items->isEmpty() ? [] : $transaction->items->map(function ($item) {
                        return [
                            'transaction_id' => $item->transaction_id,
                            'menu_id' => $item->menu_id,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'subtotal' => $item->subtotal,
                            'catatan' => $item->catatan
                        ];
                    })->all();

                    return [
                        'message' => 'Success',
                        'data' => [
                            'id' => $transaction->id,
                            'user_id' => $transaction->user_id,
                            'tenant_id' => $transaction->tenant_id,
                            'gedung_id' => $transaction->gedung_id,
                            'status' => $transaction->status,
                            'total_price' => $transaction->total_price,
                            'bukti_pembayaran' => $transaction->bukti_pembayaran,
                            'items' => $items
                        ]
                    ];
                } catch (\Exception $e) {
                    Log::error("Error mapping transaction {$transaction->id}: {$e->getMessage()}", ['exception' => $e]);
                    return [
                        'message' => 'Partial Success',
                        'data' => [
                            'id' => $transaction->id,
                            'user_id' => $transaction->user_id,
                            'tenant_id' => $transaction->tenant_id,
                            'gedung_id' => $transaction->gedung_id,
                            'status' => $transaction->status,
                            'total_price' => $transaction->total_price,
                            'bukti_pembayaran' => $transaction->bukti_pembayaran,
                            'items' => []
                        ]
                    ];
                }
            });

            Log::debug('Mapped transactions: ', $mappedTransactions->toArray());

            return response()->json($mappedTransactions);
        } catch (\Exception $e) {
            Log::error("Error fetching ongoing transactions: {$e->getMessage()}", ['exception' => $e, 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }

    public function getCourierHistoryTransactions(Request $request)
    {
        try {
            $transactions = Transaction::where('status', 'selesai') // Ubah dari ['selesai', 'dibatalkan']
                ->with(['items' => function ($query) {
                    $query->select('id', 'transaction_id', 'menu_id', 'quantity', 'price', 'subtotal', 'catatan');
                }])
                ->get();

            Log::debug('Raw history transactions fetched: ', $transactions->toArray());

            if ($transactions->isEmpty()) {
                Log::info('No history transactions found');
                return response()->json(['message' => 'No history transactions found', 'data' => []], 200);
            }

            $mappedTransactions = $transactions->map(function ($transaction) {
                try {
                    Log::debug('Processing history transaction: ', ['id' => $transaction->id, 'items_count' => $transaction->items->count()]);
                    $items = $transaction->items->isEmpty() ? [] : $transaction->items->map(function ($item) {
                        return [
                            'transaction_id' => $item->transaction_id,
                            'menu_id' => $item->menu_id,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'subtotal' => $item->subtotal,
                            'catatan' => $item->catatan
                        ];
                    })->all();

                    return [
                        'message' => 'Success',
                        'data' => [
                            'id' => $transaction->id,
                            'user_id' => $transaction->user_id,
                            'tenant_id' => $transaction->tenant_id,
                            'gedung_id' => $transaction->gedung_id,
                            'status' => $transaction->status,
                            'total_price' => $transaction->total_price,
                            'bukti_pembayaran' => $transaction->bukti_pembayaran,
                            'items' => $items
                        ]
                    ];
                } catch (\Exception $e) {
                    Log::error("Error mapping history transaction {$transaction->id}: {$e->getMessage()}", ['exception' => $e]);
                    return [
                        'message' => 'Partial Success',
                        'data' => [
                            'id' => $transaction->id,
                            'user_id' => $transaction->user_id,
                            'tenant_id' => $transaction->tenant_id,
                            'gedung_id' => $transaction->gedung_id,
                            'status' => $transaction->status,
                            'total_price' => $transaction->total_price,
                            'bukti_pembayaran' => $transaction->bukti_pembayaran,
                            'items' => []
                        ]
                    ];
                }
            });

            Log::debug('Mapped history transactions: ', $mappedTransactions->toArray());

            return response()->json($mappedTransactions);
        } catch (\Exception $e) {
            Log::error("Error fetching history transactions: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $request->validate([
                'status' => 'required|in:pending,diproses,pengantaran,diterima,selesai' // Ubah validasi
            ]);

            $transaction->status = $request->status;
            $transaction->save();

            return response()->json([
                'message' => 'Status updated',
                'data' => [
                    'id' => $transaction->id,
                    'user_id' => $transaction->user_id,
                    'user_name' => $transaction->user->name ?? 'Unknown',
                    'tenant_id' => $transaction->tenant_id,
                    'gedung_id' => $transaction->gedung_id,
                    'gedung_name' => $transaction->gedung->name ?? 'Unknown',
                    'status' => $transaction->status,
                    'total_price' => $transaction->total_price,
                    'bukti_pembayaran' => $transaction->bukti_pembayaran,
                    'items' => $transaction->items
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error updating transaction status: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $transaction = Transaction::with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                },
                'gedung' => function ($query) {
                    $query->select('id', 'nama_gedung');
                },
                'items.menu' => function ($query) {
                    $query->select('id', 'nama', 'tenant_id');
                },
                'items.menu.tenant' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->findOrFail($id);

            return response()->json([
                'message' => 'Success',
                'data' => [
                    'id' => $transaction->id,
                    'user_id' => $transaction->user_id,
                    'user_name' => $transaction->user->name ?? 'Unknown',
                    'gedung_id' => $transaction->gedung_id,
                    'gedung_name' => $transaction->gedung->nama_gedung ?? 'Unknown',
                    'tenant_id' => $transaction->tenant_id,
                    'status' => $transaction->status,
                    'total_price' => $transaction->total_price,
                    'bukti_pembayaran' => $transaction->bukti_pembayaran,
                    'items' => $transaction->items->map(function ($item) {
                        return [
                            'transaction_id' => $item->transaction_id,
                            'menu_id' => $item->menu_id,
                            'menu_name' => $item->menu->nama ?? 'Unknown',
                            'tenant_name' => $item->menu->tenant->name ?? 'Unknown',
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'subtotal' => $item->subtotal,
                            'catatan' => $item->catatan
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching transaction: {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}
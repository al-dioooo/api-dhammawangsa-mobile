<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\Midtrans;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    protected $midtransService;

    public function __construct(Midtrans $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Transaction::filter($request->only('customer_id', 'status'));
            $result = $this->paginate($query, $request->query('limit') ?? 15, $request->query('paginate'), $request->query('order_by') ?? "created_at", $request->query('direction') ?? "desc");

            return response()->json([
                'message' => 'Successfully read transaction data',
                'data' => $result
            ]);
        } catch (Handler $e) {
            return $e;
        }
    }

    /**
     * Checkout a new transaction.
     */
    public function checkout(CheckoutRequest $request)
    {
        DB::beginTransaction();

        try {
            $orderId = uniqid();

            $transaction = Transaction::create([
                ...$request->validatedExcept('details'),
                'uuid' => $orderId
            ]);
            $transaction->details()->createMany($request->input('details'));

            $midtransOrderDetails = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $request->input('grand_total'),
                ],
                'customer_details' => [
                    'first_name' => $request->input('customer_name'),
                    'email' => $request->input('customer_email'),
                    'phone' => $request->input('customer_phone'),
                ],
            ];

            $snapToken = $this->midtransService->getSnapToken($midtransOrderDetails);

            DB::commit();

            return response()->json([
                'message' => 'Successfully created a new transaction data!',
                'data' => $snapToken
            ]);
        } catch (Handler $e) {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('details');

        return response()->json([
            'message' => __('api.read.success', ['model' => 'transaction']),
            'data' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

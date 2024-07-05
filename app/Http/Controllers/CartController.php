<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Cart::filter($request->only(['user_id']));
            $result = $this->paginate($query, $request->query('limit') ?? 15, $request->query('paginate'), $request->query('order_by') ?? "created_at", $request->query('direction') ?? "desc");

            return response()->json([
                'message' => 'Successfully read cart data',
                'data' => $result
            ]);
        } catch (Handler $e) {
            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        DB::beginTransaction();

        try {
            Cart::create($request->validated());

            DB::commit();

            return response()->json([
                'message' => __('api.store.success', ['pluralization' => 'a', 'model' => 'cart']),
            ]);
        } catch (Handler $e) {
            DB::rollBack();

            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return response()->json([
            'message' => __('api.read.success', ['model' => 'cart']),
            'data' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        DB::beginTransaction();

        try {
            $cart->update($request->validated());

            DB::commit();

            return response()->json([
                'message' => __('api.update.success', ['pluralization' => 'a', 'model' => 'cart'])
            ]);
        } catch (Handler $e) {
            DB::rollback();

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        DB::beginTransaction();

        try {
            $cart->delete();

            DB::commit();

            return response()->json([
                'message' => __('api.destroy.success', ['pluralization' => 'a', 'model' => 'cart']),
            ]);
        } catch (Handler $e) {
            DB::rollBack();

            return response()->json($e);
        }
    }
}

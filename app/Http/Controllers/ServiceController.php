<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Service::filter($request->only(['user_id']));
            $result = $this->paginate($query, $request->query('limit') ?? 15, $request->query('paginate'), $request->query('order_by') ?? "created_at", $request->query('direction') ?? "desc");

            return response()->json([
                'message' => 'Successfully read service data',
                'data' => $result
            ]);
        } catch (Handler $e) {
            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}

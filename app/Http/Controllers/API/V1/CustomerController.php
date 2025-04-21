<?php


namespace App\Http\Controllers\API\V1;
use App\Models\customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorecustomerRequest;
use App\Http\Requests\V1\UpdatecustomerRequest;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    
    public function index()
    {
      return CustomerResource::collection(customer::all());
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
    public function store(StorecustomerRequest $request)
    {
        $task= customer::create($request->validated());
        return CustomerResource::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        return CustomerResource::make($customer);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomerRequest $request, customer $customer)
    {
        
        $customer->update($request->validated());
        return CustomerResource::make($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
}

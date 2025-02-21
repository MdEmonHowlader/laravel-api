<?php

namespace App\Http\Controllers\Api\V1;

use App\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;
// use App\Http\Services\V1\CustomerQuery;
use App\Filters\V1\CustomerFilter ;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

            // $filter = new CustomerQuery();

        $filter = new CustomerFilter();
        $filterItems=$filter->transform($request);
        $incudeInvoices = $request->query('includeInvoices');
        $customer = Customer::where($filterItems);
        if($incudeInvoices){
           $customer= $customer->with('invoices');
        }
         return new CustomerCollection($customer->paginate()->append($request->query()));
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
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new  CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmail;

class CustomerController extends Controller
{
    public $model;
    public $viewDirectory = 'customer::customer';
    public $route = 'customer';
    public $dataName = 'Customer';

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Renderable
    {
        $customers = $this->model->all();
        
        return view('backend.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Renderable
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function fillableAttributes($request): array
    {
        return $request->only(
            'name',
            'email',
            'phone',
            'address'
        );
    }

    public function store(Request $request): object
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email,except,id',
            'phone' => 'required',
            'address' => 'required',
        ]);

        try {
            $input = $this->fillableAttributes($request);
            $this->model->create($input);

            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address
            ];

            SendEmail::dispatch($data);

            return redirect()->route('customer.index')->with('success', ' Customer Added Successfully!');
        } catch (\Exception $e) {
            Log::error($e);
            return \redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', $this->dataName . ' Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Renderable
    {
        $customer = $this->model->findOrFail($id);
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): object
    {
        $customer = $this->model->findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        try {
            $input = $this->fillableAttributes($request);
            $customer->update($input);

            return redirect()->route('customer.index')->with('success', $this->dataName . ' Updated Successfully!');
        } catch (\Exception $e) {
            Log::error($e);
            return \redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        dd($customer);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Customer;
use App\Order;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $customer = $customer->where('email', 'LIKE', '%' . request()->q . '%');
        }
        $customer = $customer->paginate(10);
        return view('customers.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'numeric', 'min:8'],
            'address' => ['required', 'string'],
            'district_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // dd([$request->password, Hash::make($request->password),]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $request->password,
            'district_id' => $request->district_id,
            'status' => 1

        ]);
         return redirect(route('customer.index'))->with(['success' => 'Pembeli Baru Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min:8'],
            'address' => ['required', 'string'],
            'district_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $customer = Customer::find($id);
        $customer->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $request->password,
            'district_id' => $request->district_id,
            'status' => 1
        ]);
        return redirect(route('customer.index'))->with(['success' => 'Data Pembeli Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $order = Order::where('customer_id',$id);
        $order->delete();
        $customer->delete();
        return redirect(route('customer.index'))->with(['success' => 'Pembeli Sudah Dihapus']);
    }
}

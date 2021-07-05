<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hash;
class RegisterPercetakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));
        return view('register');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        $auth = $request->only('email', 'password');
        $auth['status'] = 1;
        // var_dump(auth()->guard('customer')->attempt($auth));
        // die;
        if (auth()->guard('customer')->attempt($auth)) {
            return redirect('/');
        }

        return redirect()->back()->with(['error' => 'Email / Password Salah']);
    }

    public function dashboard()
    {
        $orders = Order::selectRaw('COALESCE(sum(CASE WHEN status = 0 THEN subtotal END), 0) as pending, 
            COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
            COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')
            ->where('customer_id', auth()->guard('customer')->user()->id)->get();

        return view('ecommerce.dashboard', compact('orders'));
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect(route('customer.login'));
    }
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // dd([$request->password, Hash::make($request->password),]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 0
        ]);

        return view('auth.login');
    }
}

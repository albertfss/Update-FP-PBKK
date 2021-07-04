<?php

namespace App\Http\Controllers\Ecommerce;
use App\Product;
use App\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Mail\Sendmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewCartController extends Controller
{
    	public function addToCart(Product $product ){

    		if(session()->has('cart')){
    			$cart = new Cart(session()->get('cart'));
    		}
    		else{
    			$cart = new Cart();
    		}
    		$cart->add($product);

    		session()->put('cart', $cart);
    		// the put method is here to update the session by putting $cart in cart
  
        	return redirect()->back();
    	}

    	public function showCart(){
    		if(session()->has('cart')){
    			$cart = new Cart(session()->get('cart'));
    		}
    		else{
    			$cart = null;
    		}

    		return view('ecommerce.cart', compact('cart'));
    	}

    	public function updateCart(Request $request, $id){
    		$request->validate([
    			'qty' => 'required|numeric|min:1'

    		]);

    		$cart = new Cart(session()->get('cart'));
    		$cart->updateQty($product->id, $request->qty);
    		session()->put('cart',$cart);
    		notify()->success('Cart Updated⚡️');
        	return redirect()->back();

    	}

    	public function removeCart($id){
            $product=Product::find($id);
    		$cart = new Cart(session()->get('cart'));
    		$cart->removeCart($product->id);
    		if($cart->totalQty<=0){
    			session()->forget('cart');
    		}
    		else{
    			session()->put('cart', $cart);
	    		
    		}
	        return redirect()->back();
    	}

    	public function checkout($amount){
    		if(session()->has('cart')){
    			$cart = new Cart(session()->get('cart'));
    		}
    		else{
    			$cart = null;
    		}
    		return view('checkout', compact('amount','cart'));
    	}

    	public function charge(Request $request){
    		$charge = Stripe::charges()->create([
	            'currency'=>"USD",
	            'source'=>$request->stripeToken,
	            'amount'=>$request->amount,
	            'description'=>'Test'
	        ]);

	        $chargeId = $charge['id'];

	        if(session()->has('cart')){
    			$cart = new Cart(session()->get('cart'));
    		}
    		else{
    			$cart = null;
    		}
    		\Mail::to(auth()->user()->email)->send(new Sendmail($cart));

	        if($chargeId){
	            auth()->user()->orders()->create([

	                'cart'=>serialize(session()->get('cart'))
				// the line above is basically taking what is in the cart using session and get to put it in the cart attribute of order through serialization
	            ]);

	            session()->forget('cart');
	            //we then forget the cart because the transaction is completed
	            notify()->success(' Transaction completed!');
	            return redirect()->to('/');

	        }else{
	            return redirect()->back();
	        }
    	}

    	public function order(){
    		$orders = auth()->user()->orders;
    		$carts = $orders->transform(function($cart,$key){
    			unserialize($cart->cart);
    		});
    		return view('order', compact('cart'));
    	}

}

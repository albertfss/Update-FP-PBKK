<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $review = Review::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $review = $review->where('email', 'LIKE', '%' . request()->q . '%');
        }
        $review = $review->paginate(10);
        return view('reviews.index', compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product=Product::find($id);
        return view('reviews.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'rating' => ['required', 'integer'],
            'comment' => ['required', 'string', 'max:100'],
        ]);

        // dd([$request->password, Hash::make($request->password),]);

        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
        ]);
         return redirect(url('/products'))->with(['success' => 'Pembeli Baru Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $review = Review::find($id);
        return view('review.edit', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $review = Review::find($id);
        return view('review.edit', compact('review'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'rating' => ['required', 'integer'],
            'comment' => ['required', 'string', 'max:100'],
        ]);

        $erview = Review::find($id);
        $review->update([
            'id' => $request->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
        ]);
        return redirect(route('review.index'))->with(['success' => 'Data Pembeli Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $review = Review::find($id);
        $product = Product::where('product_id',$id);
        $product->delete();
        $review->delete();
        return redirect(route('creview.index'))->with(['success' => 'Pembeli Sudah Dihapus']);
    }
}

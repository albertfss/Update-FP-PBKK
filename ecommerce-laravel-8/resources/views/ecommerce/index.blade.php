@extends('layouts.ecommerce')

@section('title')
<title>CetakinAja Pusat Percetakan Online</title>
@endsection

@section('content')
<div class="position-relative bg-light overflow-hidden p-3 p-md-5 m-md-3 text-white text-center" style="background-image:url('{{asset('background/home-1.jpg')}}');"/>
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Cetakin Aja</h1>
        <p class="lead font-weight-normal">Platform percetakan online yang menyediakan fitur pemesanan dan pengiriman. Mari bertransaksi dengan Kami.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device box-shadow d-none d-md-block"></div>
      <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
<section class="mt-2">
	<div class="md-2">
		<div class="container">
			<div class="row">
				<h2>List Product</h2>
			</div>
			<div class="row mt-3">
				@forelse($products as $row)
				<div class="col-6 col-md-3 py-1">
					<div class="card shadow h-100">
						<div class="card-body text-left h-50">
							<img src="{{ asset('product/' . $row->image) }}" class="card-img-top" alt="...">
							<div class="card-body" >
								<h3 class="card-title" style="width: 10ch; overflow: hidden;
								white-space: nowrap;
								text-overflow: ellipsis;">{{ $row->name }}</h3>
								<h5>Rp {{ number_format($row->price) }}</h5>
								<p class="card-text" style="width: 20ch; overflow: hidden;
								white-space: nowrap;
								text-overflow: ellipsis;"> {{$row->slug}} </p>
								<a href="{{ url('/product/' . $row->slug) }}" class="btn btn-primary">Detail</a>
							</div>
						</div>
					</div>
				</div>
				@empty

				@endforelse
			</div>
		</div>

		<div class="row">
			{{ $products->links() }}
		</div>
	</div>
	</div>
</section>
<!--================End Feature Product Area =================-->
@endsection
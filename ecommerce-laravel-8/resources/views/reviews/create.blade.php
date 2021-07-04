@extends('layouts.ecommerce')

@section('title')
<title>Jual {{ $product->name }}</title>
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="mt-3 text-center">

	<div class="container">

		<h2>{{ $product->name }}</h2>

	</div>
</section>
<!--================End Home Banner Area =================-->

<div class="product_image_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<img class="d-block img-thumbnail" src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}">
			</div>
			<div class="col-lg-5 offset-lg-1">

				<h3>{{ $product->name }}</h3>
				<h2>Rp {{ number_format($product->price) }}</h2>
				<ul class="list">
					<li>

						<span>Kategori</span> : {{ $product->category->name }}</a>

				</ul>
				<p>
					@if (auth()->guard('customer')->check())
					<label>Afiliasi Link</label>
					<input type="text" value="{{ url('/product/ref/' . auth()->guard('customer')->user()->id . '/' . $product->id) }}" readonly class="form-control">
					@endif
				</p>
				<form action="{{ route('review.store') }}" method="POST">
					@csrf
					<div class="product_count">
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nilai</label>
                                <select name="rating" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected >Choose...</option>
                                    <option value="{{1}}">1</option>
                                    <option value="{{2}}">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5" selected="selected">5</option>
                                </select>
                            <label for="qty">Review:</label>
                            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                        </div>

					</div>
					<div class="card_area">
						<button class="btn btn-primary">Submit Review</button>
					</div>

					@if (session('success'))
					<div class="alert alert-success mt-2">{{ session('success') }}</div>
					@endif
				</form>
				<br>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#review" role="tab" aria-controls="profile" aria-selected="false">Review</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="color: black">
						{!! $product->description !!}
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<td>
											<h5>Harga</h5>
										</td>
										<td>
											<h5>Rp {{ number_format($product->price) }}</h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Kategori</h5>
										</td>
										<td>
											<h5>{{ $product->category->name }}</h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Waktu Pengerjaan</h5>
										</td>
										<td>
											<h5>{{ $product->processing }}</h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Material Kertas</h5>
										</td>
										<td>
											<h5>{{ $product->material }}</h5>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->

<div class="container">

</div>

<!--================End Product Description Area =================-->
@endsection


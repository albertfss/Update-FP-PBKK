@extends('layouts.ecommerce')

@section('title')
<title>CetakinAja Pusat Percetakan Online</title>
@endsection

@section('content')

<!--================Category Product Area =================-->

<section class="mt-3">
        <div class="row border-1">
            <div class="col-lg-3 bg-light border-1">
                <h2 class="card-header text-secondary bg-light margin-auto">Kategori Produk</h2>
                <div class="card-body mt-0 bg-light">
                <ul class="list-group">
                    @foreach ($categories as $category)
                    <li class="list-group-item">
                        <strong>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-secondary"> <a class="text-secondary" href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a></li>
                            </ul>
                        </strong>
                        @foreach ($category->child as $child)
                        <ul class="list-group" style="display: block">
                            <li class="list-group-item border-0 ml-0">
                                <a class="text-secondary" href="{{ url('/category/' . $child->slug) }}">{{ $child->name }}</a>
                            </li>
                        </ul>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mt-3">
                        @foreach ($products as $row)
                        <div class="col-4 col-md-3 py-1">
                            <div class="card-group h-100">
                                <div class="card shadow mt-10" style="margin-bottom:1em; margin-right:1em;">
                                    <div class="card-header ">
                                        {{ $row->name }}
                                    </div>
                                    <div class="card-body mb-10 ">
                                        <img class="card-img-top" src="{{ asset('product/' . $row->image) }}" alt="{{ $row->name }}">
                                            <p class="text-secondary"style="overflow: hidden;
                                                white-space: nowrap;
                                            text-overflow: ellipsis;">
                                            {{$row->slug}}
                                            </p>
                                        <h5>Rp {{ number_format($row->price) }}</h5>
                                        <a href="{{ url('/product/' . $row->slug) }}" class="btn btn-primary float-right">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            
        </div>

        <div class="row">
            {{ $products->links() }}
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection
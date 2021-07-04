@extends('layouts.ecommerce')

@section('title')
<title>Jual Produk Fashion - DW Ecommerce</title>
@endsection

@section('content')

<!--================Category Product Area =================-->

<section class="mt-3">
        <div class="row">
            <div class="col-lg-3">
            <div class="app-body float-left ">
            <nav class="sidebar card py-2 mb-4">
<ul class="nav flex-column" id="nav_accordion">
	<li class="nav-item">
		<a class="nav-link" href="#"> Link name </a>
	</li>
	<li class="nav-item has-submenu">
		<a class="nav-link" href="#"> Submenu links  </a>
		<ul class="submenu collapse">
			<li><a class="nav-link" href="#">Submenu item 1 </a></li>
			<li><a class="nav-link" href="#">Submenu item 2 </a></li>
			<li><a class="nav-link" href="#">Submenu item 3 </a> </li>
		</ul>
	</li>
	<li class="nav-item has-submenu">
		<a class="nav-link" href="#"> More menus  </a>
		<ul class="submenu collapse">
			<li><a class="nav-link" href="#">Submenu item 4 </a></li>
			<li><a class="nav-link" href="#">Submenu item 5 </a></li>
			<li><a class="nav-link" href="#">Submenu item 6 </a></li>
			<li><a class="nav-link" href="#">Submenu item 7 </a></li>
		</ul>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#"> Something </a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#"> Other link </a>
	</li>
</ul>
</nav>
    </div>
            </div>
            <div class="col-lg-9">
            </div>
        </div>

        <div class="row">
        </div>
</section>
<!--================End Category Product Area =================-->
@endsection
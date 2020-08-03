@extends('layouts.app')

@section('content')
<section id="products-show">
	<div class="container">
		{{-- Header --}}
		<div class="s-header row py-4">
            <div class="col-1 px-0">
                <a class="align-self-start"
                @if (strpos(url()->previous(), 'edit'))
                	href="{{ route('products.index') }}"
                @else
					href="{{ url()->previous() }}"
                @endif
                ><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    {{ __($product->name) }}
                </h1>
            </div>
        </div>
		{{-- /Header --}}

		{{-- Presentation --}}
		<div class="s-presentation row">
			<div class="col-9">
				<div class="card border-0 shadow">
					<div class="card-header bg-black p-1">
						<img src="{{ $product->get_image }}" class="card-img-top">
					</div>
					<div class="card-body">
						{{ __($product->description) }}
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-header">
						<span><b>{{ $product->price }}</b></span>
					</div>
				@if (Auth::user()->isAdmin)
					<a class="btn btn-success" href="{{ route('products.edit',$product) }}">{{ __('Edit') }}</a>
					<form action="{{ route('products.destroy',$product) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger btn-block">{{ __('Delete') }}</button>
					</form>
				@endif
				</div>
			</div>
		</div>
		{{-- /Presentation --}}
	</div>
</section>
@endsection
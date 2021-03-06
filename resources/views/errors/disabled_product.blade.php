@extends('layouts.app')

@section('content')
<section id="disabled-product" class="scene-disabled">
    {{--Main--}}
    <div class="container">
        <div class="s-header row">
            <div class="col-md-6 offset-md-3">
                <div class="card text-center my-5">
                    <div class="card-header text-warning text-uppercase">
                        <b>{{ __('We are sorry') }}</b>
                    </div>
                    <div class="card-body">
                        <p>{{ __('This product is disabled') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection

@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List of Products</div>

                <div class="panel-body">
@foreach( $products as $product)
    <article>
       <h2>
        <a href="/products/{{ $product->id }}"> {{ $product->name }} </a>
        </h2>
        <div class="body"> {{ $product->company }} </div>
    </article>
    <hr/>
@endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




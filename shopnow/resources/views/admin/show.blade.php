@extends("layouts.app")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit a Product</div>

                <div class="panel-body">
                    

    {!! Form::open(['url' => '/products/'.$product->id]) !!}
    <div class="form-group">

    {!! Form::label("name", "Name") !!}
    {!! Form::text("name",$product->name,["class" => "form-control"]) !!}

    </div> <div class="form-group">
    {!! Form::label("name", "Price") !!}
    {!! Form::text("price",$product->price,["class" => "form-control"]) !!}
    </div> <div class="form-group">
    {!! Form::label("name", "Quantity") !!}
    {!! Form::text("quantity",$product->quantity,["class" => "form-control"]) !!}
    </div> <div class="form-group">
    {!! Form::label("name", "Company") !!}
    {!! Form::text("company",$product->company,["class" => "form-control"]) !!}
    </div>

     <div class="form-group">
    {!! Form::label("imgurl", "Image URL") !!}
    {!! Form::text("imgurl",$product->imgurl,["class" => "form-control"]) !!}  
    </div>
    
     <div class="form-group">
    {!! Form::submit("Save Product",null,["class" => "btn btn-primary form-control"]) !!}
        <input type="submit" name="delete" value="Delete Product">
    </div>


    {!! Form::close() !!}
    

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif  



                </div>
            </div>
        </div>
    </div>
</div>



@stop
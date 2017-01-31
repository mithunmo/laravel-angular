@extends("layouts.app")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Product</div>

                <div class="panel-body">
                    

    {!! Form::open(['url' => '/products']) !!}
    <div class="form-group">

    {!! Form::label("name", "Name") !!}
    {!! Form::text("name",null,["class" => "form-control"]) !!}
    </div> 
    <div class="form-group">
    {!! Form::label("name", "Price") !!}
    {!! Form::text("price",null,["class" => "form-control"]) !!}
    </div>
     <div class="form-group">
    {!! Form::label("name", "Quantity") !!}
    {!! Form::text("quantity",null,["class" => "form-control"]) !!}
    </div>
     <div class="form-group">
    {!! Form::label("name", "Company") !!}
    {!! Form::text("company",null,["class" => "form-control"]) !!}  
    </div>

     <div class="form-group">
    {!! Form::label("imgurl", "Image URL") !!}
    {!! Form::text("imgurl",null,["class" => "form-control"]) !!}  
    </div>
    
     <div class="form-group">
    {!! Form::submit("Save Product",null,["class" => "btn btn-primary form-control"]) !!}
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

@endsection
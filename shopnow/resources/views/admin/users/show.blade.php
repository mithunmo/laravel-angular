@extends("layouts.app")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit a User</div>

                <div class="panel-body">
                    

    {!! Form::open(['url' => '/users/'.$user->id]) !!}
    <div class="form-group">

    {!! Form::label("name", "Name") !!}
    {!! Form::text("name",$user->name,["class" => "form-control"]) !!}

    </div> <div class="form-group">
    {!! Form::label("name", "Email") !!}
    {!! Form::text("email",$user->email,["class" => "form-control"]) !!}
    </div> 
    
     <div class="form-group">
    {!! Form::submit("Save User",null,["class" => "btn btn-primary form-control"]) !!}
            <input type="submit" name="delete" value="Delete User">
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
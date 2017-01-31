@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List of Users</div>

                <div class="panel-body">
@foreach( $users as $user)
    <article>
       <h2>
        <a href="/users/{{ $user->id }}"> {{ $user->name }} </a>
        </h2>
        <div class="body"> {{ $user->email }} </div>
    </article>
    <hr/>
@endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




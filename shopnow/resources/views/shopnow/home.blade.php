

@extends("layouts.home")

@section("content")

<div class="container" ng-controller="ProductController">    
  <div class="row">
  
  <div class="col-sm-4" ng-repeat="x in itemList">
    <div class="panel panel-primary">
        <div class="panel-heading">@{{ x.name }}</div>
        <div class="panel-body"><img src="@{{ x.imgurl }}" class="img-responsive" style="width:100%;height:80%" alt="Image"></div>
        <div class="panel-footer"> @{{ x.company }} </div>

    </div>
  </div>
  
  </div>
</div><br><br>


@endsection
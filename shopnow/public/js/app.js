

var app = angular.module("myapp",[]);

app.service("ProductService",function($http){
    this.getData = function(){
        return $http.get("http://dev1.shop.com/items");
    }
})

app.controller("ProductController", function($scope, ProductService){
    $scope.data ="dsf";
    
    ProductService.getData().then(function(response){
        $scope.itemList = response.data;
    },function(response){
        $scope.itemList = "No prodcuts";
    });
    
});


app.controller("ProductDataController", function($scope, ProductService){
    ProductService.getData().then(function(response){
        $scope.x = response.data;
    },function(response){
        $scope.x = "No prodcuts";
    });
    
});

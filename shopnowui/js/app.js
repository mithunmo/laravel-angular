

var app = angular.module("myapp", ["ngRoute", "ngCookies"]);

app.run(function ($rootScope, $cookies, $window) {
    if ($cookies.get("cart") == undefined)
        $cookies.put("cart", "[]");
    $rootScope.url = "http://dev1.shop.com/"

});
app.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            cache: false,
            templateUrl: "main.htm"
        })
        .when("/show/:param1", {
            cache: false,
            templateUrl: "show.htm"
        })
        .when("/login", {
            cache: false,
            templateUrl: "login.htm"
        })
        .when("/cart", {
            cache: false,
            templateUrl: "cart.htm"
        })
        .when("/signup", {
            cache: false,
            templateUrl: "signup.htm"
        });
});

app.service("ProductService", function ($http) {
    this.getData = function (url) {
        return $http.get(url);
    }
});


app.service("AppService", function ($http,$window) {
    var value = 0;
    var login = true;

    this.setCurrentUser = function (val) {
        login = val;
    };
    this.getCurrentUser = function (val) {
        return login;
    }

    this.set = function (val) {
        value = val;
    };
    this.get = function (val) {
        return value;
    }

    this.logout = function () {
        $window.sessionStorage.setItem("login", "true");        
    }

});


app.controller("CartController", function ($scope, AppService, $cookies, $rootScope, $window) {
    if ($window.sessionStorage.getItem("login") == "true") {
        $scope.login = true;
    } else if ($window.sessionStorage.getItem("login") == "false") {
        $scope.login = false;
    } else {
        $scope.login = true;
    }

    $scope.logout = function () {
        AppService.logout();
        AppService.setCurrentUser(true);
    }

    $scope.cart = JSON.parse($cookies.get("cart")).length;
    $scope.$watch(function () {
        return AppService.get();
    }, function (newValue, oldValue) {
        if (newValue !== oldValue)
            $scope.cart = newValue;
    });

    $scope.$watch(function () {
        return AppService.getCurrentUser();
    }, function (newValue, oldValue) {
        if (newValue !== oldValue)
            $scope.login = newValue;
    });

});

app.controller("CartListController", function ($scope, AppService, ProductService, $cookies, $rootScope) {
    var arr = JSON.parse($cookies.get("cart"));
    $scope.itemList = [];
    for (let i of arr) {
        ProductService.getData($rootScope.url + "items/" + i).then(function (response) {
            $scope.itemList.push(response.data);
            console.log(response.data);
        }, function (response) {
            $scope.itemList.push({});
        });

    }

    $scope.RemoveCart = function (id) {
        var json_str = $cookies.get('cart');
        console.log(json_str);
        var arr = JSON.parse(json_str);
        var index = arr.indexOf(id.toString());
        if (index > -1) {
            arr.splice(index, 1);
            var json_str = JSON.stringify(arr);
            $cookies.put('cart', json_str);
            AppService.set(arr.length);
            console.log($scope.itemList);
            for (i = 0; i < $scope.itemList.length; i++) {
                if (id == ($scope.itemList[i]["id"])) {
                    $scope.itemList.splice(i, 1);
                }

            }
        }
    }
});


app.controller("ProductController", function ($scope, ProductService) {
    ProductService.getData("http://dev1.shop.com/items").then(function (response) {
        $scope.itemList = response.data;
    }, function (response) {
        $scope.itemList = "No products";
    });

});

app.controller("ProductDataController", function ($scope, ProductService, $routeParams, $templateCache, AppService, $cookies) {
    $templateCache.removeAll();
    ProductService.getData("http://dev1.shop.com/items/" + $routeParams.param1).then(function (response) {
        $scope.item = response.data;
    }, function (response) {
        $scope.item = false;
    });

    $scope.addToCart = function (id) {
        var json_str = $cookies.get('cart');
        console.log(json_str);
        var arr = JSON.parse(json_str);
        if (arr.indexOf($routeParams.param1) > -1) {
            console.log("exists");
        } else {
            arr.push($routeParams.param1);
            console.log("does not exist");
        }
        var json_str = JSON.stringify(arr);
        $cookies.put('cart', json_str);
        AppService.set(arr.length);
    }

});

app.controller("SignupController", function ($scope, $http, $rootScope, $window, AppService) {
    $scope.name = "";
    $scope.password = "";
    $scope.email = "";
    $scope.password_confirm = "";
    $scope.error = false;

    $scope.signup = function () {
        $http.post($rootScope.url + "signup",
            {
                "name": $scope.name, "email": $scope.email, "password": $scope.password,
                "password_confirmation": $scope.password_confirm
            },
            { headers: { 'Content-Type': 'application/json' } })
            .then(function (response) {

                if (response.data == "True") {
                    $window.location.href = '/#/login';
                } else {
                    $scope.error = true;
                }
            }, function (response) {

            });

    }

    $scope.login = function () {

        $http.post($rootScope.url + "profile",
            { "email": $scope.email, "password": $scope.password },
            { headers: { 'Content-Type': 'application/json' } })
            .then(function (response) {

                if (response.data == "True") {
                    $window.location.href = '/#/';
                    $window.sessionStorage.setItem("login", "false");
                    AppService.setCurrentUser(false);
                } else {
                    $scope.error = true;
                }
            }, function (response) {

            });

    }


});
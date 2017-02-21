(function(){
    var app = angular.module('app', []);


    app.controller('MainCtrl', function($http,$window) {
        var that = this;


        this.newProduct = {};

        this.products = {};
        this.categories = {};
        $http({
            method: 'get',
            url: '/product'
        }).then(function successCallback(response) {

            if(response.data.success == true){
                that.products=response.data.data.products;
                that.categories=response.data.data.categories;
            }
        }, function errorCallback(response) {

        });


        this.createProduct = function () {
            $http({
                method: 'post',
                url: '/product',
                data: that.newProduct
            }).then(function successCallback(response) {
                if(response.data.success == true){
                    that.products.push(response.data.data);
                }
            }, function errorCallback(response) {
            });
        };



        this.editArray = {};
        this.isEdited = function (id) {
            if (id in that.editArray){
                return true;
            }else{
                return false;
            }
        };


        this.edit = function (product) {
            that.editArray[product.id] = product;
        };

        this.delete = function (id) {
            $http({
                method: 'delete',
                url: '/product/'+id
            }).then(function successCallback(response) {
                if(response.data.success == true){
                    var index = that.products.indexOf(id);
                    that.products.splice(index,1);
                }
            }, function errorCallback(response) {
            });
        };

        this.cancel = function (id) {
            delete that.editArray[id];
        };


        this.update = function (id) {
            $http({
                method: 'post',
                url: '/product/'+id,
                data: that.editArray[id]
            }).then(function successCallback(response) {
                if(response.data.success == true){
                    var index = that.products.indexOf(id);
                    that.products[index] = that.editArray[id];
                    delete that.editArray[id];
                }
            }, function errorCallback(response) {
            });
        };






    });
})();
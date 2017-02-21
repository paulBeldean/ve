<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet" type="text/css">


</head>
<body ng-app="app">
<div ng-controller="MainCtrl as main" class="container">
    <h4>Product CRUD</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="product in main.products track by product.id">
                <td>@{{ product.id }}</td>
                <td ng-hide="main.isEdited(product.id)">@{{ product.category.category }}</td>
                <td ng-hide="main.isEdited(product.id)">@{{ product.product_name }}</td>
                <td ng-hide="main.isEdited(product.id)">@{{ product.product_price }}</td>
                <td ng-hide="main.isEdited(product.id)">@{{ product.updated_at }}</td>

                <td ng-show="main.isEdited(product.id)">
                    <select
                            ng-model="main.editArray[product.id].category_id"
                            ng-options="category.id as category.category for category in main.categories"
                            class="form-control"
                    >
                    </select>
                </td>
                <td ng-show="main.isEdited(product.id)">
                    <input type="text" ng-model="main.editArray[product.id].product_name" class="form-control">
                </td>
                <td ng-show="main.isEdited(product.id)">
                    <input type="text" ng-model="main.editArray[product.id].product_price" class="form-control">
                </td>
                <td ng-show="main.isEdited(product.id)"></td>
                <td>
                    <div class="form-group">
                        <button class="btn btn-success" ng-click="main.edit(product)" ng-hide="main.isEdited(product.id)">Edit</button>
                        <button class="btn btn-danger" ng-click="main.delete(product.id)" ng-hide="main.isEdited(product.id)">Delete</button>
                        <button class="btn btn-default" ng-click="main.cancel(product.id)" ng-show="main.isEdited(product.id)">Cancel</button>
                        <button class="btn btn-success" ng-click="main.update(product.id)" ng-show="main.isEdited(product.id)">Update</button>
                    </div>
                </td>
            </tr>



            {{--new product row--}}
            <tr>
                <td>
                    <div class="form-control-static"><label> New product</label></div>
                </td>
                <td>
                    <div class="form-group">
                        <select
                                ng-model="main.newProduct.category_id"
                                ng-options="category.id as category.category for category in main.categories track by category.id"
                                class="form-control"
                        >
                            <option value="">Select category</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" ng-model="main.newProduct.product_name" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" ng-model="main.newProduct.product_price" class="form-control">
                    </div>
                </td>
                <td colspan="2">
                    <div class="form-group">
                        <button class="btn btn-success" ng-click="main.createProduct()">Create</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script src="{{ url('/js/angular.min.js') }}"></script>
<script src="{{ url('/js/app.js') }}"></script>

</body>
</html>

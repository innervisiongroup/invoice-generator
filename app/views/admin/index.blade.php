@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Invoices Management
            <small>
                <a href="#ModalAddInvoice" data-toggle="modal">Add new template</a>
            </small>
        </h1>
    </div>
</div>

<div ng-app="Invoices">
    <div class="row" ng-controller="InvoicesController">
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" placeholder="Search by Title or Category" class="form-control" ng-model="searchTitle">
            </div><br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="TablePost">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="invoice in invoices | filter:searchTitle">
                            <td>
                                <a href="/admin/invoice/@{{ invoice.id }}">
                                    @{{ invoice.title }}
                                </a>
                            </td>
                            <td>
                                @{{ invoice.category.name }}
                            </td>
                            <td>
                                @{{ invoice.created_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default" >
                <div class="modal fade" id="ModalAddInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form ng-submit="addInvoice()">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add new Invoice Template</h4>
                                </div>
                                <div class="modal-body">
                                    {{ Form::label('title', 'Title') }}
                                    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Invoice\'s Title', 'ng-model'=>'newInvoiceTitle']) }}
                                    {{ Form::label('category_id', 'Category') }}
                                    <select name="category_id" id="category_id" class="form-control" ng-model="selectedCategory" ng-options="category.name for category in categories">
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Categories
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="category in categories">
                            @{{ category.name }}
                            <span class="pull-right text-muted small">
                                <span ng-click="delete(category)"><i class="fa fa-trash"></i></span>
                            </span>
                        </li>
                    </ul>
                    <form ng-submit="addCategory()">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" ng-model="newCategoryText" placeholder="Add new category">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
        var app = angular.module("Invoices", [])

        app.controller("InvoicesController", function($scope, $http) {
            $http.get('/admin/api/invoice').success(function(invoices) {
                $scope.invoices = invoices;
            });

            $http.get('/admin/api/category').success(function(categories) {
                $scope.categories = categories;
            });

            $scope.addInvoice = function() {
                var invoice = {
                    title: $scope.newInvoiceTitle,
                    category_id: $scope.selectedCategory.id,
                };
                $http.post('/admin/api/invoice', invoice);
                $http.get('/admin/api/invoice').success(function(invoices) {
                    $scope.invoices = invoices;
                });
                $scope.newInvoiceTitle = null;
                $scope.selectedCategory = null;
            };

            $scope.addCategory = function() {
                var category = {
                    name: $scope.newCategoryText,
                };
                $http.post('/admin/api/category', category);
                $scope.categories.push(category);
                $scope.newCategoryText = null;
            };

            $scope.delete = function(category) {
                var index = $scope.categories.indexOf(category);
                $scope.categories.splice(index, 1);
                $http.post('/admin/api/category/delete', category);
            }
        });
    </script>
@stop
@extends('layout.admin')

@section('styles')
    <style>
        input[name=title]{
            border: 0px;
            outline: none;
            width: 100%;
        }
        .draggable{
            cursor: ns-resize;
        }
    </style>
@stop

@section('content')

@if ($errors->has())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@if (Session::has('flash_message'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{ Session::get('flash_message') }}
            </div>
        </div>
    </div>
@endif

{{ Form::model($invoice, ['url'=>'admin/invoice/'.$invoice->id, 'files'=>true]) }}
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ Form::text('title', null, ['placeholder'=>'Title']) }}
        </h1>
    </div>
    <div class="col-lg-3 pull-right">
        <div class="well">
            <div class="form-group">
                {{ Form::label('image', 'Image') }}
                <div class="fileUpload">
                    {{ Form::file('image', ['class'=>'upload']) }}
                    <img src="{{ $invoice->image }}" alt="">
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
            </div>
        </div>
    </div>
{{ Form::close() }}

<div class="col-lg-9 pull-left" ng-app="InvoicesOptions">
    <div class="row" ng-controller="InvoicesOptionsController">
        <div class="col-md-12">
            <div class="row">
                <div ui-sortable="sortableOptions" ng-model="options" class="col-md-12">
                    <div class="row" ng-repeat="option in options">
                        <div class="col-md-12 draggable">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Type :</strong> @{{ option.type }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Name / Title :</strong> @{{ option.title }}
                                    </div>
                                    <div class="col-md-4" ng-hide="!option.price">
                                        <strong>Default Price :</strong> @{{ option.price }} €
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form ng-submit="addOption()" class="form-inline">
                        <div class="form-group">
                            <label class="sr-only">Title</label>
                            <input ng-model="newOptionTitle" type="text" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Type</label>
                            <select ng-model="newOptionType" class="form-control" required>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio Buttons</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input ng-model="newOptionPrice" type="number" class="form-control" placeholder="Default Price (optionnal)">
                                <div class="input-group-addon"><i class="fa fa-euro"></i></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Add Option</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script>
    var app = angular.module("InvoicesOptions", ['ui'])

    app.controller("InvoicesOptionsController", function($scope, $http) {
        $http.get('/admin/api/invoice/{{$invoice->id}}/options').success(function(options) {
            $scope.options = options;
        });

        $scope.addOption = function() {
            var option = {
                title: $scope.newOptionTitle,
                type: $scope.newOptionType,
                price: $scope.newOptionPrice,
            };
            $http.post('/admin/api/invoice/{{$invoice->id}}/options', option);
            $scope.options.push(option);

            $scope.newOptionTitle = null;
            $scope.newOptionType = null;
            $scope.newOptionPrice = null;
        };

        $scope.sortableOptions = {
            axis: 'y'
        };

    });

    angular.bootstrap(document, ['InvoicesOptions']);
</script>
@stop
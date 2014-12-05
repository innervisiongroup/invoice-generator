@extends('layout.admin')

@section('styles')
    <style>
        input[name=title]{
            border: 0px;
            outline: none;
            width: 100%;
        }
        .handle{
            cursor: ns-resize;
        }
        .fa-trash{
            margin-top: 7px;
            cursor: pointer;
        }
        .form-inline{
            margin-bottom: 20px;
        }
        .edit{
            display: none;
        }
        .editing .view{
            display: none;
        }
        .editing .edit{
            display: inline-block;
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
                <div class="col-md-12">
                    <form ng-submit="addOption()" class="form-inline" name="addOptionForm">
                        <div class="form-group">
                            <label class="sr-only">Title</label>
                            <input ng-model="newOptionTitle" type="text" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Type</label>
                            <select ng-model="newOptionType" class="form-control" required ng-options="method.value as method.name for method in methods">
                            <option value="">Select Input Type</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input ng-model="newOptionPrice" type="number" class="form-control" placeholder="Default Price (optionnal)">
                                <div class="input-group-addon"><i class="fa fa-euro"></i></div>
                            </div>
                        </div>
                        <button type="submit" ng-disabled="!addOptionForm.$valid" class="btn btn-default">Add Option</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div ui-sortable="sortableOptions" ng-model="options" class="col-md-12 list">
                    <div class="row line" ng-repeat="option in options" ng-dblclick="toggleEditMode()" option-id="@{{ option.id }}">
                        <div class="col-md-12 draggable">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-md-1 handle">
                                                <i class="fa fa-arrows-v"></i>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="view">
                                                    <strong>Title :</strong> @{{ option.title }}
                                                </div>
                                                <form class="edit" ng-submit="updateOption(option)">
                                                    <input class="form-control" type="text" ng-model="option.title"/>
                                                </form>
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Type :</strong> @{{ option.type }}
                                            </div>
                                            <div class="col-md-3" ng-hide="!option.price">
                                                <strong>Default Price :</strong> @{{ option.price }} €
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <span ng-click="delete(option)"><i class="fa fa-trash fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
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

        $scope.methods = [{name:'Checkbox', value:'checkbox'}, {name:'Radio Button', value:'radio'}];

        $scope.addOption = function() {
            var option = {
                title: $scope.newOptionTitle,
                type: $scope.newOptionType,
                price: $scope.newOptionPrice,
            };

            $http.post('/admin/api/invoice/{{$invoice->id}}/options', option).success(function (data, status, headers) {
                $scope.options.push(data);
            });

            $scope.newOptionTitle = null;
            $scope.newOptionType = null;
            $scope.newOptionPrice = null;
        };

        $scope.toggleEditMode = function(){
            $(event.target).closest('.col-md-6').toggleClass('editing');
            $(event.target).find('input').focus();
        };
        $scope.updateOption = function(option){
            $scope.toggleEditMode();
            $http.post('/admin/api/invoice/{{$invoice->id}}/options/update', option);
        };

        $scope.delete = function(option) {
            var index = $scope.options.indexOf(option);
            $scope.options.splice(index, 1);
            $http.post('/admin/api/option/delete', option);
        }

        $scope.sortableOptions = {
            axis: 'y',
            handle: '.handle',
            update: function(e, ui) {
                var i = 0;
                $('.list .line').each(function(index, el) {
                    $(this).attr('weight', i++);
                    var weight = $(this).attr('weight');
                    var optionid = $(this).attr('option-id');
                    var option = {
                        weight: $(this).attr('weight'),
                        id: $(this).attr('option-id'),
                    };
                    $http.post('/admin/api/option/weight', option);
                });
            },
        };
    });
</script>
@stop
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Manager functions</div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>Categories</h4>
                                @include('home.grandcategories.index', ['grandcategories' => Grandcategory::all()])
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3 text-center"><a href="{{URL::route('grandcategories.create')}}" class="btn btn-primary">Create new category</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>Subcategories</h4>
                                @include('home.categories.index', ['categories' => Category::all()])
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3 text-center"><a href="{{URL::route('categories.create')}}" class="btn btn-primary">Create new subcategory</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>Products</h4>
                                @include('home.products.index', ['products' => Product::all()])
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3 text-center"><a href="{{URL::route('products.create')}}" class="btn btn-primary">Create new product</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
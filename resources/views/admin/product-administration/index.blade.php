@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product
            <small>Administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <form action="{{ route('admin.product.search') }}" method="get">
                    <h3>Filter</h3>
                    <div class="form-group">
                        <input type="text" name="content" class="form-control"
                               @if(isset($filterParams)) value="{{ old('content', $filterParams['content']) }}"
                               @endif placeholder="Name.. or ID..">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost </label>
                        <input type="number" name="costMin" class="form-control"
                               @if(isset($filterParams)) value="{{ old('costMin', $filterParams['costMin']) }}"
                               @endif placeholder="Min..">
                        @if ($errors->has('costMin'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('costMin') }}</strong>
                        </span>
                        @endif
                        <input type="number" name="costMax" class="form-control"
                               @if(isset($filterParams)) value="{{ old('costMax', $filterParams['costMax']) }}"
                               @endif placeholder="Max..">
                        @if ($errors->has('costMax'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('costMax') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Choose..</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if(isset($filterParams))
                                        @if($category->id == $filterParams['category'])
                                        selected
                                        @endif
                                        @endif>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>

            </div>
            <div class="col-md-10">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Sold</th>
                        <th></th>
                    </tr>
                    </thead>
                    <body>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <a href="{{ route('admin.product-administration.show', $product->id) }}">{{ $product->name }}</a>
                            </td>
                            <td><img src="{{ Storage::url($product->image) }}" alt=""></td>
                            <td>{{ $product->category['name'] }}</td>
                            <td>{{ nl2br($product->description) }}</td>
                            <td class="text-center">{{ $product->cost }}</td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <td class="text-center">{{ $product->sold }}</td>
                            <td class="text-center">
                                {{Form::open(['method' => 'DELETE', 'route' => ['admin.product-administration.destroy', $product->id]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </body>
                </table>
                <div class="text-right">
                    {{ $products->appends([
                    'content'=>(isset($filterParams)) ?$filterParams['content']:'',
                    'costMin'=> (isset($filterParams))?old('costMin', $filterParams['costMin']):'',
                    'costMax'=> (isset($filterParams))?old('costMax', $filterParams['costMax']):'',
                    'category'=> (isset($filterParams))?old('category', $filterParams['category']):''
                    ])->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
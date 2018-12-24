@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Product
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <form action="{{ route('home.search.filter') }}" method="get">
                    <h3>Filter</h3>
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
                <?php $col_id=1;?>
                @foreach($products as $product)

                    <?php if($col_id%4==1){

                        echo '<div class="row">';
                        }?>
                    <form action="{{ route('cart.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-3 text-center">
                            <div class="product-image">
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ Storage::url($product->image) }}" alt="">
                                </a>
                            </div>
                            <div class="product-content">
                                <p>
                                    {{ $product->name }}
                                </p>
                                <p>
                                    Giá tiền: {{ $product->cost }}$
                                </p>
                                <p>
                                    Tình trạng: {{ $product->quantity-$product->sold == 0? 'Hết hàng' : 'Còn hàng' }}
                                </p>
                                <input type="hidden" value="{{$product->id}}" name="id">
                                <input type="hidden" value="{{$product->id}}" name="product[{{$product->id}}][id]">
                                <input type="hidden" value="{{$product->name}}" name="product[{{$product->id}}][name]">
                                <input type="hidden" value="{{$product->cost}}" name="product[{{$product->id}}][cost]">
                                <input type="hidden" value={{ 1 }} name="product[{{$product->id}}][quantity]">

                            </div>
                            <div class="product-footer">
                                <button class="btn btn-primary  {{ ($product->quantity-$product->sold) == 0 ? 'hidden' :'' }}"
                                        type="submit">Add to cart
                                </button>
                            </div>
                        </div>
                    </form>

                        <?php if($col_id%4==0){

                            echo '</div>';
                        }?>
                        <?php $col_id+=1;?>
                @endforeach

            </div>
        </div>
        <div class="text-right">
            {{ $products->appends(['costMin'=> (isset($filterParams))?old('costMin', $filterParams['costMin']):'',
                                    'costMax'=> (isset($filterParams))?old('costMax', $filterParams['costMax']):'',
                                    'category'=> (isset($filterParams))?old('category', $filterParams['category']):''
                                    ])->links() }}
        </div>
    </section>
    <!-- /.content -->
@endsection
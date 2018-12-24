@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Product Detail
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    {{--<section class="content">--}}
        <div class="row">

            <div class="col-md-12">
                <form action="{{ route('cart.store') }}" method="post">
                {{ csrf_field() }}
                <!-- Product Image -->

                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="col-md-6">

                                <div class="form-group text-center">
                                    <img src="{{ Storage::url($product->image) }}" style="width:90%" alt="Product image">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="name">Product's name</label>
                                    <p>{{ $product->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <p>{{ $product->category['name'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="cost">Cost:</label>
                                    <p >{{ $product->cost }}</p>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="description"><i
                                                    class="fa  margin-r-5"></i>Description:</label>

                                    </div>
                                    <p name="description" cols="83" readonly
                                              rows="10">{{ nl2br($product->description) }}</p>

                                    <!-- /.input group -->
                                    <input type="hidden" value="{{$product->id}}" name="id">
                                    <input type="hidden" value="{{$product->id}}" name="product[{{$product->id}}][id]">
                                    <input type="hidden" value="{{$product->name}}" name="product[{{$product->id}}][name]">
                                    <input type="hidden" value="{{$product->cost}}" name="product[{{$product->id}}][cost]">
                                    <input type="hidden" value={{ 1 }} name="product[{{$product->id}}][quantity]">
                                </div>
                                <div>
                                    <div class="text-center">
                                        <button class="btn btn-primary  {{ ($product->quantity-$product->sold) == 0 ? 'hidden' :'' }}"
                                                type="submit">Add to cart
                                        </button>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                </form>


            </div>

        </div>


        <!-- /.row -->

    {{--</section>--}}

@endsection
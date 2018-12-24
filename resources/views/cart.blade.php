@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Giỏ hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">My cart</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @if($status == true)
            @php
                $total=0;
            @endphp
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Giá tiền($)</th>
                    <th class="text-center">Tổng tiền($)</th>
                    <th></th>
                </tr>
                </thead>
                <body>
                @foreach($products as $key => $value)
                    @php
                        $amount = $value['quantity'] * $value['cost'];
                        $total = $total + $amount;
                    @endphp
                    <tr>
                        {{Form::open(['method' => 'put', 'route' => ['cart.update']]) }}
                        <input type="hidden" name="id" value="{{$key}}">
                        <td>
                            <input type="hidden" class="form-control" value="{{ $value['id'] }}"
                                   name="product[{{$key}}][id]">
                            {{ $value['id'] }}</td>
                        <td class="text-center"><a href="#">{{ $value['name'] }}</a>
                            <input type="hidden" class="form-control" value="{{ $value['name'] }}"
                                   name="product[{{$key}}][name]">
                        </td>
                        <td class="text-center form-group">
                            <div>
                                <input type="number" id="quantity" name="product[{{$key}}][quantity]"
                                       value="{{ old('product.'.$key.'.quantity', $value['quantity']) }}">
                            </div>
                            <div>
                                @if ($errors->has('product.'.$key.'.quantity'))
                                    <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('product.'.$key.'.quantity') }}</strong>
                        </span>
                                @endif
                            </div>

                        </td>
                        <td class="text-center">
                            <p class="cost">{{ $value['cost'] }} </p>
                            <input type="hidden" class="form-control" value="{{ $value['cost'] }}"
                                   name="product[{{$key}}][cost]">
                        </td>
                        <td class="text-center">
                            <p class="amount">{{ $amount }}</p>
                        </td>
                        <td class="text-center">
                            {{ Form::submit('Cập nhật', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                        <td class="text-center">
                            {{Form::open(['method' => 'DELETE', 'route' => ['cart.destroy']]) }}
                            <input type="hidden" name="id" value="{{$key}}">
                            {{ Form::submit('Xóa', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">Tổng tiền:</td>
                    <td>
                        <p class="total text-center">{{ $total }}</p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pay') }}" class="btn btn-success">Thanh toán</a>
                    </td>
                </tr>
                </body>
            </table>

        @else
            <p>Giỏ hàng của bạn trống</p>
        @endif
    </section>
@endsection
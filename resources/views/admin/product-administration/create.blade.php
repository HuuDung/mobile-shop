@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Create Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Create Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.product-administration.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- Product Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="form-group text-center">
                                <input type="file" name="image" class="form-control col-3">
                            </div>
                            <div class="form-group">
                                <label for="name">Product's name</label>
                                <input class="form-control text-left" type="text" name="name"
                                       placeholder="Name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control ">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="system">System:</label>
                                <select name="system" class="form-control ">
                                    @foreach($systems as $system)
                                        <option value="{{ $system->id }}">{{ $system->system }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="screen-size">Screen size("):</label>
                                <input type="text" class="form-control text-left" name="screenSize"
                                       value="{{ old('screenSize') }}" placeholder="Screen size.." required>
                            </div>
                            <div class="form-group">
                                <label for="cpu">CPU:</label>
                                <select name="cpu" class="form-control ">
                                    @foreach($cpus as $cpu)
                                        <option value="{{ $cpu->id }}">{{ $cpu->cpu }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ram">Ram:</label>
                                <select name="ram" class="form-control ">
                                    @foreach($rams as $ram)
                                        <option value="{{ $ram->id }}">{{ $ram->ram }} Gb</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="storage">Storage:</label>
                                <select name="storage" class="form-control ">
                                    @foreach($storages as $storage)
                                        <option value="{{ $storage->id }}">{{ $storage->storage }} Gb</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight(g):</label>
                                <input type="text" class="form-control text-left" name="weight"
                                       value="{{ old('weight') }}" placeholder="Weight.." required>
                            </div>
                            <div class="form-group">
                                <label for="cosr">Cost:</label>
                                <input type="number" class="form-control text-left" name="cost"
                                       value="{{ old('cost') }}" required>
                                @if ($errors->has('cost'))
                                    <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('cost') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control text-left" name="quantity"
                                       value="{{ old('quantity') }}" required>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="description"><i
                                                class="fa fa-map-marker margin-r-5"></i>Description:</label>

                                </div>
                                <textarea name="description" rows="10"
                                          class="form-control rounded-0">{{ old('description') }}</textarea>

                                <!-- /.input group -->
                            </div>
                            <div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <!-- /.row -->
        </form>

    </section>
@endsection
@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Create System
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Create System</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.specificate.system.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- Product Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="form-group">
                                <label for="system">System</label>
                                <input class="form-control text-left" type="text" name="system"
                                       placeholder="System.." value="{{ old('system') }}" required>
                                @if ($errors->has('system'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('system') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Tạo</button>
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
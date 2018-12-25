@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Edit Cpu
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Edit Cpu</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3"></div>
            <form action="{{ route('admin.specificate.cpu.update', $cpu->id) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="col-md-6">
                    <!-- Product Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="form-group">
                                <label for="cpu">CPU</label>
                                <input class="form-control text-left" type="text" name="cpu"
                                       value="{{ $cpu->cpu }}"
                                       placeholder="Cpu.." required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('admin.specificate.cpu.show', $cpu->id) }}" class="btn btn-primary">Trở
                                    lại</a>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        </form>

        <div class="col-md-3"></div>
        </div>
        <!-- /.row -->

    </section>
@endsection
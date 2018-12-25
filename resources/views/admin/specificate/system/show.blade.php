@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Show System
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Show System</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- Product Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="form-group">
                            <label for="system">System</label>
                            <input class="form-control text-left" type="text" name="system" value="{{ $system->system }}"
                                   placeholder="System.." readonly>
                        </div>
                        <div>
                            <div class="text-center">
                                <a href="{{ route('admin.specificate.system.edit', $system->id) }}"
                                   class="btn btn-primary">Edit</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- /.row -->

    </section>
@endsection
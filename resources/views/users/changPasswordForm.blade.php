@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Change Password
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change password</li>
        </ol>
    </section>
    @if (session()->has('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <form action="{{route('password.update')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="form-group">
                                <input type="password" class="form-control" name="old_password"
                                       placeholder="Old password..." required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password"
                                       placeholder="New password..." required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="Confirm password..." required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
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
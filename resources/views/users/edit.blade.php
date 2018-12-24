@extends('layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Sửa thông tin người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PATCH">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="form-group">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{ Storage::url($user->avatar) }}"
                                     alt="User profile picture">
                            </div>
                            <div class="form-group text-center">
                                <input type="file" name="avatar" class="form-control col-3">
                            </div>
                            <div class="form-group">
                                <input class="form-control text-right" type="text" name="name"
                                       value="{{ $user->name }}"
                                       placeholder="Name">
                            </div>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Emails</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Hạng</b> <a class="pull-right">
                                        @if(Auth::user()->level == \App\User::NORMAL) {{ "Normal" }}
                                        @elseif(Auth::user()->level == \App\User::GOLD) {{ "GOLD" }}
                                        @elseif (Auth::user()->level == \App\User::DIAMOND) {{ "DIAMOND" }}
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số đơn hàng:</b> <a class="pull-right">{{ Auth::user()->order }}</a>
                                </li>
                            </ul>
                            <div class="form-group">
                                <label for="gender">Giới tính:</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="{{ \App\User::MALE }}"
                                            @if($user->gender == \App\User::MALE) selected @endif>Male
                                    </option>
                                    <option value="{{ \App\User::FERMALE }}"
                                            @if($user->gender == \App\User::FERMALE) selected @endif>Fermale
                                    </option>
                                    <option value="{{ \App\User::ORTHER }}"
                                            @if($user->gender == \App\User::ORTHER) selected @endif>Orther
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bỉthday"><i class="fa fa-calendar margin-r-5"></i>Ngày sinh:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="birthday" id="datepicker"
                                           value="{{ $user->birthday }}">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="location"><i class="fa fa-map-marker margin-r-5"></i>Địa chỉ:</label>
                                <input type="text" class="form-control pull-right" name="location"
                                       value="{{ $user->location }}"
                                       placeholder="Location">
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-file-text-o margin-r-5"></i>Ghi chú:</label>
                                <input type="text" class="form-control pull-right" name="notes"
                                       value="{{ $user->notes }}"
                                       placeholder="Notes">
                                <!-- /.input group -->
                            </div>
                            <div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                    <a href="{{ route('user.index') }}"
                                       class="btn btn-primary ">Hủy</a>
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

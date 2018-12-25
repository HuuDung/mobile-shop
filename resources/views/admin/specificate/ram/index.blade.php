@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ram
            <small>Administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Ram</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">Ram</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <body>
            @foreach($rams as $ram)
                <tr>
                    <td>{{ $ram->id }}</td>
                    <td class="text-center">
                        <a href="{{ $ram->deleted_at == null ? route('admin.specificate.ram.show', $ram->id): "#" }}">{{ $ram->ram }} Gb</a>
                    </td>
                    @if($ram->deleted_at == null)
                        <td class="text-center">
                            {{Form::open(['method' => 'DELETE', 'route' => ['admin.specificate.ram.destroy', $ram->id]]) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    @else
                        <td class="text-center">
                            {{Form::open(['method' => 'POST', 'route' => ['admin.specificate.ram.restore', $ram->id]]) }}
                            {{ Form::submit('Restore', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                    @endif
                </tr>
            @endforeach
            </body>
        </table>
        <div class="text-right">
            {{ $rams->links() }}
        </div>
    </section>
    <!-- /.content -->
@endsection
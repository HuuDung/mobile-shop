@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Storage
            <small>Administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Storage</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">Storage</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <body>
            @foreach($storages as $storage)
                <tr>
                    <td>{{ $storage->id }}</td>
                    <td class="text-center">
                        <a href="{{ $storage->deleted_at == null ? route('admin.specificate.storage.show', $storage->id): "#" }}">{{ $storage->storage }} Gb</a>
                    </td>
                    @if($storage->deleted_at == null)
                        <td class="text-center">
                            {{Form::open(['method' => 'DELETE', 'route' => ['admin.specificate.storage.destroy', $storage->id]]) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    @else
                        <td class="text-center">
                            {{Form::open(['method' => 'POST', 'route' => ['admin.specificate.storage.restore', $storage->id]]) }}
                            {{ Form::submit('Restore', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                    @endif
                </tr>
            @endforeach
            </body>
        </table>
        <div class="text-right">
            {{ $storages->links() }}
        </div>
    </section>
    <!-- /.content -->
@endsection
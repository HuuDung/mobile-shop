@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            System
            <small>Administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">System</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">System</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <body>
            @foreach($systems as $system)
                <tr>
                    <td>{{ $system->id }}</td>
                    <td class="text-center">
                        <a href="{{ $system->deleted_at == null ? route('admin.specificate.system.show', $system->id): "#" }}">{{ $system->system }}</a>
                    </td>
                    @if($system->deleted_at == null)
                        <td class="text-center">
                            {{Form::open(['method' => 'DELETE', 'route' => ['admin.specificate.system.destroy', $system->id]]) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    @else
                        <td class="text-center">
                            {{Form::open(['method' => 'POST', 'route' => ['admin.specificate.system.restore', $system->id]]) }}
                            {{ Form::submit('Restore', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                    @endif
                </tr>
            @endforeach
            </body>
        </table>
        <div class="text-right">
            {{ $systems->links() }}
        </div>
    </section>
    <!-- /.content -->
@endsection
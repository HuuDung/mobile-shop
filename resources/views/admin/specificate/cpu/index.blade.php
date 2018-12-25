@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CPU
            <small>Administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">CPU</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">CPU</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <body>
            @foreach($cpus as $cpu)
                <tr>
                    <td>{{ $cpu->id }}</td>
                    <td class="text-center">
                        <a href="{{ $cpu->deleted_at == null ? route('admin.specificate.cpu.show', $cpu->id): "#" }}">{{ $cpu->cpu }}</a>
                    </td>
                    @if($cpu->deleted_at == null)
                        <td class="text-center">
                            {{Form::open(['method' => 'DELETE', 'route' => ['admin.specificate.cpu.destroy', $cpu->id]]) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    @else
                        <td class="text-center">
                            {{Form::open(['method' => 'POST', 'route' => ['admin.specificate.cpu.restore', $cpu->id]]) }}
                            {{ Form::submit('Restore', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                    @endif
                </tr>
            @endforeach
            </body>
        </table>
        <div class="text-right">
            {{ $cpus->links() }}
        </div>
    </section>
    <!-- /.content -->
@endsection
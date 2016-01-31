@extends('laradmin::layout')
@section('title', 'Permission Management')
@section('title_extra', 'Add / edit / delete permissions')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Permissions
                    </h3>
                    <div class="box-tools">
                        <div class="btn-group">
                            <a href="{{ route('laradmin.permissions.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create new permission</a>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>
                                    <a href="{{ route('laradmin.permissions.edit', $permission->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('laradmin.permissions.delete', $permission->id) }}" class="btn btn-danger delete-it"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-6 col-sm-offset-6">
                        <div class="pull-right">
                            {!! $permissions->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

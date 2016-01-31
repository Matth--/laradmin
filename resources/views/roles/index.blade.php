@extends('laradmin::layout')
@section('title', 'Role Management')
@section('title_extra', 'Add / edit / delete roles')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Roles
                    </h3>
                    <div class="box-tools">
                        <div class="btn-group">
                            <a href="{{ route('laradmin.roles.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create new Role</a>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>Role Name</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('laradmin.roles.edit', $role->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('laradmin.roles.delete', $role->id) }}" class="btn btn-danger delete-it"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-6 col-sm-offset-6">
                        <div class="pull-right">
                            {!! $roles->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

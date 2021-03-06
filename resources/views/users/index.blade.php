@extends('laradmin::layout')
@section('title', 'User Management')
@section('title_extra', 'Add / edit / delete users')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Users
                </h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <a href="{{ route('laradmin.users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create new User</a>
                    </div>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Roles</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles() as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('laradmin.users.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('laradmin.users.delete', $user->id) }}" class="btn btn-danger delete-it"><i class="fa fa-close"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="pull-right">
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('laradmin::layout')
@section('title', 'Edit Role')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('laradmin.roles.update', $role_to_edit->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $role_to_edit->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ $role_to_edit->description }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Permissions</label>

                            <div class="col-md-6">
                                <select name="permissions[]" multiple class="form-control">
                                    @foreach($all_permissions as $single_permission)
                                        @if($role_to_edit->hasPermission($single_permission->name))
                                            <option selected value="{{ $single_permission->id }}">{{ $single_permission->name }}</option>
                                        @else
                                            <option value="{{ $single_permission->id }}">{{ $single_permission->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('permissions'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permissions') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-pencil"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

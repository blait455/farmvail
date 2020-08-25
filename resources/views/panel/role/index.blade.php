@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#all-users" data-toggle="tab">All roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#add-user" data-toggle="tab">Add role</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="all-users">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Roles</div>

                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Users</th>
                                                @can('edit-roles')
                                                    <th scope="col">Action</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <th scope="row">{{ $role->id }}</th>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ implode(', ', $role->users()->get()->pluck('name')->toArray()) }}</td>
                                                    <td>
                                                        @can('edit-roles')
                                                            <a href="{{ route('panel.roles.edit', $role->id) }}"><button type="button" class="btn btn-sm btn-primary float-left mr-1">Edit</button></a>
                                                        @endcan

                                                        @can('delete-roles')
                                                            <form action="{{ route('panel.roles.destroy', $role->id) }}" class="float-left" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="add-user">
                    <div class="tile user-settings">
                        <h4 class="line-head">Add role</h4>
                        <form action="{{ route('panel.roles.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Role</label>
                                    <input class="form-control" name="name" type="text">
                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

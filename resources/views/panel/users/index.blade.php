@extends('layouts.panel')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#all-users" data-toggle="tab">All users</a></li>
                <li class="nav-item"><a class="nav-link" href="#add-user" data-toggle="tab">Add user</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="all-users">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Users</div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Roles</th>
                                            @can('edit-users')
                                                <th scope="col">Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                                <td>
                                                    @can('edit-users')
                                                        <a href="{{ route('panel.users.edit', $user->id) }}"><button type="button" class="btn btn-sm btn-primary float-left mr-1">Edit</button></a>
                                                    @endcan

                                                    @can('delete-users')
                                                        <form action="{{ route('panel.users.destroy', $user) }}" class="float-left" method="POST">
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
                  <h4 class="line-head">Settings</h4>
                  <form>
                    <div class="row mb-4">
                      <div class="col-md-4">
                        <label>First Name</label>
                        <input class="form-control" type="text">
                      </div>
                      <div class="col-md-4">
                        <label>Last Name</label>
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8 mb-4">
                        <label>Email</label>
                        <input class="form-control" type="text">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-8 mb-4">
                        <label>Mobile No</label>
                        <input class="form-control" type="text">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-8 mb-4">
                        <label>Office Phone</label>
                        <input class="form-control" type="text">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-8 mb-4">
                        <label>Home Phone</label>
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <div class="row mb-10">
                      <div class="col-md-12">
                        <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

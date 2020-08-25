@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-md-3">
            {{-- <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#all-users" data-toggle="tab">All users</a></li>
                    <li class="nav-item"><a class="nav-link" href="#add-user" data-toggle="tab">Add user</a></li>
                </ul>
            </div> --}}
        </div>
        <div class="col-md-9">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit {{ $role->name }}</div>

                        <div class="card-body">
                            <form action="{{ route('panel.roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label>Role</label>
                                        <input class="form-control" name="name" type="text" value="{{ $role->name }}">
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

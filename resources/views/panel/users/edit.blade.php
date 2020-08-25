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
                    <div class="card-header">Edit {{ $user->name }}</div>

                    <div class="card-body">
                        <form action="{{ route('panel.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    @foreach ($roles as $role)
                                        <div>
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if ($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                            <label>{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

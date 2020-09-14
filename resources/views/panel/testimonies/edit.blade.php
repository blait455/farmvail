@extends('layouts.panel')
@section('title') Edit Testimony @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Edit Testimony</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit details</h3>
                <form action="{{ route('panel.testimonies.update', $testimony->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div class="form-group">
                            <strong>User's Name:</strong>
                            <p>{{ old('name', $testimony->user->name) }}</p>
                        </div>
                        <div class="form-group">
                            <strong>User's Email:</strong>
                            <p>{{ old('name', $testimony->user->email) }}</p>
                        </div>
                        <div class="form-group">
                            <strong>Testimony:</strong>
                            <textarea class="form-control" rows="4" name="body" id="body">{{ old('body', $testimony->body) }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                    {{ $testimony->status == 1 ? 'checked' : '' }}
                                    /> Status
                                </label>
                            </div>
                        </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('panel.testimonies.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

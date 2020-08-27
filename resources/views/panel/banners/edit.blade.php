@extends('layouts.panel')
@section('title') Edit banner @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> Edit banner</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Banner details</h3>
                <form action="{{ route('panel.banners.update', $banner->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"/>
                            {{-- <input type="hidden" name="id" value="{{ $brand->id }}"> --}}
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $banner->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="link">Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('link') is-invalid @enderror" type="text" name="link" id="link" value="{{ old('link', $banner->link) }}"/>
                            @error('link') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" {{ $banner->status == 1 ? 'checked' : '' }}/>Status
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                    @if ($banner->image != null)
                                    <div class="col-md-2">
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/media/banner/'.$banner->image) }}" id="brandLogo" class="img-fluid" alt="img">
                                        </figure>
                                    </div>
                                @endif
                                <div class="col-md-10">
                                    <label class="control-label">Banner Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Banner</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('panel.banners.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

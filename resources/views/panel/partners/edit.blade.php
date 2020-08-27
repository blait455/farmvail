@extends('layouts.panel')
@section('title') Edit partner @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> Edit partner</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Partner details</h3>
                <form action="{{ route('panel.partners.update', $partner->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $partner->name) }}"/>
                            {{-- <input type="hidden" name="id" value="{{ $brand->id }}"> --}}
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                    @if ($partner->logo != null)
                                    <div class="col-md-2">
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/media/partner/'.$partner->logo) }}" id="brandLogo" class="img-fluid" alt="img">
                                        </figure>
                                    </div>
                                @endif
                                <div class="col-md-10">
                                    <label class="control-label">Brand Logo</label>
                                    <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="image"/>
                                    @error('logo') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Partner</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('panel.partners.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

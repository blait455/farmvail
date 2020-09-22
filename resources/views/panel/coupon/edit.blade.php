@extends('layouts.panel')
@section('title') Add Coupon @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> Add Coupon</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">coupon details</h3>
                <form class="form-horizontal" action="{{ route('panel.coupon.update', $coupon->id) }}" method="POST" role="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Code <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}"/>
                            @error('code') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Value <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="value" id="value" value="{{ old('value', $coupon->value) }}"/>
                            @error('code') {{ $message }} @enderror
                        </div>

                        <fieldset class="form-group">
                            <label>Type</label>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" id="optionsRadios1" type="radio" name="type" value="percent" {{ $coupon->type == 'percent' ? 'checked' : '' }}>Percent
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" id="optionsRadios2" type="radio" name="type" value="fixed" {{ $coupon->type == 'fixed' ? 'checked' : '' }}>Fixed
                              </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('panel.coupon.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

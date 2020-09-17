@extends('layouts.panel')
@section('title') Create category @endsection
@section('content')
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Form Samples</h1>
                <p>Sample forms</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="tile">
                    <h3 class="tile-title">Register</h3>
                    <div class="tile-body">
                        <form class="form-horizontal" action="{{ route('panel.post.store') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter blog title"/>
                                    @error('title') {{ $message }} @enderror
                                </div>

                                <div class="form-group col-md-5">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id" id="exampleSelect1">
                                        <option label="Choose category">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tags</label>
                                <select class="form-control chosen-select" name="tags[]" multiple>
                                    <option value="" disabled>Post tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Body</label>
                                {{-- <textarea name="body" id="summernote" class="form-control"></textarea> --}}
                                <textarea class="description form-control" name="body"></textarea>
                                <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                                <script>
                                    tinymce.init({
                                        selector:'textarea.description',
                                        width: 900,
                                        height: 300
                                    });
                                </script>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="exampleInputFile">Image</label>
                                <input class="form-control-file" id="exampleInputFile" type="file" name="image" aria-describedby="fileHelp"><small class="form-text text-muted" id="fileHelp">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                            </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                                        &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('panel.blog') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    {{-- <script src="{{ asset('backend/lib/medium-editor/medium-editor.js') }}"></script> --}}
@endpush

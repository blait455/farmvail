{{-- @extends('layouts.panel')
@section('title') Post-Categories @endsection
@section('content') --}}

<div class="tile">
    <div>
        <div>
            <h1><i class="fa fa-tags"></i> Post Categories</h1>
            <hr>
        </div>
        <a href="{{ route('panel.post-categories.create') }}" class="btn btn-primary pull-right">Add Category</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Slug </th>
                                <th class="text-center"> Description </th>
                                <th class="text-center"> Image </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post_categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/media/blog/category/'.$category->image) }}" height="80px" width="80px" alt="">
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('panel.post-categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('panel.post-categories.delete', $category->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
    @push('scripts')
        <script type="text/javascript" src="{{ asset('panel/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('panel/js/plugins/dataTables.bootstrap.min.js') }}"></script>
        <script type="text/javascript">$('#sampleTable').DataTable();</script>
    @endpush
</div>

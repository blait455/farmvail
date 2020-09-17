<div class="tile">
    <div>
        <div>
            <h1><i class="fa fa-tags"></i> Post Tags</h1>
            <hr>
        </div>
        <a href="{{ route('panel.tag.create') }}" class="btn btn-primary pull-right">Add Tags</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Slug </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td class="text-center">{{ $tag->name }}</td>
                                    <td class="text-center">{{ $tag->slug }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('panel.tag.edit', $tag->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('panel.tag.delete', $tag->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

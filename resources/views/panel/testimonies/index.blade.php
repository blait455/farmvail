@extends('layouts.panel')
@section('title') Testimonies @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Testimonies</h1>
            <p>All</p>
        </div>
        {{-- <a href="{{ route('panel.categories.create') }}" class="btn btn-primary pull-right">Add Testimonies</a> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th class="text-center"> User </th>
                                <th class="text-center"> Email </th>
                                <th class="text-center"> Testimony </th>
                                <th class="text-center"> status </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonies as $testimony)
                                <tr>
                                    <td>{{ $testimony->id }}</td>
                                    <td>{{ $testimony->user->name }}</td>
                                    <td>{{ $testimony->user->email }}</td>
                                    <td>{{ $testimony->body }}</td>
                                    <td class="text-center">
                                        @if ($testimony->status == 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('panel.testimonies.edit', $testimony->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('panel.testimonies.delete', $testimony->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('panel/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('panel/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush

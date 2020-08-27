@extends('layouts.panel')
@section('title') Products @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Products</h1>
            <p>All</p>
        </div>
        <a href="{{ route('panel.products.create') }}" class="btn btn-primary pull-right">Add Product</a>
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
                            <th class="text-center"> Image </th>
                            <th class="text-center"> Categories </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Quantity </th>
                            <th class="text-center"> Status </th>
                            <th class="text-center"> Featured </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/media/product/'. $product->image) }}" height="100px" width="150px" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td  class="text-center">
                                        <span class="badge badge-info">{{ $product->category->name }}</span>
                                    </td>
                                    <td class="text-center"><span>&#8358;</span>{{ $product->price }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td class="text-center">
                                        @if ($product->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($product->featured == 1)
                                            <span class="badge badge-success">yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('panel.products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('panel.products.delete', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

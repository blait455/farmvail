@extends('layouts.panel')
@section('title') Orders @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> Orders</h1>
            <p>All</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th class="text-center">Order</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Payment</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->order_number }}</td>
                                    <td class="text-center">{{ $order->status }}</td>
                                    <td class="text-center">{{ $order->payment->payment_method }}</td>
                                    <td class="text-center">{{ $order->user->name }}</td>
                                    <td class="text-center">
                                        @foreach ($order->cart as $item)
                                        {{ $item->product->name }}: {{ $item->quantity }} <br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($order->cart as $item)
                                        {{ $item->product->name }}: <span>&#8358;</span>{{ $item->total }} <br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('panel.order.edit', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('panel.order.delete', $order->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

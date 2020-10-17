@extends('layouts.panel')
@section('title', 'Edit order')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> Order <small>[{{ $order->order_number }}]</small><sup class="badge badge-pill badge-secondary">{{ $order->status }}</sup></h1><sup class="badge badge-pill badge-secondary">{{ $order->status }}</sup>
        </div>
        <a href="{{ route('panel.order.completed', $order->id) }}" class="btn btn-sm btn-success">Completed</a>
        <a href="{{ route('panel.order.processing', $order->id) }}" class="btn btn-sm btn-secondary">Processing</a>
        <a href="{{ route('panel.order.declined', $order->id) }}" class="btn btn-sm btn-warning">Decline</a>
        <a href="{{ route('panel.order.delete', $order->id) }}" class="btn btn-sm btn-danger">Delete</a>
    </div>
    {{-- @include('admin.partials.flash') --}}
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#product" data-toggle="tab">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#shipping" data-toggle="tab">Shipping</a></li>
                    <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Payment</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="product">
                    <div class="tile">
                        <div>
                            <div>
                                <h1><i class="fa fa-tags"></i> Order Products Details</h1>
                                <hr>
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
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Image </th>
                                                    <th class="text-center"> Quantity </th>
                                                    <th class="text-center"> Total </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->cart as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td class="text-center">{{ $item->product->name }}</td>
                                                        <td class="text-center">
                                                            <img src="{{ asset('storage/media/product/'. $item->product->image) }}" height="80px" width="80px" alt="">
                                                        </td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
                                                        <td class="text-center"><span>&#8358;</span>{{ $item->total }}</td>

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
                </div>
                <div class="tab-pane fade" id="shipping">
                    <div class="tile">
                        <div>
                            <div>
                                <h1><i class="fa fa-tags"></i> Order Shipping Details </h1>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div class="tile-body">
                                        <table class="table table-hover table-bordered" id="sampleTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> State </th>
                                                    <th class="text-center"> Post code </th>
                                                    <th class="text-center"> Phone </th>
                                                    <th class="text-center"> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ $order->first_name }} {{ $order->last_name }}</td>
                                                    <td class="text-center">{{ $order->address }}</td>
                                                    <td class="text-center">{{ $order->state }}</td>
                                                    <td class="text-center">{{ $order->post_code }}</td>
                                                    <td class="text-center">{{ $order->phone_number }}</td>
                                                    <td class="text-center">{{ $order->status }}</td>
                                                </tr>
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
                </div>
                <div class="tab-pane fade" id="payment">
                    <div class="tile">
                        <div>
                            <div>
                                <a href="{{ route('panel.order.unpay', $order->id) }}" class="btn btn-sm btn-danger float-right">Unpay</a>
                                <a href="{{ route('panel.order.paid', $order->id) }}" class="btn btn-sm btn-success pull-right">Paid</a>
                                <h1><i class="fa fa-tags"></i>Order Payment details</h1>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div class="tile-body">
                                        <table class="table table-hover table-bordered" id="sampleTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Payment ID </th>
                                                    <th class="text-center"> Payment Method </th>
                                                    <th class="text-center"> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ $order->payment->transaction_id }}</td>
                                                    <td class="text-center">{{ $order->payment->payment_method }}</td>
                                                    <td class="text-center">{{ $order->payment->status }}</td>
                                                </tr>
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
                </div>
            </div>
        </div>
    </div>
@endsection

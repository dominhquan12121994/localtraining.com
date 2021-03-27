@extends('layouts.base')

@section('css')
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Orders') }}
                        <span class="float-right">
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">{{ __('Thêm mới order') }}</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped" id="table1">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                            <tr>
                              <td><strong>{{ $order->name }}</strong></td>
                              <td>{{ $order->phone }}</td>
                              <td>{{ $order->email }}</td>
                              <td>{{ $order->address }}</td>
                              <td>
                                <a href="{{ url('/orders/' . $order->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/orders/' . $order->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('orders.destroy', $order->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $orders->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection


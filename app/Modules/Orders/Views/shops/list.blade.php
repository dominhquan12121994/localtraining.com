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
                      <i class="fa fa-align-justify"></i>{{ __('Shops') }}
                        <span class="float-right">
                            <a href="{{ route('shops.create') }}" class="btn btn-primary">{{ __('Thêm mới Shop') }}</a>
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
                          @foreach($shops as $shop)
                            <tr>
                              <td><strong>{{ $shop->name }}</strong></td>
                              <td>{{ $shop->phone }}</td>
                              <td>{{ $shop->email }}</td>
                              <td>{{ $shop->address }}</td>
                              <td>
                                <a href="{{ url('/shops/' . $shop->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/shops/' . $shop->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('shops.destroy', $shop->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $shops->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection


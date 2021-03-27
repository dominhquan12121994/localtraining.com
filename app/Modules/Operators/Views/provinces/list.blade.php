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
                      <i class="fa fa-align-justify"></i>{{ __('Provinces') }}
                        <span class="float-right">
                            <a href="{{ route('provinces.create') }}" class="btn btn-primary">{{ __('Add Provinces') }}</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped" id="table1">
                        <thead>
                          <tr>
                            <th>Zone</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Short name</th>
                            <th>Districts</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($provinces as $province)
                            <tr>
                              <td>{{ $province->zone }}</td>
                              <td>{{ $province->code }}</td>
                              <td><strong>{{ $province->name }}</strong></td>
                              <td>{{ $province->short_name }}</td>
                              <td><a href="{{ url('/districts?p=' . $province->id) }}">{{ count($province->districts) . ' quận/huyện' }}</a></td>
                              <td>
                                <a href="{{ url('/provinces/' . $province->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/provinces/' . $province->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('provinces.destroy', $province->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{--{{ $provinces->links() }}--}}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript">
        $(document).ready( function () {
            $('#table1').DataTable();
        } );
    </script>
@endsection


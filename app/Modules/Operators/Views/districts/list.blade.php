@extends('layouts.base')

@section('css')
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Districts') }}
                        <span class="float-right">
                            <a href="{{ route('districts.create') }}" class="btn btn-primary">{{ __('Add districts') }}</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form class="form-inline" action="" method="get">
                            <div class="form-group">
                                <label for="select1" class="mr-1" for="exampleInputName2">Province</label>
                                <select class="form-control frm-select2" id="select1" name="p">
                                    <option value="0">Choose province to filter</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $arrFilter['p_id'] === $province->id ? 'selected="selected"' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="n" type="text" value="{{ $arrFilter['name'] }}" placeholder="Enter district name">
                            </div>
                            &nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit">Search</button>&nbsp;
                            <a href="{{ url('/districts/') }}" class="btn btn-danger">Reset</a>
                        </form>
                        <br>
                        <table class="table table-responsive-sm table-striped" id="table1">
                        <thead>
                          <tr>
                            <th>Province</th>
                            <th>Type</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Wards</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($districts as $district)
                            <tr>
                              <td>{{ $district->provinces->name }}</td>
                              <td>{{ $district->type }}</td>
                              <td>{{ $district->code }}</td>
                              <td><strong>{{ $district->name }}</strong></td>
                                <td><a href="{{ url('/wards?p='. $district->p_id .'&d=' . $district->id) }}">{{ count($district->wards) . ' phường/xã' }}</a></td>
                              <td>
                                <a href="{{ url('/districts/' . $district->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/districts/' . $district->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('districts.destroy', $district->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $districts->withQueryString()->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('.frm-select2').select2();
        });
    </script>
@endsection


@extends('layouts.base')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Wards') }}
                        <span class="float-right">
                            <a href="{{ route('wards.create') }}" class="btn btn-primary">{{ __('Add Wards') }}</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form class="form-inline" action="" method="get">
                            <div class="form-group">
                                <label for="select1" class="mr-1" for="exampleInputName2">Province</label>
                                <select class="form-control frm-select2" id="select1" name="p" onchange="changeDistricts()">
                                    <option value="0">Choose province to filter</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $arrFilter['p_id'] === $province->id ? 'selected="selected"' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <label for="select2" class="mx-1" for="exampleInputEmail2">District</label>
                                <select class="form-control frm-select2" id="select2" name="d">
                                    <option value="0">Please select district</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $arrFilter['d_id'] === $district->id ? 'selected="selected"' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="n" type="text" value="{{ $arrFilter['name'] }}" placeholder="Enter ward name">
                            </div>
                            &nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit">Search</button>&nbsp;
                            <a href="{{ url('/wards/') }}" class="btn btn-danger">Reset</a>
                        </form>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Province</th>
                            <th>District</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($wards as $ward)
                            <tr>
                              <td>{{ $ward->provinces->name }}</td>
                              <td>{{ $ward->districts->name }}</td>
                              <td>{{ $ward->code }}</td>
                              <td><strong>{{ $ward->name }}</strong></td>
                              <td>
                                <a href="{{ url('/wards/' . $ward->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/wards/' . $ward->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('wards.destroy', $ward->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $wards->withQueryString()->links() }}
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

        function changeDistricts() {

            let provinceID = document.getElementById('select1').value;
            let routeApi = '{{ route('api.districts.get-by-province', ":slug") }}';
            routeApi = routeApi.replace(':slug', provinceID);

            if (provinceID > 0) {
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
                        if (xmlhttp.status == 200) {
                            var response = JSON.parse(xmlhttp.responseText);
                            if (response.status_code == 200) {
                                let html = '<option value="0">Please select district</option>';
                                response.data.forEach(function (item) {
                                    html += '<option value="'+ item.id +'">'+ item.name +'</option>';
                                });
                                document.getElementById("select2").innerHTML = html;
                            }
                        }
                        else if (xmlhttp.status == 400) {
                            alert('There was an error 400');
                        }
                        else {
                            alert('something else other than 200 was returned');
                        }
                    }
                };

                xmlhttp.open("GET", routeApi, true);
                xmlhttp.send();
            } else {
                document.getElementById("select2").innerHTML = '<option value="0">Please select province</option>';
            }

        }
    </script>
@endsection


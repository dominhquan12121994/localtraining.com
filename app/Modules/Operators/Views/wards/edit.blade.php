@extends('layouts.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <form method="POST" action="/wards/{{ $ward->id }}">
                        <div class="card-header">
                          <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $ward->title }}
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col">
                                    <label for="select1">Province</label>
                                    <select class="form-control" id="select1" name="p_id" value="{{ $ward->p_id }}" onchange="changeDistricts()">
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $ward->p_id === $province->id ? 'selected="selected"' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="select2">Districts</label>
                                    <select class="form-control" id="select2" name="d_id" value="{{ $ward->d_id }}">
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" {{ $ward->d_id === $district->id ? 'selected="selected"' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Code</label>
                                    <input class="form-control @error('code') is-invalid @enderror" type="text" placeholder="{{ __('Code') }}" name="code" value="{{ $ward->code }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $ward->name }}" required>
                                </div>
                            </div>

                            @if ($errors->any())
                                <br>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="{{ route('wards.index') }}" class="btn btn-primary">{{ __('Return') }}</a>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')
    <script type="application/javascript">
        function changeDistricts() {
            let xmlhttp = new XMLHttpRequest();
            let provinceID = document.getElementById('select1').value;
            let routeApi = '{{ route('api.districts.get-by-province', ":slug") }}';
            routeApi = routeApi.replace(':slug', provinceID);

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
                    if (xmlhttp.status == 200) {
                        var response = JSON.parse(xmlhttp.responseText);
                        if (response.status_code == 200) {
                            let html = '';
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
        }
    </script>
@endsection
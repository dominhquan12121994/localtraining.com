@extends('layouts.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <form method="POST" action="{{ route('districts.store') }}">
                        <div class="card-header">
                          <i class="fa fa-align-justify"></i> {{ __('Create District') }}
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="select1">Province</label>
                                    <select class="form-control" id="select1" name="p_id">
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="select1">Type</label>
                                    <select class="form-control" id="select1" name="type">
                                        <option value="noi">Nội thành</option>
                                        <option value="ngoai">Ngoại thành</option>
                                        <option value="huyen">Huyện/xã</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Code</label>
                                    <input class="form-control @error('code') is-invalid @enderror" type="text" placeholder="{{ __('Code') }}" name="code" maxlength="10" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="{{ __('Name') }}" name="name" maxlength="255" required>
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
                            <button class="btn btn-success" type="submit">{{ __('Add') }}</button>
                            <a href="{{ route('districts.index') }}" class="btn btn-primary">{{ __('Return') }}</a>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection
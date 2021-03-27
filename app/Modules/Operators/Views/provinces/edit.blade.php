@extends('layouts.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <form method="POST" action="/provinces/{{ $province->id }}">
                        <div class="card-header">
                          <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $province->title }}
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col">
                                    <label for="select1">Khu vực</label>
                                    <select class="form-control" id="select1" name="zone" value="{{ $province->zone }}">
                                        <option value="bac">Miền Bắc</option>
                                        <option value="trung">Miền Trung</option>
                                        <option value="nam">Miền Nam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Code</label>
                                    <input class="form-control @error('code') is-invalid @enderror" type="text" placeholder="{{ __('Code') }}" name="code" value="{{ $province->code }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $province->name }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Short name</label>
                                    <input class="form-control @error('short_name') is-invalid @enderror" type="text" placeholder="{{ __('Short name') }}" name="short_name" value="{{ $province->short_name }}" required>
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
                            <a href="{{ route('provinces.index') }}" class="btn btn-primary">{{ __('Return') }}</a>
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
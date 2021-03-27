@extends('layouts.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> Province: {{ $province->name }}</div>
                    <div class="card-body">
                        <h4>Code:</h4>
                        <p> {{ $province->code }}</p>
                        <h4>Zone:</h4>
                        <p> {{ $province->zone }}</p>
                        <a href="{{ route('provinces.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
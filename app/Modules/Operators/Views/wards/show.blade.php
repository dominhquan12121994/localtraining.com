@extends('layouts.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> Ward: {{ $ward->name }}</div>
                    <div class="card-body">
                        <h4>Code:</h4>
                        <p> {{ $ward->code }}</p>
                        <h4>District:</h4>
                        <p> {{ $ward->districts->name }}</p>
                        <h4>Province:</h4>
                        <p> {{ $ward->provinces->name }}</p>
                        <a href="{{ route('wards.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
@extends('layouts.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                {{--<div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">--}}
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('orders.store') }}">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <strong>{{ __('Tạo mới đơn hàng') }}</strong>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Bên gửi</h4>

                                        <p></p>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên order</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên order" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Bên nhận</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên order</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên order" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4>Hàng hóa</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên order</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên order" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Gói cước</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên order</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên order" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Lưu ý - Ghi chú</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên order</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên order" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>
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
                                <a href="{{ route('orders.index') }}"
                                   class="btn btn-primary">{{ __('Return') }}</a>
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

        $(".add_details").click(function () {
            let rand = makeid(5);
            $(".user-details").append(`<div class="user_data">
                                            <br>
                                            <h4>
                                                Địa chỉ lấy hàng
                                                <button class="btn btn-sm btn-dark active remove-btn" type="button" aria-pressed="true" style="padding: 0px 2px">
                                                    <i class="c-icon cil-trash"></i>
                                                </button>
                                            </h4>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Tên người liên hệ</label>
                                                    <input name="addName[]" class="form-control" type="text" required>
                                                </div>
                                                <div class="col-4">
                                                    <label>Số điện thoại</label>
                                                    <input name="addPhone[]" class="form-control" type="text" required>
                                                </div>
                                                <div class="col-4">
                                                    <label>Địa chỉ lấy hàng</label>
                                                    <input name="addAddress[]" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label for="`+rand+`-select1">Tỉnh/thành</label>
                                                    <select class="form-control" id="`+rand+`-select1" name="addProvinces[]" onchange="changeProvinces('`+rand+`')">
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="`+rand+`-select2">Quận/huyện</label>
                                                    <select class="form-control" id="`+rand+`-select2" name="addDistricts[]" onchange="changeDistricts('`+rand+`')">
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="`+rand+`-select3">Phường/xã</label>
                                                    <select class="form-control" id="`+rand+`-select3" name="addWards[]">
                                                        @foreach ($wards as $ward)
                                                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>`
            );

        });

        $("body").on("click",".remove-btn",function(e){
            $(this).parents('.user_data').remove();
        });

        function changeProvinces(randTxt) {
            let provinceID = document.getElementById(randTxt+'-select1').value;
            let routeApi = '{{ route('api.districts.get-by-province', ":slug") }}';
            routeApi = routeApi.replace(':slug', provinceID);

            $.ajax({url: routeApi, success: function(response){
                if (response.status_code === 200) {
                    let html = '';
                    response.data.forEach(function (item) {
                        html += '<option value="'+ item.id +'">'+ item.name +'</option>';
                    });
                    document.getElementById(randTxt+"-select2").innerHTML = html;
                    changeDistricts(randTxt);
                }
            }});
        }
        function changeDistricts(randTxt) {
            let districtID = document.getElementById(randTxt+'-select2').value;
            let routeApi = '{{ route('api.wards.get-by-district', ":slug") }}';
            routeApi = routeApi.replace(':slug', districtID);

            $.ajax({url: routeApi, success: function(response){
                if (response.status_code === 200) {
                    let html = '';
                    response.data.forEach(function (item) {
                        html += '<option value="'+ item.id +'">'+ item.name +'</option>';
                    });
                    document.getElementById(randTxt+"-select3").innerHTML = html;
                }
            }});
        }

        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    </script>
@endsection

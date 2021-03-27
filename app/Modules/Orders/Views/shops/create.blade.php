@extends('layouts.base')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                {{--<div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">--}}
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('shops.store') }}">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <strong>{{ __('Tạo mới Shop') }}</strong>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Thông tin cơ bản</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên Shop</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       placeholder="Nhập tên shop" name="name" maxlength="10"
                                                       value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Số điện thoại</label>
                                                <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập số điện thoại') }}" name="phone"
                                                       value="{{ old('phone') }}" maxlength="255" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập email') }}" name="email"
                                                       value="{{ old('email') }}" maxlength="255" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                                       placeholder="Password" name="password" value="{{ old('password') }}" minlength="6" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Confirm Password</label>
                                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                                       placeholder="Confirm Password" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Địa chỉ shop (in trên bill)</label>
                                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập địa chỉ shop') }}" maxlength="255" name="address"
                                                       value="{{ old('address') ?: '' }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="cycle_cod">Lịch đối soát</label>
                                                <select class="form-control" id="cycle_cod" name="cycle_cod" title="Chọn thời điểm đối soát">
                                                    <option value="1_time_week" selected="selected">Đối soát 1 lần/tuần</option>
                                                    <option value="payment_twice_per_week_odd">Đối soát 2 lần/tuần thứ 3/5</option>
                                                    <option value="payment_3times_per_week">Đối soát 3 lần/tuần vào thứ 2/4/6</option>
                                                    <option value="payment_once_per_month">Đối soát 1 lần/tháng vào ngày cuối cùng của tháng</option>
                                                    <option value="payment_twice_per_month">Đối soát 2 lần/tháng vào ngày 15 và ngày cuối cùng của tháng</option>
                                                    <option value="payment_by_amount_money">Chỉ đối soát khi cộng dồn đủ số tiền (tùy chọn)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <h4>Thông tin tài khoản</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Ngân hàng</label>
                                                <input class="form-control @error('bank_name') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Chọn ngân hàng') }}" maxlength="255" name="bank_name"
                                                       value="{{ old('bank_name') ?: '' }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Chi nhánh</label>
                                                <input class="form-control @error('bank_branch') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập chi nhánh') }}" maxlength="255" name="bank_branch"
                                                       value="{{ old('bank_branch') ?: '' }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên chủ tài khoản</label>
                                                <input class="form-control @error('stk_name') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập tên chủ tài khoản') }}" maxlength="255" name="stk_name"
                                                       value="{{ old('stk_name') ?: '' }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Số tài khoản</label>
                                                <input class="form-control @error('stk') is-invalid @enderror" type="text"
                                                       placeholder="{{ __('Nhập số tài khoản') }}" maxlength="255" name="stk"
                                                       value="{{ old('stk') ?: '' }}" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="user-details">
                                            <div class="user_data">
                                                <h4>Địa chỉ lấy hàng</h4>
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
                                                        <label for="add1-select1">Tỉnh/thành</label>
                                                        <select class="form-control frm-select2" id="add1-select1" name="addProvinces[]" onchange="changeProvinces('add1')">
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="add1-select2">Quận/huyện</label>
                                                        <select class="form-control frm-select2" id="add1-select2" name="addDistricts[]" onchange="changeDistricts('add1')">
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="add1-select3">Phường/xã</label>
                                                        <select class="form-control frm-select2" id="add1-select3" name="addWards[]">
                                                            @foreach ($wards as $ward)
                                                                <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input value="Thêm địa chỉ" class="add_details" autocomplete="false" type="button">
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
                                <a href="{{ route('shops.index') }}"
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('.frm-select2').select2();
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
                                                    <select class="form-control frm-select2" id="`+rand+`-select1" name="addProvinces[]" onchange="changeProvinces('`+rand+`')">
                                                        @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="`+rand+`-select2">Quận/huyện</label>
                                                    <select class="form-control frm-select2" id="`+rand+`-select2" name="addDistricts[]" onchange="changeDistricts('`+rand+`')">
                                                        @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="`+rand+`-select3">Phường/xã</label>
                                                    <select class="form-control frm-select2" id="`+rand+`-select3" name="addWards[]">
                                                        @foreach ($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                                        @endforeach
                    </select>
                </div>
            </div>
        </div>`
                );
                $('.frm-select2').select2();
            });

            $("body").on("click",".remove-btn",function(e){
                $(this).parents('.user_data').remove();
            });
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

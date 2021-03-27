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
                        <form method="POST" action="/shops/{{ $shop->id }}">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> {{ __('Edit') }}: <strong>{{ $shop->name }}</strong>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <h4>Thông tin cơ bản</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên Shop</label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                       type="text" value="{{ $shop->name }}" placeholder="Nhập tên shop"
                                                       name="name" id="name" autofocus
                                                       maxlength="255" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Số điện thoại</label>
                                                <input class="form-control @error('phone') is-invalid @enderror"

                                                       type="text" value="{{ $shop->phone }}" name="phone"
                                                       placeholder="{{ __('Nhập số điện thoại') }}" maxlength="255"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                       type="text" value="{{ $shop->email }}" name="email"
                                                       placeholder="{{ __('Nhập email') }}" maxlength="255" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Địa chỉ shop (in trên bill)</label>
                                                <input class="form-control @error('address') is-invalid @enderror"
                                                       type="text" value="{{ $shop->address }}"
                                                       placeholder="{{ __('Nhập địa chỉ shop') }}" maxlength="255"
                                                       name="address" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="cycle_cod">Lịch đối soát</label>
                                                <select class="form-control" id="cycle_cod" name="cycle_cod"
                                                        title="Chọn thời điểm đối soát"
                                                        value="{{ $shopBank->cycle_cod }}">
                                                    @foreach ($cycleCodList as $key=>$value)
                                                        <option value="{{ $key }}" {{ $key === $shopBank->cycle_cod ? 'selected="selected"' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <h4>Thông tin tài khoản</h4>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Ngân hàng</label>
                                                <input class="form-control @error('bank') is-invalid @enderror"
                                                       type="text" name="bank_name" value="{{ $shopBank->bank_name }}"
                                                       placeholder="{{ __('Chọn ngân hàng') }}" maxlength="255">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Chi nhánh</label>
                                                <input class="form-control @error('branch') is-invalid @enderror"
                                                       type="text" name="bank_branch"
                                                       value="{{ $shopBank->bank_branch }}"
                                                       placeholder="{{ __('Nhập chi nhánh') }}" maxlength="255">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tên chủ tài khoản</label>
                                                <input class="form-control @error('stk_name') is-invalid @enderror"
                                                       type="text" name="stk_name" value="{{ $shopBank->stk_name }}"
                                                       placeholder="{{ __('Nhập tên chủ tài khoản') }}" maxlength="255">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Số tài khoản</label>
                                                <input class="form-control @error('stk') is-invalid @enderror"
                                                       type="text" name="stk" value="{{ $shopBank->stk }}"
                                                       placeholder="{{ __('Nhập số tài khoản') }}" maxlength="255">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="user-details">
                                            @foreach($shopAddress as $key=>$address)
                                                <div class="user_data">
                                                    <h4>
                                                        Địa chỉ lấy hàng
                                                        <button class="btn btn-sm btn-dark active remove-btn" type="button" aria-pressed="true" style="padding: 0px 2px">
                                                            <i class="c-icon cil-trash"></i>
                                                        </button>
                                                    </h4>
                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label>Tên người liên hệ</label>
                                                            <input type="hidden" name="addIds[]" value="{{ $address->id }}">
                                                            <input name="addName[]" class="form-control" type="text"
                                                                   value="{{ $address->name }}" required>
                                                        </div>
                                                        <div class="col-4">
                                                            <label>Số điện thoại</label>
                                                            <input name="addPhone[]" class="form-control" type="text"
                                                                   value="{{ $address->phone }}" required>
                                                        </div>
                                                        <div class="col-4">
                                                            <label>Địa chỉ lấy hàng</label>
                                                            <input name="addAddress[]" class="form-control" type="text"
                                                                   value="{{ $address->address }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label for="add{{ $key }}-select1">Tỉnh/thành</label>
                                                            <select class="form-control frm-select2" id="add{{ $key }}-select1"
                                                                    name="addProvinces[]"
                                                                    onchange="changeProvinces('add{{ $key }}')">
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province->id }}" {{ ($address->p_id===$province->id) ? 'selected="selected"' : '' }}>{{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="add{{ $key }}-select2">Quận/huyện</label>
                                                            <select class="form-control frm-select2" id="add{{ $key }}-select2"
                                                                    name="addDistricts[]"
                                                                    onchange="changeDistricts('add{{ $key }}')">
                                                                @foreach ($addDistricts[$key] as $district)
                                                                    <option value="{{ $district->id }}" {{ ($address->d_id===$district->id) ? 'selected="selected"' : '' }}>{{ $district->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="add{{ $key }}-select3">Phường/xã</label>
                                                            <select class="form-control frm-select2" id="add{{ $key }}-select3"
                                                                    name="addWards[]">
                                                                @foreach ($addWards[$key] as $ward)
                                                                    <option value="{{ $ward->id }}" {{ ($address->w_id===$ward->id) ? 'selected="selected"' : '' }}>{{ $ward->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <input value="Thêm địa chỉ" class="add_details" autocomplete="false"
                                                   type="button">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                                <a href="{{ route('shops.index') }}"
                                   class="btn btn-primary">{{ __('Return') }}</a>

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
                                                    <label for="` + rand + `-select1">Tỉnh/thành</label>
                                                    <select class="form-control frm-select2" id="` + rand + `-select1" name="addProvinces[]" onchange="changeProvinces('` + rand + `')">
                                                        @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="` + rand + `-select2">Quận/huyện</label>
                                                    <select class="form-control frm-select2" id="` + rand + `-select2" name="addDistricts[]" onchange="changeDistricts('` + rand + `')">
                                                    @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="` + rand + `-select3">Phường/xã</label>
                                                         <select class="form-control frm-select2" id="` + rand + `-select3" name="addWards[]">
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

            $("body").on("click", ".remove-btn", function (e) {
                $(this).parents('.user_data').remove();
            });
        });


        function changeProvinces(randTxt) {
            let provinceID = document.getElementById(randTxt + '-select1').value;
            let routeApi = '{{ route('api.districts.get-by-province', ":slug") }}';
            routeApi = routeApi.replace(':slug', provinceID);

            $.ajax({
                url: routeApi, success: function (response) {
                    if (response.status_code === 200) {
                        let html = '';
                        response.data.forEach(function (item) {
                            html += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        document.getElementById(randTxt + "-select2").innerHTML = html;
                        changeDistricts(randTxt);
                    }
                }
            });
        }

        function changeDistricts(randTxt) {
            let districtID = document.getElementById(randTxt + '-select2').value;
            let routeApi = '{{ route('api.wards.get-by-district', ":slug") }}';
            routeApi = routeApi.replace(':slug', districtID);

            $.ajax({
                url: routeApi, success: function (response) {
                    if (response.status_code === 200) {
                        let html = '';
                        response.data.forEach(function (item) {
                            html += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        document.getElementById(randTxt + "-select3").innerHTML = html;
                    }
                }
            });
        }

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    </script>
@endsection
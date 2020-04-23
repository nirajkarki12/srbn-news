@extends('layouts.user-login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-right">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no">

                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile_no_2" class="col-md-4 col-form-label text-md-right">Alternative Phone/Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile_no_2" type="text" class="form-control @error('mobile_no_2') is-invalid @enderror" name="mobile_no_2" value="{{ old('mobile_no_2') }}" autocomplete="mobile_no_2">

                                @error('mobile_no_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_line_3" class="col-md-4 col-form-label text-md-right">Tole/Address</label>

                            <div class="col-md-6">
                                <input id="address_line_3" type="text" class="form-control @error('address_line_3') is-invalid @enderror" name="address_line_3" value="{{ old('address_line_3') }}" required autocomplete="address_line_3" autofocus>

                                @error('address_line_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_line_1" class="col-md-4 col-form-label text-md-right">Province</label>

                            <div class="col-md-6">
                                 <select class="form-control" id="address_line_1" name="address_line_1" @error('address_line_1') is-invalid @enderror" required autocomplete="address_line_1" autofocus>
                                    <option @if(old('address_line_1') == '') selected @endif value="">--select--</option>
                                    @foreach($provinces as $province)
                                        <option @if(old('address_line_1') == $province->name) selected @endif value="{{ $province->name }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>

                                @error('address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="address_line_2" class="col-md-4 col-form-label text-md-right">District</label>

                            <div class="col-md-6">
                                <select class="form-control" id="address_line_2" name="address_line_2" @error('address_line_2') is-invalid @enderror" required autocomplete="address_line_2" autofocus>
                                    <option selected value="">--select--</option>
                                </select>
                                <input id="address_line_2_value" type="hidden" value="{{ old('address_line_2') }}">

                                @error('address_line_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="checkbox">
                          <label class="col-md-6 offset-md-4">
                            <input type="checkbox" name="agreed" @error('agreed') is-invalid @enderror" value="1" required> I have read and agree to <a href="#">terms of use.</a>*
                          </label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Pre selecting if value already exists
        var addressLine1 = $("#address_line_1").val();
        var addressLine2Value = $("#address_line_2_value").val();
        if(addressLine1) loadDistricts(addressLine1, addressLine2Value);

        function loadDistricts(province, addressLine2Value = '') {
            var dataContent = $('body').find('#address_line_2');
            var url = '{!! route("address.district.lists", ":province") !!}';
            url = url.replace(':province', province);

            $.ajax({
                type:'post',
                data: { "_token": "{{ csrf_token() }}", "oldValue": addressLine2Value },
                url: url,
                success:function(data){
                    dataContent.html(data);
                }
            });
        }

        $("body").on("change","#address_line_1", function(){
            loadDistricts($(this).val());
        });
    });
</script>
@endsection

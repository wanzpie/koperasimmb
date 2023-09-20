<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Building Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/datepicker/datepicker.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Tempusdominus Bbootstrap 4 -->

    <!-- Bootstrap4 Duallistbox -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">--}}
    {{--    <!-- Theme style -->--}}
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/dist/css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            const Toast = Swal.mixin({--}}
    {{--                toast: true,--}}
    {{--                position: 'top-end',--}}
    {{--                showConfirmButton: false,--}}
    {{--                timer: 3000--}}
    {{--            });--}}

    {{--            @if(Session::has('success'))--}}

    {{--            toastr.success("{{ Session::get('success') }}");--}}

    {{--            @endif--}}


    {{--            @if(Session::has('info'))--}}

    {{--            toastr.info("{{ Session::get('info') }}");--}}

    {{--            @endif--}}


    {{--            @if(Session::has('warning'))--}}

    {{--            toastr.warning("{{ Session::get('warning') }}");--}}

    {{--            @endif--}}


    {{--            @if(Session::has('error'))--}}

    {{--            toastr.error("{{ Session::get('error') }}");--}}

    {{--            @endif--}}
    {{--        });--}}
    {{--    </script>--}}
</head>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="card card-info col-md-6">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="POST" action="{{ route('user.password.update') }}" class="form-horizontal">
                            @method('patch')
                            @csrf

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-4 col-form-label text-md-left">{{ __('Current Password') }}</label>

                                    <div class="col-sm-8">
                                        <input id="current_password" type="password" class="form-control form-control-sm @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password">

                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="contain Letter Number and special character">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password" placeholder="contain Letter Number and special character">

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-sm">Update</button>

                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>

</html>

<!-- /.card -->
<!-- Horizontal Form -->

<!-- /.card -->


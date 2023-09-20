{{--<div class="row">--}}
{{--    <div class="col-sm-6">--}}

{{--        @if ($message = Session::get('success'))--}}

{{--            <div class="alert alert-success alert-block">--}}

{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                <strong>{{ $message }}</strong>--}}

{{--            </div>--}}

{{--        @endif--}}



{{--        @if ($message = Session::get('error'))--}}

{{--            <div class="alert alert-danger alert-block">--}}

{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                <strong>{{ $message }}</strong>--}}

{{--            </div>--}}

{{--        @endif--}}



{{--        @if ($message = Session::get('warning'))--}}

{{--            <div class="alert alert-warning alert-block">--}}

{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                <strong>{{ $message }}</strong>--}}

{{--            </div>--}}

{{--        @endif--}}



{{--        @if ($message = Session::get('info'))--}}

{{--            <div class="alert alert-info alert-block">--}}

{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                <strong>{{ $message }}</strong>--}}

{{--            </div>--}}

{{--        @endif--}}

{{--        @if ($errors->any())--}}

{{--            <div class="alert alert-danger">--}}

{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                Please check the form below for errors--}}

{{--            </div>--}}

{{--        @endif--}}

{{--    </div>--}}
{{--</div>--}}
<div class="row">
    <div class="col-sm-6">

        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block" id="success-alert">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

            <script>
                $(document).ready(function(){
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                });
            </script>

        @endif

        @if ($message = Session::get('error'))

            <div class="alert alert-danger alert-block" id="error-alert">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

            <script>
                $(document).ready(function(){
                    $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#error-alert").slideUp(500);
                    });
                });
            </script>

        @endif

        @if ($message = Session::get('warning'))

            <div class="alert alert-warning alert-block" id="warning-alert">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

            <script>
                $(document).ready(function(){
                    $("#warning-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#warning-alert").slideUp(500);
                    });
                });
            </script>

        @endif

        @if ($message = Session::get('info'))

            <div class="alert alert-info alert-block" id="info-alert">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

            <script>
                $(document).ready(function(){
                    $("#info-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#info-alert").slideUp(500);
                    });
                });
            </script>

        @endif

        @if ($errors->any())

            <div class="alert alert-danger" id="errors-alert">

                <button type="button" class="close" data-dismiss="alert">×</button>

                Please check the form below for errors

            </div>

            <script>
                $(document).ready(function(){
                    $("#errors-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#errors-alert").slideUp(500);
                    });
                });
            </script>

        @endif

    </div>
</div>

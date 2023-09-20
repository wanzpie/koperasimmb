@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-default">
                                <div class="card-header">
                                   
                                    </div>
                                </div>
                                <div class="card-body">
                                    {!! Form::model('shu', [
                                        'method' => 'post',
                                        'route' => 'vwrpembayaran',
                                    ]) !!}
                                   <div class="row">
                                    @include('layouts.flash-message')
                                   </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                <label for="unit" class="col-sm-6 col-form-label">Start date</label>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control form-control-sm" name="start_date"  placeholder="masukkan jumlah profit" id="jumlah_profit" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="unit" class="col-sm-6 col-form-label">End date</label>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control form-control-sm" name="end_data"  placeholder="Total Point" id="totalpoint" >
                                                </div>
                                            </div>
                                         
                
                                        </div>
                
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            
                                            <input type="submit" value="Submit" class="btn btn-primary" />
                                            {{-- <a class="btn btn-danger" href="{{ route('pembayaran.index') }}">kembali</a></div> --}}
                
                                    </div>
                                    {!! Form::close() !!}
                
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {


            var buttonCommon = {
                exportOptions: {
                    format: {
                        body: function ( data, row, column, node ) {
                            // Strip $ from salary column to make it numeric
                            if (column > 1) {
                                data =  data.replace( /[.,]/g, '' );
                                return data;
                            }else{
                                return data;
                            }

                        }
                    }
                }
            };
            $('#invoicereportlist').DataTable({
                pageLength : 50,
                dom: 'Bfrtip',
                "scrollX": true,

                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5',
                        title: '<?php echo "Report Utility ".$dataProject['PROJECT_CODE'].' '.$awl.' sd '.$akr; ?>',
                        footer: true
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'print',
                        title: '<?php echo "Report Utility  ".$dataProject['PROJECT_CODE'].' '.$awl.' sd '.$akr; ?>',
                        footer: true
                    } )
                ]

            });
            // $('.datepicker').datepicker({
            //     format: 'dd/mm/yyyy',
            //     todayHighlight:'TRUE',
            //     autoclose: true,
            //     orientation: 'auto bottom'
            // });
            // var table = $('#invoicereportlist').DataTable( {
            //     lengthChange: false,
            //     buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
            // } );
            // table.buttons().container()
            //     .appendTo( '#invoicereportlist_wrapper .col-md-6:eq(0)' );
          //   $('#invoicereportlist').DataTable({});
          // var table =  $('#invoicereportlist').DataTable( {
          //       "scrollX": true,
          //       dom: 'Bfrtip',
          //     "iDisplayLength": 20,
          //     bAutoWidth: true,
          //       buttons: [
          //           'excelHtml5',
          //           'pdf',
          //           'print'
          //       ]
          //   } );
          //   table.buttons().container()
          //       .appendTo( '#invoicereportlist_wrapper .col-md-8:eq(0)' );
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


        });


    </script>
@endsection


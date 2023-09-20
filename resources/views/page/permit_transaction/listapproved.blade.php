@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container-fluid">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card  mt-3  card-fuchsia" >
                                <div class="card-header" style="background-color:#39cccc; ">
                                Permit List approved
                                </div>
                                <div class="card-body ">
                                    @include('layouts.flash-message')
                                    <table class="table table-bordered table-hover nowrap " id="permitlist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >Permit Name</th>
                                            <th> Permit Number</th>
                                            <th>Issue By</th>
                                            <th > Issue date</th>
                                            <th>Expired Date</th>
                                            <th> Period</th>
                                            <th >Location</th>
                                            <th>PIC </th>
                                            <th> Note</th>
                                            <th>Download</th>
                                            <th>Status</th>
                                            <th>day</th>
                                            <td>Renew Status</td>
                                            <th>Update</th>
                                             <th>Renew</th>
                                            <th>End</th>
                                            <th>Cancel</th>
                                        </tr>
                                        </thead>
                                        @foreach($permitapprove as $permitproces)
                                            <tr >
                                                <?php
                                                $ticketTime = strtotime($permitproces->permit_expire_date);
                                                $difference = $ticketTime - time(); ?>
                                                <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Str::limit( $permitproces->permit_description,30) }}
                                                        <button type="button" class="btn btn-info btn-xs" id="judul_permit" data-toggle="tooltip" data-placement="top" title="{{ rtrim($permitproces->permit_description) }}">
                                                            Detail
                                                        </button>
                                                        {!! Form::hidden('permit_item', null,['class'=>'form-control','id'=>'permit_item','readonly'])!!}
                                                        {!! Form::hidden('id_permitdt', null,['class'=>'form-control','id'=>'id_permitdt','readonly'])!!}
                                                    </td>
                                                <td>{{ $permitproces->permit_trx_nochar }}
                                                    {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}

                                                </td>
                                                <td>{{ Str::limit($permitproces->nama_instansi,25) }}
                                                    <button type="button" class="btn btn-info btn-xs" id="judul_instansi" data-toggle="tooltip" data-placement="top" title="{{ rtrim($permitproces->nama_instansi) }}">
                                                        Detail
                                                    </button>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($permitproces->permit_issue_date)) }}
                                                    {!! Form::hidden('permit_etd_date_hidden', $permitproces->permit_expire_date,['class'=>'form-control','id'=>'permit_etd_date_hidden','readonly'])!!}
                                               </td>
                                                <td>{{ ($permitproces->permit_expire_date) ? date('d-m-Y', strtotime($permitproces->permit_expire_date)):null }}
                                                    {!! Form::hidden('permit_expire_date_hidden', $permitproces->permit_expire_date,['class'=>'form-control','id'=>'permit_expire_date_hidden','readonly'])!!}
                                                </td>
                                                <td>{{ $permitproces->permit_period }}</td>
                                                <td>{{ $permitproces->permit_location }}</td>
                                                <td></td>
                                                <td>{{ $permitproces->permit_desc }}</td>

                                                    <td>
                                                    <a href="{{ URL('/download/'.$permitproces->permit_doc_approved_name) }}" target="_blank">{{$permitproces->permit_doc_approved_name}}</a>
                                                    </td>

                                                    {{--                                                    <td>{{ round($difference / 86400) }}</td>--}}

                                                         <td>{{ $permitproces->permit_gov_status }}</td>
                                                    <td>{{ round($difference / 86400) }}</td>
                                                    <td>@if($permitproces->permit_renew_int==0)
                                                            TIDAK   PERPANJANG
                                                        @else
                                                            PERPANJANG
                                                        @endif</td>
                                                    {{--                                                <td>{{ round($difference / 86400) }}</td>--}}

                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="updateservicedate({{$permitproces->id_permit_int}})" val="{{$permitproces->permit_trx_nochar}}" val1="{{ $permitproces->permit_desc }}"
                                                           data-target="#UpdatescModal" class="btn btn-xs bg-gradient-info updatedoc"><i class="fa fa-close " title="Edit " ></i>Update</a>

                                                    <td>
                                                        <a href="{{ route('permitprocess.renew', $permitproces->id_permit_int) }}" class="btn btn-xs bg-gradient-primary "><i class="fa fa-refresh" title="detail"></i>Renew</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="enddocpermit({{$permitproces->id_permit_int}})" val="{{$permitproces->permit_trx_nochar}}" val1="{{ $permitproces->permit_desc }}"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-warning updatedoc"><i class="fa fa-close " title="Edit " ></i>End</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                    </td>


                                            </tr>

                                        @endforeach

                                    </table>
                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="saveclosepermitForm" method="post" enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">END FORM</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar" placeholder="Number" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Desc</label>
                                                            <div class="col-sm-8">
                                                                <textarea name="permit_desc" id="permit_desc" rows="2" class="form-control form-control-sm" readonly></textarea>
                                                                  </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Reason </label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_cancel_reason" placeholder="Number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Doc Meter(PDF File Only)</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::hidden('bill_meter', null,['id'=>'sheet']) !!}
                                                                {!! Form::file('bill_meter', null,['id'=>'sheet']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-4 col-form-label"> Doc Billing(PDF File Only)</label>
                                                                <div class="col-sm-8">
                                                                    {!! Form::hidden('bill_doc', null,['id'=>'sheet']) !!}
                                                                    {!! Form::file('bill_doc', null,['id'=>'sheet']) !!}
                                                                </div>
                                                               </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Note</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_trx_nochar" placeholder="Note">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Cancel date</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" type="date" name="permit_cancel_date" placeholder="date ">
                                                            </div>
                                                        </div>

                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="formSubmit()">Process</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>

                    </section>
                </div>
            </div>
        </div>

    </div>
    <div id="CancelModal" class="modal fade cancelpermit" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="cancelform" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Cancel Permit</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar_cancel" placeholder="note" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-4 col-form-label">Reason</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="permit_cancel_reason" id="permit_cancel_reason" placeholder="note">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="permit_descmodal" name="permit_desc" rows="3"></textarea>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <center>

                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approvecancel()">Save</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="CancelModal" class="modal fade cancelpermit" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="cancelform" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Update Permit</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar_cancel" placeholder="note" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Update date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" name="receipt_date" value="{{date('Y-m-d')}}" readonly>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <center>

                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approvecancel()">Save</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function enddocpermit(id)
        {

            var id = id;
            var url = '{{ route("permitprocess.saveclosepermit", ":id") }}';
            url = url.replace(':id', id);
            $("#saveclosepermitForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#saveclosepermitForm").submit();
        }
        function cancelpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.approvedcancelpermit", ":id") }}';
            url = url.replace(':id', id);

            $("#cancelform").attr('action', url);
        }
        function approvecancel()
        {
            $("#cancelform").submit();
        }
         function updateservicedate(id)
             {

                 var id = id;
                 var url = '{{ route("permitprocess.updatescdate", ":id") }}';
                 url = url.replace(':id', id);
                 $("#saveclosepermitForm").attr('action', url);
             }
        function approvescupdatel()
        {
            $("#cancelform").submit();
        }


    </script>
    <script>
        $(document).ready(function(){
            $(function () {
                $('#judul_permit').tooltip();
            })

            $(".renew").click(function(){
                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(1)").val(); // prmit id
                var col5=currentRow.find("td:eq(5)").find('#permit_expire_date_hidden').val(); //expire date
                var col6=currentRow.find("td:eq(1)").find('#id_permitdt').val();
                var col4=currentRow.find("td:eq(2)").html(); // prmit number
              //  alert(col5);

                // var col4=currentRow.find("td:eq(2)").find('#permit_gov_status_old1').val();
                // var col5=currentRow.find("td:eq(0)").find('#id_permit_int_hidden').val();
                // var col9=currentRow.find("td:eq(9)").html();
                // var col10=currentRow.find("td:eq(10)").html();

                // get current row 3rd table cell  TD value
                // var col4=currentRow.find("td:eq(4)").html();
                // var col5=currentRow.find("td:eq(5)").html();
                //
                // document.getElementById('no_unit').value = col1;
                // document.getElementById('cust_id').value = col2;
                // document.getElementById('cust_name').value = col3;
                // document.getElementById('building').value = col4;
                // document.getElementById('BOOKING_CODE').value = col5;
                $('#permit_nochar').val(col4);
                $('#permit_expire_date').val(col5);
                $('#permit_etd_date').val(col6);
                // $('#permit_gov_status_old').val(col4);
                // $('#id_permit_int').val(col5);
                // $('#permit_descmodal').val(col9);
                //
                // $('#permit_gov_status ').val(col10);
                // $('#unitModal').modal('hide');
            });

            $('#permitlist').dataTable({
                "scrollX": true,
                  dom: 'Bfrtip',
                  buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $(document).on('click','.updatedoc', function () {
                getVal = $(this).attr('val');
                desc = $(this).attr('val1');
                $('#permit_trx_nochar').val(getVal);
                $('#permit_desc').val(desc);

            });

            $(document).on('click','.cancelbtn', function () {
                getVal = $(this).attr('val');
                $('#permit_trx_nochar_cancel').val(getVal);

            });



        });


    </script>
@endsection


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
                                Permit Approval

                                </div>
                                <div class="card-body ">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <h3>Permit Approval</h3>
                                            <table class="table table-bordered table-hover nowrap " id="permitlist">
                                                <thead>
                                                <tr >
                                                    <th> No</th>
                                                    <th> Permit Number</th>
                                                    <th >Permit Name</th>
                                                    <th>Issue By</th>

                                                    <th>Expired Date</th>

                                                    <th>File</th>
                                                    <th></th>
                                                    <th></th>

                                                </tr>
                                                </thead>
                                                @foreach($permitprocess as $permitproces)
                                                    <tr >
                                                        <?php
                                                        $ticketTime = strtotime($permitproces->permit_expire_date);
                                                        $difference = $ticketTime - time(); ?>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $permitproces->permit_trx_nochar }}
                                                        </td>
                                                        <td>{{ $permitproces->id_permitdt }}</td>
                                                        <td>{{ $permitproces->id_instansi_int }}</td>

                                                        <td>{{ date('d-m-Y', strtotime($permitproces->permit_expire_date)) }}</td>

                                                        <td> <a href="{{ URL('/download/'.$permitproces->permit_doc_approved_name) }}" target="_blank">{{$permitproces->permit_doc_approved_name}}</a></td>

                                                        {{--                                                    <td>{{ round($difference / 86400) }}</td>--}}

                                                        <td>

                                                            <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                               data-target="#DeleteModal" class="btn btn-xs bg-gradient-info "><i class="fa fa-check " title="Edit " ></i>Approve</a>

                                                        </td>
                                                        <td>

                                                            <a href="javascript:" data-toggle="modal" onclick="resetpermit({{$permitproces->id_permit_int}})"
                                                               data-target="#ResetModal" class="btn btn-xs bg-gradient-danger "><i class="fa fa-close " title="Edit " ></i>Reset</a>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </table>
                                        </div>
                                        <div class="col-md-12">

                                            <h3>Cancel/End Approval</h3>
                                            <table class="table table-bordered table-hover nowrap " id="permitlist1">
                                                <thead>
                                                <tr >
                                                    <th> No</th>
                                                    <th> Permit Number</th>
                                                    <th >Permit Name</th>
                                                    <th>PIC </th>
                                                    <th> Note</th>
                                                    <th></th>
                                                    <th>File</th>
                                                    <th></th>
                                                    <th></th>

                                                </tr>
                                                </thead>
                                                @foreach($cancelpermits as $permitproces)
                                                    <tr >
                                                        <?php
                                                        $ticketTime = strtotime($permitproces->permit_expire_date);
                                                        $difference = $ticketTime - time(); ?>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $permitproces->permit_trx_nochar }}
                                                        </td>
                                                        <td>{{ $permitproces->id_permitdt }}</td>

                                                        <td>{{ $permitproces->permit_pic_userid }}</td>
                                                        <td>{{ $permitproces->permit_desc }}</td>
                                                        <td></td>
                                                        <td>
                                                            <a href="{{ URL('/download/'.$permitproces->permit_doc_approved_name) }}" target="_blank">{{$permitproces->permit_doc_approved_name}}</a>
                                                        </td>
                                                        <td>

                                                            <a href="javascript:" data-toggle="modal" onclick="approvecancelpermit({{$permitproces->id_permit_int}})"
                                                               data-target="#ApprovecancelModal" class="btn btn-xs bg-gradient-info "><i class="fa fa-check " title="Edit " ></i>Approve</a>

                                                        </td>
                                                        <td>

                                                            <a href="javascript:" data-toggle="modal" onclick="unapprovecancelpermit({{$permitproces->id_permit_int}})"
                                                               data-target="#ResetModal" class="btn btn-xs bg-gradient-danger "><i class="fa fa-close " title="Edit " ></i>Reset</a>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </table>
                                        </div>

                                    </div>

                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">APPROVE CONFIRMATION</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <p class="text-center">Your document has been upload ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approve()">Approve</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="ResetModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="resetform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">RESET CONFIRMATION</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <p class="text-center">This action will reset to "REQUEST"</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="resetform()">Reset</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="ApprovecancelModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approvecancelform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">END CONFIRMATION</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <p class="text-center">This action will end permit/Contract</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="cancelapproveform()">Reset</button>
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
    <script type="text/javascript">

        function approvedocpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.approvedoc", ":id") }}';
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }


        function approve()
        {
            $("#approveform").submit();
        }



        function resetpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.resetpermit", ":id") }}';
            url = url.replace(':id', id);

            $("#resetform").attr('action', url);
        }


        function resetform()
        {
            $("#resetform").submit();
        }

        function approvecancelpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.approveclosepermit", ":id") }}';
            url = url.replace(':id', id);

            $("#approvecancelform").attr('action', url);
        }

        function cancelapproveform()
        {
            $("#approvecancelform").submit();
        }


        function unapprovecancelpermit(id)
        {
            //cancel approve
            var id = id;
            var url = '{{ route("permitprocess.approveclosepermit", ":id") }}';
            url = url.replace(':id', id);

            $("#resetform").attr('action', url);
        }

    </script>
    <script>
        $(document).ready(function(){


            $('#permitlist').dataTable({
                "scrollX": true,
                  dom: 'Bfrtip',
                  buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
            $('#permitlist1').dataTable({
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
                $('#permitochar_modal').val(getVal);

            });

        });


    </script>
@endsection


@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container-fluid">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-info mt-3">
                                <div class="card-header">
                                List pembayaran
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">

                                        <a href="{{ route('pembayaran.create') }}" class="btn bg-gradient-primary  btn-sm">Tambah Pembayaran</a>

                                    </div>
                                    <div>
                                        @include('layouts.flash-message')
                                    </div>

                                    <table class="table table-bordered table-hover dataTable" id="coalist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th>No Doc</th>
                                            <th >Nama bank</th>
                                            <th>Tgl bayar </th>
                                            <th >Catatan</th>
                                            <th>Jumlah </th>
                                            <th>Status</th>
                                            
                                            <th  colspan="3"><center>Action</center></th>


                                        </tr>
                                        </thead>
                                        @foreach($spmbayar as $spmbyr)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $spmbyr->spmbayar_nochar }}</td>
                                                <td>{{ $spmbyr->nama_bank }}</td>
                                                <td>{{ $spmbyr->spmbayar_tgl_bayar }}</td>
                                                <td>{{ $spmbyr->spmbayar_catatan }}</td>
                                                  <td>{{ $spmbyr->spmbayar_nominal }}</td>
                                                  <td>@if ($spmbyr->spmbayar_status==0)
                                                      Request
                                                  @else
                                                      Approved
                                                  @endif </td>
                                             

                                                    <td>
                                                         
                                                        <a href="{{ route('pembayaran.edit', $spmbyr->id_bayar ) }}" class="btn  btn-xs bg-gradient-warning ">Edit</a>
                                                    </td>
                                                    <td> 

                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{ $spmbyr->id_bayar }})"
                                                            data-target="#DeleteModal" class="btn btn-xs bg-gradient-info updatedoc">Appove
                                                        </a>
 
                                                   </td> 
                                                        
                                                        {{-- <a href="{{ route('pembayaran.approve', $spmbyr->id_bayar ) }}" class="btn  btn-xs bg-gradient-success ">Approve</a> --}}
                                                    
                                                   
                                                        <td>
                                                            <a href="#" class="btn btn-xs bg-gradient-danger"
                                                               data-toggle="modal"
                                                               data-target="#konfirmasiHapus{{ $spmbyr->id_bayar }}">Delete</a>
                                                        </td>
                                                        
                                            </tr>

                                        @endforeach

                                    </table>

                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Approve</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                  <h4> Yakin mau approve pembayaran ini? </h3>
                                                                  

                                                            </div>
                                                        </div>


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
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="konfirmasiHapus{{ $spmbyr->id_bayar }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiHapusLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pembayaran ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                {{-- <a href="{{ route('pembayaran.delete', $spmbyr->id_bayar ) }}" class="btn btn-danger">Ya, Hapus</a> --}}
            </div>
        </div>
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
            var url = '{{ route("pembayaran.approve", ":id") }}';
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }

    </script>
    <script>
        $(document).ready(function(){

            $(".updatedoc").click(function(){
                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
                var col2=currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
                var col3=currentRow.find("td:eq(3)").html();
                var col4=currentRow.find("td:eq(4)").html();
                var col5=currentRow.find("td:eq(5)").html();
                var col6=currentRow.find("td:eq(6)").html();


                $('#PROJECT_NAME').val(col1);
                $('#PROJECT_CODE').val(col2);
                $('#PROJECT_DESC').val(col3);
                $('#GM_NAME').val(col6);
                $('#DIR_OPS_MAIL').val(col4);
                $('#GM_MAIL').val(col5);
                // $('#unitModal').modal('hide');
            });

            $('#coalist').dataTable();
            const Toast = Swal.mixin({
                toast: true,
                showConfirmButton: false,
                timer: 3000
            });

            var max_fields = 10; //Maximum allowed input fields
            var wrapper    = $(".cheklist"); //Input fields wrapper
            var add_button = $(".add_button"); //Add button class or ID
            var x = 1; //Initial input field is set to 1

        //    When user click on add input button
            $(add_button).click(function(e){
                e.preventDefault();
                //Check maximum allowed input fields
                if(x < max_fields){
                    x++; //input field increment
                    //add input field
                    $(wrapper).append('<div><input type="text" name="permit_doc[]" class="mb-1" placeholder="Input Text Here"> <a href="javascript:void(0);" class="remove_field" >Remove</a></div>');
                }
            });
//
         //   when user click on remove button
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //remove inout field
                x--; //inout field decrement
            });

            $('#submit').on('click',function() {

                if ($('#permit_cat').val() === '') {
                    Toast.fire({
                        type: 'error',
                        title: 'Please Choose Category'
                    });
                    $('#permit_cat').focus();
                    return false;
                }
                if ($('#permit_description').val() === '') {
                    Toast.fire({
                        type: 'error',
                        title: 'Permit Item Required'
                    });
                    $('#permit_description').focus();
                    return false;
                }


            });

        });


    </script>
@endsection



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
                                List Anggota
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">

                                        <a href="{{ route('anggota.create') }}" class="btn bg-gradient-primary  btn-sm">tambah Anggota</a>

                                    </div>
                                    <div  class="row">
                                        @include('layouts.flash-message')
                                    </div>

                                    <table class="table table-bordered table-hover dataTable" id="coalist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >NIK </th>
                                            <th>Nama Anggota </th>
                                            <th>Gabung Perusahaan</th>
                                            <th>Gabung Koperasi</th>
                                            <th>Status</th>
                                            <th >Proyek</th>
                                            <th>Divisi</th>
                                            <th>jabatan</th>
                                            <th>Pnd Terakhir</th>
                                            <th>nama Sutri</th>
                                            <th>Pek Sutri</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        @foreach($anggota as $agt)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $agt->nik_karyawan }}</td>
                                                <td>{{ $agt->nama_karyawan }}</td>
                                                <td>{{ $agt->tanggal_join_karyawan }}</td>
                                                <td>{{ $agt->tgl_join_koperasi }}</td>
                                                <td>{{ $agt->status_karyawan }}</td>
                                                <td>{{ $agt->project_name }}</td>
                                                <td>{{ $agt->nama_divisi }}</td>
                                                <td>{{ $agt->nama_jabatan }}</td>
                                                <td>{{ $agt->pend_terakhir }}</td>
                                                <td>{{ $agt->nama_sutri }}</td>
                                                <td>{{ $agt->pek_sutri }}</td>
                                                    <td>
                                                        {{-- <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{ $agt->id_anggota}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-info updatedoc"><i class="fa fa-edit" title="Edit " ></i>Detail</a> --}}

                                                       <a href="{{ route('anggota.edit', $agt->id_anggota) }}" class="btn  btn-xs bg-gradient-warning">Edit</a></td>
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="rejectdoc({{ $agt->id_anggota}})"
                                                            data-target="#RejectModal" class="btn btn-xs bg-gradient-danger updatedoc">Delete</a>
 
                                                      {{-- <a href="{{ route('anggota.destroy', $agt->id_anggota) }}" class="btn  btn-xs bg-gradient-danger ">Delete</a> --}}
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
                                                        <h4 class="modal-title text-center">Edit Project</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Project Name </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="PROJECT_NAME" id="PROJECT_NAME" placeholder="project Name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Project Desc </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="PROJECT_DESC" id="PROJECT_DESC" placeholder="project Name"  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Project Code </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="PROJECT_CODE" id="PROJECT_CODE" placeholder="project Name" READONLY >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">GM Name</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="GM_NAME" id="GM_NAME" placeholder="Gm Name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Dir Ops Email</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="DIR_OPS_MAIL" id="DIR_OPS_MAIL" placeholder="Dir Ops Email" type="email" REQUIRED>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">GM email</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="GM_MAIL" id="GM_MAIL" placeholder="GM email" type="email" REQUIRED>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approve()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div id="RejectModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="Rejectform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Delete Anggota</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">
                                                                        <h3>Yakin mau hapus data ini?</h3>
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="reject()">Reject</button>
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
            {{--var url = '{{ route("project.saveedit", ":id") }}';--}}
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }
  function rejectdoc(id){

          var id = id;
           url = '{{ route("anggota.reject", ":id") }}';
            url = url.replace(':id', id);
            $("#Rejectform").attr('action', url);
  }

  function reject()
        {
            $("#Rejectform").submit();
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

            $('#coalist').dataTable( {
                "paging":true,
                "scrollX": true,
                // dom: 'Bfrtip'
            });
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



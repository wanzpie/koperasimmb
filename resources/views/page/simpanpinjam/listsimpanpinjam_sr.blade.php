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
                                Daftar Simpanan Sukarela
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">

                                        <a href="{{ route('simpanan_sr.create') }}" class="btn bg-gradient-primary  btn-sm">Tambah Simp Sukarela</a>

                                    </div>
                                    <div class="row">
                                        @include('layouts.flash-message')
                                    </div>

                                    <table class="table table-bordered table-hover dataTable" id="coalist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th>No Simpanan</th>
                                            <th >NIK karyawan</th>
                                            <th>Nama karyawan</th>
                                            <th>Tgl Gabung koperasi</th>
                                            <th>Divisi</th>
                                            <th>Simpanan sukarela</th>
                                            <th  colspan="2">Action</th>


                                        </tr>
                                        </thead>
                                        @foreach($spm_sr as $spmsr)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $spmsr->spmhd_nochar }}</td>
                                                <td>{{ $spmsr->nik_karyawan }}</td>
                                                <td>{{ $spmsr->nama_karyawan }}</td>
                                                <td>{{ $spmsr->tgl_join_koperasi }}</td>
                                                <td>{{ $spmsr->nama_divisi }}</td>
                                                <td>{{ $spmsr->spmhd_nominal }}</td>

                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{ $listproject->PROJECT_NO_CHAR}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-info updatedoc">Edit</a>
                                              <td>
                                                    
                                                        <a href="javascript:" data-toggle="modal" onclick="rejectdoc({{ $spmsr->id_spmhd}})"
                                                            data-target="#konfirmasiHapus" class="btn btn-xs bg-gradient-danger approverejectdoc">Delete
                                                         </a>
                                                        
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
                                                        <h4 class="modal-title text-center">Edit Sukarela</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">No simpanan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="no_simpanan" id="no_simpanan" placeholder="project Name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">NIK Karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nik_karyawan" id="nik_karyawan" placeholder="project Name"  readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nama_karyawan" id="nama_karyawan" placeholder="project Name" READONLY >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Gabung</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="tgl_gabung" id="tgl_gabung" placeholder="Gm Name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Divisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="divisi" id="divisi" placeholder="Dir Ops Email" type="email" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nom Sukarela</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" class="form-control form-control-sm" name="nom_sukarela" id="nom_sukarela" placeholder="nom_sukarela"  >
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

                                     <!-- Modal Konfirmasi Hapus -->
                                     <div id="konfirmasiHapus" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="rejectform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Delete </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                    
                                                                <div class="form-group row">
                                                                          <h4>Yakin data ini mau di hapus?</h4>                                
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="reject()">Approve</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
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
//reject popup form
        function rejectdoc(id)
        {
            var id = id;
             url = '{{ route("simpanan_sr.deletesr", ":id") }}';
            url = url.replace(':id', id);

            $("#rejectform").attr('action', url);
        }
        function reject()
        {
            $("#rejectform").submit();
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


                $('#no_simpanan').val(col1);
                $('#nik_karyawan').val(col2);
                $('#nama_karyawan').val(col3);
                $('#tgl_gabung').val(col4);
                $('#divisi').val(col5);
                $('#nom_sukarela').val(col6);
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



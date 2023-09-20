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
                                Daftar Simpan Pinjam
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">

                                        <a href="{{ route('peminjaman.createspm') }}" class="btn bg-gradient-primary  btn-sm">Tambah Pinjaman</a>

                                    </div>
                                    <div class="row">@include('layouts.flash-message')</div>

                                    <table class="table table-bordered table-hover dataTable" id="listpinjam">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th>No Pinjaman</th>
                                            <th >NIK </th>
                                            <th >Nama </th>
                                            <th >Divisi</th>
                                            <th > Pinjaman</th>
                                            <th>Tgl Pinjaman</th>
                                            <th>Periode(bln)</th>
                                            <th>Deskripsi </th>
                                            <th>Nominal </th>
                                            <th> Status</th>
                                            <th></th>
                                            <th ><center>Action</center></th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        @foreach($spmpinjams as $spmpinjam)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $spmpinjam->spmhd_nochar }}</td>
                                                <td>{{ $spmpinjam->nik_karyawan }}</td>
                                                <td>{{ $spmpinjam->nama_karyawan }}</td>
                                                <td>{{ $spmpinjam->nama_divisi }}</td>
                                                <td>@if($spmpinjam->jenis_spmhd=='KRU')
                                                         Uang
                                                        @else
                                                     Barang 
                                                    @endif
                                                     </td>
                                                <td>{{ $spmpinjam->tgl_pengajuan }}</td>
                                                <td>{{ $spmpinjam->spm_period }}</td>
                                                <td>{{ $spmpinjam->spm_catatan }}</td>
                                                <td>{{ $spmpinjam->spmhd_nominal }}</td>
                                                <td>{{ $spmpinjam->spm_status }}</td>

                                                    
                                                        @if($spmpinjam->is_generate==0)
                                                        <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="spmsaveedit({{ $spmpinjam->id_spmhd}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-warning updatedoc">Edit
                                                        </a>
                                                        </td>

{{--                                                        <a href="{{ route('project.edit', $listproject->PROJECT_NO_CHAR) }}" class="btn  btn-xs bg-gradient-success">Edit</a></td>--}}
                                                    <td>

                                                       
                                                        <a href="javascript:" data-toggle="modal" onclick="generatesch({{ $spmpinjam->id_spmhd}})"
                                                            data-target="#GenerateModal" class="btn btn-xs bg-gradient-info generatedoc">generate
                                                        </a>
                                                    </td> 
                                                        <td>
                                                            <a href="javascript:" data-toggle="modal" onclick="rejectdoc({{ $spmpinjam->id_spmhd}})"
                                                                data-target="#konfirmasiHapus" class="btn btn-xs bg-gradient-danger approverejectdoc">Delete
                                                             </a>
                                                            
                                                        </td>
                                                    @else
                                                     <td>
                                                    <a href="{{ route('peminjaman.spmupdate', $spmpinjam->id_spmhd) }}" class="btn bg-gradient-warning btn-xs disabled">edit</a>
                                                     
                                                     </td>
                                                     <td>

                                                    <a href="{{ route('peminjaman.spmupdate', $spmpinjam->id_spmhd) }}" class="btn bg-gradient-info btn-xs disabled">generated</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('peminjaman.spmdelete', $spmpinjam->id_spmhd) }}" class="btn bg-gradient-danger btn-xs disabled">delete</a>
                                               
                                                </td>
                                                    @endif
                                                    
                                                    
                                                    
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
                                                        <h4 class="modal-title text-center">Edit </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">No Pinjaman</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="spmhd_nochar" id="spmhd_nochar" placeholder="project Name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">NIK karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nik_karyawan" id="nik_karyawan" placeholder="project Name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nama_karyawan" id="nama_karyawan" placeholder="nama_karyawan"  readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">tanggal pinjaman</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="tanggal_pinjaman" id="tanggal_pinjaman" placeholder="project Name" READONLY >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Periode</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="periode" id="periode" placeholder="Gm Name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Catatan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="spm_catatan" id="spm_catatan" placeholder="Catatan" type="email" REQUIRED>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nominal</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="spm_nominal" id="spm_nominal" placeholder="Nominal" type="email" REQUIRED>
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
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approverejectdoc()">Approve</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="GenerateModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="generateform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Generate jadwal </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nama_karyawan" id="gen_nama_karyawan" placeholder="project Name" readonly>
                                                                        <input type="hidden" class="form-control form-control-sm" name="id_project" id="id_project"value="{{$id_project}}" >
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Tgl Awal </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="date" class="form-control form-control-sm" name="tgl_sch_awal" id="gen_tgl_sch_awal" placeholder="project Name"  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Jumlah</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="spm_nominal" id="gen_spm_nominal" placeholder="project Name" READONLY >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">periode</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="periode" id="gen_periode" placeholder="Gm Name" >
                                                                    </div>
                                                                </div>
                                                               

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="gensch()">Generate</button>
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



        function spmsaveedit(id)
        {
            var id = id;
            var url = '{{ route("peminjaman.spmupdate", ":id") }}';
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }

        function generatesch(id)
        {
            var id = id;
            var url = '{{ route("peminjaman.generatesch", ":id") }}';
            url = url.replace(':id', id);

            $("#generateform").attr('action', url);
        }
        function gensch(){
            $("#generateform").submit();
        }

        function rejectdoc(id)
        {
            var id = id;
            var url = '{{ route("peminjaman.inactive", ":id") }}';
            url = url.replace(':id', id);

            $("#rejectform").attr('action', url);
        }
        function approverejectdoc(){
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
                var col4=currentRow.find("td:eq(6)").html();
                var col5=currentRow.find("td:eq(7)").html();
                var col6=currentRow.find("td:eq(8)").html();
                var col7=currentRow.find("td:eq(9)").html();


                $('#spmhd_nochar').val(col1);
                $('#nik_karyawan').val(col2);
                $('#nama_karyawan').val(col3);
                $('#tanggal_pinjaman').val(col4);
                $('#periode').val(col5);
                $('#spm_catatan').val(col6);
                $('#spm_nominal').val(col7);
                
                // $('#unitModal').modal('hide');
            });
           
            $(".generatedoc").click(function(){
                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(3)").html(); // get current row 1st table cell TD value
                var col2=currentRow.find("td:eq(6)").html(); // get current row 2nd table cell TD value
                var col3=currentRow.find("td:eq(7)").html();
                var col4=currentRow.find("td:eq(9)").html();

                $('#gen_nama_karyawan').val(col1);
                $('#gen_tgl_sch_awal').val(col2);
                $('#gen_periode').val(col3);
                $('#gen_spm_nominal').val(col4);
                
                // $('#unitModal').modal('hide');
            });
            var table = $('#listpinjam').DataTable({
                "paging":true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ]});
            $(table.table().container()).on('keyup', 'tfoot input', function () {
                table.column($(this).data('index'))
                    .search(this.value, true, false)
                    .draw();
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



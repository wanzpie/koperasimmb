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
                                 Master Instansi
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">
                                        <a href="javascript:" data-toggle="modal" onclick="addData()"
                                           data-target="#AddModal" class="bg-gradient-primary btn ml-2 mr-3">Add Instansi </a>

                                        <a href="javascript:" data-toggle="modal" onclick="addDatalokasi()"
                                           data-target="#AddModallokasi" class="bg-gradient-navy btn">Add Location </a>
                                      </div>
                                    <table class="table table-bordered table-hover dataTable" id="coalist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >Name</th>
{{--                                            <th>Location</th>--}}

                                            <th >Edit</th>
{{--                                            <th ></th>--}}

                                        </tr>
                                        </thead>
                                        @foreach($instansi as $instans)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $instans->nama_instansi }}</td>
{{--                                                <td>{{ $instans->name_lokasi }}</td>--}}
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal"  val="{{$instans->id}}" onclick="editinstansi({{$instans->id}})"
                                                           data-target="#editModal" class="btn btn-xs bg-gradient-info  editclass">Edit</a>
                                                    </td>
{{--                                                    <td><a href="{{ route('instansi.destroy', $instans->id) }}" class="btn  btn-xs bg-gradient-danger">Delete</a></td>--}}
                                            </tr>

                                        @endforeach

                                    </table>
                                    <div id="AddModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="deleteForm" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input class="form-control form-control-sm" type="text" name="nama_instansi" id="name"  />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Location</label>
                                                            <select name="lokasi_id" class="form-control form-control-sm" id="lokasi_id" >
                                                            <option value="">---Select---</option>
                                                            @foreach($lokasi as $div)
                                                                <option value="{{ $div->id }}">{{ $div->name_lokasi }}</option>
                                                                @endforeach
                                                                </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="formSubmit()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="AddModallokasi" class="modal fade " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="modallokasiform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group">
                                                            <label for="name">Location name</label>
                                                            <input class="form-control form-control-sm" type="text" name="name_lokasi" id="name"  />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="formSubmitlokasi()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Edit Instansi</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Id</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="id_instansi" id="id_instansi" placeholder="note" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="name_instansi" id="name_instansi" placeholder="name" >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary " data-dismiss="modal" onclick="approve()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="editModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="lokasiform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group">
                                                            <label for="name">Id Instansi</label>
                                                            <input class="form-control form-control-sm" type="text" name="edit_id_instansi" id="edit_id_instansi"  readonly />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Id Instansi</label>
                                                            <input class="form-control form-control-sm" type="text" name="edit_name_instansi" id="edit_name_instansi"   />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="submiteditlokasi()">Save</button>
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
        {{--function approvedocpermit(id)--}}
        {{--{--}}
        {{--    var id = id;--}}
        {{--    var url = '{{ route("instansi.saveedit", ":id") }}';--}}
        {{--    url = url.replace(':id', id);--}}

        {{--    $("#approveform").attr('action', url);--}}
        {{--}--}}
        function addData()
        {
            var url = '{{ route("instansi.save") }}';
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }

        function addDatalokasi()
        {
            var url = '{{ route("lokasi.save") }}';
            $("#modallokasiform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }

        function formSubmitlokasi()
        {
            $("#modallokasiform").submit();
        }
        function editinstansi(id)
        {
            var id = id;
            var url = '{{ route("instansi.saveedit", ":id") }}';
            url = url.replace(':id', id);

            $("#lokasiform").attr('action', url);
        }
        function submiteditlokasi()
        {
            $("#lokasiform").submit();
        }

    </script>
    <script>
        $(document).ready(function(){

            $(".editclass").click(function() {
                var currentRow = $(this).closest("tr");
                var col0=currentRow.find("td:eq(0)").html();
                var col1=currentRow.find("td:eq(1)").html();
                $('#edit_id_instansi').val(col0);
                $('#edit_name_instansi').val(col1);
            });

            $('#coalist').dataTable();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


        });

        $('body').on('click', '.editclass', function () {
              getVal = $(this).attr('val');

            $.get('instansi' +'/' + getVal +'/edit', function (data) {
                $('#modelHeading').html("Edit Instansi");
                $('#saveBtn').val("edit-user");
                $('#editModel').modal('show');
                // $('#id_instansi').val(data.name);
                // $('#nama_instansi').val(data.detail);
            })
        });
        // $('body').on('click', '#editCompany', function (event) {
        //
        //     event.preventDefault();
        //     var id = $(this).data('id');
        //
        //     $.get(store+'/'+ id+'/edit', function (data) {
        //
        //         $('#userCrudModal').html("Edit company");
        //         $('#submit').val("Edit company");
        //         $('#modal-id').modal('show');
        //         $('#company_id').val(data.data.id);
        //         $('#name').val(data.data.name);
        //         $('#address').val(data.data.address);
        //     })
        // });

    </script>
@endsection


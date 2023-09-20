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
                                Project Detail
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">

                                        <a href="javascript:" data-toggle="modal" onclick="addData()"
                                           data-target="#AddModal" class="btn-primary bg-gradient-primary btn mr-3 ml-2">Tambah Project</a>

                                    </div>

                                    <table class="table table-bordered table-striped table-hover dataTable" id="coalist">
                                        <thead  class="" >
                                        <tr >
                                            <th> No</th>
                                            <th >Nama</th>
                                            <th>alamat</th>
                                            <th colspan="2" >Action</th>


                                        </tr>
                                        </thead>
                                        @foreach($project as $listproject)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $listproject->project_name }}</td>
                                                <td>{{ $listproject->alamat_project }}</td>

                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{ $listproject->project_no_char}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-info updatedoc"><i class="fa fa-edit" title="Edit " ></i>Edit
                                                        </a>

{{--                                                        <a href="{{ route('project.edit', $listproject->PROJECT_NO_CHAR) }}" class="btn  btn-xs bg-gradient-success">Edit</a></td>--}}
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="rejectdoc({{ $listproject->project_no_char}})"
                                                            data-target="#RejectModal" class="btn btn-xs bg-gradient-danger updatedoc">Reject
                                                         </a>
                                                        {{-- <a href="{{ route('project.destroy', $listproject->project_no_char) }}" class="btn  btn-xs bg-gradient-danger ">Disable</a> --}}
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

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="project_name" id="project_name" placeholder="project Name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="alamat_project" id="alamat_project" placeholder="project alamat"  >
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
                                    <div id="AddModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="addform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Tambah Project</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="project_name" id="project_name" placeholder="project Name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="alamat_project" id="alamat_project" placeholder="project alamat"  >
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="save()">Save</button>
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
                                                        <h4 class="modal-title text-center">Delete Project</h4>
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


        function addData()
        {

            var url = '{{ route("project.store") }}';
            $("#addform").attr('action', url);
        }
        function save()
        {
            $("#addform").submit();
        }

        function approvedocpermit(id)
        {
            var id = id;
            var url = '{{ route("project.saveedit", ":id") }}';
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }
       
        function rejectdoc(id){

        var id = id;
        url = '{{ route("project.reject", ":id") }}';
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


                $('#project_name').val(col1);
                $('#alamat_project').val(col2);

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



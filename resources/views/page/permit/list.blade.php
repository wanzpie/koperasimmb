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
                                Permit Detail
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">
                                        <a href="javascript:" data-toggle="modal" onclick="addData()"
                                           data-target="#AddModal" class="btn-primary bg-gradient-primary btn mr-3 ml-2">Add Detail</a>

                                        @if(Session::get('PROJECT_NO_CHAR')=='1')
                                            <a href="javascript:" data-toggle="modal" onclick="addDatalokasi()"
                                           data-target="#AddModallokasi" class="bg-gradient-navy btn">Add Category </a>
                                         @endif
                                     </div>
                                    <div class="row">
                                        <div class="col-md-6">@include('layouts.flash-message')</div>
                                    </div>
                                    <table class="table table-bordered table-hover dataTable" id="coalist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >Category</th>
                                            <th>Name</th>

                                            <th ></th>
                                            <th ></th>

                                        </tr>
                                        </thead>
                                        @foreach($permitdt as $listpermit)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $listpermit->nama_perijinan }}</td>
                                                <td>{{ $listpermit->permit_description }}</td>
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="editpermit({{$listpermit->id_permitdt}})"
                                                           data-target="#EditMPModal" val="{{$listpermit->id_permitdt}}" val1="{{$listpermit->permit_description}}" class="btn btn-xs bg-gradient-info edit_mp " >
                                                            <i class="fa fa-edit" title="upload" ></i>Edit
                                                        </a>

                                                    </td>
                                                    <td>
                                                        <a href="javascript:" data-toggle="modal" onclick="delpermit({{$listpermit->id_permitdt}})"
                                                           data-target="#DelMPModal" val="{{$listpermit->id_permitdt}}" class="btn btn-xs bg-gradient-danger del_mp " >
                                                            <i class="fa fa-trash" title="delete" ></i>Delete
                                                        </a>
                                                    </td>
                                            </tr>

                                        @endforeach

                                    </table>
                                    <div id="AddModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="savepermitForm" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gray-light">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group">
                                                                    <label for="name">Permit Category</label>
                                                                    <select name="permit_hd_int" class="form-control form-control-sm" id="permit_cat" >
                                                                        <option value="">---Select---</option>
                                                                        @foreach($permithd as $permith)
                                                                            <option value="{{ $permith->id }}">{{ $permith->nama_perijinan }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input class="form-control form-control-sm" type="text" name="permit_description" id="permit_description"  />
                                                                </div>

                                                                <div class="form-group cheklist">
                                                                    <label for="name">Checklist Document</label><br>

                                                                    <input  name="permit_doc[]" id="permit_doc" class="mb-1" />
                                                                </div>
                                                                    <p><a href="#" class="btn-info btn-sm mt-2 add_button">Add More </a></p>

                                                            </div>
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
                                                            <label for="name">Category name</label>
                                                            <input class="form-control form-control-sm" type="text" name="category_name" id="name"  />
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

                                    <div id="EditMPModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="editform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Edit </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group">
                                                            <label for="name">Permit ID</label>
                                                            <input class="form-control form-control-sm" type="text" name="permit_id" id="permit_id" readonly />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name">Permit name</label>
                                                            <input class="form-control form-control-sm" type="text" name="permit_name" id="permit_name"  />
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="submiteditpermit()">Submit</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="DelMPModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="delform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-danger">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Delete </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group">
                                                            <label for="name">Sure want to delete this Detail Permit?</br>
                                                            This action will hide all permit transaction in this category</label>
                                                          </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="submiteditpermit()">Submit</button>
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
            var url = '{{ route("permitdt.save") }}';
            $("#savepermitForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#savepermitForm").submit();
        }
        function addDatalokasi()
        {
            var url = '{{ route("permitct.save") }}';
            $("#modallokasiform").attr('action', url);
        }

        function formSubmitlokasi()
        {
            $("#modallokasiform").submit();
        }
        function editpermit(id)
        {
            var id = id;
            var url = '{{ route("permitdt.prmdtsaveedit", ":id") }}';
            url = url.replace(':id', id);

            $("#editform").attr('action', url);
        }
        function submiteditpermit()
        {
            $("#editform").submit();
        }
        function delpermit(id)
        {
            var id = id;
            var url = '{{ route("permitdt.delete", ":id") }}';
            url = url.replace(':id', id);

            $("#delform").attr('action', url);
        }
        function submitdelpermit()
        {
            $("#delform").submit();
        }

    </script>
    <script>
        $(document).ready(function(){

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
            $(".edit_mp").click(function() {

                var currentRow = $(this).closest("tr");
                var col1 = currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
                var col2 = currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
             //   $('#permit_id').val(col1);
               // alert(col2);
                $('#permit_name').val(col2);


            });
                $(document).on('click','.edit_mp', function () {
                getVal = $(this).attr('val');
                getVal1 = $(this).attr('val1');
                $('#permit_id').val(getVal);
                $('#permit_name').val(getVal1);

            });


        });


    </script>
@endsection



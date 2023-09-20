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
                                List  SHU Bagi hasil
                                </div>
                                <div class="card-body ">
                                   
                                    {!! Form::model('shu', [
                                        'method' => 'post',
                                        'route' => 'vwreportshu',
                                    ]) !!}
                                   <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="unit" class="col-sm-12 col-form-label">Pilih Period SHU</label>
                                                <div class="col-sm-6">
                                                    <select name="periodeshu" id="periodeshu"  class="custom-select select2-info">
                                                        <option value="">Pilih</option>
                                                        @for ($i = date('Y') - 1; $i <= date('Y') + 5; $i++)
                                                            <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="submit" value="tampilkan" class="btn btn-primary" />
                                           
                                                </div>
                                            </div>
                                       
                                        </div>
                
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="form-group row">
                                                <label for="unit" class="col-sm-6 col-form-label"></label>
                                               
                                                <div class="col-sm-6">   
                                                 </div>    
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <div class="row"></div>
                
                                    {!! Form::close() !!}<br><br><br><br>
                                    <div class="row"></div>
                                    @if (isset($result))
                                    <div class="row"> <h3>bagi Hasil  SHU periode {{$periode}} </h3><br></div>
                                    <div class="row">
                                       
                                        <table class="table table-bordered table-hover dataTable nowrap" id="listshu">
                                            <thead>
                                            <tr >
                                                <th> No</th>
                                                <th >NIK </th>
                                                <th>Nama Anggota </th>
                                                <th>Project </th>
                                                <th>Tanggal Join</th>
                                               <th >Total Simpanan Pokok</th>
                                                <th >Total Sukarela</th>
                                                <th >bagi hasil Pinjaman</th>
                                                <th >bagi hasil SHU</th>
                                              
    
                                            </tr>
                                            </thead>
                                            @foreach($result as $agt)
                                                <tr >
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $agt->nik_karyawan }}</td>
                                                    <td>{{ $agt->nama_karyawan }}</td>
                                                    <td>{{ $agt->project_name }}</td>
                                                    <td>{{ $agt->tgl_join_koperasi }}</td>
                                                    <td>{{ $agt->jum_simwa }}</td>
                                                    <td>{{ $agt->jum_simpsr }}</td>
                                                    <td>{{ $agt->bagihasil_pinjaman }}</td>
                                                     
                                                     <td>{{ $agt->nominal_shu }}</td>
                                                   
    
                                            @endforeach
    
                                        </table>
                                    </div>   

                                    @endif

                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">


        function editshu(id)
        {
            var id = id;
            var url = '{{ route("shu.saveedit", ":id") }}'; 
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
           $('#listshu').DataTable(
            {
                "paging":true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    {
            extend: 'print',
            orientation: 'landscape'}
                ]});
           
        });
    </script>  
    <script>
        $(document).ready(function(){
            $('#periodeshu').select2();
         
        
       
            $(".updatedoc").click(function(){
                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
                var col2=currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
                var col7=currentRow.find("td:eq(7)").html();
                var col8=currentRow.find("td:eq(8)").html();
                var col9=currentRow.find("td:eq(9)").html();
              

                $('#nik_karyawan').val(col1);
                $('#nama_karyawan').val(col2);
                $('#total_simpo').val(col7);
                $('#total_sim_sr').val(col8);
                $('#total_pinjaman').val(col9);
                
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



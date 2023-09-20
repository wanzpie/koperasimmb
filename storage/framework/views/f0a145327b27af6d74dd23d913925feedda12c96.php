<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container-fluid">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-info mt-3">
                                <div class="card-header">
                                List Point SHU 
                                </div>
                                <div class="card-body ">
                                    <div class="row mb-2">
                                    <h3>Point SHU tahun <?php echo e($company->year_period); ?></h3>
                                    </div>
                                    <div>
                                        <?php echo $__env->make('layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>

                                    <table class="table table-bordered nowrap table-hover dataTable" id="listshu">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >NIK </th>
                                            <th>Nama Anggota </th>
                                            <th>Project </th>
                                            <th>Tanggal Join</th>
                                            <th>Sim sukarela</th>
                                            <th >Total Pinjaman</th>
                                            <th >Total Simp Wajib</th>
                                            <th >Total Sukarela</th>
                                            <th >bagi hasil Pinjaman</th>
                                            <th >Point SHU</th>
                                            

                                        </tr>
                                        </thead>
                                        <?php $__currentLoopData = $datashu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr >
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($agt->nik_karyawan); ?></td>
                                                <td><?php echo e($agt->nama_karyawan); ?></td>
                                                <td><?php echo e($agt->project_name); ?></td>
                                                <td><?php echo e($agt->tgl_join_koperasi); ?></td>
                                                <td><?php echo e($agt->simp_sukarela); ?></td>
                                                <td><?php echo e($agt->pinjaman1); ?></td>
                                                <td><?php echo e($agt->jum_simwa); ?></td>
                                                <td><?php echo e($agt->jum_simpsr); ?></td>
                                                <td><?php echo e($agt->bagihasil_pinjaman); ?></td>
                                                 
                                                 
                                                 <td><?php echo e(($agt->jum_simwa/1000)+($agt->jum_simpsr/2000)+($agt->bagihasil_pinjaman/2000)); ?></td>
                                                 

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </table>

                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Edit Point</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <?php echo e(csrf_field()); ?>

                                                                <?php echo e(method_field('POST')); ?>

                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">NIK Karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nik_karyawan" id="nik_karyawan" placeholder="project Name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Karyawan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="nama_karyawan" id="nama_karyawan" placeholder="project Name"  readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Simpanan Pokok</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="total_simpo" id="total_simpo" placeholder="Total Simpanan Pokok"  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Simpanan Sukarela</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="total_sim_sr" id="total_sim_sr" placeholder="total simpanan sukarela" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Bagi hasil Pinjaman</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm" name="total_pinjaman" id="total_pinjaman" placeholder="Total Pinjaman"  REQUIRED>
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
            var url = '<?php echo e(route("shu.saveedit", ":id")); ?>'; 
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
         
            var table = $('#listshu').DataTable({
                "paging":true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'print',
                    'excelHtml5',
                    'pdfHtml5'
                ]});
            $(table.table().container()).on('keyup', 'tfoot input', function () {
                table.column($(this).data('index'))
                    .search(this.value, true, false)
                    .draw();
            });
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/shu/list.blade.php ENDPATH**/ ?>
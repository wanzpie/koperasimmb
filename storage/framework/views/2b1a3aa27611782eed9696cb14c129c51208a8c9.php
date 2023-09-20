<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h4>Tambah Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <?php echo Form::model('pembayaran', [
  'method' => 'post',
  'route' => 'pembayaran.store',
]); ?>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="client" class="col-sm-4 col-form-label">Bank account</label>
                                    <div class="col-sm-8">
                                        <select name="spmbayar_bank_id"
                                                class="custom-select select2-info"
                                                id="id_bank" style="width:100%" required>
                                                <option value="">Pilih</option>

                                            <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bnk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($bnk->id_bank); ?>" data-id="<?php echo e($bnk->id_bank); ?>"><?php echo e($bnk->nama_bank); ?>-<?php echo e($bnk->deskripsi); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>   </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label">Tanggal masuk </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control form-control-sm" name="spmbayar_tgl_bayar"  placeholder="tgl bayar" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control  form-control-sm" name="spmbayar_catatan" placeholder="catatan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label">Nominal</label>
                                    <div class="col-sm-8">
                                        <input class="form-control  form-control-sm" id="spmbayar_nominal" NAME="spmbayar_nominal" type="number" placeholder="nominal" required>
                                   </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label"> Pilih Project</label>
                                    <div class="col-sm-8">
                                        <select name="id_project"
                                                class="custom-select select2-info"
                                                id="id_project" style="width:100%" required>
                                                <option value="0">Pilih</option>

                                            <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($prj->project_no_char); ?>" data-id="<?php echo e($prj->project_no_char); ?>"><?php echo e($prj->project_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>  </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover dataTable" id="listpinjam">
                                    <thead>
                                    <tr >
                                        <th> No</th>
                                        
                                        <th>No DOc</th>
                                        <th >Nama </th>
                                        <th>Jenis SPM</th>
                                        <th > Invoice</th>
                                        <th>Tgl schedule</th>
                                        <th>Nominal</th>
                                        <th>bagi hasil</th>
                                        <th>Bayar</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 "> <input type="submit" value="Simpan" class="btn btn-primary" />
                                <a class="btn btn-warning" href="<?php echo e(route('pembayaran.create')); ?>">Reset</a>

                            <a class="btn btn-danger" href="<?php echo e(route('pembayaran.index')); ?>">kembali</a></div>

                        </div>

                        <?php echo Form::close(); ?>

                    </div>
                    <div class="card-footer">
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#id_bank').select2();
                $('#id_project').select2();
            });
            $('#id_anggota').change(function () {

                var value = $("#id_anggota").select2().find(":selected").data("id");
                var splitval = value.split(',');

                $('#nama_karyawan').val(splitval[0]);
                $('#jabatan').val(splitval[1]);

            });

            $('select[name="OPT_UTILITY_NOCHAR"]').on('change', function() {
                $('select[name="bill_type"]').empty();
                var subID = $(this).val();
                if(subID) {
                    $.ajax({
                        url: '/myform/ajax/'+subID,
                        type: "GET",
                        dataType: "json",

                        success:function(data) {
                            var myJson = JSON.stringify(data);
                            //  alert(myJson);
                            // $('select[name="item_id"]').empty();
                            $('select[name="bill_type"]').prepend("<option value='' selected='selected'>Select Type</option>");
                            $.each(data, function(key, value) {

                                $('select[name="bill_type"]').append('<option value="'+ value.MD_FORMULA_ID_INT +'-' +value.START_METER+'">'+ value.MD_FORMULA_NAME +'</option>');

                            });

                        }

                    });
                }else{
                    $('select[name="sub_kategori_id"]').empty();
                }
            });
        </script>
         <script>
            $(document).ready(function(){

                $('#id_project').on('change', function(){
                    var option = $(this).val();
    
                    // Buat AJAX request untuk mengambil data sesuai dengan opsi yang dipilih
                    $.ajax({
                        url: '/ambil-data-pinjaman/' + option,
                        type: 'GET',
                        success: function(data){
                            // Update tabel dengan data yang diterima
                            $('#listpinjam tbody').html(data);
                        }
                    });
                });
               
                $(document).on("change", ".bayar", function() {
                    // alert('stse');
                var akumulasiBayar = 0;
                $(".bayar").each(function(){
                    akumulasiBayar += +$(this).val();
                });
                $("#akumbayar").val(akumulasiBayar);
                var nominalPembayaran = parseFloat($("#spmbayar_nominal").val()) || 0;
            //    alert(nominalPembayaran);
               var selisih = nominalPembayaran - akumulasiBayar;
              $('#balance').val(selisih.toFixed(0)); // Menampilkan selisih dengan 2 desimal
   

                            });
              
       
            });

        </script>
      

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/pembayaran/form.blade.php ENDPATH**/ ?>
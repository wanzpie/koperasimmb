<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4>Form Pinjaman</h4>
                </div>
                <div class="card-body">
                    <?php echo Form::model('Msimpanpinjam_hd', [
         'method' => 'post',
         'route' => 'peminjaman.spmsimpan',
     ]); ?>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama Anggota</label>
                                <div class="col-sm-6">
                                    <select name="id_anggota"
                                            class="custom-select select2-info"
                                            id="id_anggota" style="width:100%">
                                        <option value=''>Pilih</option>
                                        <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         
                                            <option
                                                value="<?php echo e($data->id_anggota); ?>" data-id="<?php echo e($data->nama_karyawan); ?>"><?php echo e($data->nik_karyawan); ?>--<?php echo e($data->nama_karyawan); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nama_karyawan"  placeholder="nama" id="nama_karyawan" readonly>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Status Karyawan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="status_karyawan" style="width: 100%;" name="status_karyawan">
                                        <option value="">-- Status --</option>
                                        <option value="1">Tetap</option>
                                        <option value="2">Kontrak</option>

                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Tanggal pengajuan </label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="tgl_pengajuan_spm" placeholder="tgl pengajuan" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Catatan </label>
                                <div class="col-sm-6">
                                    <textarea id="spm_catatan" name="spm_catatan"  class="form-control" >

                                    </textarea>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Jenis Simpanpinjam</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="jenis_spmhd" style="width: 100%;" name="jenis_spmhd">
                                        <option value="0" >-- Jenis Pinjaman --</option>
                                        <option value="KRU">Pinjaman uang</option>
                                        <option value="KRB">Kredit barang</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama barang</label>
                                <div class="col-sm-6">
                                    <select name="id_barang"
                                            class="custom-select select2-info"
                                            id="id_barang" style="width:100%">
                                        <option value="0" >-- nama Barang --</option>

                                        <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brg->id_barang); ?>" data-id="<?php echo e($brg->harga_barang); ?>"><?php echo e($brg->nama_barang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Nominal </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="spmhd_nominal" name="spmhd_nominal" placeholder="Nominal" >

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Periode</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-sm" id="spm_period" name="spm_period" placeholder="bulan" >
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 "> <input type="submit" value="Simpan" class="btn btn-primary" />
                            <a class="btn btn-danger" href="<?php echo e(route('anggota.index')); ?>">kembali</a></div>

                    </div>

                    <?php echo Form::close(); ?>

                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
        <script>
            $(document).ready(function () {
                $('#id_anggota').select2();
                $('#id_project').select2();
                $('#id_barang').select2();
                $('#jenis_spmhd').val()

                $('#jenis_spmhd').change(function(){
                   var isi = $(this).val();
                   if(isi=='KRU'){
                       $("#id_barang").prop("disabled", true);
                   }else{
                       $("#id_barang").prop("disabled", false);
                   }
                });




                $('#id_anggota').change(function() {

                    var value=$("#id_anggota").select2().find(":selected").data("id");

                    $('#nama_karyawan').val(value);

                });
                $('#id_barang').change(function() {

                    var value=$("#id_barang").select2().find(":selected").data("id");

                    $('#spmhd_nominal').val(value);

                });
            });
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/simpanpinjam/formspm.blade.php ENDPATH**/ ?>
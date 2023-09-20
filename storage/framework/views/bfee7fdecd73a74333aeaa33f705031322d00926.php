<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Form generate SHU</h3>
                </div>
                <div class="card-body">
                    <?php echo Form::model('shu', [
                        'method' => 'post',
                        'route' => 'simpanshu',
                    ]); ?>

                   <div class="row">
                    <?php echo $__env->make('layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Pilih Period SHU</label>
                                <div class="col-sm-6">
                                    <select name="periodeshu" id="periodeshu"  class="custom-select select2-info">
                                        <option value="">Pilih</option>
                                        <?php for($i = date('Y') - 1; $i <= date('Y') + 5; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(old('year') == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Masukkan jumlah profit</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-sm" name="jumlah_profit"  placeholder="masukkan jumlah profit" id="jumlah_profit" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Total Point anggota</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-sm" name="totalpoint"  placeholder="Total Point" id="totalpoint" >
                                </div>
                            </div>
                         
                            

                           

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 ">
                            
                            <input type="submit" value="Generate" class="btn btn-primary" />
                            <a class="btn btn-danger" href="<?php echo e(route('anggota.index')); ?>">kembali</a></div>

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
           $('#periodeshu').select2();

        });
    </script>
<script>
    $(document).ready(function () {
      
        $('select[name="periodeshu"]').on('change', function() {
            var subID = $(this).val();
            if (subID) {
                $.ajax({
                    url: '/getpointallshu/' + subID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Hapus baris berikut yang mencoba mengatur nilai input dengan ID 'totalpoint'
                        // $('#totalpoint').val(myJson);

                        // Tampilkan total point di dalam elemen dengan ID 'total-point'
                        $('#totalpoint').val(data.totalpoint);
                    },
                    error: function () {
                        // Handle kesalahan jika diperlukan
                        console.error('Terjadi kesalahan dalam permintaan AJAX');
                    }
                });
            } else {
                // Apabila tidak ada pilihan yang dipilih, Anda bisa menambahkan kode yang sesuai di sini
                // Contoh: $('#total-point').text(''); untuk mengosongkan nilai total point
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/shu/form.blade.php ENDPATH**/ ?>
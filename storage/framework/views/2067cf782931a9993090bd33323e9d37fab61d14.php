<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Report pembayaran</h3>
                </div>
                <div class="card-body">
                    <?php echo Form::model('shu', [
                        'method' => 'post',
                        'route' => 'vwrpembayaran',
                    ]); ?>

                   <div class="row">
                    <?php echo $__env->make('layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Start date</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="start_date"  placeholder="masukkan jumlah profit" id="jumlah_profit" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">End date</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="end_data"  placeholder="Total Point" id="totalpoint" >
                                </div>
                            </div>
                         

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 ">
                            
                            <input type="submit" value="Submit" class="btn btn-primary" />
                            

                    </div>
                    <?php echo Form::close(); ?>


                </div>
         
                <div class="card-footer">
                   
                    <div class="row">
                        <?php if(isset($spmbayar)): ?>
                        <div> <h3>Rekap pembayaran</h3></div>
                       
                        <table class="table table-bordered table-hover dataTable" id="rbayar">
                            <thead>
                            <tr >
                                <th> No</th>
                                <th>No Doc</th>
                                <th >Nama bank</th>
                                <th>Tgl bayar </th>
                                <th >Catatan</th>
                                <th>Jumlah </th>
                                <th>Status</th>
                              
                            </tr>
                            </thead>
                            <?php $__currentLoopData = $spmbayar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spmbyr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr >
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($spmbyr->spmbayar_nochar); ?></td>
                                    <td><?php echo e($spmbyr->nama_bank); ?></td>
                                    <td><?php echo e($spmbyr->spmbayar_tgl_bayar); ?></td>
                                    <td><?php echo e($spmbyr->spmbayar_catatan); ?></td>
                                      <td><?php echo e($spmbyr->spmbayar_nominal); ?></td>
                                      <td><?php echo e($spmbyr->spmbayar_status); ?></td>
                                            
                                            
                                </tr>
         
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
                        </table>
                        <?php endif; ?>
                       </div>
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
      
        $('#rbayar').DataTable(
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/pembayaran/rpembayaran.blade.php ENDPATH**/ ?>
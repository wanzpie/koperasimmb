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
                                List  Data Anggota Koperasi MMB
                                </div>
                                <div class="card-body ">
                                    <table class="table table-bordered table-hover dataTable nowrap" id="listanggota">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >NIK </th>
                                            <th>Nama Anggota </th>
                                            <th>Gabung Perusahaan</th>
                                            <th>Gabung Koperasi</th>
                                            <th>Status</th>
                                            <th >Proyek</th>
                                            <th>Divisi</th>
                                            <th>jabatan</th>
                                            <th>Pnd Terakhir</th>
                                            <th>nama Sutri</th>
                                            <th>Pek Sutri</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr >
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($agt->nik_karyawan); ?></td>
                                                <td><?php echo e($agt->nama_karyawan); ?></td>
                                                <td><?php echo e($agt->tanggal_join_karyawan); ?></td>
                                                <td><?php echo e($agt->tgl_join_koperasi); ?></td>
                                                <td><?php echo e($agt->status_karyawan); ?></td>
                                                <td><?php echo e($agt->project_name); ?></td>
                                                <td><?php echo e($agt->nama_divisi); ?></td>
                                                <td><?php echo e($agt->nama_jabatan); ?></td>
                                                <td><?php echo e($agt->pend_terakhir); ?></td>
                                                <td><?php echo e($agt->nama_sutri); ?></td>
                                                <td><?php echo e($agt->pek_sutri); ?></td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                   
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
           $('#listanggota').DataTable(
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



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/anggota/ranggota.blade.php ENDPATH**/ ?>
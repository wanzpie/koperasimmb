
<?php
use App\Navigations\MenuBuildNav;
use App\Model\ProjectModel;
?>


<div id="modal-default" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form class="modal-content" role="form" method="POST" id="change_proj" action="<?php echo e(route('change_project')); ?>">
            <?php $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR'); ?>

            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Change Project</h4>
                </div>
                <div class="modal-body">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('POST')); ?>

                    <div class="form-group row">

                        <label for="inputEmail3" class="col-sm-4 col-form-label">Project Name</label>
                        <div class="col-sm-8">
                            <?php $perms = explode(',', Session::get('assignment_project'));

                            $projects = ProjectModel::select('PROJECT_NO_CHAR','PROJECT_NAME')
                                ->whereIn('PROJECT_NO_CHAR', $perms)
                                ->OrderBy('PROJECT_NAME','ASC')->get();
                            ?>
                            <select name="project" id="project" class="custom-select select2-info"  style="width: 100%">
                                <option value="0">-=Pilih=-</option>

                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->PROJECT_NO_CHAR); ?>"><?php echo e($project->PROJECT_NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>       </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit"  class="btn bg-gradient-primary" id="chbutton" data-dismiss="modal" >Save</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- /.modal-dialog -->

<!-- /.modal -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php
            $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR');
            $prefix= \DB::table('md_company')->SELECT('company_name')->where('id_company',$PROJECT_NO_CHAR)->first();
//       dd($PROJECT_NO_CHAR);
            ?>
            <a href="#"  class="nav-link" ><b><?php echo e($prefix->company_name); ?> &nbsp;</b></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->











    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->


        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('logout')); ?>" title="LOGOUT" data-widget="control-sidebar"
               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i></a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-fuchsia sidebar-light-fuchsia elevation-3" style="background-color: #001f3f;">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('home')); ?>" class="brand-link" style="color: #FFFFFF;">
        Version : 1.0.0
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-3 mb-1 d-flex" >
            <div class="image">
                <img src="<?php echo e(URL::to('/')); ?>/assets/Licenza2.jpeg" class="img-lg elevation-2" alt=" Image" style="width: 70px;border-radius: 35px;">
            </div>



        <div class="info">
            <a href="#" class="nav-link">
               <?php echo e(Session::get('username')); ?>

            </a>
        </div>
    </div>
<?php echo MenuBuildNav::menus(); ?>

    <!-- Sidebar -->




























































































































































































































































































































    <!-- /.sidebar -->
</aside>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>

<script src="<?php echo e(asset('datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('datatable/DataTables-1.10.20/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('datatable/pdfmake-0.1.36/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('datatable/pdfmake-0.1.36/vfs_fonts.js')); ?>"></script>

 
<!-- Bootstrap -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/datepicker/datepicker.js')); ?>"></script>
<!-- SELECT JS -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/select2/js/select2.full.js')); ?>"></script>

<!-- SweetAlert2 -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<!-- Toastr -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/toastr/toastr.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js')); ?>"></script>
<script src="<?php echo e(asset('assets/AdminLTE/plugins/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('assets/AdminLTE/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/AdminLTE/dist/js/adminlte.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>



<!-- PAGE SCRIPTS
<script src="<?php echo e(asset('assets/AdminLTE/dist/js/pages/dashboard2.js')); ?>"></script>-->

<script>
    $(document).ready(function () {
        $('#project').select2();
        
        
        
        
        
        
        $('#chbutton').on('click', function(){
            // alert('test');
            $('#change_proj').submit();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        function fresh_ajax(){
            $.ajax({
                type:"POST",
                url:"<?php echo e(route('checkValidSession')); ?>",
                data: {
                    id: "<?php echo e(Session::get('checker')); ?>",
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function( data ) {
                    console.log(data['msg']);
                    if(data['msg'] == '1'){
                        window.location.replace("<?php echo e(route('home')); ?>");
                    }
                }
            });
        }
        window.setInterval(function(){
            fresh_ajax();
        }, 7000);

    });
</script>
<?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>
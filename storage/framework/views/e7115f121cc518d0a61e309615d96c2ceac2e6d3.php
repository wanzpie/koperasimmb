
























<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->































<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Koperasi MMB</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?> ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css')); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href=" <?php echo e(asset('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css')); ?>">
    <!-- datepicker -->
    <link rel="stylesheet" href=" <?php echo e(asset('assets/AdminLTE/plugins/datepicker/datepicker.css')); ?>">
    
    <link rel="stylesheet" href=" <?php echo e(asset('assets/AdminLTE/plugins/select2/css/select2.css')); ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/plugins/toastr/toastr.min.css')); ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    <!-- Tempusdominus Bbootstrap 4 -->

    <!-- Bootstrap4 Duallistbox -->


    <link rel="stylesheet" href="<?php echo e(asset('assets/AdminLTE/dist/css/adminlte.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />


    




    




































</head>

<body class="hold-transition sidebar-mini

<?php if(Session::get('id')): ?>
    layout-navbar-fixed layout-fixed
    <?php else: ?>
    login-page
    <?php endif; ?>
    ">
<div class="wrapper">

    <?php if(Session::get('id')): ?>
        <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>



<?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/layouts/app.blade.php ENDPATH**/ ?>
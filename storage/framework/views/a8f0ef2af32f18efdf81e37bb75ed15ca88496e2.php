<?php $__env->startSection('content'); ?>
<?php if($user->exists): ?>
<script type="text/javascript">
$( document ).ready(function() {
    var str = document.getElementById('menus').value;
    var menu = str.split(',');
    for(var i=0; i< menu.length; i++){
        console.log(menu[i]);
        var tes = '#cek' + menu[i];
        $(tes).prop( "checked", true );
    }
});
</script>
<?php endif; ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4><?php echo $user->exists ? 'Edit User' : 'Form User'; ?></h4>
                </div>
                <div class="card-body">
                 <div class="col-md-2"></div>
                 <div class="col-md-10">
               <section class="content">

    &nbsp;
    <?php echo Form::model('user', [
        'method' => $user->exists ? 'put' : 'post',
        'route' => $user->exists ? ['users.update', $user->id] : ['users.store'],
    ]); ?>

    <input type="hidden" name="ip" id="ip" >
    <?php if($user->exists): ?><input type="hidden" name="menus" id="menus" value="<?php echo e($user->menu); ?>" /><?php endif; ?>
    <div class="form-group row">
        <label for="name" class="col-sm-6 col-form-label">Name</label>
        <input class="form-control col-sm-6" type="text" name="name" id="name" value="<?php echo e($user->name); ?>" />
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-6 col-form-label">Username</label>
        <input class="form-control col-sm-6" type="text" name="username" id="username" value="<?php echo e($user->username); ?>" />
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-6 col-form-label">Email</label>
        <input class="form-control col-sm-6" type="text" name="email" id="email" value="<?php echo e($user->email); ?>" />
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-6 col-form-label">Password</label>
        <input class="form-control col-sm-6" type="password" name="password" id="password" />
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-6 col-form-label">Password Confirmation</label>
        <input class="form-control col-sm-6" type="password" name="password_confirmation" id="password_confirmation" />
    </div>
                   

    <div class="form-group row">
        <label for="level" class="col-sm-6 col-form-label">Level Access</label>
        <select class="form-control col-sm-6" id="level" name="perms_name">
            <option value="NULL">-=Pilih=-</option>
            <option value="Administrator" <?php if($user->level == 'Administrator'): ?> selected <?php endif; ?>>Administrator</option>
            <option value="Manager" <?php if($user->level == 'manager'): ?> selected <?php endif; ?>>Manager</option>
            <option value="Supervisor" <?php if($user->level == 'Supervisor'): ?> selected <?php endif; ?>>Supervisor</option>
            <option value="Staff" <?php if($user->level == 'Staff'): ?> selected <?php endif; ?>>Staff</option>

        </select>
    </div>
    <?php if($menu_parents): ?>
    <div class="form-group col-lg-12">
    <?php $__currentLoopData = $menu_parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4">
        <?php if($row->is_parent == TRUE): ?>
        <legend><?php echo $row->title; ?></legend>
        <?php endif; ?>
        <ul class="checkbox">
        <?php $__currentLoopData = $menu_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($row->id == $child->parent_id): ?>
            <li>
                <input type="checkbox" name="menu_perms[]" id='cek<?php echo $child->id; ?>' value="<?php echo $child->id; ?>" />
                <label for="cek<?php echo $child->id; ?>"><?php echo $child->title; ?></label>
            </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
    <div class="form-group col-lg-12">
        <input type="submit" value="Save" class="btn btn-primary" />
        <a class="btn btn-danger" href="<?php echo e(route('users.index')); ?>">Back</a>
    </div>
    <?php echo Form::close(); ?>

      </section>
    </div>
                </div>
                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\koperasimmb\resources\views/page/users/form.blade.php ENDPATH**/ ?>
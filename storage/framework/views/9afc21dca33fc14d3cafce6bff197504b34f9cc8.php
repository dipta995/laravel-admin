<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title','Laravel Role Admin'); ?></title>

    <?php echo $__env->make('backend.layouts.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="shortcut icon" href="<?php echo e(asset('backend/assets/images/favicon.svg')); ?>" type="image/x-icon">
</head>

<body>

    <div id="app">
        <?php echo $__env->make('backend.layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div id="main">
            <header class="mb-3">
                <?php echo $__env->make('backend.layouts.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


           <?php echo $__env->yieldContent('admin-content'); ?>


           <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p><?php echo e(date('Y')); ?> &copy; Dipta</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
    </div>
   <?php echo $__env->make('backend.layouts.partials.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\admin_laravel_nine\resources\views/backend/layouts/master.blade.php ENDPATH**/ ?>
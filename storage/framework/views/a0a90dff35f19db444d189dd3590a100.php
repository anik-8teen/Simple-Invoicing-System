<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <?php echo e(config('app.name', 'Laravel')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbarNavbar" aria-controls="topbarNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topbarNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <span class="nav-link"><?php echo e(Auth::user()->name); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <?php echo e(__('Log Out')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Log in')); ?></a>
                    </li>
                    <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\LaravelAPI\resources\views/components/topbar.blade.php ENDPATH**/ ?>
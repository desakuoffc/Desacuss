<?php $__env->startSection('konten'); ?>
<div class="form-signin-kontener text-center">
    <main class="form-signin bg-white radiuz">
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <h1 class="h4 mb-2 fw-normal">Login</h1>
            <span class="hr-desa mb-3 wid-75">
                <em class="hr-desa wid-50"></em>
            </span>
            <div class="card p-4 radiuz">

                <div class="form-group mb-3">
                    <label for="email" class="form-label pull-left"><i class="bi bi-at"></i>
                        <?php echo e(__('E-Mail Address')); ?></label>
                    <input id="emaillogin" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong id="error_email"></strong>
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label pull-left"><i class="bi bi-key"></i>
                        <?php echo e(__('Password')); ?></label>
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="password" required autocomplete="current-password">

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button id="btnLogin" class="w-100 btn btn-lg btn-success mb-3" type="submit">
                    <div id="loadingLogin" class="text-center sembunyi">
                        <div class="spinner" style="display: inline-block"></div>
                    </div>
                    <p id="teksLogin" class="my-0"> <?php echo e(__('Login')); ?></p>
                </button>

                <?php if(Route::has('password.request')): ?>
                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                    <?php echo e(__('Lupa Password?')); ?>

                </a>
                <?php endif; ?>
            </div>
        </form>
    </main>
</div>

<?php echo $__env->make('layouts.loginjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('auth.modal.perbaikan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/auth/login.blade.php ENDPATH**/ ?>
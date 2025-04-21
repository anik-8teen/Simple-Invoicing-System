
<div <?php echo e($attributes->merge(['class' => 'card shadow-sm mb-4'])); ?>> 
    <?php if(isset($title)): ?>
        <div class="card-header"> 
            <?php echo e($title); ?>

        </div>
    <?php endif; ?>

    <div class="card-body"> 
        <?php echo e($slot); ?> 
    </div>

    <?php if(isset($footer)): ?>
        <div class="card-footer text-muted"> 
            <?php echo e($footer); ?>

        </div>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\LaravelAPI\resources\views/components/card.blade.php ENDPATH**/ ?>
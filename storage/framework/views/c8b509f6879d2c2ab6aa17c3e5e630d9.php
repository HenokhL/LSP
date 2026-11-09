

<?php $__env->startSection('title', 'Data Kategori'); ?>
<?php $__env->startSection('page-title', 'Data Kategori'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-header">
        <span>
            <i class="fas fa-tags"></i>
            Data Kategori
        </span>

        <button class="btn btn-teal"
                onclick="document.getElementById('formTambah').style.display='block'">
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </button>
    </div>

    <div class="card-body">

        <?php if(session('success')): ?>
            <div style="padding:10px;background:#dcfce7;color:#166534;margin-bottom:15px;border-radius:6px;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Form Tambah -->
        <div id="formTambah" style="display:none;margin-bottom:20px;">
            <form action="<?php echo e(route('kategori.simpan')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="text"
                       name="nama_kategori"
                       placeholder="Nama Kategori"
                       required
                       style="padding:10px;width:300px;">
                <button type="submit" class="btn btn-teal">Simpan</button>
            </form>
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Nama Kategori</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->nama_kategori); ?></td>
                    <td>
                        <form action="<?php echo e(route('kategori.update', $item->id)); ?>"
                              method="POST"
                              style="display:inline">
                            <?php echo csrf_field(); ?>
                            <input type="text"
                                   name="nama_kategori"
                                   value="<?php echo e($item->nama_kategori); ?>"
                                   style="padding:6px;">
                            <button class="btn btn-navy">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>

                        <a href="<?php echo e(route('kategori.hapus', $item->id)); ?>"
                           class="btn btn-red"
                           onclick="return confirm('Yakin ingin menghapus kategori?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" align="center">Belum ada data kategori</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LSP\resources\views/kategori/index.blade.php ENDPATH**/ ?>
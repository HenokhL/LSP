

<?php $__env->startSection('title', 'Tambah Barang'); ?>
<?php $__env->startSection('page-title', 'Tambah Barang'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <span>Tambah Data Barang</span>
    </div>

    <div class="card-body">
        <form action="<?php echo e(route('barang.simpan')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="margin-bottom:15px;">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Kategori</label>
                <select name="kategori_id" required style="width:100%;padding:10px;">
                    <option value="">-- Pilih Kategori --</option>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama_kategori); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Stok</label>
                <input type="number" name="stok" min="0" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Harga</label>
                <input type="number" name="harga" required style="width:100%;padding:10px;">
            </div>

            <button type="submit" class="btn btn-teal">Simpan</button>
            <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-red">Batal</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LSP\resources\views/barang/tambah.blade.php ENDPATH**/ ?>
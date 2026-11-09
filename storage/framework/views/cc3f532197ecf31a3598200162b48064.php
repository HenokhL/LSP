

<?php $__env->startSection('title', 'Edit Barang'); ?>
<?php $__env->startSection('page-title', 'Edit Barang'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-header">
        <span>Edit Data Barang</span>
    </div>

    <div class="card-body">

        <form action="<?php echo e(route('barang.update', $barang->id)); ?>" method="POST">
            

            <?php echo csrf_field(); ?>

            <div style="margin-bottom:15px;">
                <label>Kode Barang</label>
                <input type="text"
                       name="kode_barang"
                       value="<?php echo e($barang->kode_barang); ?>"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       value="<?php echo e($barang->nama_barang); ?>"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Kategori</label>
                <select name="kategori_id" required style="width:100%;padding:10px;">
                    
                    <option value="">-- Pilih Kategori --</option>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>"
                            <?php echo e($barang->kategori_id == $k->id ? 'selected' : ''); ?>>
                            
                            <?php echo e($k->nama_kategori); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       value="<?php echo e($barang->stok); ?>"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-weight: 600; color: #1B9EA5;">Harga Barang (Rp)</label>
                <input type="number"
                       name="harga"
                       value="<?php echo e($barang->harga ?? 0); ?>"
                       min="0"
                       placeholder="Contoh: 150000"
                       required
                       style="width:100%;padding:10px; border: 1px solid #1B9EA5; border-radius: 4px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Status</label>
                <select name="status" style="width:100%;padding:10px;">
                    
                    <option value="tersedia"
                        <?php echo e(strtolower($barang->status) == 'tersedia' ? 'selected' : ''); ?>>
                        Tersedia
                    </option>
                    <option value="habis"
                        <?php echo e(strtolower($barang->status) == 'habis' ? 'selected' : ''); ?>>
                        Habis
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-teal">Update</button>
            <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-red">Batal</a>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LSP\resources\views/barang/edit.blade.php ENDPATH**/ ?>
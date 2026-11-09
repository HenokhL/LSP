

<?php $__env->startSection('title', 'Daftar Pengguna'); ?>
<?php $__env->startSection('page-title', 'Manajemen Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div style="padding:10px;background:#dcfce7;color:#166534;margin-bottom:15px;border-radius:6px;">
        ✅ <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div style="padding:10px;background:#fee2e2;color:#dc2626;margin-bottom:15px;border-radius:6px;">
        ❌ <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <span><i class="fas fa-users"></i> Daftar Pengguna</span>
        <button class="btn btn-teal" onclick="document.getElementById('formTambah').style.display='block'">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </div>

    <div class="card-body">

        
        <div id="formTambah" style="display:none; background:#f8fafc; padding:20px; border-radius:8px; margin-bottom:20px; border:1px solid #e2e8f0;">
            <h6 style="margin-bottom:15px; font-weight:600; color:#1a2e5a;">Tambah User Baru</h6>
            <form action="<?php echo e(route('users.simpan')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                    <div>
                        <label style="font-size:0.85rem; font-weight:600; color:#4a5568; display:block; margin-bottom:5px;">Nama Lengkap</label>
                        <input type="text" name="nama" required placeholder="Contoh: John Doe"
                               style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; outline:none;">
                    </div>
                    <div>
                        <label style="font-size:0.85rem; font-weight:600; color:#4a5568; display:block; margin-bottom:5px;">Username</label>
                        <input type="text" name="username" required placeholder="Contoh: johndoe"
                               style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; outline:none;">
                    </div>
                    <div>
                        <label style="font-size:0.85rem; font-weight:600; color:#4a5568; display:block; margin-bottom:5px;">Password</label>
                        <input type="password" name="password" required placeholder="Min. 6 karakter"
                               style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; outline:none;">
                    </div>
                    <div>
                        <label style="font-size:0.85rem; font-weight:600; color:#4a5568; display:block; margin-bottom:5px;">Role</label>
                        <select name="level" required style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; outline:none;">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top:15px; display:flex; gap:10px;">
                    <button type="submit" class="btn btn-teal">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-red"
                            onclick="document.getElementById('formTambah').style.display='none'">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background-color:#f8fafc; border-bottom:1px solid #e2e8f0;">
                    <th style="padding:12px; text-align:left;">No</th>
                    <th style="padding:12px; text-align:left;">Nama</th>
                    <th style="padding:12px; text-align:left;">Username</th>
                    <th style="padding:12px; text-align:left;">Role</th>
                    <th style="padding:12px; text-align:left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:12px;"><?php echo e($index + 1); ?></td>
                    <td style="padding:12px;"><?php echo e($user->nama ?? '-'); ?></td>
                    <td style="padding:12px;"><?php echo e($user->username ?? '-'); ?></td>
                    <td style="padding:12px;">
                        <span style="background-color:<?php echo e($user->level == 'admin' ? '#dbeafe' : '#dcfce7'); ?>;
                                     color:<?php echo e($user->level == 'admin' ? '#1d4ed8' : '#15803d'); ?>;
                                     padding:4px 10px; border-radius:20px; font-size:0.8rem; font-weight:600;">
                            <?php echo e(ucfirst($user->level ?? 'staff')); ?>

                        </span>
                    </td>
                    <td style="padding:12px;">
                        <form action="<?php echo e(route('users.update', $user->id_user)); ?>" method="POST"
                              style="display:inline-flex; gap:5px; align-items:center; flex-wrap:wrap;">
                            <?php echo csrf_field(); ?>
                            <input type="text" name="nama" value="<?php echo e($user->nama); ?>"
                                   style="padding:5px 8px; border:1px solid #cbd5e1; border-radius:4px; width:120px; font-size:0.85rem;">
                            <input type="text" name="username" value="<?php echo e($user->username); ?>"
                                   style="padding:5px 8px; border:1px solid #cbd5e1; border-radius:4px; width:100px; font-size:0.85rem;">
                            <input type="password" name="password" placeholder="Password baru"
                                   style="padding:5px 8px; border:1px solid #cbd5e1; border-radius:4px; width:110px; font-size:0.85rem;">
                            <select name="level" style="padding:5px 8px; border:1px solid #cbd5e1; border-radius:4px; font-size:0.85rem;">
                                <option value="admin" <?php echo e($user->level == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                <option value="staff" <?php echo e($user->level == 'staff' ? 'selected' : ''); ?>>Staff</option>
                            </select>
                            <button type="submit" class="btn btn-navy" style="padding:5px 10px;">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>

                        <a href="<?php echo e(route('users.hapus', $user->id_user)); ?>"
                           class="btn btn-red"
                           style="padding:5px 10px; margin-left:5px;"
                           onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding:20px;">
                        Belum ada data pengguna.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LSP\resources\views/user/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Laporan'); ?>
<?php $__env->startSection('page-title', 'Laporan Transaksi Barang'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .laporan-card {
        background: #ffffff !important;
        border-radius: 12px !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06) !important;
        overflow: hidden !important;
        border: none !important;
    }

    .table-laporan-custom thead th {
        background: #f8fafc !important;
        color: #64748b !important;
        font-size: 0.85rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 12px 16px !important;
        font-weight: 600 !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .table-laporan-custom tbody td {
        padding: 14px 16px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: #334155 !important;
    }

    .badge-capsule {
        padding: 0.4rem 1rem !important;
        border-radius: 50px !important;
        font-size: 0.8rem !important;
        font-weight: 600 !important;
        display: inline-block !important;
        min-width: 95px !important;
        text-align: center !important;
    }

    .badge-capsule-success { background-color: #dcfce7 !important; color: #16a34a !important; }
    .badge-capsule-danger { background-color: #fee2e2 !important; color: #dc2626 !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="laporan-card mb-4">
    <div class="card-body p-4">
        <form action="<?php echo e(route('laporan.index')); ?>" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">

            <div style="flex: 1; min-width: 200px;">
                <label class="form-label fw-semibold text-secondary small mb-2" style="display:block;">Tanggal Awal</label>
                <input type="date" name="tanggal_awal"
                       value="<?php echo e(request('tanggal_awal')); ?>"
                       class="form-control"
                       style="width:100%; border-radius: 10px; padding: 10px; border: 1px solid #cbd5e1; outline:none;">
            </div>

            <div style="flex: 1; min-width: 200px;">
                <label class="form-label fw-semibold text-secondary small mb-2" style="display:block;">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir"
                       value="<?php echo e(request('tanggal_akhir')); ?>"
                       class="form-control"
                       style="width:100%; border-radius: 10px; padding: 10px; border: 1px solid #cbd5e1; outline:none;">
            </div>

            <div style="flex: 1; min-width: 200px;">
                <label class="form-label fw-semibold text-secondary small mb-2" style="display:block;">Jenis Transaksi</label>
                <select name="jenis" class="form-select" style="width:100%; border-radius: 10px; padding: 10px; border: 1px solid #cbd5e1; background-color: #f8fafc; outline:none;">
                    <option value="">⏳ Semua</option>
                    <option value="masuk" <?php echo e(request('jenis') == 'masuk' ? 'selected' : ''); ?>>↗️ Masuk</option>
                    <option value="keluar" <?php echo e(request('jenis') == 'keluar' ? 'selected' : ''); ?>>↘️ Keluar</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-dark px-4" style="border-radius: 10px; padding: 11px 24px; background-color: #0f172a; color: #ffffff; border:none; cursor:pointer;">
                    <i class="fas fa-search" style="color: #ffffff; margin-right: 5px;"></i> Cari
                </button>

                <a href="<?php echo e(route('laporan.cetak', request()->query())); ?>"
                   target="_blank"
                   style="border-radius: 10px; padding: 11px 24px; background-color: #16a34a; color: #ffffff; text-decoration:none; display:inline-flex; align-items:center; gap:5px; font-size:14px;">
                    <i class="fas fa-print" style="color: #ffffff;"></i> Print
                </a>

                <?php if(request('tanggal_awal') || request('tanggal_akhir') || request('jenis')): ?>
                    <a href="<?php echo e(route('laporan.index')); ?>" class="btn btn-light px-3" style="border-radius: 10px; padding: 11px 15px; border: 1px solid #e2e8f0; background:#fff; text-decoration:none; color:#334155;">
                        🔄 Reset
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<div class="stat-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">

    <div class="stat-card">
        <div class="stat-icon" style="background-color: #eff6ff; color: #2563eb;">
            <i class="fas fa-file-alt" style="color: #2563eb;"></i>
        </div>
        <div class="stat-info">
            <div class="value"><?php echo e($totalTransaksi); ?></div>
            <div class="label">Total Transaksi</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: #f0fdf4; color: #16a34a;">
            <i class="fas fa-arrow-up" style="color: #16a34a;"></i>
        </div>
        <div class="stat-info">
            <div class="value"><?php echo e(number_format($totalMasuk)); ?></div>
            <div class="label">Total Barang Masuk</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef2f2; color: #dc2626;">
            <i class="fas fa-arrow-down" style="color: #dc2626;"></i>
        </div>
        <div class="stat-info">
            <div class="value"><?php echo e(number_format($totalKeluar)); ?></div>
            <div class="label">Total Barang Keluar</div>
        </div>
    </div>

    <div class="stat-card" style="background: linear-gradient(135deg, #fefcbf 0%, #fef9c3 100%); border: 1px solid #fef08a;">
        <div class="stat-icon" style="background-color: #ca8a04; color: #ffffff;">
            <i class="fas fa-money-bill-wave" style="color: #ffffff;"></i>
        </div>
        <div class="stat-info">
            <div class="value" style="color: #854d0e; font-size: 1.25rem;">Rp <?php echo e(number_format($totalPendapatan ?? 0, 0, ',', '.')); ?></div>
            <div class="label" style="color: #a16207; font-weight: 600;">Total Nilai Jual</div>
        </div>
    </div>

</div>

<div class="laporan-card">
    <div class="card-body p-0">

        <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background-color: #ffffff; border-bottom: 1px solid #f1f5f9;">
            <h5 class="fw-bold mb-0" style="color: #0f172a; font-size: 1.1rem; font-weight:600;">Rincian Transaksi</h5>
            <span class="badge bg-light text-dark fw-normal px-3 py-2" style="border-radius: 20px; border: 1px solid #f1f5f9; color:#334155; font-size:0.8rem;">
                <?php echo e($transaksi->count()); ?> transaksi ditemukan
            </span>
        </div>

        <div style="overflow-x: auto;">
            <table class="table-laporan-custom" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th style="text-align: center; width: 150px;">Jenis Transaksi</th>
                        <th style="text-align: center; width: 100px;">Jumlah</th>
                        <th style="text-align: right; width: 160px;">Total Harga</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color: #64748b;">
                            <?php echo e(\Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y')); ?>

                        </td>
                        <td style="font-weight: 600; color: #0f172a;"><?php echo e($t->nama_barang); ?></td>
                        <td style="text-align: center;">
                            <span class="badge-capsule <?php echo e(strtolower($t->jenis) == 'masuk' ? 'badge-capsule-success' : 'badge-capsule-danger'); ?>">
                                <?php echo e(ucfirst($t->jenis)); ?>

                            </span>
                        </td>
                        <td style="text-align: center; font-weight: 700; color: #0f172a;">
                            <?php echo e(number_format($t->jumlah)); ?>

                        </td>
                        <td style="text-align: right; font-weight: 700; color: #16a34a;">
                            <?php echo e(strtolower($t->jenis) == 'keluar' ? 'Rp '.number_format($t->total_harga ?? 0, 0, ',', '.') : '-'); ?>

                        </td>
                        <td style="color: #64748b; font-size: 0.9rem;"><?php echo e($t->keterangan ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 50px 0; color: #94a3b8;">
                            <div style="font-size: 2rem; margin-bottom: 10px;">📭</div>
                            Tidak ada data transaksi yang ditemukan.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LSP\resources\views/laporan/index.blade.php ENDPATH**/ ?>
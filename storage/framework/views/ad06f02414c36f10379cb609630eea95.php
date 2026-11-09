<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Inventory System'); ?> – Prime Jacket Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 250px; min-height: 100vh;
            background: #1a2e5a;
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 100;
        }
        .sidebar-brand {
            padding: 1.5rem 1.2rem;
            color: #fff;
            font-size: 1rem; font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; gap: 0.6rem;
        }
        .sidebar-brand i { color: #1B9EA5; font-size: 1.3rem; }
        .sidebar-menu { padding: 1rem 0; flex: 1; }
        .menu-label {
            color: rgba(255,255,255,0.4);
            font-size: 0.65rem; font-weight: 600;
            letter-spacing: 0.08em;
            padding: 0.8rem 1.2rem 0.3rem;
            text-transform: uppercase;
        }
        .menu-item a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1.2rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .menu-item a:hover, .menu-item a.active {
            color: #fff;
            background: rgba(27,158,165,0.15);
            border-left-color: #1B9EA5;
        }
        .menu-item a i { width: 18px; text-align: center; color: #1B9EA5; }
        .sidebar-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-footer a {
            display: flex; align-items: center; gap: 0.6rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none; font-size: 0.82rem;
            transition: color 0.2s;
        }
        .sidebar-footer a:hover { color: #fff; }

        /* MAIN */
        .main-content { margin-left: 250px; flex: 1; display: flex; flex-direction: column; }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 0.9rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            position: sticky; top: 0; z-index: 50;
        }
        .topbar h4 { font-size: 1rem; font-weight: 600; color: #1a2e5a; }
        .topbar-user { display: flex; align-items: center; gap: 0.6rem; font-size: 0.85rem; color: #555; }
        .topbar-user .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: #1B9EA5;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 600; font-size: 0.85rem;
        }

        /* PAGE CONTENT */
        .page-content { padding: 1.5rem; flex: 1; }

        /* CARDS */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: #fff; border-radius: 10px;
            padding: 1.2rem 1.4rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: #fff;
        }
        .stat-icon.teal   { background: #1B9EA5; }
        .stat-icon.navy   { background: #1a2e5a; }
        .stat-icon.orange { background: #f97316; }
        .stat-icon.green  { background: #22c55e; }
        .stat-icon.red    { background: #ef4444; }
        .stat-info .label { font-size: 0.75rem; color: #888; margin-bottom: 0.2rem; }
        .stat-info .value { font-size: 1.4rem; font-weight: 700; color: #1a2e5a; }

        /* TABLE */
        .card {
            background: #fff; border-radius: 10px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            overflow: hidden; margin-bottom: 1.5rem;
        }
        .card-header {
            background: #1B9EA5; color: #fff;
            padding: 0.9rem 1.2rem;
            display: flex; align-items: center; justify-content: space-between;
            font-weight: 600; font-size: 0.9rem;
        }
        .card-body { padding: 1rem; }
        table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        thead th { background: #1B9EA5; color: #fff; padding: 0.7rem 1rem; text-align: left; font-weight: 500; }
        tbody td { padding: 0.7rem 1rem; border-bottom: 1px solid #f0f0f0; color: #444; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #f9fafb; }

        .badge {
            padding: 0.25rem 0.6rem; border-radius: 20px;
            font-size: 0.72rem; font-weight: 500;
        }
        .badge-success { background: #dcfce7; color: #16a34a; }
        .badge-danger  { background: #fee2e2; color: #dc2626; }
        .badge-warning { background: #fef9c3; color: #ca8a04; }

        .btn { padding: 0.45rem 1rem; border-radius: 6px; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; font-size: 0.82rem; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-teal  { background: #1B9EA5; color: #fff; }
        .btn-red   { background: #ef4444; color: #fff; }
        .btn-navy  { background: #1a2e5a; color: #fff; }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-jacket"></i>
        Prime Jacket Store
    </div>
    <nav class="sidebar-menu">
        <div class="menu-label">Menu Utama</div>
        <div class="menu-item">
            <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
        </div>
        <div class="menu-label">Master Data</div>
        <div class="menu-item">
            <a href="<?php echo e(route('barang.index')); ?>" class="<?php echo e(request()->routeIs('barang.*') ? 'active' : ''); ?>">
                <i class="fas fa-box"></i> Barang
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('kategori.index')); ?>" class="<?php echo e(request()->routeIs('kategori.*') ? 'active' : ''); ?>">
                <i class="fas fa-tags"></i> Kategori
            </a>
        </div>
        <div class="menu-label">Transaksi</div>
        <div class="menu-item">
            <a href="<?php echo e(route('persediaan.index')); ?>" class="<?php echo e(request()->routeIs('persediaan.*') ? 'active' : ''); ?>">
                <i class="fas fa-warehouse"></i> Persediaan
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('laporan.index')); ?>" class="<?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?>">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
        </div>
        <?php if(session('role') === 'admin'): ?>
        <div class="menu-label">Pengaturan</div>
        <div class="menu-item">
            <a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                <i class="fas fa-users"></i> Manajemen User
            </a>
        </div>
        <?php endif; ?>
    </nav>
    <div class="sidebar-footer">
        <a href="<?php echo e(route('auth.logout')); ?>">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <div class="topbar">
        <h4><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h4>
        <div class="topbar-user">
            <div class="avatar"><?php echo e(strtoupper(substr(session('user_nama', 'U'), 0, 1))); ?></div>
            <span><?php echo e(session('user_nama')); ?></span>
        </div>
    </div>
    <div class="page-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\LSP\resources\views/layout/main.blade.php ENDPATH**/ ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= esc($title ?? 'Panel'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-[1024px] min-h-[760px] p-4">
        <header class="mb-4 rounded-lg bg-white p-4 shadow-sm">
            <h1 class="text-2xl font-bold">Sistema de ventas - Pollo a la brasa</h1>
            <nav class="mt-3 grid grid-cols-3 gap-2 text-lg">
                <a href="/catalogo/productos" class="rounded-md bg-amber-500 p-3 text-center font-semibold text-white">Productos</a>
                <a href="/catalogo/menus" class="rounded-md bg-amber-500 p-3 text-center font-semibold text-white">Menús</a>
                <a href="/catalogo/combos" class="rounded-md bg-amber-500 p-3 text-center font-semibold text-white">Combos</a>
            </nav>
        </header>

        <?php if (session('success')): ?>
            <div class="mb-3 rounded-md bg-emerald-200 p-3"><?= esc(session('success')); ?></div>
        <?php endif; ?>

        <?php if (session('error')): ?>
            <div class="mb-3 rounded-md bg-rose-200 p-3"><?= esc(session('error')); ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content'); ?>
    </main>
</body>
</html>

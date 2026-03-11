<?= $this->extend('layouts/touch'); ?>
<?= $this->section('content'); ?>
<section class="rounded-lg bg-white p-5 shadow-sm">
    <h2 class="mb-4 text-2xl font-bold">Registro de productos</h2>

    <form action="/catalogo/productos" method="post" class="grid grid-cols-2 gap-4 text-lg">
        <?= csrf_field(); ?>

        <label class="flex flex-col gap-2">
            <span>Nombre del producto</span>
            <input name="name" required class="rounded-md border border-slate-300 p-3">
        </label>

        <label class="flex flex-col gap-2">
            <span>Categoría</span>
            <select name="category" class="rounded-md border border-slate-300 p-3">
                <option value="pollo">Pollo a la brasa</option>
                <option value="parrilla">Parrilla</option>
                <option value="acompanamiento">Acompañamiento</option>
                <option value="bebida">Bebida</option>
            </select>
        </label>

        <label class="flex flex-col gap-2">
            <span>Porción</span>
            <select name="portion" class="rounded-md border border-slate-300 p-3">
                <option value="entero">Entero</option>
                <option value="3/4">Tres cuartos</option>
                <option value="1/2">Medio</option>
                <option value="1/4">Cuarto</option>
                <option value="unidad">Unidad</option>
            </select>
        </label>

        <label class="flex flex-col gap-2">
            <span>Precio base (S/)</span>
            <input type="number" step="0.01" min="0" name="base_price" required class="rounded-md border border-slate-300 p-3">
        </label>

        <label class="flex flex-col gap-2">
            <span>Color para botón táctil</span>
            <input type="color" name="touch_color" value="#f59e0b" class="h-14 rounded-md border border-slate-300 p-1">
        </label>

        <label class="flex items-center gap-3 pt-9">
            <input type="checkbox" name="active" value="1" checked class="h-6 w-6">
            <span>Activo</span>
        </label>

        <button class="col-span-2 rounded-md bg-slate-900 p-4 text-xl font-bold text-white">Guardar producto</button>
    </form>
</section>
<?= $this->endSection(); ?>

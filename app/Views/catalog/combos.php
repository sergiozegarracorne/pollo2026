<?= $this->extend('layouts/touch'); ?>
<?= $this->section('content'); ?>
<section class="rounded-lg bg-white p-5 shadow-sm">
    <h2 class="mb-4 text-2xl font-bold">Registro de combos (precio promocional)</h2>

    <form action="/catalogo/combos" method="post" class="space-y-4 text-lg">
        <?= csrf_field(); ?>
        <div class="grid grid-cols-2 gap-4">
            <label class="flex flex-col gap-2">
                <span>Nombre del combo</span>
                <input name="name" required class="rounded-md border border-slate-300 p-3">
            </label>
            <label class="flex flex-col gap-2">
                <span>Precio del combo (S/)</span>
                <input type="number" step="0.01" min="0" name="combo_price" required class="rounded-md border border-slate-300 p-3">
            </label>
        </div>

        <label class="flex flex-col gap-2">
            <span>Descripción</span>
            <input name="description" class="rounded-md border border-slate-300 p-3" placeholder="Incluye gaseosa/papas y aplica descuento">
        </label>

        <div id="comboItems" class="space-y-3"></div>

        <div class="flex gap-3">
            <button type="button" id="addComboItem" class="rounded-md bg-amber-500 px-6 py-3 font-bold text-white">Agregar ítem</button>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="active" value="1" checked class="h-6 w-6">
                Activo
            </label>
        </div>

        <button class="w-full rounded-md bg-slate-900 p-4 text-xl font-bold text-white">Guardar combo</button>
    </form>
</section>

<template id="comboTpl">
    <div class="grid grid-cols-3 gap-2 rounded-md border border-slate-200 bg-slate-50 p-2">
        <select name="items[__INDEX__][product_id]" class="rounded-md border border-slate-300 p-3">
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id']; ?>"><?= esc($product['name']); ?> (<?= esc($product['portion']); ?>)</option>
            <?php endforeach; ?>
        </select>
        <input type="number" min="1" name="items[__INDEX__][quantity]" value="1" class="rounded-md border border-slate-300 p-3">
        <input type="number" step="0.01" name="items[__INDEX__][price_delta]" value="0" class="rounded-md border border-slate-300 p-3" placeholder="Ajuste precio">
    </div>
</template>

<script>
    let comboIndex = 0;
    const addComboItem = () => {
        const tpl = document.getElementById('comboTpl').innerHTML.replaceAll('__INDEX__', comboIndex++);
        document.getElementById('comboItems').insertAdjacentHTML('beforeend', tpl);
    };
    document.getElementById('addComboItem').addEventListener('click', addComboItem);
    addComboItem();
</script>
<?= $this->endSection(); ?>

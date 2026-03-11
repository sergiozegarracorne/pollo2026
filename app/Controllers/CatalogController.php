<?php

namespace App\Controllers;

use App\Models\ComboModel;
use App\Models\MenuModel;
use App\Models\ProductModel;

class CatalogController extends BaseController
{
    public function index(): string
    {
        return view('catalog/dashboard');
    }

    public function products(): string
    {
        return view('catalog/products');
    }

    public function menus(): string
    {
        $products = (new ProductModel())->where('active', 1)->findAll();

        return view('catalog/menus', ['products' => $products]);
    }

    public function combos(): string
    {
        $products = (new ProductModel())->where('active', 1)->findAll();

        return view('catalog/combos', ['products' => $products]);
    }

    public function storeProduct()
    {
        (new ProductModel())->insert([
            'name'       => $this->request->getPost('name'),
            'category'   => $this->request->getPost('category'),
            'portion'    => $this->request->getPost('portion'),
            'base_price' => $this->request->getPost('base_price'),
            'touch_color'=> $this->request->getPost('touch_color'),
            'active'     => $this->request->getPost('active') ? 1 : 0,
        ]);

        return redirect()->to('/catalogo/productos')->with('success', 'Producto registrado');
    }

    public function storeMenu()
    {
        $menuModel = new MenuModel();
        $db = db_connect();

        $menuModel->insert([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'active'      => $this->request->getPost('active') ? 1 : 0,
        ]);

        $menuId = $menuModel->getInsertID();
        $items = $this->request->getPost('items') ?? [];

        foreach ($items as $item) {
            $db->table('menu_items')->insert([
                'menu_id'      => $menuId,
                'product_id'   => $item['product_id'] ?? null,
                'variant_name' => $item['variant_name'] ?? null,
                'quantity'     => $item['quantity'] ?? 1,
            ]);
        }

        return redirect()->to('/catalogo/menus')->with('success', 'Menú registrado');
    }

    public function storeCombo()
    {
        $comboModel = new ComboModel();
        $db = db_connect();

        $comboModel->insert([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'combo_price' => $this->request->getPost('combo_price'),
            'active'      => $this->request->getPost('active') ? 1 : 0,
        ]);

        $comboId = $comboModel->getInsertID();
        $items = $this->request->getPost('items') ?? [];

        foreach ($items as $item) {
            $db->table('combo_items')->insert([
                'combo_id'    => $comboId,
                'product_id'  => $item['product_id'] ?? null,
                'quantity'    => $item['quantity'] ?? 1,
                'price_delta' => $item['price_delta'] ?? 0,
            ]);
        }

        return redirect()->to('/catalogo/combos')->with('success', 'Combo registrado');
    }
}

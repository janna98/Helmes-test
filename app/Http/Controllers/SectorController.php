<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Sector;
use App\Services\SectorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SectorController extends BaseController
{
    public function index() {
        $sectors = Sector::get();
        $industries = Industry::get();
        $products = Product::get();
        $productTypes = ProductType::get();
        return view('sectorForm',
            [
                "sectors" => $sectors,
                "industries" => $industries,
                "products" => $products,
                "productTypes" => $productTypes
            ]);
    }

    public function insert(Request $request) {
        $table = $request->input('table');
        $name = $request->input('name');
        $parentId = $request->input('parentId');
        $service = new SectorService;
        $service->add($table, $name, $parentId);
        return redirect()->back()->withInput();
    }
}

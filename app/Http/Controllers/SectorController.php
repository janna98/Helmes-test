<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Sector;
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
        // Industry::where('name', 'Maritime')->delete();
        if ($table === 'industry') {
            $industry = new Industry();
            $industry->name = $name;
            $industry->sector_id = $parentId;
            $industry->save();
        } else if ($table === 'product') {
            $product = new Product();
            $product->name = $name;
            $product->industry_id = $parentId;
            $product->save();
        } else if ($table === 'productType') {
            $productType = new ProductType();
            $productType->name = $name;
            $productType->product_id = $parentId;
            $productType->save();
        }
        return redirect()->back()->withInput();
    }
}

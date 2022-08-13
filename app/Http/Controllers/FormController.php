<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FormController extends BaseController
{
    public function index() {
        $sectors = Sector::select('id', 'name')->get()->toArray();
        $selections = $sectors;
        foreach ($sectors as $index => $sector) {
            $childIndustries = Industry::select('id', 'name')
                ->where('sector_id', $sector['id'])->get()->toArray();
            foreach ($childIndustries as $industryIndex => $childIndustry) {
                $childProducts = Product::where('industry_id', $childIndustry['id'])->get()->toArray();
                foreach ($childProducts as $productIndex => $childProduct) {
                    $childProductTypes = ProductType::where('product_id', $childProduct['id'])->get()->toArray();
                    $childProducts[$productIndex]['children'] = $childProductTypes;
                }
                $childIndustries[$industryIndex]['children'] = $childProducts;
            }
            $selections[$index]['children'] = $childIndustries;
        }
        return view('form', ["selections" => $selections]);
    }

    public function insertUserSector(Request $request) {
        return redirect()->back()->withInput();
    }
}

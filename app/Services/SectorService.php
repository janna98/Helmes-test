<?php

namespace App\Services;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Sector;

final class SectorService
{

    public function add($table, $name, $parentId): void
    {
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
    }

    public function getFormattedSectors()
    {
        $sectors = Sector::select('id', 'name')->get()->toArray();
        $selections = $sectors;
        foreach ($sectors as $index => $sector) {
            $childIndustries = Industry::select('id', 'name')
                ->where('sector_id', $sector['id'])->get()->toArray();
            foreach ($childIndustries as $industryIndex => $childIndustry) {
                $childProducts = Product::select('id', 'name')
                    ->where('industry_id', $childIndustry['id'])->get()->toArray();
                foreach ($childProducts as $productIndex => $childProduct) {
                    $childProductTypes = ProductType::select('id', 'name')
                        ->where('product_id', $childProduct['id'])->get()->toArray();
                    $childProducts[$productIndex]['children'] = $childProductTypes;
                }
                $childIndustries[$industryIndex]['children'] = $childProducts;
            }
            $selections[$index]['children'] = $childIndustries;
        }
        return $selections;
    }
}


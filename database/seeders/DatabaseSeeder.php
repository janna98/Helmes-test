<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedSectors();
        $this->seedIndustries();
        $this->seedProducts();
        $this->seedProductTypes();
    }

    private function seedSectors(): void {
        $sectorNames = ['Manufacturing', 'Other', 'Service'];
        foreach($sectorNames as $sectorName) {
            $sector = new Sector();
            $sector->name = $sectorName;
            $sector->save();
        }
    }

    private function seedIndustries(): void {
        $industriesWithParentIds = [
            1 => [
                'Construction Materials', 'Electronics and Optics', 'Food and Beverage',
                'Furniture', 'Machinery', 'Metalworking', 'Plastic and Rubber', 'Printing',
                'Textile and Clothing', 'Wood',
            ],
            2 => [
                'Creative Industries', 'Energy Technology', 'Environment'
            ],
            3 => [
                'Business Services', 'Engineering', 'Information Technology and Telecommunications',
                'Tourism', 'Translation Services', 'Transport and Logistics'
            ],
        ];
        foreach($industriesWithParentIds as $key => $industries) {
            foreach($industries as $industry) {
                $newIndustry = new Industry();
                $newIndustry->name = $industry;
                $newIndustry->sector_id = $key;
                $newIndustry->save();
            }
        }
    }

    private function seedProducts(): void
    {
        $productsWithParentIds = [
            3 => [
                'Bakery & Confectionery Products', 'Beverages', 'Fish & Fish Products',
                'Meat & Meat Products', 'Milk & Dairy Products', 'Other', 'Sweets & Snack Food'
            ],
            4 => [
                'Bathroom/Sauna', 'Bedroom', 'Children’s Room', 'Kitchen', 'Living Room',
                'Office', 'Other (Furniture)', 'Outdoor', 'Project Furniture'
            ],
            5 => [
                'Machinery Components', 'Machinery Equipment/Tools', 'Manufacture of Machinery',
                'Maritime', 'Metal Structures', 'Other', 'Repair and Maintenance Service'
            ],
            6 => [
                'Construction of Metal Structures', 'Houses and Buildings', 'Metal Products',
                'Metal Works'
            ],
            7 => [
                'Packaging', 'Plastic Goods', 'Plastic Processing Technology', 'Plastic Profiles'
            ],
            8 => [
                'Advertising', 'Book/Periodicals Printing', 'Labelling and Packaging Printing'
            ],
            9 => [
                'Clothing', 'Textile'
            ],
            10 => [
                'Other (Wood)', 'Wooden Building Materials', 'Wooden Houses'
            ],
            16 => [
                'Data Processing, Web Portals, E-marketing', 'Programming, Consultancy', 'Software, Hardware',
                'Telecommunications'
            ],
            19 => [
                'Air', 'Rail', 'Road', 'Water'
            ]
        ];
        foreach($productsWithParentIds as $key => $products) {
            foreach($products as $product) {
                $newProduct = new Product();
                $newProduct->name = $product;
                $newProduct->industry_id = $key;
                $newProduct->save();
            }
        }
    }

    private function seedProductTypes(): void
    {
        $productTypesWithParentIds = [
            20 => [
                'Aluminium and Steel Workboats', 'Boat/Yacht Building', 'Ship Repair and Conversion',
            ],
            27 => [
                'CNC-machining', 'Forgings, Fasteners', 'Gas, Plasma, Laser Cutting', 'MIG, TIG, Aluminum Welding'
            ],
            30 => [
                'Blowing', 'Moulding', 'Plastics Welding and Processing'
            ]
        ];
        foreach($productTypesWithParentIds as $key => $productTypes) {
            foreach($productTypes as $productType) {
                $newProductType = new ProductType();
                $newProductType->name = $productType;
                $newProductType->product_id = $key;
                $newProductType->save();
            }
        }
    }
}

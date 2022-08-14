<?php

namespace App\Services;

use App\Models\UserSector;

final class UserSectorService
{
    public function add($userId, $chosenSectors): void {
        if (UserSector::where('user_id', $userId)->exists()) {
            UserSector::where('user_id', $userId)->delete();
        }
        foreach ($chosenSectors as $sector) {
            [$name, $id] =explode("_", $sector);
            $userInSectors = new UserSector();
            $userInSectors->user_id = $userId;
            switch ($name) {
                case 'sector':
                    $userInSectors->sector_id = $id;
                    break;
                case 'industry':
                    $userInSectors->industry_id = $id;
                    break;
                case 'product':
                    $userInSectors->product_id = $id;
                    break;
                case 'productType':
                    $userInSectors->product_type_id = $id;
                    break;
            }
            $userInSectors->save();
        }
    }
}


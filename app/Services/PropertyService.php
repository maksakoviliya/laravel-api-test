<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

final readonly class PropertyService
{
    public function filter(array $filters): Collection
    {
        $query = Property::query();



        return $query->get();
    }
}

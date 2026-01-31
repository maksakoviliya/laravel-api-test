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

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if (isset($filters['price'])) {
            $prices = $filters['price'];
            $query->where('price', '>=', $prices[0]);
            if (isset($prices[1])) {
                $query->where('price', '<=', $prices[1]);
            }
        }

        if (isset($filters['bedrooms'])) {
            $query->where('bedrooms', $filters['bedrooms']);
        }

        if (isset($filters['bathrooms'])) {
            $query->where('bathrooms', $filters['bathrooms']);
        }

        if (isset($filters['storeys'])) {
            $query->where('storeys', $filters['storeys']);
        }

        if (isset($filters['garages'])) {
            $query->where('garages', $filters['garages']);
        }

        return $query->get();
    }
}

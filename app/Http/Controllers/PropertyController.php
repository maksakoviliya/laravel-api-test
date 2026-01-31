<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchPropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Services\PropertyService;

class PropertyController extends Controller
{
    public function __construct(
        private readonly PropertyService $propertyService
    ) {}

    public function index(SearchPropertyRequest $request): PropertyResource
    {
        return new PropertyResource(
            $this->propertyService->filter($request->validated())
        );
    }
}

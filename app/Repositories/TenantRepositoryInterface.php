<?php

namespace App\Repositories;

use App\Models\Tenant;

interface TenantRepositoryInterface {
    public function find(int $id): ?Tenant;
}

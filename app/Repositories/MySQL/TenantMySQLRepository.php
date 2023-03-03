<?php

namespace App\Repositories\MySQL;

use App\Models\Tenant;
use App\Repositories\TenantRepositoryInterface;

class TenantMySQLRepository implements TenantRepositoryInterface
{
    /**
     * @param int $id
     * @return Tenant|null
     */
    public function find(int $id): ?Tenant
    {
        return Tenant::find($id);
    }
}

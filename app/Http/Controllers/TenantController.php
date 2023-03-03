<?php

namespace App\Http\Controllers;

use App\Repositories\TenantRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    /**
     * @var TenantRepositoryInterface
     */
    private TenantRepositoryInterface $tenantRepository;

    /**
     * TenantController constructor.
     * @param TenantRepositoryInterface $tenantRepository
     */
    public function __construct(TenantRepositoryInterface $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json([
            'tenant' => $this->tenantRepository->find($id)
        ]);
    }
}

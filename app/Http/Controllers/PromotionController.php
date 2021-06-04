<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPromotion;
use App\Repository\PromotionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class PromotionController extends Controller
{
    /**
     * @var PromotionRepositoryInterface
     */
    private PromotionRepositoryInterface $promotionRepository;

    /**
     * PromotionController constructor.
     * @param PromotionRepositoryInterface $promotionRepository
     */
    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * @return string|false
     */
    public function index(): bool|string
    {
        $promotions = $this->promotionRepository->getFeatured();

        return new JsonResponse($promotions, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'description' => 'required',
            'expired_at' => 'required|date',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['error' => $validator->errors()], '401');
        }
        $data = $request->toArray();
        $promotion = $this->promotionRepository->create($data);

        return new JsonResponse($promotion, 200);
    }

    public function update(int $id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'description' => 'required',
            'expired_at' => 'required|date',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['error' => $validator->errors()], '401');
        }
        $data = $request->toArray();
        $this->promotionRepository->update($id,$data);

        return new JsonResponse('Mis a jour avec succés!', 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $this->promotionRepository->delete($id);

        return new JsonResponse('Supprimé avec succés!', '200');
    }
}

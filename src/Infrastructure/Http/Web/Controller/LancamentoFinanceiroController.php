<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Entity\LancamentoFinanceiro;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LancamentoFinanceiroController extends AbstractController
{
    /**
     * @Route("/lancamento-financeiro", name="lancamento_financeiro")
     */
    public function index()
    {
        $lancamentos = $this->getDoctrine()
            ->getManager()
            ->getRepository(LancamentoFinanceiro::class)->findAll();

        return $this->render('lancamento_financeiro/index.html.twig', [
            'controller_name' => 'LancamentoFinanceiroController',
            'lancamentos' => $lancamentos
        ]);
    }
}

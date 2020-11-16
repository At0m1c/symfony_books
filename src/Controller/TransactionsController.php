<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class TransactionsController extends AbstractController
{
    public function __construct(UserRepository $userRepository, Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @Route("/transactions", name="transactions")
     * @param Request            $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $status = $this->transaction->create($request->get('email_from'), $request->get('email_to'), $request->get('amount'));
        return new Response($status);
    }

    /**
     * @Route("/send-transaction", name="send_transactions")
     */
    public function sendTransaction()
    {
        $status = $this->transaction->send();
        return new Response($status);
    }
}

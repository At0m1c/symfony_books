<?php

namespace App\Service;

use App\Entity\Bill;
use App\Entity\Transaction as Tr;
use App\Repository\BillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Transaction
{
    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        BillRepository $billRepository,
        HttpClientInterface $client
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->billRepository = $billRepository;
        $this->client = $client;
    }


    /**
     * @param string $from
     * @param string $to
     * @param int    $amount
     *
     * @return bool
     */
    public function create(string $from, string $to, int $amount)
    {
        $userFrom = $this->userRepository->findOneBy(['email' => $from]);
        $userTo = $this->userRepository->findOneBy(['email' => $to]);

        $currentAmountFromObj = $this->billRepository->findOneBy(['user_id' => $userFrom->getId()]);
        $currentAmountFrom = $currentAmountFromObj->getAmount();

        if ($currentAmountFrom > $amount) {
            // записываем историю транзакций
            $transaction = new Tr();
            $transaction->setAmount($amount);
            $transaction->setUserFrom($userFrom->getId());
            $transaction->setUserTo($userTo->getId());
            $transaction->setDate(time());
            $this->entityManager->persist($transaction);
            $this->entityManager->flush();

            $newAmount = $currentAmountFrom - $amount;

            $userFromBill = $this->billRepository->findOneBy(['user_id' => $userFrom->getId()]);
            $userToBill = $this->billRepository->findOneBy(['user_id' => $userTo->getId()]);

            // обновляем счёт у отправителя
            $userFromBill->setAmount($newAmount);
            $this->entityManager->flush();

            // если у пользователя есть счёт, то делаем апдейт иначе создаём
            if (!empty($userToBill)) {
                $userToBill->setAmount($userToBill->getAmount() + $amount);
                $this->entityManager->flush();
            } else {
                $billTo = new Bill();
                $billTo->setUser($userTo);
                $billTo->setAmount($amount);
                $this->entityManager->persist($billTo);
                $this->entityManager->flush();
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * тест из браузера
     */
    public function send()
    {
        $response = $this->client->request('GET', 'http://web:80/transactions', [
            'query' => [
                'email_from' => 'meagan08@gogreenon.com',
                'email_to' => 'bettye16@p-response.com',
                'amount' => 50,
            ]
        ]);
        $statusCode = $response->getContent();

        return $statusCode;
    }
}
<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function addNoResi(int $id, array $data);
    public function getTransactionById(int $id);
    public function getTransactionByStoreId(int $id);
    public function createTransaction(array $data);
    public function updateTransaction(int $id, array $data);
    public function deleteTransaction(int $id);
    public function checkTransactionCode(string $code): bool;

}

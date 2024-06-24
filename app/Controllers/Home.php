<?php

namespace App\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;

class Home extends BaseController
{
    public function index()
    {
        $customerModel = new Pelanggan();
        $transactionModel = new Transaksi();

        $totalCustomers = $customerModel->getTotalCustomers();
        $totalPending = $transactionModel->getTotalTransactionsByStatus('pending');
        $totalSelesai = $transactionModel->getTotalTransactionsByStatus('selesai');
        $totalDicuci = $transactionModel->getTotalTransactionsByStatus('dicuci');
        $totalDiambil = $transactionModel->getTotalTransactionsByStatus('diambil');

        // Get today's transactions
        $todaysTransactions = $transactionModel->getTodayTransactionsWithCustomer();

        $data = [
            'totalCustomers' => $totalCustomers,
            'totalPending' => $totalPending,
            'totalSelesai' => $totalSelesai,
            'totalDicuci' => $totalDicuci,
            'totalDiambil' => $totalDiambil,
            'todaysTransactions' => $todaysTransactions
        ];

        return view('dashboard', $data);
    }
}

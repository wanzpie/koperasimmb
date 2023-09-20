<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpmDetailController extends Controller
{


    public function generateSchedule()
    {
        $totalAmount = 1000000;
        $installmentCount = 10;
        $installmentAmount = $totalAmount / $installmentCount;

        $currentDate = now();
        $schedules = [];

        for ($i = 1; $i <= $installmentCount; $i++) {
            $paymentDate = $currentDate->addMonths($i);

            $schedule = [
                'invoice_number' => 'INV-' . $i,
                'payment_date' => $paymentDate,
                'amount' => $installmentAmount,
            ];

            $schedules[] = $schedule;
        }

        PaymentSchedule::insert($schedules);

        return "Jadwal pembayaran berhasil di-generate.";
    }

}

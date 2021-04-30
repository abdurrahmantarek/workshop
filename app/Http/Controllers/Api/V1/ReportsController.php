<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Exception;
use PDF;

class ReportsController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function report()
    {
        try {

            $pdf = $this->reportService->generatePdf();

            return $pdf->download();

        }catch (Exception $exception) {

            return response()->json(['error' => 'something went wrong'], 400 );
        }
    }
}

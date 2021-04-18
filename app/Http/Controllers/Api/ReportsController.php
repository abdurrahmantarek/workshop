<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Exception;

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

            return $this->reportService->downloadPdf();

        }catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 500 );
        }
    }
}

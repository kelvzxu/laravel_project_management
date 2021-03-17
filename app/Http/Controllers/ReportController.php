<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function TaskAnalysisReport(Request $request,$token)
    {
        return Jetstream::inertia()->render($request, 'Report/TaskAnalysis', [
        ]);
    }
}

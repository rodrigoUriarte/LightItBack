<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoricDiagnosisResource;
use App\Models\HistoricDiagnosis;
use App\Validators\GetHistoricDiagnosticsValidator;

class HistoricDiagnosisController extends Controller
{
    public function index(GetHistoricDiagnosticsValidator $request)
    {
        $limit = $this->getPaginationLimit($request);
        $user_id = $request->input('user_id');

        $historic_diagnostics = HistoricDiagnosis::query()
            ->where('user_id', $user_id)
            ->paginate($limit)
            ->withQueryString();

        return $this->response(HistoricDiagnosisResource::collection($historic_diagnostics));
    }
}
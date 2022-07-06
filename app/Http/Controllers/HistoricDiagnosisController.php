<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoricDiagnosisResource;
use App\Models\HistoricDiagnosis;
use App\Validators\GetHistoricDiagnosticsValidator;
use Illuminate\Support\Facades\Auth;

class HistoricDiagnosisController extends Controller
{
    public function index(GetHistoricDiagnosticsValidator $request)
    {
        $limit = $this->getPaginationLimit($request);
        $user_id = Auth::user()->id;

        $historic_diagnostics = HistoricDiagnosis::query()
            ->where('user_id', $user_id)
            ->paginate($limit);

        return $this->response(HistoricDiagnosisResource::collection($historic_diagnostics));
    }

    public function update (HistoricDiagnosis $historic_diagnosis)
    {
        $historic_diagnosis->confirmed = true;

        $historic_diagnosis->save();

        return $this->response(new HistoricDiagnosisResource($historic_diagnosis));
    }
}

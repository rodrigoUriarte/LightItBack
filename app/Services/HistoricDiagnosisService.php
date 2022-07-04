<?php

namespace App\Services;

use App\DataTransferObjects\HistoricDiagnosisData;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoricDiagnosisResource;
use App\Models\HistoricDiagnosis;
use Illuminate\Support\Facades\DB;

class HistoricDiagnosisService extends Controller
{
    public function create(HistoricDiagnosisData $data): HistoricDiagnosis
    {

        $historic_diagnosis = new HistoricDiagnosis;

        $historic_diagnosis->historic_diagnosis_id = $data->historic_diagnosis_id;
        $historic_diagnosis->name = $data->name;
        $historic_diagnosis->accuracy = $data->accuracy;
        $historic_diagnosis->icd = $data->icd;
        $historic_diagnosis->icd_name = $data->icd_name;
        $historic_diagnosis->prof_name = $data->prof_name;
        $historic_diagnosis->ranking = $data->ranking;

        return $historic_diagnosis;

    }

    public function store($historicDiagnosis)
    {

        $data = [];
        $resource_data = collect();
        foreach ($historicDiagnosis as $diagnosis) {
            $dto = HistoricDiagnosisData::fromDiagnosis($diagnosis);
            $historic_diagnosis = $this->create($dto);
            $resource_data->push($historic_diagnosis);
            $data[] = $historic_diagnosis->toArray();
        }

        DB::table('historic_diagnostics')->insert($data);

        return $this->response(HistoricDiagnosisResource::collection($resource_data));

    }

}

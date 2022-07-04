<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoricDiagnosisResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        return [
            //'id' => $this->id,
            'historic_diagnosis_id' => $this->historic_diagnosis_id,
            'name' => $this->name,
            'accuracy' => $this->accuracy,
            'icd' => $this->icd,
            'icd_name' => $this->icd_name,
            'prof_name' => $this->prof_name,
            'ranking' => $this->ranking
        ];
    }
}

<?php

namespace App\DataTransferObjects;

use PHPUnit\Util\Json;
use Spatie\DataTransferObject\DataTransferObject;

class HistoricDiagnosisData extends DataTransferObject
{
    public int $historic_diagnosis_id;
    public string $name;
    public int $accuracy;
    public string $icd;
    public string $icd_name;
    public string $prof_name;
    public int $ranking;

    public static function fromDiagnosis(object $data): self
    {
        return new self([
            'historic_diagnosis_id' => $data->Issue->ID,
            'name' => $data->Issue->Name,
            'accuracy' => $data->Issue->Accuracy,
            'icd' => $data->Issue->Icd,
            'icd_name' => $data->Issue->IcdName,
            'prof_name' => $data->Issue->ProfName,
            'ranking' => $data->Issue->Ranking,
        ]);
    }

}

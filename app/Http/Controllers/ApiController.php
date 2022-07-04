<?php

namespace App\Http\Controllers;

use App\Enums\GenderType;
use App\Http\Resources\SymptomsResource;
use App\Services\HistoricDiagnosisService;
use App\Validators\GetDiagnosisValidator;
use App\Validators\GetSymptomsValidator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    /**
     * @var HistoricDiagnosisService
     */
    protected $service;

    public function __construct(HistoricDiagnosisService $service)
    {
        //parent::__construct();
        $this->service = $service;
    }

    //This function get a token from the API and stores it for 2hours in the cache.
    public function getToken()
    {
        $token = Cache::remember('token', 7200, function () {
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.apimedic.user') . ':' . config('services.apimedic.hashed_key')
            ])->post('https://sandbox-authservice.priaid.ch/login')->object()->Token;
        });

        return $token;

    }

    //This function get the symptoms from the API
    public function getSymptoms(GetSymptomsValidator $request)
    {
        $response = Cache::remember('symptoms', 86400, function () {
            return Http::get('https://sandbox-healthservice.priaid.ch/symptoms', [
                'token' => Cache::get('token', function () {
                    return $this->getToken();
                }),
                'symptoms' => [],
                'language' => 'es-es'
            ])->object();
        });

        return $this->response(SymptomsResource::collection($response));

    }

    //This function get the diagnosis from the API, given an array of symptoms.
    public function getDiagnosis(GetDiagnosisValidator $request)
    {
        $response = Http::get('https://sandbox-healthservice.priaid.ch/diagnosis', [
            'token' => Cache::get('token', function () {
                return $this->getToken();
            }),
            'symptoms' => json_encode($request->get('symptoms')),
            'gender' => GenderType::from($request->get('gender'))->value,
            'year_of_birth' => $request->get('year_of_birth'),
            'language' => 'es-es',
        ])->object();

        $diagnosis = $this->service->store($response);

        return $diagnosis;
    }
}

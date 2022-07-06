<?php

namespace App\Http\Controllers;

use App\Enums\GenderType;
use App\Http\Resources\HistoricDiagnosisResource;
use App\Http\Resources\SymptomsResource;
use App\Services\HistoricDiagnosisService;
use App\Validators\GetDiagnosisValidator;
use App\Validators\GetSymptomsValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    public function getSymptoms()
    {
        $response = Cache::remember('symptoms', 86400, function () {
            return Http::get('https://sandbox-healthservice.priaid.ch/symptoms', [
                'token' => Cache::get('token', function () {
                    return $this->getToken();
                }),
                'language' => 'es-es'
            ])->object();
        });

        return $this->response(SymptomsResource::collection($response));

    }

    //This function get the diagnosis from the API, given an array of symptoms.
    public function getDiagnostics(GetDiagnosisValidator $request)
    {
        $gender = GenderType::from(Auth::user()->gender)->value;
        $year_of_birth = Carbon::createFromFormat('Y-m-d', Auth::user()->birthday)->year;

        $response = Http::get('https://sandbox-healthservice.priaid.ch/diagnosis', [
            'token' => Cache::get('token', function () {
                return $this->getToken();
            }),
            'symptoms' => json_encode($request->get('symptoms')),
            'gender' => $gender,
            'year_of_birth' => $year_of_birth,
            'language' => 'es-es',
        ])->object();

        $resource_data = $this->service->store($response);

        return $this->response(HistoricDiagnosisResource::collection($resource_data));

    }
}

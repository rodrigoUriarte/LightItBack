<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricDiagnosis extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'historic_diagnostics';

    /**
     * List of attributes for which mass assignment is forbidden.
     */
    protected $guarded = [
        'id',
    ];
}

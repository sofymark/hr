<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Selects;

class Languages extends Model
{
    public $timestamps = false;

    protected $table = "languages";

    protected $fillable = [
        'employee_id',
        'language',
        'languageOther',
        'languageLevel',
        'languageInstitution',
        'languageInstitutionOther'
    ];

    protected $appends = ['language_description','language_level_description','language_institution_description'];

    public function getLanguageDescriptionAttribute()
    {
        $item = Selects::where(['forSelect' => 'language', 'code' => $this->language])->first();
        return $this->attributes['language_description'] = ($item) ? $item->description : '';
    }

    public function getLanguageLevelDescriptionAttribute()
    {
        $item = Selects::where(['forSelect' => 'languageLevel', 'code' => $this->languageLevel])->first();
        return $this->attributes['language_level_description'] = ($item) ? $item->description : '';
    }

    public function getLanguageInstitutionDescriptionAttribute()
    {
        $item = Selects::where(['forSelect' => 'languageInstitution', 'code' => $this->languageInstitution])->first();
        return $this->attributes['language_institution_description'] = ($item) ? $item->description : '';
    }
}

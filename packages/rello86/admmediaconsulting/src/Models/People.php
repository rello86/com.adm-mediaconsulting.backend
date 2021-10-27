<?php

namespace Rello86\AdmMediaConsulting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'created_at',
        'updated_at',
        'url',
    ];

    public function planet()
    {
        return $this->hasOneThrough(Planet::class, PeoplePlanet::class, 'people_id', 'id', 'id', 'planet_id');
    }

}

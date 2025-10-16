<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['short_des','description','photo','address','phone','phone2','email','email2','email3','logo','facebook','warranty_years','experience_years','projects_count','hero_slogan','presentation_image','about_hero_bg','about_presentation_image','about_mission_image','about_objectives_image','about_expertise_image','about_approach_image'];
}

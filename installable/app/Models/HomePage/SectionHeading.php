<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHeading extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function headingLang()
  {
    return $this->belongsTo('App\Models\Language');
  }
}

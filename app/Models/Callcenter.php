<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callcenter extends Model
{
  use HasFactory;

  protected $fillable = ['image', 'assignment', 'city', 'street', 'number', 'personone', 'phoneone', 'emailone', 'persontwo', 'phonetwo', 'emailtwo', 'emergency', 'keywords'];
}  
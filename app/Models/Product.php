<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  use HasFactory;

  protected $fillable = ['content'];
  protected $hidden = ['updated_at'];
  protected $appends = ['current_price'];

  public function getCurrentPriceAttribute() {
    return $this->price * 3;
  }
}

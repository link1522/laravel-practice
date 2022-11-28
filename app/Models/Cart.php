<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
  use HasFactory;

  protected $guarded = [''];
  private $rate = 1;

  public function cartItems() {
    return $this->hasMany(CartItem::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function order() {
    return $this->hasOne(Order::class);
  }

  public function checkout() {
    $order = $this->order()->create([
      'user_id' => $this->user_id
    ]);

    if ($this->user->level == 2) {
      $this->rate = 0.8;
    }

    foreach ($this->cartItems as $cartItem) {
      $order->orderItems()->create([
        'product_id' => $cartItem->product_id,
        'price' => $cartItem->product->price * $this->rate
      ]);
    }

    $this->update(['checkouted' => true]);

    $order->orderItems;
    return $order;
  }
}

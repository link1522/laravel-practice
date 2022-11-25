<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartItem;

class CartItems extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'cart_id' => 'required|integer',
      'product_id' => 'required|integer',
      'quantity' => 'required|integer'
    ]);

    if ($validator->fails()) {
      return response($validator->errors(), 422);
    }

    $validatedData = $validator->validate();

    // create cart item by relating to cart
    // $cart = Cart::find($validatedData['cart_id']);
    // $result = $cart->cartItems()->create([
    //   'product_id' => $validatedData['product_id'],
    //   'quantity' => $validatedData['quantity']
    // ]);

    // create cart item
    $result = CartItem::create([
      'cart_id' => (int) $validatedData['cart_id'],
      'product_id' => (int) $validatedData['product_id'],
      'quantity' => (int) $validatedData['quantity']
    ]);

    return response($result);
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {

    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'quantity' => 'required|integer'
    ]);

    if ($validator->fails()) {
      return response($validator->errors(), 422);
    }

    $validatedData = $validator->validate();

    // $result = CartItem::find($id)->update([
    //   'quantity' => (int) $validatedData['quantity']
    // ]);

    $result = CartItem::find($id)->fill([
      'quantity' => (int) $validatedData['quantity']
    ]);

    $result->save();

    return response($result);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $result = CartItem::find($id)->delete();

    return response($result);
  }
}

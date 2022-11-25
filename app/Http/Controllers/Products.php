<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Products extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // $data = DB::table('sbl_teams')->get();
    $data = Product::all();
    // dd($data);

    return response($data);
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
   * @param  \App\Http\Requests\StorePostRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePostRequest $request) {
    // $request->validate([
    //   'card_id' => ['required', 'integer'],
    //   'product_id' => ['required', 'integer'],
    //   'quantity' => ['required', 'integer']
    // ]);

    $validated = $request->validated();

    // $validator = Validator::make($request->all(), [
    //   'card_id' => ['required', 'integer'],
    //   'product_id' => ['required', 'integer'],
    //   'quantity' => ['required', 'integer']
    // ], [
    //   'required' => ':attribute 必填',
    //   'integer' => ':attribute 需為整數'
    // ]);

    // if ($validator->fails()) {
    //   return response($validator->errors(), 400);
    // }

    return response('OK');
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
    $request->validate([
      'card_id' => ['required', 'integer'],
      'product_id' => ['required', 'integer'],
      'quantity' => ['required', 'integer']
    ]);

    // $form = $request->all();
    // $data = $this->getData();
    // $selectedData = $data->where('id', $id)->first();
    // $selectedData = $selectedData->merge(collect($form));

    return response('OK');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $data = $this->getData();
    $data = $data->filter(function ($product) use ($id) {
      return $product['id'] != $id;
    })->values();

    return response($data);
  }

  public function getData() {
    return collect([
      collect([
        'id' => 0,
        'title' => 'product-1',
        'content' => 'this is product 1',
        'price' => 200
      ]),
      collect([
        'id' => 1,
        'title' => 'product-2',
        'content' => 'this is product 2',
        'price' => 150
      ]),
      collect([
        'id' => 2,
        'title' => 'product-3',
        'content' => 'this is product 3',
        'price' => 450
      ])
    ]);
  }
}

<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends ApiRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules() {
    return [
      'card_id' => ['required', 'integer'],
      'product_id' => ['required', 'integer'],
      'quantity' => ['required', 'integer']
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages() {
    return [
      'card_id.required' => ':attribute 為必填',
      'card_id.integer' => ':attribute 須為整數',
      'product_id.required' => ':attribute 為必填',
      'product_id.integer' => ':attribute 須為整數',
      'quantity.required' => ':attribute 為必填',
      'quantity.integer' => ':attribute 須為整數'
    ];
  }

  /**
   * Failed validation disable redirect
   *
   * @param \Illuminate\Validation\Validator $validator
   */
  // protected function failedValidation($validator) {
  //   throw new HttpResponseException(response()->json($validator->errors(), 422));
  // }
}

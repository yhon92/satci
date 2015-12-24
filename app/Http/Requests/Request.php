<?php
namespace SATCI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Validator;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{

  // protected function formatErrors(Validator $validator)
  protected function formatValidationErrors(Validator $validator)
  {
    // dd($validator->errors()->all());
    return $validator->errors()->all();
  }
  
}

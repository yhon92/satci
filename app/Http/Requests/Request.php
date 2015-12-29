<?php
namespace SATCI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{

  protected function formatValidationErrors(Validator $validator)
  {
    return $validator->errors()->all();
  }
  
}

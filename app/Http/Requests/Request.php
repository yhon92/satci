<?php namespace SATCI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

abstract class Request extends FormRequest {

	protected function formatErrors(Validator $validator)
	{
		// dd($validator->errors()->all());
		return $validator->errors()->all();
	}
}

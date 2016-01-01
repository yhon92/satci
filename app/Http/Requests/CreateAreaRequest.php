<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class CreateAreaRequest extends Request
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $rules = [
      'name' => 'required',
      'director_id' => 'required',
      'means' => 'required|exists:means,id',
    ];

    $email = $this->request->get('email');

    if ($email !== "No tiene" && empty($email) === false) {
      $rules['email'] = 'required|email';
    }

    return $rules;
  }
}

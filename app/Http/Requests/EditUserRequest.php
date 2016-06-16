<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditUserRequest extends Request
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
      // 'username' => 'required|unique:users,username',
    'first_name' => 'required',
    'last_name' => 'required',
    'active' => 'required|boolean',
    ];

    $password = $this->request->get('password');

    if (!empty($password)) {
      $rules['password'] = 'required|confirmed|min:3';
    }

    return $rules;
  }

}

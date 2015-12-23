<?php namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class CreateUserRequest extends Request {

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
    return [
      'username' => 'required|unique:users,username',
      'first_name' => 'required',
      'last_name' => 'required',
      'password' => 'required|confirmed|min:3',
    ];
  }

}

<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditDirectorRequest extends Request
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
    $id = $this->route()->parameters()['director'];

    return [
      'identification' => 'required|regex:(^([0-9]{6,8})$)|min:6|max:8|unique:directors,identification,'.$id,
      'full_name' => 'required',
      'first_name' => 'required',
      'last_name' => 'required',
      'prefix_phone' => 'required|min:4|max:4',
      'number_phone' => 'required|min:7|max:7',
      'email' => 'required|email',
      'resolution' => 'required|regex:(^([A])-([0-9]{4})-([0-9]{3})$)',
    ];
  }
}

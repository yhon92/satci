<?php namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditCitizenRequest extends Request {

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
    $id = $this->route()->parameters()['citizen'];

    return [
      'identification' => 'required|min:6|max:8|unique:citizens,identification,'.$id, 
      'full_name' => 'required', 
      'first_name' => 'required', 
      'last_name' => 'required', 
      'address' => 'required', 
      'prefix_phone' => 'required|min:4|max:4', 
      'number_phone' => 'required|min:7|max:7', 
      'parish_id' => 'required|max:1|exists:parishes,id',
    ];
  }


}

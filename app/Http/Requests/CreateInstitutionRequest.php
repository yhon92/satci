<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class CreateInstitutionRequest extends Request
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
    return [
      'identification' => 'required|unique:institutions,identification', 
      'full_name' => 'required', 
      'address' => 'required', 
      'prefix_phone' => 'required|min:4|max:4', 
      'number_phone' => 'required|min:7|max:7', 
      'agent_identification' => 'required', 
      'agent_full_name' => 'required', 
      'agent_first_name' => 'required', 
      'agent_last_name' => 'required', 
      'parish_id' => 'required|max:1|exists:parishes,id',
    ];
  }

}

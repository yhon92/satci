<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditAssignSolicitudeRequest extends Request
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
      'update' => [
          'status' => 'required|in:Leído,Aceptado,Rechazado,Atendido'
        ],
      ];
      
    return $rules;
  }
  
}

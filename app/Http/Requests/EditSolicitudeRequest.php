<?php

namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditSolicitudeRequest extends Request
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
      'document_date' => 'required|date', 
      'topic' => 'required',
      'status' => 'required|in:Recibido,Rechazado,Anulado'
      ];
      
    return $rules;
  }
}

<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class CreateSolicitudeRequest extends Request
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
      'reception_date' => 'required|date', 
      'applicant_type' => 'required|in:citizen,institution', 
      // 'applicant_id' => 'requerid', 
      'document_date' => 'required|date', 
      'topic' => 'required', 
      ];

      $entity = $this->request->get('applicant_type');
      
      if ($entity === 'citizen') {
        $rules['applicant_id'] = 'required|exists:citizens,id';
      }
      if ($entity === 'institution') {
        $rules['applicant_id'] = 'required|exists:institutions,id';
      }

      return $rules;
    }
}

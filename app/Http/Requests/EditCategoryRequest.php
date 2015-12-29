<?php
namespace SATCI\Http\Requests;

use SATCI\Http\Requests\Request;

class EditCategoryRequest extends Request
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
    $id = $this->route()->parameters()['category'];

    return [
    'name' => 'required|unique:categories'
    ];
  }
}

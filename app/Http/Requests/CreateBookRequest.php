<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
          'google_id' => 'required',
          'title' => 'required|max:255',
          'author' => 'required',
      ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
      return [
          'title.required' => 'A title is required',
          'title.max' => 'The max length of a title is 255',
          'author.required'  => 'Please provide an the authors name'
      ];
  }

}

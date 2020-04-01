<?php

namespace App\Http\Requests;

use App\Staff;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric|unique:users,id,'.$this->checkIdExists(),
            'email' => 'required|email|unique:users,id,'.$this->checkIdExists(),
            'gender' => 'required|'.Rule::in(Staff::$acceptedGender),
            'file' => 'image|mimes:jpeg,png,jpg',
        ];
    }

    public function checkIdExists(){
        if($this->id){
            return $this->id;
        }
        return false;
    }
}

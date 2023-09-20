<?php

namespace App\Http\Requests\MasterData;

use App\Http\Requests\Request;

class PricingUploadRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'sheet' => ['required']
            
        ];
    }

    public function messages() {
        return [
            'sheet.required'=>'Please Upload Spreadsheet file',
          
        ];
    }

}

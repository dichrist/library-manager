<?php 

namespace App\Validators;

class BookValidator {
    public static function rules() {
        return [
            'title'         => 'string|required',
            'description'   => 'string',
            'price'         => 'numeric|required',
            'status'        => 'integer'
        ];
    }

    public static function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
        ];
    }
}
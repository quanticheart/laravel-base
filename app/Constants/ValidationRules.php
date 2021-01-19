<?php
    
    namespace App\Constants;
    
    class ValidationRules
    {
        const NEW_USER = [
            'usuario' => 'required|min:5|max:80',
            'celular' => 'required|celular_com_ddd',
            'password' => 'required',
            'email' => 'required|email|unique:usuario,email'
        ];
        
        const UPDATE_USER = [
            'usuario' => 'required|min:5|max:80',
            'celular' => 'required|celular_com_ddd',
            'password' => 'required'
        ];
        
        const LOGIN = [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ];
    }

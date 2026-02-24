<?php

return [

    'required' => ':attribute wajib diisi.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => ':attribute minimal :min karakter.',
    ],
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'different' => ':attribute tidak boleh sama dengan :other.',
    'current_password' => 'Password lama tidak sesuai.',

    'attributes' => [
        'name' => 'Nama',
        'email' => 'Email',
        'password' => 'Password',
        'current_password' => 'Password lama',
        'password_confirmation' => 'Konfirmasi password',
    ],

];

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpj implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove caracteres não numéricos
        $value = preg_replace('/\D/', '', $value);

        if (strlen($value) === 11) {
            return $this->validateCpf($value);
        }

        if (strlen($value) === 14) {
            return $this->validateCnpj($value);
        }

        return false;
    }

    public function message()
    {
        return 'O campo :attribute deve ser um CPF ou CNPJ válido.';
    }

    private function validateCpf($cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    private function validateCnpj($cnpj)
    {
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        for ($t = 12; $t <= 13; $t++) {
            $d = 0;
            $pos = $t - 7;

            for ($c = 0; $c < $t; $c++) {
                $d += $cnpj[$c] * $pos--;
                if ($pos < 2) {
                    $pos = 9;
                }
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

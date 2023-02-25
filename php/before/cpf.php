<?php

class Cpf
{
    private function array_every($array, callable $callback)
    {
        foreach ($array as $item) {
            if (!$callback($item)) {
                return false;
            }
        }
        return true;
    }

    private function isAllDigitEquals($cpf) {
        $cpfArr = str_split($cpf);

        return $this->array_every($cpfArr, function ($item) use ($cpfArr) {
            return $item === $cpfArr[0];
        });
    }

    private function calculateCheckDigit($cpf, $factor) {
        $sumDigit = 0;
        for ($i = $factor; $i >= 2; $i--) {
            $digit = intval($cpf[$factor-$i]);
            $sumDigit += $i * $digit;
        };
        $rest = ($sumDigit % 11);
        return ($rest < 2) ? 0 : 11 - $rest;
    }

    public function validate($str)
    {
        if (empty($str)) {
            return false;
        }
        
        $str = $this->cleanCpf($str);
        
        if (strlen($str) !== 11) {
            return false;
        }

        if ($this->isAllDigitEquals($str)) {
            return false;
        }
        
        $firstCheckDigit = $this->calculateCheckDigit($str, 10);
        $secondCheckDigit = $this->calculateCheckDigit($str, 11); 
        $nDigVerific = substr($str, strlen($str) - 2, 2);
        $nDigResult = (string) $firstCheckDigit . $secondCheckDigit;
        return $nDigVerific == $nDigResult;
    }

    private function cleanCpf($cpf)
    {
        return preg_replace('/\D/', '', $cpf);
    }
}

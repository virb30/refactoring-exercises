<?php

class cpf
{
    function array_every($array, callable $callback)
    {
        foreach ($array as $item) {
            if (!$callback($item)) {
                return false;
            }
        }
        return true;
    }

    function validate($str)
    {
        if (!is_null($str)) {
            if (isset($str)) {
                if (strlen($str) >= 11 || strlen($str) <= 14) {

                    $str = str_replace('.', '', $str);
                    $str = str_replace('.', '', $str);
                    $str = str_replace('-', '', $str);
                    $str = str_replace(' ', '', $str);

                    $strArr = str_split($str);

                    if (!$this->array_every($strArr, function ($item) use ($strArr) {
                        return $item === $strArr[0];
                    })) {
                        try {
                            $d1 = 0;
                            $d2 = 0;
                            $dg1 = 0;
                            $dg2 = 0;
                            $rest = 0;
                            $digito = 0;
                            $nDigResult = 0;

                            for ($nCount = 1; $nCount < strlen($str) - 1; $nCount++) {
                                // if (!is_numeric(intval(substr($str, $nCount - 1, 1)))) {
                                // 	return false;
                                // } else {

                                $digito = intval(substr($str, $nCount - 1, 1));
                                $d1 = $d1 + (11 - $nCount) * $digito;
                                
                                $d2 = $d2 + (12 - $nCount) * $digito;
                                // }
                            };

                            $rest = ($d1 % 11);

                            $dg1 = ($rest < 2) ? 0 : 11 - $rest;
                            $d2 += 2 * $dg1;
                            $rest = ($d2 % 11);
                            if ($rest < 2)
                                $dg2 = 0;
                            else
                                $dg2 = 11 - $rest;

                            $nDigVerific = substr($str, strlen($str) - 2, 2);
                            $nDigResult = "" . $dg1 . "" . $dg2;
                            return $nDigVerific == $nDigResult;
                        } catch (Exception $e) {
                            print_r($e);
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

}

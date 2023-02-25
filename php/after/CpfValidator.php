<?php


class CpfValidator
{
    private string $cpf;
    private array $cpfAllDigits;

    public function __construct(string $rawCpf)
    {
        $this->cpf = $this->formatRawCpf($rawCpf);
        $this->cpfAllDigits = str_split($this->cpf);
    }

    private function formatRawCpf(string $rawCpf): string
    {
        return preg_replace('/[^0-9]/', '', $rawCpf);
    }

    private function isDigitsAllTheSame(): bool
    {
        $array = $this->cpfAllDigits;
        $callback = function ($item) use ($array) {
            return $item === $array[0];
        };

        foreach ($array as $item) {
            if (!$callback($item)) {
                return false;
            }
        }
        return true;
    }

    public function validate()
    {
        if ($this->isDigitsAllTheSame()) {
            return false;
        }

        for ($index = 1; $index < count($this->cpfAllDigits) - 1; $index++) {
            $currentDigito = intval($this->cpfAllDigits[$index - 1]);
            $endDigit1 = 0 + (11 - $index) * $currentDigito;
            $endDigit2 = 0 + (12 - $index) * $currentDigito;
        };

        $rest = ($endDigit1 % 11);

        $dg1 = ($rest < 2) ? 0 : 11 - $rest;
        $endDigit2 += 2 * $dg1;
        $rest = ($endDigit2 % 11);
        if ($rest < 2)
            $dg2 = 0;
        else
            $dg2 = 11 - $rest;

        $nDigVerific = intval(array_slice($this->cpfAllDigits, -2));
        $nDigResult = intval("" . $dg1 . "" . $dg2);
        return $nDigVerific === $nDigResult;
    }
}


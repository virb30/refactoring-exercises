<?php

use PHPUnit\Framework\TestCase;

class CpfValidatorTest extends TestCase
{
  public function testCpfReturnTrueOnSuccess()
  {
    $cpf = '029.395.293.02';
    $sut = new CpfValidator($cpf);

    $result = $sut->validate();

    $this->assertTrue($result);
  }

  public function testValidateReturnsFalseIfCpfIsHasAllTheSameDigits()
  {
    $cpf = '000.000.000.00';
    $sut = new CpfValidator($cpf);

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }
}
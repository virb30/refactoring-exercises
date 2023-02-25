<?php

use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
  
  public function testValidateReturnsTrue()
  {
    $sut = new Cpf();
    $cpf = '029.395.293.02';

    $result = $sut->validate($cpf);

    $this->assertTrue($result);
  }
  

  public function testValidateReturnsFalse()
  {
    $sut = new Cpf();
    $cpf = '413.446.789.32';

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }


  public function testValidateReturnsFalseIfCpfIsNull()
  {
    $sut = new Cpf();
    $cpf = null;

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }

  public function testValidateReturnsFalseIfCpfIsNotSet()
  {
    $sut = new Cpf();
    $cpf = null;

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }

  public function testValidateReturnsFalseIfCpfIsHasAllTheSameDigits()
  {
    $sut = new Cpf();
    $cpf = '000.000.000.00';

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }

  public function testValidateReturnsFalseIfCpfIsSmallerThanElevenDigits()
  {
    $sut = new Cpf();
    $cpf = '123';

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }
  
  public function testValidateReturnsFalseIfCpfHasInvalidCharacterDigits()
  {
    $sut = new Cpf();
    $cpf = '123456789ab';

    $result = $sut->validate($cpf);

    $this->assertFalse($result);
  }
}
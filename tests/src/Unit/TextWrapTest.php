<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé sobre", $ret[5]);
    $this->assertEquals("ombros", $ret[6]);
    $this->assertEquals("de", $ret[7]);
    $this->assertEquals("gigantes", $ret[8]);
    $this->assertCount(9, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
    $this->assertCount(6, $ret);
  }

  /**
   * Checa o retorno para tamanho de substring zero.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForZeroLength() {
    $ret = $this->resolucao->textWrap($this->baseString, 0);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }
   
  /**
   * Checa o retorno para tamanho de substring negativo.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForNegativeLength() {
    $ret = $this->resolucao->textWrap($this->baseString, -100);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }
  
  /**
   * Checa o retorno para o caso em que a palavra é maior
   * que o tamanho máximo da substring.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigWord() {
    $ret = $this->resolucao->textWrap("gigante", 3);
    $this->assertEquals("gig", $ret[0]);
    $this->assertEquals("ant", $ret[1]);
    $this->assertEquals("e", $ret[2]);
    $this->assertCount(3, $ret);
  }
  
  /**
   * Checa o retorno para o caso em que a palavra é maior
   * que o tamanho máximo da substring.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigWord2() {
    $ret = $this->resolucao->textWrap($this->baseString, 5);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi", $ret[3]);
    $this->assertEquals("por", $ret[4]);
    $this->assertEquals("estar", $ret[5]);
    $this->assertEquals("de pé", $ret[6]);
    $this->assertEquals("sobre", $ret[7]);
    $this->assertEquals("ombro", $ret[8]);
    $this->assertEquals("s de", $ret[9]);
    $this->assertEquals("gigan", $ret[10]);
    $this->assertEquals("tes", $ret[11]);
    $this->assertCount(12, $ret);
  }
  
  /**
   * Checa o retorno para o caso em que há mais de um espaço
   * no fim de uma substring.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSpaces() {
    $ret = $this->resolucao->textWrap("Estar   de pé", 5);
    $this->assertEquals("Estar", $ret[0]);
    $this->assertEquals("de pé", $ret[1]);
    $this->assertCount(2, $ret);
  }

}

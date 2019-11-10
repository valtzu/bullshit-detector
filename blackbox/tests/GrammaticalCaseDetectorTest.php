<?php

use Blackbox\Detectors\AblativeGrammaticalCaseDetector;
use Blackbox\Detectors\AdessiveGrammaticalCaseDetector;
use Blackbox\Detectors\AllativeGrammaticalCaseDetector;
use Blackbox\Detectors\ElativeGrammaticalCaseDetector;
use Blackbox\Detectors\EssiveGrammaticalCaseDetector;
use Blackbox\Detectors\GenitiveGrammaticalCaseDetector;
use Blackbox\Detectors\IllativeGrammaticalCaseDetector;
use Blackbox\Detectors\InessiveGrammaticalCaseDetector;
use Blackbox\Detectors\PartitiveGrammaticalCaseDetector;
use Blackbox\Detectors\TranslativeGrammaticalCaseDetector;
use PHPUnit\Framework\TestCase;

class GrammaticalCaseDetectorTest extends TestCase
{
	public function ablativeProvider()
	{
		yield ['äidiltä', true];
		yield ['kaverilta', true];
		yield ['koululta', true];
		yield ['perseeltä', true];
		yield ['ehe ehe', false];
		yield ['säälistä', false];
	}

	/**
	 * @dataProvider ablativeProvider
	 */
	public function testAblative($word, $shouldMatch)
	{
		$detector = new AblativeGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function adessiveProvider()
	{
		yield ['isällä', true];
		yield ['frendillä', true];
		yield ['tutuilla', true];
		yield ['kylillä', true];
		yield ['kyllllä', false];
		yield ['ehe ehe', false];
		yield ['pehmeää', false];
	}

	/**
	 * @dataProvider adessiveProvider
	 */
	public function testAdessive($word, $shouldMatch)
	{
		$detector = new AdessiveGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function allativeProvider()
	{
		yield ['valituille', true];
		yield ['vanhukselle', true];
		yield ['ihmisille', true];
		yield ['sepolle', true];
		yield ['ismolle', true];
		yield ['ismollle', false];
		yield ['ehe ehe', false];
		yield ['ismolta', false];
	}

	/**
	 * @dataProvider allativeProvider
	 */
	public function testAllative($word, $shouldMatch)
	{
		$detector = new AllativeGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function elativeProvider()
	{
		yield ['säälistä', true];
		yield ['säleistä', true];
		yield ['saleista', true];
		yield ['säämiskä', false];
		yield ['ssssssta', false];
	}

	/**
	 * @dataProvider elativeProvider
	 */
	public function testElative($word, $shouldMatch)
	{
		$detector = new ElativeGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function essiveProvider()
	{
		yield ['sinä', true];
		yield ['sinuna', true];
		yield ['minä', true];
		yield ['minuna', true];
		yield ['tavoitteena', true];
		yield ['jouluna', true];
		yield ['joulumaa', false];
		yield ['nunna', false];
	}

	/**
	 * @dataProvider essiveProvider
	 */
	public function testEssive($word, $shouldMatch)
	{
		$detector = new EssiveGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function genitiveProvider()
	{
		yield ['sinun', true];
		yield ['minun', true];
		yield ['meidän', true];
		yield ['eläinten', true];
		yield ['kaverusten', true];
		yield ['sunn', false];
		yield ['sinä', false];
	}

	/**
	 * @dataProvider genitiveProvider
	 */
	public function testGenitive($word, $shouldMatch)
	{
		$detector = new GenitiveGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function illativeProvider()
	{
		yield ['sinuun', true];
		yield ['meihin', true];
		yield ['pyötään', true];
		yield ['veneeseen', true];
		yield ['veneisiin', true];
		yield ['meidän', false];
		yield ['sineen', false];
	}

	/**
	 * @dataProvider illativeProvider
	 */
	public function testIllative($word, $shouldMatch)
	{
		$detector = new IllativeGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function inessiveProvider()
	{
		yield ['sinussa', true];
		yield ['meissä', true];
		yield ['kesässä', true];
		yield ['kaveruksissa', true];
		yield ['syksyssä', true];
		yield ['veneeseen', false];
		yield ['pöydästä', false];
	}

	/**
	 * @dataProvider inessiveProvider
	 */
	public function testInessive($word, $shouldMatch)
	{
		$detector = new InessiveGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function partitiveProvider()
	{
		yield ['sinua', true];
		yield ['kantavia', true];
		yield ['työtä', true];
		yield ['kolikoita', true];
		yield ['sukkia', true];
		yield ['meitä', true];
		yield ['kesää', true];
		yield ['kaveruksia', true];
		yield ['kevättä', true];
		yield ['jouluna', false];
		yield ['jääkaappi', false];
	}

	/**
	 * @dataProvider partitiveProvider
	 */
	public function testPartitive($word, $shouldMatch)
	{
		$detector = new PartitiveGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}

	public function translativeProvider()
	{
		yield ['sinuksi', true];
		yield ['meiksi', true];
		yield ['kesäksi', true];
		yield ['kaveruksiksi', true];
		yield ['kevääksi', true];
		yield ['jääkaappi', false];
		yield ['pakastin', false];
	}

	/**
	 * @dataProvider translativeProvider
	 */
	public function testTranslative($word, $shouldMatch)
	{
		$detector = new TranslativeGrammaticalCaseDetector;
		$this->assertSame($shouldMatch, $detector->matches($word));
	}
}
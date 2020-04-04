<?php

namespace Tests\Unit;

use App\Classes\PriceRuleProcessor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PricingTest extends TestCase
{
	public function testPrices()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('tickrate:128=>2,64=>1;*;slots:1;*;slots:1;*;gotv:0=>1,1=>1.25;-;vip:0=>0,1=>50;/;vip:0=>1,1=>2');
		$a->setValues([
			'tickrate' => '128',
			'slots'    => 10,
			'gotv'     => 1,
			'vip'      => 1,
		]);

		$this->assertEquals(100, $a->run());
	}

	public function testSelectorRules()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('tickrate:128=>2,64=>1');

		$a->setValues([
			'tickrate' => '128',
		]);
		$this->assertEquals(2, $a->run());

		$a->setValues([
			'tickrate' => 64,
		]);
		$this->assertEquals(1, $a->run());
	}

	public function testValueRules()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('slots:10');

		$a->setValues([
			'slots' => '10',
		]);
		$this->assertEquals(100, $a->run());

		$a->setValues([
			'slots' => 5,
		]);
		$this->assertEquals(50, $a->run());
	}

	public function testRawValue()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('10');

		$a->setValues([
			'slots' => '10',
		]);
		$this->assertEquals(10, $a->run());

		$a->setValues([
			'slots' => 5,
		]);
		$this->assertEquals(10, $a->run());

		$a->setRule('10;*;10');

		$a->setValues([
			'slots' => '10',
		]);
		$this->assertEquals(100, $a->run());

		$a->setValues([
			'slots' => 5,
		]);
		$this->assertEquals(100, $a->run());
	}

	public function testSumOp()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('tickrate:128=>50,64=>25;+;slots:10');

		$a->setValues([
			'tickrate' => 128,
			'slots'    => '10',
		]);
		$this->assertEquals(150, $a->run());

		$a->setValues([
			'tickrate' => 64,
			'slots'    => 5,
		]);
		$this->assertEquals(75, $a->run());
	}

	public function testSubOp()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('slots:10;-;vip:0=>0,1=>40');

		$a->setValues([
			'slots' => '10',
			'vip'   => 0,
		]);
		$this->assertEquals(100, $a->run());

		$a->setValues([
			'slots' => 10,
			'vip'   => 1,
		]);
		$this->assertEquals(60, $a->run());
	}

	public function testMultOp()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('slots:10;*;vip:0=>2,1=>1');

		$a->setValues([
			'slots' => '10',
			'vip'   => 0,
		]);
		$this->assertEquals(200, $a->run());

		$a->setValues([
			'slots' => 10,
			'vip'   => 1,
		]);
		$this->assertEquals(100, $a->run());
	}

	public function testDivOp()
	{
		$a = new PriceRuleProcessor();

		$a->setRule('slots:10;/;vip:0=>1,1=>2');

		$a->setValues([
			'slots' => '10',
			'vip'   => 0,
		]);
		$this->assertEquals(100, $a->run());

		$a->setValues([
			'slots' => 10,
			'vip'   => 1,
		]);
		$this->assertEquals(50, $a->run());
	}

}

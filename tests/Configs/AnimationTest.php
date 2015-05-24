<?php

namespace Khill\Lavacharts\Tests\Configs;

use \Khill\Lavacharts\Tests\ProvidersTestCase;
use \Khill\Lavacharts\Configs\Animation;
use \Mockery as m;

class AnimationTest extends ProvidersTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->a = new Animation;
    }

    public function testConstructorDefaults()
    {
        $this->assertNull($this->a->duration);
        $this->assertNull($this->a->easing);
        $this->assertNull($this->a->startup);
    }

    public function testConstructorValuesAssignment()
    {
        $animation = new Animation([
            'duration' => 300,
            'easing'   => 'linear',
            'startup'  => true
        ]);

        $this->assertEquals(300, $animation->duration);
        $this->assertEquals('linear', $animation->easing);
        $this->assertTrue($animation->startup);
    }

    /**
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigProperty
     */
    public function testConstructorWithInvalidPropertiesKey()
    {
        new Animation(['Pickles' => 'tasty']);
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testDurationWithBadParams($badParams)
    {
        $this->a->duration($badParams);
    }

    /**
     * @dataProvider easingVals
     */
    public function testEasingWithAcceptedValues($easingVals)
    {
        $this->a->easing($easingVals);
        $this->assertEquals($easingVals, $this->a->easing);
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testEasingWithNonAcceptableValue()
    {
        $this->a->easing('fast');
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testEasingWithBadParams($badParams)
    {
        $this->a->easing($badParams);
    }

    /**
     * @dataProvider nonBoolProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testStartupWithBadParams($badParams)
    {
        $this->a->startup($badParams);
    }

    public function easingVals()
    {
        return [
            ['linear'],
            ['in'],
            ['out'],
            ['inAndOut'],
        ];
    }
}

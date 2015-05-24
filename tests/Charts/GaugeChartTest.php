<?php

namespace Khill\Lavacharts\Tests\Charts;

use \Khill\Lavacharts\Charts\GaugeChart;

class GaugeChartTest extends ChartTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->GaugeChart = new GaugeChart('Temps', $this->partialDataTable);
    }

    public function testInstanceOfGaugeChartWithType()
    {
        $this->assertInstanceOf('\Khill\Lavacharts\Charts\GaugeChart', $this->GaugeChart);
    }

    public function testTypeGaugeChart()
    {
        $chart = $this->GaugeChart;

        $this->assertEquals('GaugeChart', $chart::TYPE);
    }

    public function testLabelAssignedViaConstructor()
    {
        $this->assertEquals('Temps', $this->GaugeChart->label);
    }

    public function testForceIFrame()
    {
        $this->GaugeChart->forceIFrame(true);

        $this->assertTrue($this->GaugeChart->getOption('forceIFrame'));
    }

    /**
     * @dataProvider nonBoolProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testForceIFrameWithBadType($badTypes)
    {
        $this->GaugeChart->forceIFrame($badTypes);
    }

    public function testGreenColor()
    {
        $this->GaugeChart->greenColor('#FE9BC5');

        $this->assertEquals('#FE9BC5', $this->GaugeChart->getOption('greenColor'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testGreenColorWithBadTypes($badTypes)
    {
        $this->GaugeChart->greenColor($badTypes);
    }

    public function testGreenFrom()
    {
        $this->GaugeChart->greenFrom(0);

        $this->assertEquals(0, $this->GaugeChart->getOption('greenFrom'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testGreenFromWithBadTypes($badTypes)
    {
        $this->GaugeChart->greenFrom($badTypes);
    }

    public function testGreenTo()
    {
        $this->GaugeChart->greenTo(100);

        $this->assertEquals(100, $this->GaugeChart->getOption('greenTo'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testGreenToWithBadTypes($badTypes)
    {
        $this->GaugeChart->greenTo($badTypes);
    }

    public function testMajorTicks()
    {
        $ticks = [
            'Safe',
            'Ok',
            'Danger',
            'Critical'
        ];

        $this->GaugeChart->majorTicks($ticks);

        $this->assertEquals($ticks, $this->GaugeChart->getOption('majorTicks'));
    }

    /**
     * @dataProvider nonArrayProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testMajorTicksWithBadTypes($badTypes)
    {
        $this->GaugeChart->majorTicks($badTypes);
    }

    public function testMax()
    {
        $this->GaugeChart->max(100);

        $this->assertEquals(100, $this->GaugeChart->getOption('max'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testMaxWithBadTypes($badTypes)
    {
        $this->GaugeChart->max($badTypes);
    }

    public function testMin()
    {
        $this->GaugeChart->min(1);

        $this->assertEquals(1, $this->GaugeChart->getOption('min'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testMinWithBadTypes($badTypes)
    {
        $this->GaugeChart->min($badTypes);
    }

    public function testMinorTicks()
    {
        $this->GaugeChart->minorTicks(5);

        $this->assertEquals(5, $this->GaugeChart->getOption('minorTicks'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testMinorTicksWithBadTypes($badTypes)
    {
        $this->GaugeChart->minorTicks($badTypes);
    }

    public function testRedColor()
    {
        $this->GaugeChart->redColor('#43F9C1');

        $this->assertEquals('#43F9C1', $this->GaugeChart->getOption('redColor'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testRedColorWithBadTypes($badTypes)
    {
        $this->GaugeChart->redColor($badTypes);
    }

    public function testRedFrom()
    {
        $this->GaugeChart->redFrom(0);

        $this->assertEquals(0, $this->GaugeChart->getOption('redFrom'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testRedFromWithBadTypes($badTypes)
    {
        $this->GaugeChart->redFrom($badTypes);
    }

    public function testRedTo()
    {
        $this->GaugeChart->redTo(100);

        $this->assertEquals(100, $this->GaugeChart->getOption('redTo'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testRedToWithBadTypes($badTypes)
    {
        $this->GaugeChart->redTo($badTypes);
    }

    public function testYellowColor()
    {
        $this->GaugeChart->yellowColor('#00FB3C');

        $this->assertEquals('#00FB3C', $this->GaugeChart->getOption('yellowColor'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testYellowColorWithBadTypes($badTypes)
    {
        $this->GaugeChart->yellowColor($badTypes);
    }

    public function testYellowFrom()
    {
        $this->GaugeChart->yellowFrom(0);

        $this->assertEquals(0, $this->GaugeChart->getOption('yellowFrom'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testYellowFromWithBadTypes($badTypes)
    {
        $this->GaugeChart->yellowFrom($badTypes);
    }

    public function testYellowTo()
    {
        $this->GaugeChart->yellowTo(100);

        $this->assertEquals(100, $this->GaugeChart->getOption('yellowTo'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testYellowToWithBadTypes($badTypes)
    {
        $this->GaugeChart->yellowTo($badTypes);
    }
}

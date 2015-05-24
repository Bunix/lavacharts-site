<?php

namespace Khill\Lavacharts\Tests\Charts;

use \Khill\Lavacharts\Charts\PieChart;
use \Mockery as m;

class PieChartTest extends ChartTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->PieChart = new PieChart('MyTestChart', $this->partialDataTable);
    }

    public function testInstanceOfPieChartWithType()
    {
        $this->assertInstanceOf('\Khill\Lavacharts\Charts\PieChart', $this->PieChart);
    }

    public function testTypePieChart()
    {
        $chart = $this->PieChart;

        $this->assertEquals('PieChart', $chart::TYPE);
    }

    public function testLabelAssignedViaConstructor()
    {
        $this->assertEquals('MyTestChart', $this->PieChart->label);
    }

    public function testIs3D()
    {
        $this->PieChart->is3D(true);

        $this->assertTrue($this->PieChart->getOption('is3D'));
    }

    /**
     * @dataProvider nonBoolProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testIs3DWithBadType($badTypes)
    {
        $this->PieChart->is3D($badTypes);
    }

    public function testSlices()
    {
        $textStyleVals = [
           'color'    => 'blue',
           'fontName' => 'Arial',
           'fontSize' => 16
        ];

        $mockTextStyle = m::mock('Khill\Lavacharts\Configs\TextStyle');
        //$mockTextStyle->shouldReceive('getValues')->once()->andReturn($textStyleVals);

        $sliceVals = [
           'color'     => 'blue',
           'offset'    => 'Arial',
           'textStyle' => $mockTextStyle
        ];

        $mockSlice1 = m::mock('Khill\Lavacharts\Configs\Slice');
        $mockSlice1->shouldReceive('getValues')->once()->andReturn($sliceVals);

        $mockSlice2 = m::mock('Khill\Lavacharts\Configs\Slice');
        $mockSlice2->shouldReceive('getValues')->once()->andReturn($sliceVals);

        $this->PieChart->slices([$mockSlice1, $mockSlice2]);

        $slices = $this->PieChart->getOption('slices');

        $this->assertEquals($sliceVals, $slices[0]);
        $this->assertEquals($sliceVals, $slices[1]);
    }

    /**
     * @dataProvider nonArrayProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testSlicesWithBadTypes($badTypes)
    {
        $this->PieChart->slices($badTypes);
    }

    public function testPieSliceBorderColorValidValues()
    {
        $this->PieChart->pieSliceBorderColor('green');

        $this->assertEquals('green', $this->PieChart->getOption('pieSliceBorderColor'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieSliceBorderColorWithBadTypes($badTypes)
    {
        $this->PieChart->pieSliceBorderColor($badTypes);
    }

    public function testPieSliceTextWithValidValues()
    {
        $this->PieChart->pieSliceText('percentage');
        $this->assertEquals('percentage', $this->PieChart->getOption('pieSliceText'));

        $this->PieChart->pieSliceText('value');
        $this->assertEquals('value', $this->PieChart->getOption('pieSliceText'));

        $this->PieChart->pieSliceText('label');
        $this->assertEquals('label', $this->PieChart->getOption('pieSliceText'));

        $this->PieChart->pieSliceText('none');
        $this->assertEquals('none', $this->PieChart->getOption('pieSliceText'));
    }

    /**
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieSliceTextWithBadValue()
    {
        $this->PieChart->pieSliceText('beer');
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieSliceTextWithBadTypes($badTypes)
    {
        $this->PieChart->pieSliceText($badTypes);
    }

    public function testPieSliceTextStyle()
    {
        $this->PieChart->pieSliceTextStyle($this->getMockTextStyle('pieSliceTextStyle'));

        $this->assertTrue(is_array($this->PieChart->getOption('pieSliceTextStyle')));
    }

    public function testPieStartAngle()
    {
        $this->PieChart->pieStartAngle(12);

        $this->assertEquals(12, $this->PieChart->getOption('pieStartAngle'));
    }

    /**
     * @dataProvider nonIntProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieStartAngleWithBadTypes($badTypes)
    {
        $this->PieChart->pieStartAngle($badTypes);
    }

    public function testReverseCategories()
    {
        $this->PieChart->reverseCategories(true);

        $this->assertTrue($this->PieChart->getOption('reverseCategories'));
    }

    /**
     * @dataProvider nonBoolProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testReverseCategoriesWithBadType($badTypes)
    {
        $this->PieChart->reverseCategories($badTypes);
    }

    public function testSliceVisibilityThreshold()
    {
        $this->PieChart->sliceVisibilityThreshold(23);

        $this->assertEquals(23, $this->PieChart->getOption('sliceVisibilityThreshold'));
    }

    /**
     * @dataProvider nonNumericProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testSliceVisibilityThresholdWithBadTypes($badTypes)
    {
        $this->PieChart->sliceVisibilityThreshold($badTypes);
    }

    public function testPieResidueSliceColor()
    {
        $this->PieChart->pieResidueSliceColor('red');

        $this->assertEquals('red', $this->PieChart->getOption('pieResidueSliceColor'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieResidueSliceColorWithBadTypes($badTypes)
    {
        $this->PieChart->pieResidueSliceColor($badTypes);
    }

    public function testPieResidueSliceLabel()
    {
        $this->PieChart->pieResidueSliceLabel('leftovers');

        $this->assertEquals('leftovers', $this->PieChart->getOption('pieResidueSliceLabel'));
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testPieResidueSliceLabelWithBadTypes($badTypes)
    {
        $this->PieChart->pieResidueSliceLabel($badTypes);
    }
}

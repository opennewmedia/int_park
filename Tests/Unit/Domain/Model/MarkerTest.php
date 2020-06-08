<?php
namespace ONM\IntPark\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Usman Ahmad <ua@onm.de>
 */
class MarkerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ONM\IntPark\Domain\Model\Marker
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ONM\IntPark\Domain\Model\Marker();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLatReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLat()
        );
    }

    /**
     * @test
     */
    public function setLatForFloatSetsLat()
    {
        $this->subject->setLat(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'lat',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getLonReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLon()
        );
    }

    /**
     * @test
     */
    public function setLonForFloatSetsLon()
    {
        $this->subject->setLon(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'lon',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getContentReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getContent()
        );
    }

    /**
     * @test
     */
    public function setContentForStringSetsContent()
    {
        $this->subject->setContent('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'content',
            $this->subject
        );
    }
}

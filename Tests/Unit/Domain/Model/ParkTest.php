<?php
namespace ONM\IntPark\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Usman Ahmad <ua@onm.de>
 */
class ParkTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ONM\IntPark\Domain\Model\Park
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ONM\IntPark\Domain\Model\Park();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getImageReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getImage()
        );
    }

    /**
     * @test
     */
    public function setImageForFileReferenceSetsImage()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setImage($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'image',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMarkersReturnsInitialValueForMarker()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getMarkers()
        );
    }

    /**
     * @test
     */
    public function setMarkersForObjectStorageContainingMarkerSetsMarkers()
    {
        $marker = new \ONM\IntPark\Domain\Model\Marker();
        $objectStorageHoldingExactlyOneMarkers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneMarkers->attach($marker);
        $this->subject->setMarkers($objectStorageHoldingExactlyOneMarkers);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneMarkers,
            'markers',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addMarkerToObjectStorageHoldingMarkers()
    {
        $marker = new \ONM\IntPark\Domain\Model\Marker();
        $markersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $markersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($marker));
        $this->inject($this->subject, 'markers', $markersObjectStorageMock);

        $this->subject->addMarker($marker);
    }

    /**
     * @test
     */
    public function removeMarkerFromObjectStorageHoldingMarkers()
    {
        $marker = new \ONM\IntPark\Domain\Model\Marker();
        $markersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $markersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($marker));
        $this->inject($this->subject, 'markers', $markersObjectStorageMock);

        $this->subject->removeMarker($marker);
    }
}

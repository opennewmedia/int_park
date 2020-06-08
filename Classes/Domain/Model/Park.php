<?php
namespace ONM\IntPark\Domain\Model;

/***
 *
 * This file is part of the "Interactive Park Plan" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Usman Ahmad <ua@onm.de>, Open New Media GmbH.
 *
 ***/

/**
 * Park
 */
class Park extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * bgcolor
     *
     * @var string
     */
    protected $bgcolor = '';
    
    /**
     * iconDistance
     *
     * @var string
     */
    protected $iconDistance = '';

    /**
     * iconDistanceLeft
     *
     * @var string
     */
    protected $iconDistanceLeft = '';

    /**
     * iconColor
     *
     * @var string
     */
    protected $iconColor = '';
    
    /**
     * pin
     *
     * @var string
     */
    protected $pin = '';
    
    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    /**
     * markers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ONM\IntPark\Domain\Model\Marker>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $markers = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->markers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Adds a Marker
     *
     * @param \ONM\IntPark\Domain\Model\Marker $marker
     * @return void
     */
    public function addMarker(\ONM\IntPark\Domain\Model\Marker $marker)
    {
        $this->markers->attach($marker);
    }

    /**
     * Removes a Marker
     *
     * @param \ONM\IntPark\Domain\Model\Marker $markerToRemove The Marker to be removed
     * @return void
     */
    public function removeMarker(\ONM\IntPark\Domain\Model\Marker $markerToRemove)
    {
        $this->markers->detach($markerToRemove);
    }

    /**
     * Returns the markers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ONM\IntPark\Domain\Model\Marker> $markers
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Sets the markers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ONM\IntPark\Domain\Model\Marker> $markers
     * @return void
     */
    public function setMarkers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $markers)
    {
        $this->markers = $markers;
    }

    /**
     * Get title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string  $title  title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get pin
     *
     * @return  string
     */ 
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Set pin
     *
     * @param  string  $pin  pin
     *
     * @return  self
     */ 
    public function setPin(string $pin)
    {
        $this->pin = $pin;

        return $this;
    }

    /**
     * Get iconDistance
     *
     * @return  string
     */ 
    public function getIconDistance()
    {
        return $this->iconDistance;
    }

    /**
     * Set iconDistance
     *
     * @param  string  $iconDistance  iconDistance
     *
     * @return  self
     */ 
    public function setIconDistance(string $iconDistance)
    {
        $this->iconDistance = $iconDistance;

        return $this;
    }

    /**
     * Get iconColor
     *
     * @return  string
     */ 
    public function getIconColor()
    {
        return $this->iconColor;
    }

    /**
     * Set iconColor
     *
     * @param  string  $iconColor  iconColor
     *
     * @return  self
     */ 
    public function setIconColor(string $iconColor)
    {
        $this->iconColor = $iconColor;

        return $this;
    }

    /**
     * Get bgcolor
     *
     * @return  string
     */ 
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Set bgcolor
     *
     * @param  string  $bgcolor  bgcolor
     *
     * @return  self
     */ 
    public function setBgcolor(string $bgcolor)
    {
        $this->bgcolor = $bgcolor;

        return $this;
    }

    /**
     * Get iconDistanceLeft
     *
     * @return  string
     */ 
    public function getIconDistanceLeft()
    {
        return $this->iconDistanceLeft;
    }

    /**
     * Set iconDistanceLeft
     *
     * @param  string  $iconDistanceLeft  iconDistanceLeft
     *
     * @return  self
     */ 
    public function setIconDistanceLeft(string $iconDistanceLeft)
    {
        $this->iconDistanceLeft = $iconDistanceLeft;

        return $this;
    }
}

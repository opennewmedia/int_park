<?php
namespace ONM\IntPark\Domain\Model;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
 * Marker
 */
class Marker extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * icon
     *
     * @var string
     */
    protected $icon = '';

    /**
     * lat
     *
     * @var float
     */
    protected $lat = 0.0;

    /**
     * lon
     *
     * @var float
     */
    protected $lon = 0.0;

    /**
     * contenthtml
     *
     * @var string
     */
    protected $contenthtml = '';

    /**
     * list
     *
     * @var string
     */
    protected $list = '';

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the lat
     *
     * @return float $lat
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Sets the lat
     *
     * @param float $lat
     * @return void
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * Returns the lon
     *
     * @return float $lon
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Sets the lon
     *
     * @param float $lon
     * @return void
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    }

    /**
     * Returns the contenthtml
     *
     * @return string $contenthtml
     */
    public function getContenthtml()
    {
        return $this->contenthtml;
    }

    /**
     * Sets the contenthtml
     *
     * @param string $contenthtml
     * @return void
     */
    public function setContenthtml($contenthtml)
    {
        $this->contenthtml = $contenthtml;
    }

    /**
     * Get icon
     *
     * @return  string
     */ 
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set icon
     *
     * @param  string  $icon  icon
     *
     * @return  self
     */ 
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get list
     *
     * @return  string
     */ 
    public function getList()
    {
        return ($this->list == NULL) ? '' : $this->list;
    }

    /**
     * Set list
     *
     * @param  string  $list  list
     *
     * @return  self
     */ 
    public function setList(string $list)
    {
        $this->list = $list;

        return $this;
    }
    
    /**
     * Get list
     *
     * @return  string
     */ 
    public function getListcontent()
    {
        if($this->getList()) {
            // this will fetch textmedia elements from list property and render them to be shown in marker's info window
            $uids = explode(',', $this->getList());

            $connection = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getConnectionForTable('tt_content');

            $queryBuilder = $connection->createQueryBuilder();
            $query = $queryBuilder
                ->select('*')
                ->from('tt_content')
                ->where('uid in ('.$this->getList().')');

            $rows = $query->execute()->fetchAll();

            foreach($rows as $row) {
                $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
                $fileObject = $fileRepository->findByRelation('tt_content', 'assets', $row['uid']);
                $assetUid = (!empty($fileObject)) ? $fileObject[0]->getUid() : 0;
                $data[] = ['assetUid' => $assetUid,
                    'uid' => $row['uid'],
                    'header' => $row['header'],
                    'link' => $row['header_link'],
                    'bodytext' => $row['bodytext']
                ];
            }

            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
            $standaloneView = $objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);
            $templatePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:int_park/Resources/Private/Templates/Map/Listcontent.html');

            $standaloneView->setFormat('html');
            $standaloneView->setTemplatePathAndFilename($templatePath);
            $standaloneView->assignMultiple(['data' => $data]);

            return $standaloneView->render();
        } else {
            return '';
        }
    }
}

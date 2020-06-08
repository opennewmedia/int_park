<?php
namespace ONM\IntPark\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2019 Usman Ahmad <ua@onm.de>, Open New Media GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;

class MapController extends ActionController
{
    /**
	 * whether or not the applicant has agreed to the privacy agreement
	 *
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
    protected $cObj;

    /**
	 * @var \ONM\IntPark\Domain\Repository\ParkRepository
     * @inject
	 */
    private $parkRepository = NULL;

    /**
     * initializeAction
     *
     * @return void
     */
    public function initializeAction()
    {
        $this->cObj = $this->configurationManager->getContentObject();
    }

    /**
     * action index
     *
     * @return void
     */
    public function indexAction()
    {
        $park = $this->parkRepository->findByUid($this->cObj->data['tx_intpark_park']);
        if($park) {
            $imageInfo = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Type\File\ImageInfo::class, $park->getPin());
            $this->view->assign('pinW', $imageInfo->getWidth());
            $this->view->assign('pinH', $imageInfo->getHeight());
            $this->view->assign('park', $park);
            $this->view->assign('zoom', $this->cObj->data['tx_intpark_zoom']);
        }
    }
}
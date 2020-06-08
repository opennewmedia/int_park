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
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;

class PlannerController extends ActionController
{
    // /**
    //  * Backend Template Container
    //  *
    //  * @var string
    //  */
    // protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

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
	 * @var \ONM\IntPark\Domain\Repository\MarkerRepository
     * @inject
	 */
    private $markerRepository = NULL;

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
     * action map
     *
     * @return void
     */
    public function mapAction()
    {
        $parkId = (int)GeneralUtility::_GP('parkId');
        $pid = (int)GeneralUtility::_GP('id');
        $iconFontFile = "";
        $this->view->assign('pid', $pid);
        $park = $this->parkRepository->findByUid($parkId);
        if($park) {
            if (version_compare(VersionNumberUtility::getCurrentTypo3Version(), '9.0.0', '<')) {
                $pathSite = PATH_site;
            } else {
                $pathSite = Environment::getPublicPath() . '/';
            }
            $imageInfo = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Type\File\ImageInfo::class, $pathSite.$park->getPin());
            $this->view->assign('pinW', $imageInfo->getWidth());
            $this->view->assign('pinH', $imageInfo->getHeight());
            $this->view->assign('park', $park);
        }
        $this->view->assign('markerImg', $park->getPin());
    }

    /**
     * action save
     *
     * @return void
     */
    public function saveAction(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response = NULL)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $parkId = $data['settings']['park'];
        $pid = $data['settings']['pid'];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_intpark_domain_model_marker');
        $affectedRows = $queryBuilder
        ->delete('tx_intpark_domain_model_marker')
        ->where(
            $queryBuilder->expr()->eq('park', $queryBuilder->createNamedParameter($parkId))
        )
        ->execute();
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $parkRepository = $this->objectManager->get('ONM\IntPark\Domain\Repository\ParkRepository');
        $park = $parkRepository->findByUid($parkId);
        
        foreach($data['notes'] as $marker) {
            $markerObj = new \ONM\IntPark\Domain\Model\Marker();
            $markerObj->setLat($marker['x']);
            $markerObj->setLon($marker['y']);
            $markerObj->setTitle(($marker['title']) ? $marker['title'] : 'Untitled_'.$park->getTitle());
            $markerObj->setContenthtml(html_entity_decode($marker['note']));
            $markerObj->setIcon($marker['icon']);
            if($marker['list']) {
                $markerObj->setList($marker['list']);
            } else {
                $markerObj->setList('');
            }
            $markerObj->setPid($pid);
            $park->getMarkers()->attach($markerObj);
        }
        $parkRepository->update($park);
        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        
        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
        if($response) {
            $response->getBody()->write(json_encode(['reply'=>'done']));
            return $response;
        } else {
            return (new JsonResponse())->setPayload(['reply'=>'done']);
        }
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
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
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;

class BackendmapController extends ActionController
{
    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

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
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view)
    {
        /** @var BackendTemplateView $view */
        parent::initializeView($view);
        if ($this->actionMethodName == 'indexAction') {
            $this->view->getModuleTemplate()->setFlashMessageQueue($this->controllerContext->getFlashMessageQueue());
        }
        if ($view instanceof BackendTemplateView) {
            $view->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/Modal');
        }
    }

    /**
     * action index
     *
     * @return void
     */
    public function indexAction()
    {
        $this->pageId = (int)GeneralUtility::_GP('id');
        if (version_compare(VersionNumberUtility::getCurrentTypo3Version(), '9.0.0', '<')) {
            $this->view->assign('webListLink', \TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_list')."&id=".$_GET['id']);
        } else {
            $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
            $uri = $uriBuilder->buildUriFromRoute('web_list');
            $this->view->assign('webListLink', $uri."&id=".$_GET['id']);
        }
        $parks = $this->parkRepository->findByPid($this->pageId)->toArray();
        $data = [];
        foreach($parks as $park) {
            $data[] = [
                'map' => $park,
                'editLink' => \TYPO3\CMS\Backend\Utility\BackendUtility::editOnClick('&edit[tx_intpark_domain_model_park]['.$park->getUid().']=edit')
            ];
        }
        $this->view->assign('parks', $data);
    }
    /**
     * action map
     *
     * @return void
     */
    public function mapAction()
    {
        $parkId = (int)GeneralUtility::_GP('parkId');
        $this->view->assign('park', $this->parkRepository->findByUid($parkId));
        // $this->view->assign('parks', $this->parkRepository->findByPid($this->pageId));
    }

}
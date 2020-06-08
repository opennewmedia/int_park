<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ONM.IntPark',
            'Map',
            'Map'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'ONM.IntPark',
                'web', // Make module a submodule of 'web'
                'backendmap', // Submodule key
                '', // Position
                [
                    'Backendmap' => 'index',
                    'Planner' => 'map'
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:int_park/Resources/Public/Icons/icon.png',
                    'labels' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_backendmap.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('int_park', 'Configuration/TypoScript', 'Interactive Park Plan');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_intpark_domain_model_park', 'EXT:int_park/Resources/Private/Language/locallang_csh_tx_intpark_domain_model_park.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_intpark_domain_model_park');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_intpark_domain_model_marker', 'EXT:int_park/Resources/Private/Language/locallang_csh_tx_intpark_domain_model_marker.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_intpark_domain_model_marker');

    }
);

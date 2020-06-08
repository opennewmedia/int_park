<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ONM.IntPark',
            'Map',
            [
                'Map' => 'index'
            ],
            // non-cacheable actions
            [
                
            ],
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    map {
                        iconIdentifier = int_park-plugin-map
                        title = LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_int_park_map.name
                        description = LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_int_park_map.description
                        tt_content_defValues {
                            CType = intpark_map
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'int_park-plugin-map',
				\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
				['source' => 'EXT:int_park/Resources/Public/Icons/icon.png']
			);
		
    }
);

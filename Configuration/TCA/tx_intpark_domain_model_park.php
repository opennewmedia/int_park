<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_park',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'image,markers',
        'iconfile' => 'EXT:int_park/Resources/Public/Icons/tx_intpark_domain_model_park.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, image, pin, markers, bgcolor',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, image, pin, --palette--;LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_park.palettes.distance;distance, --palette--;LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_park.palettes.color;color, markers, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'palettes' => [
        'distance' => [
            'showitem' => 'icon_distance,icon_distance_left'
        ],
        'color' => [
            'showitem' => 'icon_color,bgcolor'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_intpark_domain_model_park',
                'foreign_table_where' => 'AND tx_intpark_domain_model_park.pid=###CURRENT_PID### AND tx_intpark_domain_model_park.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'pin' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.pin',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'placeholder' => 'fileadmin/user_upload/images/marker-icon.png',
                'default' => 'typo3conf/ext/int_park/Resources/Public/lib/images/marker-icon.png',
                'eval' => 'trim,required',
                'readOnly' => true
            ],
        ],
        'icon_distance' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.icon_distance',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'readOnly' => true
            ],
        ],
        'icon_distance_left' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.icon_distance_left',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'readOnly' => true
            ],
        ],
        'icon_color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.icon_color',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'size' => 10,
                'readOnly' => true
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_park.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'markers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_park.markers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_intpark_domain_model_marker',
                'foreign_field' => 'park',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
        'bgcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_intpark_domain_model_marker.bgcolor',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'size' => 10,
                'readOnly' => true
            ]
        ]
    ]
];

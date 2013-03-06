<?php
/**
 * Magento code generator
 *
 * PHP version 5.3
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category  Client
 * @package   ZFConsole
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'create-module' => array(
                    'options' => array(
                        'route' => 'create module <module>',
                        'defaults' => array(
                            'controller' => 'Module\Controller\Creator',
                            'action'     => 'create',
                        )
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Module\Controller\Creator' => 'MTool\Client\ZFConsole\Bundle\Module\Controller\CreatorController',
        ),
    ),
);

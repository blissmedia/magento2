<?php
/**
 * Application request handler. Launches front controller, request routing and dispatching process.
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Core_Model_App_Handler implements Magento_Http_HandlerInterface
{
    /**
     * Application object
     *
     * @var Mage_Core_Model_AppInterface
     */
    protected $_app;

    /**
     * @param Mage_Core_Model_AppInterface $app
     */
    public function __construct(Mage_Core_Model_AppInterface $app)
    {
        $this->_app = $app;
    }

    /**
     * Handle http request
     *
     * @param Zend_Controller_Request_Http $request
     * @param Zend_Controller_Response_Http $response
     */
    public function handle(Zend_Controller_Request_Http $request, Zend_Controller_Response_Http $response)
    {
        $response->headersSentThrowsException = Mage::$headersSentThrowsException;
        set_error_handler(Mage::DEFAULT_ERROR_HANDLER);
        date_default_timezone_set(Mage_Core_Model_Locale::DEFAULT_TIMEZONE);
        $this->_app->setRequest($request)->setResponse($response)->run();
    }
}


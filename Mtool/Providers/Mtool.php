<?php 
/**
 * Mage tool maintainance provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Mtool
    extends Mtool_Providers_Abstract
{
    /**
     * Mage tool version
     * @var string
     */
    protected $_version = '1.0.0';

	/**
	 * Get provider name
	 * @return string
	 */
	public function getName()
	{
		return 'mtool';
	}

    /**
     * Check mtool working
     */
    public function info()
    {
        $this->_answer("Magento Command Line Console Tool v{$this->_version}");
    }
}

<?php 
/**
 * Mage tool maintainance provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Mtool
    extends Zend_Tool_Framework_Provider_Abstract
{
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
    public function test()
    {
    	echo 'Mtool is working. Wiii!';
    }
}

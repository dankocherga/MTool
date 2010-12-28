<?php 
require_once 'Mtool/Codegen/Entity/Abstract.php';
/**
 * Helper code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Helper extends MTool_Codegen_Entity_Abstract
{
	/**
	 * Entity folder name
	 * @var string
	 */
	protected $_folderName = 'Helper';

	/**
	 * Create template name
	 * @var string
	 */
	protected $_createTemplate = 'helper_blank';

	/**
	 * Rewrite template name
	 * @var string
	 */
	protected $_rewriteTemplate = 'helper_rewrite';

	/**
	 * Entity name
	 * @var string
	 */
	protected $_entityName = 'Helper';

	/**
	 * Namespace in config file
	 * @var string
	 */
	protected $_configNamespace = 'helpers';
}

<?php 
require_once 'Mtool/Codegen/Entity/Abstract.php';
/**
 * Model code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Model extends MTool_Codegen_Entity_Abstract
{
	/**
	 * Entity folder name
	 * @var string
	 */
	protected $_folderName = 'Model';

	/**
	 * Create template name
	 * @var string
	 */
	protected $_createTemplate = 'model_blank';

	/**
	 * Rewrite template name
	 * @var string
	 */
	protected $_rewriteTemplate = 'model_rewrite';

	/**
	 * Entity name
	 * @var string
	 */
	protected $_entityName = 'Model';

	/**
	 * Namespace in config file
	 * @var string
	 */
	protected $_configNamespace = 'models';
}

<?php 
/**
 * Block code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Block extends Mtool_Codegen_Entity_Abstract
{
    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName = 'Block';

    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate = 'block_blank';

    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate = 'block_rewrite';

    /**
     * Entity name
     * @var string
     */
    protected $_entityName = 'Block';

    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace = 'blocks';
}

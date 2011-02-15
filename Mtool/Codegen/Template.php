<?php 
/**
 * File template class
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Template extends Mtool_Codegen_Parser
{
    /**
     * Template name
     * @var string
     */
    protected $_template;

    /**
     * Init template
     *
     * @param string $name
     *     should be the same as filename from the Template directory
     *     witout extension
     */
    public function __construct($name)
    {
        $this->_template = $name;
    }

    /**
     * Move template to $to directory with $as name
     *
     * @param string $to - target directory
     * @param string $as - result filename
     */
    public function move($to, $as)
    {
        $to = Mtool_Codegen_Filesystem::slash($to);
        Mtool_Codegen_Filesystem::mkdir($to);
        Mtool_Codegen_Filesystem::write(
            $to . $as,
            $this->content());
    }


    /**
     * Get parsed template content
     * @return string
     */
    public function content()
    {
        $templatePath =  dirname(__FILE__) .
            DIRECTORY_SEPARATOR . 'Template' .
            DIRECTORY_SEPARATOR . "{$this->_template}.tpl";
        $source = Mtool_Codegen_Filesystem::read($templatePath);
        return $this->parse($source);
    }

}

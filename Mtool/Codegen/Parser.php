<?php 
/**
 * Template parser class
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Parser
{
    /**
     * Template params
     * @var array
     */
    protected $_params = array();

    /**
     * Set template params
     * @param array $params
     * @return Mtool_Codegen_Template
     */
    public function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    /**
     * Parse content and inject parmeters
     * parameter keys are encolured in the #{} mask
     *
     * @param string $content
     * @access public
     * @return string
     */
    public function parse($content)
    {
        $pattern = '/(#\{(.*?)\})/';
        return preg_replace_callback($pattern, array($this, 'parseVar'), $content);
    }

    /**
     * Parse one var
     *
     * @param array $matches
     * @return string
     */
    protected function parseVar($matches)
    {
        return @$this->_params[@$matches[2]];
    }
}

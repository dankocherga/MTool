<?php
/**
 * Mage Tool
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Filesystem browser class
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Codegen_Browser
{
    /**
     * Find files in filesystem
     *
     * @param string $file
     * @param string $in - directory
     * @static
     * @return RegexIterator
     */
    public static function find($file, $in)
    {
        $dir = new RecursiveDirectoryIterator($in);
        $iterator = new RecursiveIteratorIterator($dir);
        $regex = new RegexIterator($iterator, "/^.+{$file}$/i", RecursiveRegexIterator::GET_MATCH);
        return $regex;
    }
}

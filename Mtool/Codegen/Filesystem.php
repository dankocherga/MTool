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
 * Filesystem stuff class
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Codegen_Filesystem
{
    /**
     * Recursively create dir with 0777 permissions
     *
     * @static
     * @param string $path
     * @throws Mtool_Codegen_Exception_Filesystem
     */
    public static function mkdir($path)
    {
        if(is_dir($path))
            return;

        $result = mkdir($path, 0777, true);
        if($result === false)
            throw new Mtool_Codegen_Exception_Filesystem(
                "Cannot create directory {$path}.  Maybe permissions problem?"
            );
        system('chmod -R 777 ' . $path);
    }

    /**
     * Read file contents
     *
     * @param string $filepath
     * @static
     * @return string
     */
    public static function read($filepath)
    {
        $handle = fopen($filepath, 'r');
        $result = fread($handle, filesize($filepath));
        if($result === false)
            throw new Mtool_Codegen_Exception_Filesystem(
                "Cannot read file {$filepath}"
            );
        return $result;
    }

    /**
     * Write into file
     *
     * @param string $filepath
     * @param string $content
     * @static
     * @return string
     */
    public static function write($filepath, $content)
    {
        $handle = fopen($filepath, 'w+');
        $result = fwrite($handle, $content);
        if($result === false)
            throw new Mtool_Codegen_Exception_Filesystem(
                "Cannot write into file {$filepath}"
            );
        system('chmod -R 777 ' . $filepath);
        return $result;
    }

    /**
     * Check if file exists
     *
     * @param string $path
     * @static
     * @return boolean
     */
    public static function exists($path)
    {
        return file_exists($path);
    }

    /**
     * Add diretory separator
     * to the end of the path if it's not there
     *
     * @param string $path
     * @static
     * @return string
     */
    public static function slash($path)
    {
        if($path[strlen($path) - 1] != DIRECTORY_SEPARATOR)
            $path .= DIRECTORY_SEPARATOR;
        return $path;
    }
}

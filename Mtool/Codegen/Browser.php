<?php
/**
 * Filesystem browser class
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
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

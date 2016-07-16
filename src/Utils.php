<?php
namespace Walmart;

class Utils
{
    /**
     * Get current timestamp in milliseconds
     * @return float
     */
    public static function getMilliseconds()
    {
        return round(microtime(true) * 1000);
    }

    /**
     * Remove namespaces from XML
     * @param string $xml
     * @return string
     */
    public static function stripNamespacesFromXml($xml)
    {
        $xml = preg_replace('/<[a-zA-Z0-9]+:/','<',$xml);
        $xml = preg_replace('/<\/[a-zA-Z0-9]+:/','</',$xml);
        $xml = preg_replace('/ xmlns:[a-zA-Z0-9]+=".*">/','>',$xml);

        return $xml;
    }

    /**
     * Check if given array is assoc or sequential
     * @param array $array
     * @return bool
     */
    public static function is_assoc(array $array) {
        return (bool)count(array_filter(array_keys($array), 'is_string'));
    }

    public static function getIso8601Time($timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        return date('c', $timestamp);
    }
}
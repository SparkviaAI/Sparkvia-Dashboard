<?php

namespace App\Support;

class ParseTemplate
{
    protected $body;
    protected $invoice;
    protected $user;
    protected $delimiter = '/{{{([^{|}]*)}}}/';

    /**
     * Check the value and return default value if empty in the system.
     * @param array $replacement
     * @return string
     */
    protected function setDefaultIfEmpty(array $replacement): string
    {
        $value = current($replacement);
        if (blank($value)) {
            return '';
        }
        return $value;
    }

    /**
     * @param $search
     * @param $replace
     * @param string $template
     * @return string
     */
    protected function replace($search, $replace, string $template): string
    {
        return str_replace($search->all(), $replace->all(), $template);
    }
}

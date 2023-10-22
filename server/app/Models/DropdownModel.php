<?php

namespace App\Models;

class DropdownModel
{
    public $value;
    public $options;

    public function __construct($value, $options)
    {
        $this->value = $value;
        $this->options = $options;
    }

    public function getLabel() {
        foreach ($this->options as $key => $label) {
            if ($key === $this->value) {
                return $label;
            }
        }
        return "";
    }
}
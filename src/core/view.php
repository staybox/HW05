<?php

class View
{
    /**
     * @param string $filename
     * @param array $data
     */
    public function render(string $filename, array $data)
    {

        require_once ("src/views/".$filename.".php");

    }
}
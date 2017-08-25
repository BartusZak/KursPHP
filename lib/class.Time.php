<?php
date_default_timezone_set("Europe/Warsaw");
class Time
{
    const DEFAULT_TIME_ZONE = "Europe/Warsaw";
    public $text;
    function __construct() {
    }
    function __toString() {
        return $this->setText().$this->setTimeNow();
    }
            
    function setTimeNow ()
    {
        return date("H:i:s d M Y", time());
    }
    function setText()
    {
        $this->text = "Wygenerowano o ";
        return $this->text;
    }
}
?>
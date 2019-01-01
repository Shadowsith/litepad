<?php

class SettingLoader {

    public $cookies;
    public $lang;
    public $maxFiles;
    public $uiFgColor;
    public $uiBgColor;
    public $pdfFont;
    public $editor;

    private const XMLPATH = "../config/config.xml";

    function __construct() {
        $this->readFromXml();
    }

    public function getLang() {
        return $this->lang;
    }

    public function getSettings() {
        return json_encode($this);
    }

    public function setSettings($json) {
        $obj = json_decode($json);
        $this->writeToXml($obj);
    }

    private function readFromXml() {
        $xml = simplexml_load_file(self::XMLPATH);
        $this->cookies = $xml->global->cookies; 
        $this->lang = $xml->global->lang; 
        $this->uiFgColor = $xml->global->ui->fg;
        $this->uiBgColor = $xml->global->ui->bg;

        $this->maxFiles = $xml->notes->maxFiles;
        $this->pdfFont = $xml->notes->pdfFont;
        $this->editor = $xml->notes->editor;
    }

    private function writeToXml($obj) {
        $xml = simplexml_load_file(self::XMLPATH);

        $xml->global->cookies = $obj->cookies;
        $xml->global->lang = $obj->lang;
        $xml->global->ui->fg = $obj->uiFgColor;
        $xml->global->ui->bg = $obj->uiBgColor;

        $xml->notes->maxFiles = $obj->maxFiles;
        $xml->notes->pdfFont = $obj->pdfFont;
        $xml->notes->editor = $obj->editor;

        $xml->asXML(self::XMLPATH);
    }
}

?>

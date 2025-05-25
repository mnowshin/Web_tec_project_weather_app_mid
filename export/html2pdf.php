<?php
class HTML2PDF {
    private $html;
    
    public function writeHTML($html) {
        $this->html = $html;
    }
    
    public function Output($filename, $dest) {
        // Convert special characters
        $this->html = mb_convert_encoding($this->html, 'HTML-ENTITIES', 'UTF-8');
        
        // Basic PDF header
        echo "%PDF-1.7\n";
        echo $this->html;
    }
}

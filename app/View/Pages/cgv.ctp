<?php
    switch ($this->Session->read('Config.language')) {
        case 'fr':
            echo $this->element('tos/fr');
            break;

        default:
            echo $this->element('tos/en');
            break;
    }
?>

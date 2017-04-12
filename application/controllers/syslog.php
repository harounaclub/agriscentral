
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Syslog extends CI_Controller {
    
    public function run() {
        $this->load->model('syslogmodel');
        $addresstypes = $this->syslogmodel->addUpdateEquipmentStatus();
    }
    
            
}

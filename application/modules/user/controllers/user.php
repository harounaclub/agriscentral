<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load("french","french");
    }

    public function index() {
         
        if(checkAdminAccess() === 1){
            redirect('/user/dashboard');
        } else if(checkAdminAccess() === 'user'){
            redirect('/map', 'refresh');
        } else if(checkAdminAccess() === 0){
            $this->load->view('/user/login'); 
        }
        
    }

    public function dashboard() {
       
        if(checkAdminAccess() === 'user'){
            redirect('/map', 'refresh');
        } else if(checkAdminAccess() === 1){
            
            $data['footer_assets']  = '/user/footer_list_assets';
            $data['main_content']  = '/user/dashboard';
            $this->load->view('admin_template', $data);
        }  else if(checkAdminAccess() === 0){
            redirect('/user/login'); 
        }
    }
    
    function getDataforcontainerchart() {
        $this->load->model('equipment/equipmentModel');
        $total_equipment_inventory = $this->equipmentModel->getCountOfEquipmentInventory();
        $installed_inventory = $this->equipmentModel->getInstalledEquipmentInventory();
        $remaining_enventory = $total_equipment_inventory-$installed_inventory;
        $equipments = $this->equipmentModel->getEquipmentInveoryDetails();
        
        $jsondata = array(
            'total_equipment_inentory'=>$total_equipment_inventory,
            'installed_inventory'=>(int)$installed_inventory,
            'remaining_inventory'=>(int)$remaining_enventory,
            'equipments'=>$equipments,
            
        );
        
        echo json_encode($jsondata);
            
    }
    
    function getDataforColumnChart() {
        $this->load->model('equipment/equipmentModel');
        $monthly_equipments = $this->equipmentModel->getEquipmentMonthly();
        
        $jsondata = array(
            'monthly_equipments'=>$monthly_equipments
        );
        
        echo json_encode($jsondata);
    }
}

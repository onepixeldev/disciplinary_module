<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplinary_setup extends MY_Controller
{
    private $staff_id;
    private $username;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Disciplinary_model', 'disc_mdl');
        $this->staff_id = $this->lib->userid();
        $this->username = $this->lib->username();
    }

    // View Page Filter
    public function viewTabFilter($tabID, $sid = null)
    {
        // set session
        $this->session->set_userdata('tabID', $tabID);

        if($sid == 'ASF132') {
            redirect($this->class_uri('ASF132'));
        }
    }


    // DISCIPLINARY SETUP
    public function AFF007()
    {   
        $this->render();
    }

    /*===========================================================
       DISCIPLINARY SETUP - AFF007
    =============================================================*/

    // SERVICE POSITION GROUP
    public function svcPosGroup()
    {   
        // get available records
        $data['svc_pos_grp_list'] = $this->disc_mdl->getSvcPosGrpList();

        $this->render($data);
    }

    // ACTION CATEGORY
    public function actCategory()
    {   
        // get available records
        $data['ac_list'] = $this->disc_mdl->getActCategoryList();

        $this->render($data);
    }

    // CASE STATUS
    public function caseStatus()
    {   
        // get available records
        $data['cs_list'] = $this->disc_mdl->getCaseStatusList();

        $this->render($data);
    }

    // TYPE OF PUNISHMENT
    public function typePunishment()
    {   
        // get available records
        $data['top_list'] = $this->disc_mdl->getTypePunishmentList();

        $this->render($data);
    }

    // ASSET LOSS SETUP
    public function assetLossSetup()
    {   
        // get available records
        $data['als_list'] = $this->disc_mdl->getAssetLossSetupList();

        $this->render($data);
    }

    // ADD KUMPULAN JAWATAN PERKHIDMATAN
    public function addSvcPosGroup()
    {  
        $this->render();
    }

    // SAVE ADD KUMPULAN JAWATAN PERKHIDMATAN
    public function saveAddSpg() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // CODE
        $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[10]',
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $check = $this->disc_mdl->getSvcPosGrpDetl($code);

            if(empty($check)) {
                $insert = $this->disc_mdl->saveAddSvcPosGrp($form);

                if($insert > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Record already exist', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // UPDATE KUMPULAN JAWATAN PERKHIDMATAN
    public function editSvcPosGroup()
    { 
        $code = $this->input->post('code', true);
        
        $data['spg_detl'] = $this->disc_mdl->getSvcPosGrpDetl($code);
        
        $this->render($data);
    }

    // SAVE UPDATE KUMPULAN JAWATAN PERKHIDMATAN
    public function saveUpdSpg() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $update = $this->disc_mdl->saveUpdSvcPosGrp($form);

            if($update > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // // DELETE KUMPULAN JAWATAN PERKHIDMATAN
    // public function delSpg() 
    // {
	// 	$this->isAjax();
		
    //     $code = $this->input->post('code', true);
        
    //     if (!empty($code)) {
    //         $del = $this->disc_mdl->delSpg($code);
        
    //         if ($del > 0) {
    //             $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success');
    //         } else {
    //             $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
    //         }
    //     } else {
    //         $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
    //     }
    //     echo json_encode($json);
    // }

    // ADD KATEGORI TINDAKAN
    public function addActCat()
    {  
        $this->render();
    }

    // SAVE ADD KATEGORI TINDAKAN
    public function saveAddAc() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // CODE
        $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[10]',
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $check = $this->disc_mdl->getActCatDetl($code);

            if(empty($check)) {
                $insert = $this->disc_mdl->saveAddActCat($form);

                if($insert > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Record already exist', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // UPDATE KATEGORI TINDAKAN
    public function editActCategory()
    { 
        $code = $this->input->post('code', true);
        
        $data['ac_detl'] = $this->disc_mdl->getActCatDetl($code);
        
        $this->render($data);
    }

    // SAVE UPDATE KATEGORI TINDAKAN
    public function saveUpdAc() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $update = $this->disc_mdl->saveUpdAc($form);

            if($update > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // // DELETE KATEGORI TINDAKAN
    // public function delAc() 
    // {
	// 	$this->isAjax();
		
    //     $code = $this->input->post('code', true);
        
    //     if (!empty($code)) {
    //         $del = $this->disc_mdl->delAc($code);
        
    //         if ($del > 0) {
    //             $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success');
    //         } else {
    //             $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
    //         }
    //     } else {
    //         $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
    //     }
    //     echo json_encode($json);
    // }

    // ADD STATUS KES
    public function addCaseStatus()
    {  
        $this->render();
    }

    // SAVE ADD STATUS KES
    public function saveAddCs() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // CODE
        $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[20]',
            'description' => 'max_length[100]',
            'order' => 'numeric|max_length[6]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $check = $this->disc_mdl->getCaseStatusDetl($code);

            if(empty($check)) {
                $insert = $this->disc_mdl->saveAddCs($form);

                if($insert > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Record already exist', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // UPDATE STATUS KES
    public function editCaseStatus()
    { 
        $code = $this->input->post('code', true);
        
        $data['cs_detl'] = $this->disc_mdl->getCaseStatusDetl($code);
        
        $this->render($data);
    }

    // SAVE UPDATE STATUS KES
    public function saveUpdCs() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'description' => 'max_length[100]',
            'order' => 'numeric|max_length[6]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $update = $this->disc_mdl->saveUpdCs($form);

            if($update > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // ADD PUNISHMENT TYPE
    public function addPunishmentType()
    {  
        $this->render();
    }

    // SAVE ADD PUNISHMENT TYPE
    public function saveAddTop() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // CODE
        $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[100]',
            'description' => 'max_length[2000]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $check = $this->disc_mdl->getPunishmentTypeDetl($code);

            if(empty($check)) {
                $insert = $this->disc_mdl->saveAddTop($form);

                if($insert > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Record already exist', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // UPDATE PUNISHMENT TYPE
    public function editPunishmentType()
    { 
        $code = $this->input->post('code', true);
        
        $data['top_detl'] = $this->disc_mdl->getPunishmentTypeDetl($code);
        
        $this->render($data);
    }

    // SAVE UPDATE PUNISHMENT TYPE
    public function saveUpdTop() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[100]',
            'description' => 'max_length[2000]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $update = $this->disc_mdl->saveUpdTop($form);

            if($update > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // ADD ASSET LOSS SETUP
    public function addResALS()
    {  
        $this->render();
    }

    // SAVE ADD ASSET LOSS SETUP
    public function saveAddAls() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // CODE
        $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'code' => 'required|max_length[10]',
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $check = $this->disc_mdl->getAlsDetl($code);

            if(empty($check)) {
                $insert = $this->disc_mdl->saveAddAls($form);

                if($insert > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Record already exist', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // UPDATE ASSET LOSS SETUP
    public function editResALS()
    {  
        $code = $this->input->post('code', true);

        $data['als_detl'] = $this->disc_mdl->getAlsDetl($code);

        $this->render($data);
    }

    // SAVE UPDATE ASSET LOSS SETUP
    public function saveUpdAls() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);

        // $code = strtoupper($form['code']);

        // form / input validation
        $rule = array(
            'description' => 'max_length[100]',
            'active' => 'max_length[1]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
            $update = $this->disc_mdl->saveUpdAls($form);

            if($update > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

}

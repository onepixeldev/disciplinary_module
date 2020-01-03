<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplinary extends MY_Controller
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

    // CASE REPORT ENTRY DISCIPLINARY
    public function AFF016()
    {   
        $this->render();
    }

    // CASE REPORT ENTRY ABSENCE FROM DUTY
    public function AFF019()
    {   
        $this->render();
    }

    // CASE REPORT ENTRY ASSET LOSS
    public function AFF018()
    {   
        $this->render();
    }

    /*===========================================================
       CASE REPORT ENTRY (DISCIPLINARY) - AFF016
    =============================================================*/

    // CASE REPORT ENTRY DISCIPLINARY LIST
    public function csRpEntDisc()
    {   
        // get available records
        $data['rp_disc_list'] = $this->disc_mdl->getRpDiscList();

        $this->render($data);
    }

    // ADD CASE DISCIPLINARY
    public function addCaseDiscForm()
    {  
        $data['cs_type'] = 'DISCIPLINARY';
        $data['file_reference'] = 'UPSI/PEND/BG2/801';
        $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $data['grp_svc_list'] = $this->dropdown($this->disc_mdl->getSvcGroup(), 'DGS_GROUP_CODE', 'DGS_GROUP_CODE_DESC', ' ---Please select--- ');

        $data['act_cat_list'] = $this->dropdown($this->disc_mdl->getActCat(), 'DCA_CATEGORY_CODE', 'DCA_CATEGORY_CODE_DESC', ' ---Please select--- ');

        $data['p_type_list'] = $this->dropdown($this->disc_mdl->getPunishmentType(), 'DPM_PENALTY_CODE', 'DPM_PENALTY_CODE_DESC', ' ---Please select--- ');

        $data['dcm_sts_inf'] = $this->disc_mdl->getDcmStsDesc($data['dcm_sts']);
        if(!empty($data['dcm_sts_inf'])) {
            $data['dcm_sts_desc'] = $data['dcm_sts_inf']->SM_STATUS_DESC;
        } else {
            $data['dcm_sts_desc'] = '';
        }

        $this->render($data);
    }

    // UPDATE CASE DISCIPLINARY
    public function editCaseDiscForm()
    {  
        $case_id = $this->input->post('case_id', true);

        $data['rp_disc_detl'] = $this->disc_mdl->getRpDiscDetl($case_id);

        if(!empty($data['rp_disc_detl']->DCS_STAFF_ID)) {
            $stf_id = $data['rp_disc_detl']->DCS_STAFF_ID;

            $stf_detl = $this->disc_mdl->stfDetl($stf_id);

            $data['stf_name'] = $stf_detl->SM_STAFF_NAME;
            $data['svc_desc'] = $stf_detl->SS_SERVICE_DESC;
            $data['dept_desc'] = $stf_detl->DM_DEPT_DESC;
        } else {
            $data['stf_name'] = '';
            $data['svc_desc'] = '';
            $data['dept_desc'] = '';
        }

        $data['dcm_sts'] = $data['rp_disc_detl']->DCM_STATUS;

        $data['grp_svc_list'] = $this->dropdown($this->disc_mdl->getSvcGroup(), 'DGS_GROUP_CODE', 'DGS_GROUP_CODE_DESC', ' ---Please select--- ');

        $data['act_cat_list'] = $this->dropdown($this->disc_mdl->getActCat(), 'DCA_CATEGORY_CODE', 'DCA_CATEGORY_CODE_DESC', ' ---Please select--- ');

        $data['p_type_list'] = $this->dropdown($this->disc_mdl->getPunishmentType(), 'DPM_PENALTY_CODE', 'DPM_PENALTY_CODE_DESC', ' ---Please select--- ');

        $data['dcm_sts_inf'] = $this->disc_mdl->getDcmStsDesc($data['dcm_sts']);
        if(!empty($data['dcm_sts_inf'])) {
            $data['dcm_sts_desc'] = $data['dcm_sts_inf']->SM_STATUS_DESC;
        } else {
            $data['dcm_sts_desc'] = '';
        }

        $this->render($data);
    }

    // SEARCH STAFF
    public function searchStaffMd() 
    {
        $staff_id = $this->input->post('staff_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        if(!empty($staff_id) && $search_trigger == 1) {
            $data['stf_inf'] = $this->disc_mdl->getStaffSearch($staff_id);
            $this->render($data);
        } else {
            $this->render();
        }
    }

    // SAVE ADD CASE REPORT ENTRY (DISCIPLINARY)
    public function saveAddRpEntFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCP = 0;
        $successDCS = 0;

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[100]',
            'staff_id' => 'required|max_length[10]',
            'service_id' => 'max_length[10]',
            'department_id' => 'max_length[10]',
            'service_group' => 'max_length[10]',
            'action_category' => 'max_length[10]',

            'guilty' => 'max_length[1]',
            'offense_type' => 'max_length[4000]',
            'status' => 'max_length[100]',
            'status_desc' => 'max_length[300]',
            'status_date' => 'required|max_length[11]',
            'rule_a605' => 'max_length[4000]',
            'punishment_type' => 'max_length[100]',
            'punishment_enforcement_date' => 'required|max_length[11]',
            'punishment_end_date' => 'required|max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $gen_id = $this->disc_mdl->genDcmCaseID();
            if(!empty($gen_id)) {
                $case_id = $gen_id->CASE_ID;
            } else {
                $case_id = '';
            }
           
            $insertDcm = $this->disc_mdl->insertDcm($case_id, $form);
            if($insertDcm > 0) {
                $successDCM = 1;

                $insertDcp = $this->disc_mdl->insertDcp($case_id, $form);
                if($insertDcp > 0) {
                    $successDCP = 1;
                } else {
                    $successDCP = 0;
                }
            } else {
                $successDCM = 0;
            }

            $insertDcs = $this->disc_mdl->insertDcs($case_id, $form);
            if($insertDcs > 0) {
                $successDCS = 1;
            } else {
                $successDCS = 0;
            }

            if($successDCM > 0 && $successDCP > 0 && $successDCS > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // SAVE UPDATE CASE REPORT ENTRY (DISCIPLINARY)
    public function saveEditRpEntFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCS = 0;

        // CASE ID
        $case_id = $form['case_id'];

        // form / input validation
        $rule = array(
            'case_id' => 'max_length[30]',
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[100]',
            'staff_id' => 'required|max_length[10]',
            'service_id' => 'max_length[10]',
            'department_id' => 'max_length[10]',
            'service_group' => 'max_length[10]',
            'action_category' => 'max_length[10]',

            'guilty' => 'max_length[1]',
            'offense_type' => 'max_length[4000]',
            'status' => 'max_length[100]',
            'status_desc' => 'max_length[300]',
            'status_date' => 'required|max_length[11]',
            'rule_a605' => 'max_length[4000]',
            'punishment_type' => 'max_length[100]',
            'punishment_enforcement_date' => 'required|max_length[11]',
            'punishment_end_date' => 'required|max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
           
            $updDcm = $this->disc_mdl->updDcm($case_id, $form);
            if($updDcm > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $updDcs = $this->disc_mdl->updDcs($case_id, $form);
            if($updDcs > 0) {
                $successDCS = 1;
            } else {
                $successDCS = 0;
            }

            if($successDCM > 0 && $successDCS > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // DELETE CASE REPORT ENTRY (DISCIPLINARY)
    public function delCaseDiscForm() 
    {
		$this->isAjax();
		
        $case_id = $this->input->post('case_id', true);
        
        if (!empty($case_id)) {
            $check1 = $this->disc_mdl->getDCP($case_id);
            $check2 = $this->disc_mdl->getDCS($case_id);

            if(!empty($check1) || !empty($check2)) {
                $json = array('sts' => 0, 'msg' => 'Cannot delete master record when matching detail records exist. <br><b>Please make sure sub-record does not exist on case progress and case suspect. </b>', 'alert' => 'success');
            } else {
                $del = $this->disc_mdl->delCaseDiscForm($case_id);
        
                if ($del > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
                }
            }
            
        } else {
            $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
        }
        echo json_encode($json);
    }

    /*===========================================================
       CASE REPORT ENTRY (ABSENCE FROM DUTY) - AFF019
    =============================================================*/

    // CASE REPORT ENTRY (ABSENCE FROM DUTY) LIST
    public function csRpEntAFD()
    {   
        // get available records
        $data['rp_afd_list'] = $this->disc_mdl->getRpAFDList();

        $this->render($data);
    }

    // ADD CASE AFD
    public function addCaseAFDForm()
    {  
        $data['cs_type'] = 'ABSENCE';
        $data['file_reference'] = 'UPSI/PEND/BG2/812';
        $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $this->render($data);
    }

    // SAVE ADD CASE REPORT ENTRY (AFD)
    public function saveAddRpAfdFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCS = 0;

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[100]',
            'staff_id' => 'required|max_length[10]',
            'service_id' => 'max_length[10]',
            'department_id' => 'max_length[10]',

            'guilty' => 'max_length[1]',
            'complaint_date' => 'max_length[11]',
            'registrar_meeting_date' => 'max_length[11]',
            'show_cause_notice_date' => 'max_length[11]',
            'administration_warning_date' => 'max_length[11]',
            'absent_day' => 'numeric|max_length[1000]',
            'total_emolument_deduction' => 'numeric|max_length[100]',
            'status' => 'max_length[100]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $gen_id = $this->disc_mdl->genAFDCaseID();
            if(!empty($gen_id)) {
                $case_id = $gen_id->CASE_ID;
            } else {
                $case_id = '';
            }
           
            $insertDcmAFD = $this->disc_mdl->insertDcmAFD($case_id, $form);
            if($insertDcmAFD > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $insertDcsAFD = $this->disc_mdl->insertDcsAFD($case_id, $form);
            if($insertDcsAFD > 0) {
                $successDCS = 1;
            } else {
                $successDCS = 0;
            }

            if($successDCM > 0 && $successDCS > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // EDIT CASE AFD
    public function editCaseAFDForm()
    {  
        $case_id = $this->input->post('case_id', true);

        $data['rp_afd_detl'] = $this->disc_mdl->getRpAFDDetl($case_id);

        if(!empty($data['rp_afd_detl']->DCS_STAFF_ID)) {
            $stf_id = $data['rp_afd_detl']->DCS_STAFF_ID;

            $stf_detl = $this->disc_mdl->stfDetl($stf_id);

            $data['stf_name'] = $stf_detl->SM_STAFF_NAME;
            $data['svc_desc'] = $stf_detl->SS_SERVICE_DESC;
            $data['dept_desc'] = $stf_detl->DM_DEPT_DESC;
        } else {
            $data['stf_name'] = '';
            $data['svc_desc'] = '';
            $data['dept_desc'] = '';
        }

        $data['cs_type'] = 'ABSENCE';
        $data['file_reference'] = 'UPSI/PEND/BG2/812';
        $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $this->render($data);
    }

    // SAVE ADD CASE REPORT ENTRY (AFD)
    public function saveEditRpAfdFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $case_id = $form['case_id'];
        $successDCM = 0;
        $successDCS = 0;

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[100]',
            'staff_id' => 'required|max_length[10]',
            'service_id' => 'max_length[10]',
            'department_id' => 'max_length[10]',

            'guilty' => 'max_length[1]',
            'complaint_date' => 'max_length[11]',
            'registrar_meeting_date' => 'max_length[11]',
            'show_cause_notice_date' => 'max_length[11]',
            'administration_warning_date' => 'max_length[11]',
            'absent_day' => 'numeric|max_length[1000]',
            'total_emolument_deduction' => 'numeric|max_length[100]',
            'status' => 'max_length[100]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
           
            $updateDcmAFD = $this->disc_mdl->updateDcmAFD($case_id, $form);
            if($updateDcmAFD > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $updateDcsAFD = $this->disc_mdl->updateDcsAFD($case_id, $form);
            if($updateDcsAFD > 0) {
                $successDCS = 1;
            } else {
                $successDCS = 0;
            }

            if($successDCM > 0 && $successDCS > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // DELETE CASE REPORT ENTRY (AFD)
    public function delCaseAfdForm() 
    {
		$this->isAjax();
		
        $case_id = $this->input->post('case_id', true);
        
        if (!empty($case_id)) {
            // $check1 = $this->disc_mdl->getDCP($case_id);
            $check2 = $this->disc_mdl->getDCS($case_id);

            if(!empty($check2)) {
                $json = array('sts' => 0, 'msg' => 'Cannot delete master record when matching detail records exist. <br><b>Please make sure sub-record does not exist on case suspect. </b>', 'alert' => 'success');
            } else {
                $del = $this->disc_mdl->delCaseAfdForm($case_id);
        
                if ($del > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success');
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
                }
            }
            
        } else {
            $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
        }
        echo json_encode($json);
    }

    /*===========================================================
       CASE REPORT ENTRY (ASSET LOSS) - AFF018
    =============================================================*/

    // CASE REPORT ENTRY (ASSET LOSS) LIST
    public function csRpEntAL()
    {   
        // get available records
        $data['rp_al_list'] = $this->disc_mdl->getRpALList();

        $this->render($data);
    }

    // ADD CASE ASSET lOSS
    public function addCaseALForm()
    {  
        $data['cs_type'] = 'ASSET_LOSS';
        $data['file_reference'] = 'UPSI/PEND/BG2/961';
        $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $data['money_type'] = array(''=>'---Please Select---', 'CASH'=>'Wang Tunai', 'CHEQUE'=>'Cek', 'POSTORDER'=>'Wang Pos', 'MONEYORDER'=>'Kiriman Wang', 'OTHER'=>'Lain-lain');

        $this->render($data);
    }

    // SEARCH ASSET
    public function searchAssetMd() 
    {
        $asset_type = $this->input->post('item_type', true);

        $asset_id = $this->input->post('asset_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        $data['asset_type'] = $asset_type;

        if(!empty($asset_id) && $search_trigger == 1) {
            $data['asset_list'] = $this->disc_mdl->getAssetList($asset_id);
        } 

        $this->render($data);
    }

    // SAVE ADD CASE REPORT ENTRY (AL)
    public function saveAddRpAlFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCL = 0;
        $successDCI = 0;
        $pol_rep_date = $form['police_report_date'];
        $dcm_sts = '';
        $dcm_sts_date = '';

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[50]',
            'item_type' => 'required|max_length[10]',
            'item_details' => 'max_length[10]',
            'item_description' => 'max_length[1000]',
            'asset_id' => 'max_length[30]',
            'asset_type' => 'max_length[3000]',
            'serial_no' => 'max_length[30]',
            'brand' => 'max_length[30]',
            'quantity' => 'numeric|max_length[10]',
            'amount' => 'numeric|max_length[17]',

            'loss_location' => 'max_length[100]',
            'how_the_loss_happened' => 'max_length[4000]',
            'staff_id' => 'required|max_length[10]',
            'police_report_date' => 'max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $gen_id = $this->disc_mdl->genALCaseID();
            if(!empty($gen_id)) {
                $case_id = $gen_id->CASE_ID;
            } else {
                $case_id = '';
            }

            if(!empty($pol_rep_date)) {
                $dcm_sts = 'CLOSED'; 
                $dcm_sts_date = $pol_rep_date; 
            }
            else if (empty($pol_rep_date) ) {
                $dcm_sts = 'PRELIMINARY REPORT'; 
                $dcm_sts_date = $pol_rep_date; 
            }
           
            $insertDcmAL = $this->disc_mdl->insertDcmAL($case_id, $dcm_sts, $dcm_sts_date, $form);
            if($insertDcmAL > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $insertDclAL = $this->disc_mdl->insertDclAL($case_id, $form);
            if($insertDclAL > 0) {
                $successDCL = 1;
            } else {
                $successDCL = 0;
            }

            $insertDcItlAL = $this->disc_mdl->insertDcItlAL($case_id, $form);
            if($insertDcItlAL > 0) {
                $successDCI = 1;
            } else {
                $successDCI = 0;
            }

            if($successDCM > 0 && $successDCL > 0 && $successDCI > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // EDIT CASE ASSET lOSS
    public function editCaseALForm()
    {  
        $case_id = $this->input->post('case_id', true);

        $data['rp_al_detl'] = $this->disc_mdl->getRpALDetl($case_id);

        if(!empty($data['rp_al_detl']->DCL_STAFF_LAST)) {
            $stf_id = $data['rp_al_detl']->DCL_STAFF_LAST;

            $stf_detl = $this->disc_mdl->stfDetl($stf_id);

            $data['stf_name'] = $stf_detl->SM_STAFF_NAME;
        } else {
            $data['stf_name'] = '';
        }

        $data['cs_type'] = 'ASSET_LOSS';
        $data['file_reference'] = 'UPSI/PEND/BG2/961';
        $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $data['money_type'] = array(''=>'---Please Select---', 'CASH'=>'Wang Tunai', 'CHEQUE'=>'Cek', 'POSTORDER'=>'Wang Pos', 'MONEYORDER'=>'Kiriman Wang', 'OTHER'=>'Lain-lain');

        $this->render($data);
    }

    // SAVE UPDATE CASE REPORT ENTRY (AL)
    public function saveEditRpAlFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCL = 0;
        $successDCI = 0;
        $pol_rep_date = $form['police_report_date'];
        $case_id = $form['case_id'];
        $dcm_sts = '';
        $dcm_sts_date = '';

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'max_length[50]',
            'item_type' => 'required|max_length[10]',
            'item_details' => 'max_length[10]',
            'item_description' => 'max_length[1000]',
            'asset_id' => 'max_length[30]',
            'asset_type' => 'max_length[3000]',
            'serial_no' => 'max_length[30]',
            'brand' => 'max_length[30]',
            'quantity' => 'numeric|max_length[10]',
            'amount' => 'numeric|max_length[17]',

            'loss_location' => 'max_length[100]',
            'how_the_loss_happened' => 'max_length[4000]',
            'staff_id' => 'required|max_length[10]',
            'police_report_date' => 'max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            if(!empty($pol_rep_date)) {
                $dcm_sts = 'CLOSED'; 
                $dcm_sts_date = $pol_rep_date; 
            }
            else if (empty($pol_rep_date)) {
                $dcm_sts = 'PRELIMINARY REPORT'; 
                $dcm_sts_date = $pol_rep_date; 
            }
           
            $updateDcmAL = $this->disc_mdl->updateDcmAL($case_id, $dcm_sts, $dcm_sts_date, $form);
            if($updateDcmAL > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $updateDclAL = $this->disc_mdl->updateDclAL($case_id, $form);
            if($updateDclAL > 0) {
                $successDCL = 1;
            } else {
                $successDCL = 0;
            }

            $updateDcItlAL = $this->disc_mdl->updateDcItlAL($case_id, $form);
            if($updateDcItlAL > 0) {
                $successDCI = 1;
            } else {
                $successDCI = 0;
            }

            if($successDCM > 0 && $successDCL > 0 && $successDCI > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // SUSPECT (ASSET LOSS) LIST
    public function ALSuspectList()
    {   
        $case_id = $this->input->post('case_id', true);

        // get available records
        $data['sp_list'] = $this->disc_mdl->getSpListAL($case_id);
        $data['case_id'] = $case_id;

        $this->render($data);
    }

    // ADD SUSECT DETL AL
    public function addSuspectDetlAL()
    {  
        $case_id = $this->input->post('case_id', true);
        $staff_id = $this->input->post('staff_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        $data['case_id'] = $case_id;

        if(!empty($staff_id) && $search_trigger == 1) {
            $data['stf_inf'] = $this->disc_mdl->getStaffSearch($staff_id);
        } 

        $this->render($data);
    }

    // SAVE ADD SUSPECT DETL
    public function saveSpDetl() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCS = 0;
        $case_id = $form['case_id'];
        $staff_id = $form['staff_id_form'];

        // form / input validation
        $rule = array(
            'case_id' => 'required|max_length[100]',
            'staff_id_form' => 'required|max_length[10]',
            'staff_dept' => 'max_length[10]',
            'staff_svc' => 'required|max_length[10]',
            'guilty' => 'max_length[10]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $check_rec = $this->disc_mdl->getSpdetl($case_id, $staff_id);

            if(empty($check_rec)) {
                $insertDcsAL = $this->disc_mdl->insertDcsAL($form);
                if($insertDcsAL > 0) {
                    $successDCS = 1;
                } else {
                    $successDCS = 0;
                }

                if($successDCS > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
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

    // DELETE SUSPECT DETL
    public function delSpDetl() 
    {
		$this->isAjax();
		
        $case_id = $this->input->post('case_id', true);
        $staff_id = $this->input->post('staff_id', true);
        
        if (!empty($case_id) && !empty($staff_id)) {

            $del = $this->disc_mdl->delSpDetl($case_id, $staff_id);
    
            if ($del > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success');
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
        }
        echo json_encode($json);
    }

}

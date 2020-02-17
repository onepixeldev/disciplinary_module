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
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsDiscYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' ---Please select--- ');

        $this->render($data);
    }

    // CASE REPORT ENTRY ABSENCE FROM DUTY
    public function AFF019()
    {   
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsAFDYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' ---Please select--- ');

        $this->render($data);
    }

    // CASE REPORT ENTRY ASSET LOSS
    public function AFF018()
    {   
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsALYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' ---Please select--- ');

        $this->render($data);
    }

    // CASE REPORT ENTRY INQUIRY
    public function AFF017()
    {   
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsIQYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' ---Please select--- ');

        $this->render($data);
    }

    // CASE UPDATE
    public function AFF015()
    {   
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' ---Please select--- ');

        $data['sts_list'] = array(''=>' ---Please select--- ', 'CLOSED'=>'CLOSED');

        $data['case_type'] = array(''=>'All', 'DISCIPLINARY'=>'Disciplinary', 'ABSENCE'=>'Absence', 'ASSET_LOSS'=>'Asset Loss', 'INQUIRY_SHOWCAUSE'=>'Inquiry');

        $this->render($data);
    }

    // CASE STATISTIC QUERY
    public function AFF009()
    {   
        // get admin dept code
        $hrdCode = $this->disc_mdl->getDiscAdminDeptCode();

        // DEPT CODE BG AND BSM
        $hrd = $this->disc_mdl->getDeptCode1();
        $hrd2 = $this->disc_mdl->getDeptCode2();

        $curr_usr_dept = $this->disc_mdl->getCurUserDept();
        $curr_usr_dept = $curr_usr_dept->SM_DEPT_CODE;
        $data['curr_dept'] = '';

        if($curr_usr_dept == $hrdCode) {
            $isAdmin = 1;
            $data['case_dept_list'] = $this->dropdown($this->disc_mdl->getCsDept($hrd, $hrd2, $isAdmin), 'DM_DEPT_CODE', 'DM_DEPT_CODE_DESC', ' ---All department--- ');
            $data['curr_dept'] = 'BG';
        } else {
            $isAdmin = 0;
            $data['case_dept_list'] = $this->dropdown($this->disc_mdl->getCsDept($hrd, $hrd2, $isAdmin), 'DM_DEPT_CODE', 'DM_DEPT_CODE_DESC', '');
            $data['curr_dept'] = $curr_usr_dept;
        }
        
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' All');

        $data['sts_list'] = $this->dropdown($this->disc_mdl->getCaseStatusList2(), 'SM_STATUS_CODE', 'SM_STATUS_CODE_DESC', ' All');

        $data['case_type'] = array(''=>'All', 'DISCIPLINARY'=>'Disciplinary', 'ABSENCE'=>'Absence', 'ASSET_LOSS'=>'Asset Loss', 'INQUIRY_SHOWCAUSE'=>'Inquiry');

        
        $this->render($data);
    }

    // CASE QUERY BY STAFF
    public function AFF014()
    {   
        // get admin dept code
        $hrdCode = $this->disc_mdl->getDiscAdminDeptCode();

        // DEPT CODE BG AND BSM
        $hrd = $this->disc_mdl->getDeptCode1();
        $hrd2 = $this->disc_mdl->getDeptCode2();

        $curr_usr_dept = $this->disc_mdl->getCurUserDept();
        $curr_usr_dept = $curr_usr_dept->SM_DEPT_CODE;
        $data['curr_dept'] = '';

        if($curr_usr_dept == $hrdCode) {
            $isAdmin = 1;
            $data['case_dept_list'] = $this->dropdown($this->disc_mdl->getCsDept($hrd, $hrd2, $isAdmin), 'DM_DEPT_CODE', 'DM_DEPT_CODE_DESC', ' ---All department--- ');
            $data['curr_dept'] = 'BG';
        } else {
            $isAdmin = 0;
            $data['case_dept_list'] = $this->dropdown($this->disc_mdl->getCsDept($hrd, $hrd2, $isAdmin), 'DM_DEPT_CODE', 'DM_DEPT_CODE_DESC', '');
            $data['curr_dept'] = $curr_usr_dept;
        }
        
        $data['curr_date'] = $this->disc_mdl->getCurDate();
        $data['curr_year'] = $data['curr_date']->SYSDATE_YYYY;

        $data['case_year_list'] = $this->dropdown($this->disc_mdl->getCsYear(), 'DCM_CASE_YEAR', 'DCM_CASE_YEAR', ' All');

        $data['sts_list'] = $this->dropdown($this->disc_mdl->getCaseStatusList2(), 'SM_STATUS_CODE', 'SM_STATUS_CODE_DESC', ' All');

        $data['case_type'] = array(''=>'All', 'DISCIPLINARY'=>'Disciplinary', 'ABSENCE'=>'Absence', 'ASSET_LOSS'=>'Asset Loss', 'INQUIRY_SHOWCAUSE'=>'Inquiry');

        
        $this->render($data);
    }

    // STAFF DISCIPLINARY REPORT
    public function AFF008()
    {   
        $this->render();
    }

    /*===========================================================
       GENERATE REPORT
    =============================================================*/

    // SET REPORT PARAM
    public function setRepParam() 
    {
		$this->isAjax();
		
		$repCode = $this->input->post('repCode', true);
        $param = '';
		
		if ($repCode == 'AFR010') {
			$case_id = $this->input->post('case_id', true);
			$sid = $this->input->post('sid', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','CASE_ID'=>$case_id,'STAFF_ID'=>$sid));
        }
        else if ($repCode == 'AFR006') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
        else if ($repCode == 'AFR007') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
        else if ($repCode == 'AFR008') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
        else if ($repCode == 'AFR009') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
        else if ($repCode == 'AFR001') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
        else if ($repCode == 'AFR002') {
            $case_sts = $this->input->post('case_sts', true);
			$year_frm = $this->input->post('year_frm', true);
            $year_to = $this->input->post('year_to', true);
            $repFormat = 'PDF';

			$param = $this->encryption->encrypt_array(array('REPORT'=>$repCode,'FORMAT'=>$repFormat,'PARAMFORM' => 'NO','P_STATUS'=>$case_sts,'P_YEAR_FROM'=>$year_frm,'P_YEAR_TO'=>$year_to));
        } 
		
		$json = array('report' => $param);
		
		echo json_encode($json);		
    } 
    
    // GENERATE REPORT
    public function report()
    {
		$report = $this->encryption->decrypt_array($this->input->get('r'));
		$this->lib->generate_report($report, false);
    }

    /*===========================================================
       CASE REPORT ENTRY (DISCIPLINARY) - AFF016
    =============================================================*/

    // CASE REPORT ENTRY DISCIPLINARY LIST
    public function csRpEntDisc()
    {   
        $year_f = $this->input->post('year_f', true);

        // get available records
        $data['rp_disc_list'] = $this->disc_mdl->getRpDiscList($year_f);

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

    // SEARCH STAFF 2
    public function searchStaffMd2() 
    {
        $staff_id = $this->input->post('staff_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        if(!empty($staff_id) && $search_trigger == 1) {
            $data['stf_inf'] = $this->disc_mdl->getStaffSearch2($staff_id);
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
            'punishment_enforcement_date' => 'max_length[11]',
            'punishment_end_date' => 'max_length[11]'
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
            'punishment_enforcement_date' => 'max_length[11]',
            'punishment_end_date' => 'max_length[11]'
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
        $year_f = $this->input->post('year_f', true);

        // get available records
        $data['rp_afd_list'] = $this->disc_mdl->getRpAFDList($year_f);

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
        $year_f = $this->input->post('year_f', true);

        // get available records
        $data['rp_al_list'] = $this->disc_mdl->getRpALList($year_f);

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
        // $pol_rep_date = $form['police_report_date'];
        $dcm_sts = '';
        $dcm_sts_date = '';

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'required|max_length[50]',
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

            $dcm_sts = 'PRELIMINARY REPORT'; 
           
            $insertDcmAL = $this->disc_mdl->insertDcmAL($case_id, $dcm_sts, $form);
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

            $stf_detl = $this->disc_mdl->stfDetl2($stf_id);

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
        // $pol_rep_date = $form['police_report_date'];
        $case_id = $form['case_id'];
        $dcm_sts = '';
        $dcm_sts_date = '';

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'required|max_length[50]',
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

            $dcm_sts = 'PRELIMINARY REPORT'; 
           
            $updateDcmAL = $this->disc_mdl->updateDcmAL($case_id, $dcm_sts, $form);
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

    // COMMITEE CASE
    public function comCaseAl()
    {   
        $case_id = $this->input->post('case_id', true);

        // get available records
        $data['com_list'] = $this->disc_mdl->getComList($case_id);
        $data['com_detl'] = $this->disc_mdl->getComDetl($case_id);
        $data['dec_sts_dd'] = $this->dropdown($this->disc_mdl->getDecStsDD(), 'DAR_RESULT_CODE', 'DAR_RESULT_DESC', ' ---Please select--- ');
        $data['case_id'] = $case_id;

        $this->render($data);
    }

    // SAVE COMMITTEE DETL
    public function saveCmDetl() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCL2 = 0;
        $successDCM2 = 0;
        $case_id = $form['case_id'];
        $decision_date_jktk = $form['decision_date_jktk'];
        $dcm_sts = $form['status'];

        // form / input validation
        $rule = array(
            // 'case_id' => 'required|max_length[100]',
            'commitee_appointment_date' => 'required|max_length[11]',
            'recommendation_investigation_committee' => 'max_length[4000]',
            'decision_date' => 'max_length[11]',
            'decision' => 'max_length[10]',
            'decision_date_jktk' => 'max_length[11]',
            'status' => 'max_length[100]',
            'decision_jktk' => 'max_length[4000]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            if(!empty($decision_date_jktk)) {
                $dcm_sts = 'CLOSED';
                $dcm_sts_date = $decision_date_jktk;
            } else if(empty($decision_date_jktk) && $dcm_sts == 'CLOSED') {
                $dcm_sts = 'PRELIMINARY REPORT';
                $dcm_sts_date = $decision_date_jktk;
            }

            $updDclAL2 = $this->disc_mdl->updDclAL2($form);
            if($updDclAL2 > 0) {
                $successDCL2 = 1;
            } else {
                $successDCL2 = 0;
            }

            $updDcmAL2 = $this->disc_mdl->updDcmAL2($form);
            if($updDcmAL2 > 0) {
                $successDCM2 = 1;
            } else {
                $successDCM2 = 0;
            }

            if($successDCL2 > 0 && $successDCM2 > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }

        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // ADD COMMITTEE AL
    public function addCommAL()
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

    // SAVE ADD COMMITTEE MEMBER
    public function saveCommMem() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCC = 0;
        $case_id = $form['case_id'];
        $staff_id = $form['staff_id_form'];

        // form / input validation
        $rule = array(
            'case_id' => 'required|max_length[100]',
            'staff_id_form' => 'required|max_length[10]',
            'staff_dept' => 'max_length[12]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $check_rec = $this->disc_mdl->getCommMemDetl($case_id, $staff_id);

            if(empty($check_rec)) {
                $insertDccAL = $this->disc_mdl->insertDccAL($form);
                if($insertDccAL > 0) {
                    $successDCC = 1;
                } else {
                    $successDCC = 0;
                }

                if($successDCC > 0) {
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

    // DELETE COMMITTEE DETL
    public function delCmmMem() 
    {
		$this->isAjax();
        
        $seq = $this->input->post('seq', true);
        $case_id = $this->input->post('case_id', true);
        $seq_count = 0;
        
        if (!empty($case_id) && !empty($seq)) {

            $del = $this->disc_mdl->delCmmMem($case_id, $seq);
    
            if ($del > 0) {
                $com_list = $this->disc_mdl->getComList($case_id);
                if(!empty($com_list)) {
                    foreach($com_list as $cl) {
                        $cur_seq = $cl->DCC_SEQ; 
                        $seq_count = $seq_count + 1;

                        if($cur_seq != $seq_count) {
                            $upd_seq = $this->disc_mdl->updSeqCmAl($case_id, $seq_count, $cur_seq);
                        }
                    }

                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success', 'case_id' => $case_id);
                } else {
                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success', 'case_id' => $case_id);
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
        }
        echo json_encode($json);
    }

    /*===========================================================
       CASE REPORT ENTRY (INQUIRY) - AFF017
    =============================================================*/

    // CASE REPORT ENTRY (INQUIRY) LIST
    public function csRpEntIQ()
    {   
        $year_f = $this->input->post('year_f', true);

        // get available records
        $data['rp_iq_list'] = $this->disc_mdl->getRpIQList($year_f);

        $this->render($data);
    }

    // ADD CASE IQ
    public function addCaseIQForm()
    {  
        $data['cs_type'] = 'INQUIRY_SHOWCAUSE';
        $data['file_reference'] = 'UPSI/PEND/BG2/812';
        // $data['dcm_sts'] = 'PRELIMINARY REPORT';

        $this->render($data);
    }

    // SAVE ADD CASE REPORT ENTRY (INQUIRY)
    public function saveAddRpIqFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCL = 0;

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'required|max_length[50]',
            'complaint_date' => 'max_length[11]',
            'audit_report_date' => 'max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $gen_id = $this->disc_mdl->genIQCaseID();
            if(!empty($gen_id)) {
                $case_id = $gen_id->CASE_ID;
            } else {
                $case_id = '';
            }
           
            $insertDcmIQ = $this->disc_mdl->insertDcmIQ($case_id, $form);
            if($insertDcmIQ > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $insertDclIQ = $this->disc_mdl->insertDclIQ($case_id, $form);
            if($insertDclIQ > 0) {
                $successDCL = 1;
            } else {
                $successDCL = 0;
            }

            if($successDCM > 0 && $successDCL > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // EDIT CASE INQUIRY
    public function editCaseIQForm()
    {  
        $case_id = $this->input->post('case_id', true);

        $data['rp_iq_detl'] = $this->disc_mdl->getRpIQDetl($case_id);

        $this->render($data);
    }

    // INQUIRY COMMITEE
    public function editCommIQForm()
    {   
        $case_id = $this->input->post('case_id', true);

        // get available records
        $data['com_list'] = $this->disc_mdl->getComList($case_id);
        $data['com_detl'] = $this->disc_mdl->getComDetl($case_id);
        $data['case_id'] = $case_id;

        $this->render($data);
    }

    // SAVE COMMITTEE IQ DETL
    public function saveCmIQDetl() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCL2 = 0;
        $successDCM2 = 0;
        $case_id = $form['case_id'];

        // form / input validation
        $rule = array(
            // 'case_id' => 'required|max_length[100]',
            'commitee_appointment_date' => 'required|max_length[11]',
            'investigation_scope' => 'max_length[4000]',
            'investigation_committee_rec' => 'required|max_length[4000]',
            'decision_date_mpe' => 'max_length[11]',
            'status' => 'max_length[100]',
            'decision_mpe' => 'max_length[4000]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $updDclIQ2 = $this->disc_mdl->updDclIQ2($form);
            if($updDclIQ2 > 0) {
                $successDCL2 = 1;
            } else {
                $successDCL2 = 0;
            }

            $updDcmIQ2 = $this->disc_mdl->updDcmIQ2($form);
            if($updDcmIQ2 > 0) {
                $successDCM2 = 1;
            } else {
                $successDCM2 = 0;
            }

            if($successDCL2 > 0 && $successDCM2 > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }

        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // ADD COMMITTEE IQ
    public function addCommIQ()
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

    // SAVE ADD COMMITTEE MEMBER
    public function saveCommIQ() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCC = 0;
        $case_id = $form['case_id'];
        $staff_id = $form['staff_id_form'];

        // form / input validation
        $rule = array(
            'case_id' => 'required|max_length[100]',
            'staff_id_form' => 'required|max_length[10]',
            'staff_dept' => 'max_length[12]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $check_rec = $this->disc_mdl->getCommMemDetl($case_id, $staff_id);

            if(empty($check_rec)) {
                $insertDccAL = $this->disc_mdl->insertDccAL($form);
                if($insertDccAL > 0) {
                    $successDCC = 1;
                } else {
                    $successDCC = 0;
                }

                if($successDCC > 0) {
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

    // DELETE COMMITTEE MEMBER INQUIRY
    public function delCmmIQ() 
    {
		$this->isAjax();
        
        $seq = $this->input->post('seq', true);
        $case_id = $this->input->post('case_id', true);
        $seq_count = 0;
        
        if (!empty($case_id) && !empty($seq)) {

            $del = $this->disc_mdl->delCmmMem($case_id, $seq);
    
            if ($del > 0) {
                $com_list = $this->disc_mdl->getComList($case_id);
                if(!empty($com_list)) {
                    foreach($com_list as $cl) {
                        $cur_seq = $cl->DCC_SEQ; 
                        $seq_count = $seq_count + 1;

                        if($cur_seq != $seq_count) {
                            $upd_seq = $this->disc_mdl->updSeqCmAl($case_id, $seq_count, $cur_seq);
                        }
                    }

                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success', 'case_id' => $case_id);
                } else {
                    $json = array('sts' => 1, 'msg' => 'Record has been deleted', 'alert' => 'success', 'case_id' => $case_id);
                }
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to delete record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => 'Invalid operation. Please contact administrator', 'alert' => 'danger');
        }
        echo json_encode($json);
    }

    // SAVE ADD CASE REPORT ENTRY (INQUIRY)
    public function saveEditRpIQFrm() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCL = 0;
        $case_id = $form['case_id'];

        // form / input validation
        $rule = array(
            'case_type' => 'max_length[50]',
            'case_year' => 'required|max_length[4]',
            'file_reference' => 'required|max_length[50]',
            'complaint_date' => 'max_length[11]',
            'audit_report_date' => 'max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {
           
            $updDcmIQ = $this->disc_mdl->updDcmIQ($case_id, $form);
            if($updDcmIQ > 0) {
                $successDCM = 1;
            } else {
                $successDCM = 0;
            }

            $updDclIQ = $this->disc_mdl->updDclIQ($case_id, $form);
            if($updDclIQ > 0) {
                $successDCL = 1;
            } else {
                $successDCL = 0;
            }

            if($successDCM > 0 && $successDCL > 0) {
                $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
            } else {
                $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
            }
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // SUSPECT LIST (INQUIRY)
    public function IQSuspectList()
    {   
        $case_id = $this->input->post('case_id', true);

        // get available records
        $data['sp_list_iq'] = $this->disc_mdl->getSpListIQ($case_id);
        $data['case_id'] = $case_id;

        $this->render($data);
    }

    // ADD SUSECT DETL (INQUIRY)
    public function addSuspectDetlIQ()
    {  
        $case_id = $this->input->post('case_id', true);
        $staff_id = $this->input->post('staff_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        $data['case_id'] = $case_id;

        if(!empty($staff_id) && $search_trigger == 1) {
            $data['stf_inf'] = $this->disc_mdl->getStaffSearch($staff_id);
        } 

        $data['grp_svc_list'] = $this->dropdown($this->disc_mdl->getSvcGroup(), 'DGS_GROUP_CODE', 'DGS_GROUP_CODE_DESC', ' ---Please select--- ');

        $this->render($data);
    }

    // SAVE ADD SUSPECT DETL (INQUIRY)
    public function saveSpDetlIQ() 
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
            'group_service' => 'max_length[10]',
            'guilty' => 'max_length[10]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            $check_rec = $this->disc_mdl->getSpdetl($case_id, $staff_id);

            if(empty($check_rec)) {
                $insertDcsIQ = $this->disc_mdl->insertDcsIQ($form);
                if($insertDcsIQ > 0) {
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

    // DELETE SUSPECT DETL (INQUIRY)
    public function delSpDetlIQ() 
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

    /*===========================================================
       CASE UPDATE - AFF015
    =============================================================*/

    // CASE LIST
    public function csUpdList()
    {   
        $case_type_f = $this->input->post('case_type_f', true);
        $year_f = $this->input->post('year_f', true);
        $sts_f = $this->input->post('sts_f', true);

        $caseLtArr = array();

        // get available records
        $data['rp_list'] = $this->disc_mdl->getCsUpdList($case_type_f, $year_f, $sts_f);

        foreach($data['rp_list'] as $rl) {
            $case_id = $rl->DCM_CASE_ID;
            $case_type = $rl->DCM_CAT_CODE;
            $dcm_sts = $rl->DCM_STATUS;
            $dcm_sts_date = $rl->DCM_STATUS_DATE2;

            $ref_no = '';
            $id = '';
            $cName = '';

            if($case_type == 'DISCIPLINARY' || $case_type == 'ABSENCE') {
                $caseDetl = $this->disc_mdl->getCaseDetl($case_id);
                if(!empty($caseDetl)) {
                    $ref_no = $caseDetl->DCS_REF;
                    $id = $caseDetl->DCS_STAFF_ID;
                    $cName = $caseDetl->SM_STAFF_NAME;
                } else {
                    $ref_no = '';
                    $id = '';
                    $cName = '';
                }
            }

            if($case_type == 'INQUIRY_SHOWCAUSE') {
                $caseDetl2 = $this->disc_mdl->getCaseDetl2($case_id);
                if(!empty($caseDetl2)) {
                    $ref_no = $caseDetl2->DCL_REF_CODE;
                    $id = '';
                    $cName = $caseDetl2->DCL_INQUIRY;
                } else {
                    $ref_no = '';
                    $id = '';
                    $cName = '';
                }
            }

            if($case_type == 'ASSET_LOSS') {
                $item_tp = $this->disc_mdl->getItemTypeAl($case_id);

                if(!empty($item_tp)) {
                    $item_tp = $item_tp->DCI_ITEMTYPE;
                } else {
                    $item_tp = '';
                }

                if($item_tp == 'MONEY') {
                    $caseDetl3 = $this->disc_mdl->getCaseDetl3($case_id);
                    if(!empty($caseDetl3)) {
                        $ref_no = $caseDetl3->DCL_REF_CODE;
                        $id = $caseDetl3->DCI_ITEM;
                        $cName = $caseDetl3->DCI_ITEM_DESC;
                    } else {
                        $ref_no = '';
                        $id = '';
                        $cName = '';
                    }
                }

                if($item_tp  == 'ASSET' || $item_tp == 'INVENTORY') {
                    $caseDetl4 = $this->disc_mdl->getCaseDetl4($case_id);
                    if(!empty($caseDetl4)) {
                        $ref_no = $caseDetl4->DCL_REF_CODE;
                        $id = $caseDetl4->DCI_ASSET_CODE;
                        $cName = $caseDetl4->DCI_ASSET_DESC;
                    } else {
                        $ref_no = '';
                        $id = '';
                        $cName = '';
                    }
                }
            }

            if($case_type == 'DISCIPLINARY') {
                $case_type2 = 'Disciplinary';
            } else if($case_type == 'ABSENCE') {
                $case_type2 = 'Absence';
            } else if($case_type == 'ASSET_LOSS') {
                $case_type2 = 'Asset / item loss';
            } else if($case_type == 'INQUIRY_SHOWCAUSE') {
                $case_type2 = 'Inquiry';
            } else {
                $case_type2 = '';
            }

            $caseLtArr [] = array('case_id'=>$case_id,
            'case_type'=>$case_type2,
            'ref_no'=>$ref_no,
            'id'=>$id,
            'cName'=>$cName,
            'dcm_sts'=>$dcm_sts,
            'dcm_sts_date'=>$dcm_sts_date,
            'case_type_val'=>$case_type);
        }

        $data['rp_list_arr'] = $caseLtArr;

        $this->render($data);
    }

    // UPDATE CASE DISCIPLINARY
    public function editCaseDiscForm2()
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

        $data['sts_list'] = $this->dropdown($this->disc_mdl->getStatusList($case_id), 'SM_STATUS_CODE', 'STS_CODE_DESC', ' ---Please select--- ');

        $data['dcm_sts_inf'] = $this->disc_mdl->getDcmStsDesc($data['dcm_sts']);
        if(!empty($data['dcm_sts_inf'])) {
            $data['dcm_sts_desc'] = $data['dcm_sts_inf']->SM_STATUS_DESC;
        } else {
            $data['dcm_sts_desc'] = '';
        }

        $this->render($data);
    }

    // STATUS PROGRESS MODAL
    public function stsProgressMd() 
    {
        $case_id = $this->input->post('case_id', true);
        
        $data['sts_prog'] = $this->disc_mdl->getStatusProgress($case_id);

        $this->render($data);
    }

    // SAVE UPDATE CASE REPORT ENTRY (DISCIPLINARY) - AFF015
    public function saveEditRpEntFrm2() 
    {
        $this->isAjax();

        // get parameter values
        $form = $this->input->post('form', true);
        $successDCM = 0;
        $successDCS = 0;
        $successDCP = 0;

        // CASE ID
        $case_id = $form['case_id'];
        $status_cs = $form['status'];

        $punishment_type = $form['punishment_type'];
        $punishment_enforcement_date = $form['punishment_enforcement_date'];
        $punishment_end_date = $form['punishment_end_date'];

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
            'punishment_enforcement_date' => 'max_length[11]',
            'punishment_end_date' => 'max_length[11]'
        );

        $exclRule = null;
        
        list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        if ($status == 1) {

            if($status_cs == 'CLOSED') {
                if(empty($punishment_type)) {
                    $json = array('sts' => 0, 'msg' => 'Punishment Type is required when status is set to CLOSED', 'alert' => 'danger');
                } else if(empty($punishment_enforcement_date)) {
                    $json = array('sts' => 0, 'msg' => 'Punishment Enforcement Date is required when status is set to CLOSED', 'alert' => 'danger');
                } else if(empty($punishment_end_date)) {
                    $json = array('sts' => 0, 'msg' => 'Punishment End Date is required when status is set to CLOSED', 'alert' => 'danger');
                } else {
                    // GET NEXT SEQ
                    $seq = $this->disc_mdl->getDcpSeq($case_id);
                    if(!empty($seq)) {
                        $seq_no = $seq->DCP_SEQ2;
                    } else {
                        $seq_no = 1;
                    }

                    // CHECK DCP
                    $checkDcp = $this->disc_mdl->getDcpDetl($case_id, $status_cs);
                    if(empty($checkDcp)) {
                        // INSERT DCP 2
                        $insertDcp2 = $this->disc_mdl->insertDcp2($case_id, $form, $seq_no);
                        if($insertDcp2 > 0) {
                            $successDCP = 1;
                        } else {
                            $successDCP = 0;
                        }
                    } else {
                        $successDCP = 1;
                    }
                    
                    
                    // UPDATE DCM
                    $updDcm = $this->disc_mdl->updDcm($case_id, $form);
                    if($updDcm > 0) {
                        $successDCM = 1;
                    } else {
                        $successDCM = 0;
                    }
                    
                    // UPDATE DCS
                    $updDcs = $this->disc_mdl->updDcs($case_id, $form);
                    if($updDcs > 0) {
                        $successDCS = 1;
                    } else {
                        $successDCS = 0;
                    }

                    if($successDCM > 0 && $successDCS > 0 && $successDCP > 0) {
                        $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
                    } else {
                        $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                    }
                }
            } else {
                // GET NEXT SEQ
                $seq = $this->disc_mdl->getDcpSeq($case_id);
                if(!empty($seq)) {
                    $seq_no = $seq->DCP_SEQ2;
                } else {
                    $seq_no = 1;
                }
                
                // CHECK DCP
                $checkDcp = $this->disc_mdl->getDcpDetl($case_id, $status_cs);
                if(empty($checkDcp)) {
                    // INSERT DCP 2
                    $insertDcp2 = $this->disc_mdl->insertDcp2($case_id, $form, $seq_no);
                    if($insertDcp2 > 0) {
                        $successDCP = 1;
                    } else {
                        $successDCP = 0;
                    }
                } else {
                    $successDCP = 1;
                }
                
                // UPDATE DCM
                $updDcm = $this->disc_mdl->updDcm($case_id, $form);
                if($updDcm > 0) {
                    $successDCM = 1;
                } else {
                    $successDCM = 0;
                }
                
                // UPDATE DCS
                $updDcs = $this->disc_mdl->updDcs($case_id, $form);
                if($updDcs > 0) {
                    $successDCS = 1;
                } else {
                    $successDCS = 0;
                }

                if($successDCM > 0 && $successDCS > 0 && $successDCP > 0) {
                    $json = array('sts' => 1, 'msg' => 'Record has been saved', 'alert' => 'success', 'case_id' => $case_id);
                } else {
                    $json = array('sts' => 0, 'msg' => 'Fail to save record', 'alert' => 'danger');
                }
            }
           
            
        } else {
            $json = array('sts' => 0, 'msg' => $err, 'alert' => 'danger');
        }
         
        echo json_encode($json);
    }

    // STATUS DESC
    public function getStatusDesc() 
    {
        $this->isAjax();

        // get parameter values
        $sts_code = $this->input->post('sts_code', true);

        $sts_inf = $this->disc_mdl->getStatusDesc($sts_code);
        if(!empty($sts_inf)) {
            $sts_desc = $sts_inf->SM_STATUS_DESC;
        } else {
            $sts_desc = '';
        }
         
        $json = array('sts' => 1, 'msg' => 'Status Desc', 'alert' => 'success', 'sts_desc' => $sts_desc);

        echo json_encode($json);
    }

    // EDIT CASE AFD 2
    public function editCaseAFDForm2()
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

    // ASSET LOSS UPDATE FORM
    public function assetLossUpdForm()
    {  
        $this->render();
    }

    // INQUIRY UPDATE FORM
    public function inquiryUpdForm()
    {  
        $this->render();
    }

    /*===========================================================
       CASE STATISTIC QUERY - AFF009
    =============================================================*/

    // CASE STATISTIC LIST
    public function caseStatList()
    {   
        $year_f = $this->input->post('year_f', true);
        $case_dept_f = $this->input->post('case_dept_f', true);
        $case_type_f = $this->input->post('case_type_f', true);
        $case_sts_f = $this->input->post('case_sts_f', true);

        // get all available records
        $data['case_stat_list'] = $this->disc_mdl->getCaseStatList($year_f, $case_dept_f, $case_type_f, $case_sts_f);

        $this->render($data);
    }

    // CASE DETL LIST
    public function caseDetlList()
    {   
        $case_year = $this->input->post('case_year', true);
        $case_dept = $this->input->post('case_dept', true);
        $case_type = $this->input->post('case_type', true);
        $case_sts = $this->input->post('case_sts', true);

        $caseLtArr = array();

        // get available records
        $data['rp_list'] = $this->disc_mdl->getCsDetlList($case_year, $case_dept, $case_type, $case_sts);

        foreach($data['rp_list'] as $rl) {
            $case_id = $rl->DCM_CASE_ID;
            $case_type = $rl->DCM_CAT_CODE;
            $dcm_sts = $rl->DCM_STATUS;
            $dcm_sts_date = $rl->DCM_STATUS_DATE2;

            $ref_no = '';
            $id = '';
            $cName = '';

            if($case_type == 'DISCIPLINARY' || $case_type == 'ABSENCE') {
                $caseDetl = $this->disc_mdl->getCaseDetl($case_id);
                if(!empty($caseDetl)) {
                    $ref_no = $caseDetl->DCS_REF;
                    $id = $caseDetl->DCS_STAFF_ID;
                    $cName = $caseDetl->SM_STAFF_NAME;
                } else {
                    $ref_no = '';
                    $id = '';
                    $cName = '';
                }
            }

            if($case_type == 'INQUIRY_SHOWCAUSE') {
                $caseDetl2 = $this->disc_mdl->getCaseDetl2($case_id);
                if(!empty($caseDetl2)) {
                    $ref_no = $caseDetl2->DCL_REF_CODE;
                    $id = '';
                    $cName = $caseDetl2->DCL_INQUIRY;
                } else {
                    $ref_no = '';
                    $id = '';
                    $cName = '';
                }
            }

            if($case_type == 'ASSET_LOSS') {
                $item_tp = $this->disc_mdl->getItemTypeAl($case_id);

                if(!empty($item_tp)) {
                    $item_tp = $item_tp->DCI_ITEMTYPE;
                } else {
                    $item_tp = '';
                }

                if($item_tp == 'MONEY') {
                    $caseDetl3 = $this->disc_mdl->getCaseDetl3($case_id);
                    if(!empty($caseDetl3)) {
                        $ref_no = $caseDetl3->DCL_REF_CODE;
                        $id = $caseDetl3->DCI_ITEM;
                        $cName = $caseDetl3->DCI_ITEM_DESC;
                    } else {
                        $ref_no = '';
                        $id = '';
                        $cName = '';
                    }
                }

                if($item_tp  == 'ASSET' || $item_tp == 'INVENTORY') {
                    $caseDetl4 = $this->disc_mdl->getCaseDetl4($case_id);
                    if(!empty($caseDetl4)) {
                        $ref_no = $caseDetl4->DCL_REF_CODE;
                        $id = $caseDetl4->DCI_ASSET_CODE;
                        $cName = $caseDetl4->DCI_ASSET_DESC;
                    } else {
                        $ref_no = '';
                        $id = '';
                        $cName = '';
                    }
                }
            }

            if($case_type == 'DISCIPLINARY') {
                $case_type2 = 'Disciplinary';
            } else if($case_type == 'ABSENCE') {
                $case_type2 = 'Absence';
            } else if($case_type == 'ASSET_LOSS') {
                $case_type2 = 'Asset / item loss';
            } else if($case_type == 'INQUIRY_SHOWCAUSE') {
                $case_type2 = 'Inquiry';
            } else {
                $case_type2 = '';
            }

            $caseLtArr [] = array('case_id'=>$case_id,
            'case_type'=>$case_type2,
            'ref_no'=>$ref_no,
            'id'=>$id,
            'cName'=>$cName,
            'dcm_sts'=>$dcm_sts,
            'dcm_sts_date'=>$dcm_sts_date,
            'case_type_val'=>$case_type);
        }

        $data['rp_list_arr'] = $caseLtArr;

        $this->render($data);
    }

    // DISCIPLINARY DETAIL FORM
    public function discDetlForm()
    {  
        $case_id = $this->input->post('case_id', true);

        $data['rp_disc_detl'] = $this->disc_mdl->getRpDiscDetl($case_id);
        $data['case_id'] = $case_id;
        $data['sid'] = $data['rp_disc_detl']->DCS_STAFF_ID;

        $this->render($data);
    }

    // ASSET LOSS DETAIL FORM
    public function assetLossDetlForm()
    {  
        $this->render();
    }

    // INQUIRY DETAIL FORM
    public function inquiryDetlForm()
    {  
        $this->render();
    }

    /*===========================================================
       CASE QUERY BY STAFF - AFF014
    =============================================================*/

    // SEARCH STAFF
    public function searchStaffMd3() 
    {
        $staff_id = $this->input->post('staff_id', true);
        $search_trigger = $this->input->post('search_trigger', true);

        if(!empty($staff_id) && $search_trigger == 1) {
            $data['stf_inf'] = $this->disc_mdl->getStaffSearchQ($staff_id);
            $this->render($data);
        } else {
            $this->render();
        }
    }

    // CASE STAFF QUERY LIST
    public function caseStaffListQ()
    {   
        $staff_id = $this->input->post('staff_id', true);

        $caseLtArr = array();

        // get all available records
        $data['case_stf_list'] = $this->disc_mdl->getCaseStaffListQ($staff_id);

        foreach($data['case_stf_list'] as $csl) {
            $case_id = $csl->VSDL_CASE_ID;
            $case_type = $csl->VSDL_CAT_CODE;
            $case_year = $csl->VSDL_CASE_YEAR;
            $sid = $csl->VSDL_STAFF_ID;
            $cName = $csl->VSDL_NAME;
            $guilty = $csl->VSDL_GUILTY2;
            $dcm_sts = $csl->VSDL_STATUS;

            $ref_no = '';

            if($case_type == 'DISCIPLINARY' || $case_type == 'ABSENCE') {
                $ref_no1 = $this->disc_mdl->getRefNo1($case_id, $sid);
                if(!empty($ref_no1)) {
                    $ref_no = $ref_no1->DCS_REF;
                } else {
                    $ref_no = '';
                }
            }

            if($case_type == 'INQUIRY_SHOWCAUSE' || $case_type == 'ASSET_LOSS') {
                $ref_no2 = $this->disc_mdl->getRefNo2($case_id, $sid);
                if(!empty($ref_no2)) {
                    $ref_no = $ref_no2->DCL_REF_CODE;
                } else {
                    $ref_no = '';
                }
            }

            $caseLtArr [] = array('case_id'=>$case_id,
            'case_type'=>$case_type,
            'case_year'=>$case_year,
            'ref_no'=>$ref_no,
            'sid'=>$sid,
            'cName'=>$cName,
            'guilty'=>$guilty,
            'dcm_sts'=>$dcm_sts);
        }

        $data['rp_list_arr'] = $caseLtArr;

        $this->render($data);
    }

    /*===========================================================
       STAFF DISCIPLINARY REPORTS - AFF008
    =============================================================*/

    // REPORT TAB
    public function caseReport()
    {  
        $data['sts_list'] = $this->dropdown($this->disc_mdl->getCaseStatusRep(), 'SM_STATUS_CODE', 'SM_STATUS_CODE_DESC', ' ---Please select--- ');

        $data['sts_list2'] = array('ENTRY'=>'ENTRY', 'CLOSED'=>'CLOSED', ''=>'ALL');

        $this->render($data);
    }

    // REPORT TAB 2
    public function caseReportII()
    {  
        $data['sts_list'] = $this->dropdown($this->disc_mdl->getCaseStatusRep(), 'SM_STATUS_CODE', 'SM_STATUS_CODE_DESC', ' ---Please select--- ');

        $this->render($data);
    }


}

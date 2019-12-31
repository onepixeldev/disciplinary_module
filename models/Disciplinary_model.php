<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplinary_model extends MY_Model
{
    private $staff_id;
    private $username;

    public function __construct()
    {
        $this->load->database();
        $this->staff_id = $this->lib->userid();
        $this->username = $this->lib->username();
    }

    // get current date
    public function getCurDate() 
    {		
        $this->db->select("TO_CHAR(SYSDATE, 'MM') AS SYSDATE_MM, TO_CHAR(SYSDATE, 'YYYY') AS SYSDATE_YYYY");
        $this->db->from("DUAL");
        $q = $this->db->get();
                
        return $q->row();
    } 

    // GET YEAR DROPDOWN
    public function getYearList() 
    {		
        $this->db->select("to_char(CM_DATE, 'YYYY') AS CM_YEAR");
        $this->db->from("CALENDAR_MAIN");
        $this->db->where("to_char(CM_DATE, 'YYYY') >= to_char(SYSDATE, 'YYYY') - 15");
        $this->db->group_by("to_char(CM_DATE, 'YYYY')");
        $this->db->order_by("to_char(CM_DATE, 'YYYY') DESC");
        $q = $this->db->get();
                
        return $q->result();
    } 

    // GET MONTH DROPDOWN
    public function getMonthList() 
    {		
        $this->db->select("to_char(CM_DATE, 'MM') AS CM_MM, to_char(CM_DATE, 'MONTH') AS CM_MONTH");
        $this->db->from("CALENDAR_MAIN");
        $this->db->group_by("to_char(CM_DATE,'MM'), to_char(CM_DATE, 'MONTH')");
        $this->db->order_by("to_char(CM_DATE, 'MM')");
        $q = $this->db->get();
		        
        return $q->result();
    } 

    // CURREMT USER DEPT
    public function currentUsrDept()
    {  
        $curr_usr = $this->username;

        $this->db->select("SM_DEPT_CODE");
        $this->db->from("STAFF_MAIN");
        $this->db->where("UPPER(SM_APPS_USERNAME)", $curr_usr);
        $q = $this->db->get();
    
        return $q->row();
    }

    // ALL DEPARTMENT
    public function getDeptAll()
    {  
        $this->db->select("DM_DEPT_CODE, DM_DEPT_CODE||' - '||DM_DEPT_DESC AS DP_CODE_DESC");
        $this->db->from("DEPARTMENT_MAIN");
        $this->db->where("COALESCE(DM_STATUS,'INACTIVE') = 'ACTIVE'");
        $this->db->where("DM_LEVEL IN (1,2)");
        $this->db->order_by("DM_DEPT_CODE");
        $q = $this->db->get();
    
        return $q->result();
    }

    // NOT ALL DEPARTMENT
    public function getDeptBased()
    {  
        $curr_usr = $this->username;

        $this->db->select("DM_DEPT_CODE, DM_DEPT_CODE||' - '||DM_DEPT_DESC AS DP_CODE_DESC");
        $this->db->from("DEPARTMENT_MAIN");
        $this->db->where("COALESCE(DM_STATUS,'INACTIVE') = 'ACTIVE'");
        $this->db->where("DM_LEVEL IN (1,2)");
        $this->db->where("DM_DEPT_CODE = (SELECT SM_DEPT_CODE FROM STAFF_MAIN WHERE UPPER(SM_APPS_USERNAME) = '$curr_usr')");
        $this->db->order_by("DM_DEPT_CODE");
        $q = $this->db->get();
    
        return $q->result();
    }
    
    /*===========================================================
       DISCIPLINARY SETUP - AFF007
    =============================================================*/

    // SERVICE POSITION GROUP LIST
    public function getSvcPosGrpList()
    {
        $this->db->select("DGS_GROUP_CODE,
        DGS_GROUP_DESC,
        DGS_STATUS,
        CASE DGS_STATUS
        WHEN 'Y' THEN 'Yes' 
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS DGS_STATUS_DESC");
        $this->db->from("DISC_GROUP_SERVICE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // ACTION CATEGORY
    public function getActCategoryList()
    {
        $this->db->select("DCA_CATEGORY_CODE,
        DCA_CATEGORY_DESC,
        DCA_STATUS,
        CASE DCA_STATUS
        WHEN 'Y' THEN 'Yes' 
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS DCA_STATUS_DESC");
        $this->db->from("DISC_CATEGORY_ACTION");

        $q = $this->db->get();
        
        return $q->result();
    }

    // CASE STATUS
    public function getCaseStatusList()
    {
        $this->db->select("SM_STATUS_CODE,
        SM_STATUS_DESC,
        SM_STATUS_RANK,
        SM_UPDATABLE,
        CASE SM_UPDATABLE
        WHEN 'Y' THEN 'Yes' 
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS SM_UPDATABLE_DESC");
        $this->db->from("STATUS_MAIN");
        $this->db->where("SM_MODULE_CODE = 'HRA_AF' AND SM_FUNCTION = 'DISCIPLINARY'");
        $this->db->order_by("SM_STATUS_RANK");

        $q = $this->db->get();
        
        return $q->result();
    }

    // TYPE OF PUNISHMENT
    public function getTypePunishmentList()
    {
        $this->db->select("DPM_PENALTY_CODE,
        DPM_REPLY,
        DPM_PENALTY_DESC");
        $this->db->from("DISC_PENALTY_MAIN");
        $this->db->order_by("DPM_PENALTY_CODE ASC");

        $q = $this->db->get();
        
        return $q->result();
    }

    // ASSET LOSS SETUP
    public function getAssetLossSetupList()
    {
        $this->db->select("DAR_RESULT_CODE,
        DAR_RESULT_DESC,
        DAR_STATUS,
        CASE DAR_STATUS
        WHEN 'Y' THEN 'Yes' 
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS DAR_STATUS_DESC");
        $this->db->from("DISC_ASSET_RESULT");
        $this->db->order_by("DAR_RESULT_CODE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // GET SERVICE POSITION GROUP DETL
    public function getSvcPosGrpDetl($code)
    {
        $this->db->select("DGS_GROUP_CODE,
        DGS_GROUP_DESC,
        DGS_STATUS");
        $this->db->from("DISC_GROUP_SERVICE");
        $this->db->where("DGS_GROUP_CODE", $code);

        $q = $this->db->get();
        
        return $q->row();
    }

    // SAVE ADD SERVICE POSITION GROUP
    public function saveAddSvcPosGrp($form) 
    {
        $data = array(
            "DGS_GROUP_CODE" => strtoupper($form['code']),
            "DGS_GROUP_DESC" => $form['description'],
            "DGS_STATUS" => $form['active'],
        );

        return $this->db->insert("DISC_GROUP_SERVICE", $data);
    }

    // SAVE UPDATE SERVICE POSITION GROUP
    public function saveUpdSvcPosGrp($form) 
    {
        $code = $form['code'];

        $data = array(
            "DGS_GROUP_DESC" => $form['description'],
            "DGS_STATUS" => $form['active'],
        );

        $this->db->where("UPPER(DGS_GROUP_CODE) = UPPER('$code')");

        return $this->db->update("DISC_GROUP_SERVICE", $data);
    }

    // DELETE SERVICE POSITION GROUP
    public function delSpg($code) 
    {
        $this->db->where("UPPER(DGS_GROUP_CODE) = UPPER('$code')");
        return $this->db->delete('DISC_GROUP_SERVICE');
    }

    // GET ACTION CATEGORY DETL
    public function getActCatDetl($code)
    {
        $this->db->select("DCA_CATEGORY_CODE,
        DCA_CATEGORY_DESC,
        DCA_STATUS");
        $this->db->from("DISC_CATEGORY_ACTION");
        $this->db->where("DCA_CATEGORY_CODE", $code);

        $q = $this->db->get();
        
        return $q->row();
    }

    // SAVE ADD ACTION CATEGORY
    public function saveAddActCat($form) 
    {
        $data = array(
            "DCA_CATEGORY_CODE" => strtoupper($form['code']),
            "DCA_CATEGORY_DESC" => $form['description'],
            "DCA_STATUS" => $form['active'],
        );

        return $this->db->insert("DISC_CATEGORY_ACTION", $data);
    }

    // SAVE UPDATE ACTION CATEGORY
    public function saveUpdAc($form) 
    {
        $code = $form['code'];

        $data = array(
            "DCA_CATEGORY_DESC" => $form['description'],
            "DCA_STATUS" => $form['active'],
        );

        $this->db->where("UPPER(DCA_CATEGORY_CODE) = UPPER('$code')");

        return $this->db->update("DISC_CATEGORY_ACTION", $data);
    }

    // DELETE ACTION CATEGORY
    public function delAc($code) 
    {
        $this->db->where("UPPER(DCA_CATEGORY_CODE) = UPPER('$code')");
        return $this->db->delete('DISC_CATEGORY_ACTION');
    }

    // GET CASE STATUS DETL
    public function getCaseStatusDetl($code)
    {
        $this->db->select("SM_STATUS_CODE,
        SM_STATUS_DESC,
        SM_STATUS_RANK,
        SM_UPDATABLE");
        $this->db->from("STATUS_MAIN");
        $this->db->where("SM_STATUS_CODE", $code);
        $this->db->where("SM_MODULE_CODE = 'HRA_AF'");
        $this->db->where("SM_FUNCTION = 'DISCIPLINARY'");

        $q = $this->db->get();
        
        return $q->row();
    }

    // SAVE ADD CASE STATUS
    public function saveAddCs($form) 
    {
        $data = array(
            "SM_MODULE_CODE" => 'HRA_AF',
            "SM_FUNCTION" => 'DISCIPLINARY',
            "SM_STATUS_CODE" => strtoupper($form['code']),
            "SM_STATUS_DESC" => $form['description'],
            "SM_STATUS_RANK" => $form['order'],
            "SM_UPDATABLE" => $form['active']
        );

        return $this->db->insert("STATUS_MAIN", $data);
    }

    // SAVE UPDATE CASE STATUS
    public function saveUpdCs($form) 
    {
        $code = $form['code'];

        $data = array(
            "SM_STATUS_DESC" => $form['description'],
            "SM_STATUS_RANK" => $form['order'],
            "SM_UPDATABLE" => $form['active']
        );

        $this->db->where("UPPER(SM_STATUS_CODE) = UPPER('$code')");
        $this->db->where("SM_MODULE_CODE = 'HRA_AF'");
        $this->db->where("SM_FUNCTION = 'DISCIPLINARY'");

        return $this->db->update("STATUS_MAIN", $data);
    }

    // GET PUNISHMENT TYPE DETL
    public function getPunishmentTypeDetl($code)
    {
        $this->db->select("DPM_PENALTY_CODE,
        DPM_PENALTY_DESC");
        $this->db->from("DISC_PENALTY_MAIN");
        $this->db->where("DPM_PENALTY_CODE", $code);

        $q = $this->db->get();
        
        return $q->row();
    }

    // SAVE ADD PUNISHMENT TYPE
    public function saveAddTop($form) 
    {
        $data = array(
            "DPM_PENALTY_CODE" => strtoupper($form['code']),
            "DPM_PENALTY_DESC" => $form['description']
        );

        return $this->db->insert("DISC_PENALTY_MAIN", $data);
    }

    // SAVE UPDATE PUNISHMENT TYPE
    public function saveUpdTop($form) 
    {
        $code = $form['code'];

        $data = array(
            "DPM_PENALTY_DESC" => $form['description']
        );

        $this->db->where("DPM_PENALTY_CODE = UPPER('$code')");

        return $this->db->update("DISC_PENALTY_MAIN", $data);
    }

    // GET ASSET LOSS SETUP DETL
    public function getAlsDetl($code)
    {
        $this->db->select("DAR_RESULT_CODE,
        DAR_RESULT_DESC,
        DAR_STATUS");
        $this->db->from("DISC_ASSET_RESULT");
        $this->db->where("DAR_RESULT_CODE", $code);

        $q = $this->db->get();
        
        return $q->row();
    }

    // SAVE ADD ASSET LOSS SETUP
    public function saveAddAls($form) 
    {
        $data = array(
            "DAR_RESULT_CODE" => strtoupper($form['code']),
            "DAR_RESULT_DESC" => $form['description'],
            "DAR_STATUS" => $form['active']
        );

        return $this->db->insert("DISC_ASSET_RESULT", $data);
    }

    // SAVE UPDATE ASSET LOSS SETUP
    public function saveUpdAls($form) 
    {
        $code = $form['code'];

        $data = array(
            "DAR_RESULT_DESC" => $form['description'],
            "DAR_STATUS" => $form['active']
        );

        $this->db->where("DAR_RESULT_CODE = UPPER('$code')");

        return $this->db->update("DISC_ASSET_RESULT", $data);
    }

    /*===========================================================
       CASE REPORT ENTRY (DISCIPLINARY) - AFF016
    =============================================================*/

    // CASE REPORT ENTRY DISCIPLINARY LIST
    public function getRpDiscList()
    {
        $this->db->select("DCM_CASE_ID, 
        DCS_STAFF_ID, 
        SM_STAFF_NAME, 
        DCM_CAT_CODE, 
        DCM_CASE_YEAR,
        DCS_GUILTY, 
        CASE DCS_GUILTY
        WHEN 'Y' THEN 'Yes'
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS DCS_GUILTY_DESC");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_SUSPECT", "DCM_CASE_ID = DCS_CASE_ID", "LEFT");
        $this->db->join("STAFF_MAIN", "DCS_STAFF_ID = SM_STAFF_ID", "LEFT");
        $this->db->where("DCM_CAT_CODE = 'DISCIPLINARY'");
        $this->db->where("DCM_STATUS = 'PRELIMINARY REPORT'");

        $q = $this->db->get();
        
        return $q->result();
    }

    // SEARCH STAFF
    public function getStaffSearch($staffID)
    {
        $this->db->select("SM_STAFF_ID, SM_STAFF_NAME, SM_STAFF_ID ||' - '||SM_STAFF_NAME AS SM_STAFF_ID_NAME,
        SS_SERVICE_CODE,
        SS_SERVICE_DESC,
        SM_DEPT_CODE,
        DM_DEPT_DESC");
        $this->db->from("STAFF_MAIN, SERVICE_SCHEME, DEPARTMENT_MAIN");
        $this->db->where("SM_JOB_CODE = SS_SERVICE_CODE");
        $this->db->where("SM_DEPT_CODE = DM_DEPT_CODE");
        $this->db->where("SM_STAFF_TYPE = 'STAFF'");
        // $this->db->where("SS_STATUS_STS = 'ACTIVE'");

        $this->db->where("(UPPER(SM_STAFF_ID) LIKE UPPER('%$staffID%') OR UPPER(SM_STAFF_NAME) LIKE UPPER('%$staffID%'))");
        $this->db->order_by("2");

        $q = $this->db->get();
        return $q->result();
    }

    // SERVICE GROUP DD
    public function getSvcGroup()
    {
        $this->db->select("DGS_GROUP_CODE, 
        DGS_GROUP_DESC, 
        DGS_GROUP_CODE||' - '||DGS_GROUP_DESC AS DGS_GROUP_CODE_DESC");
        $this->db->from("DISC_GROUP_SERVICE");
        $this->db->where("COALESCE(DGS_STATUS,'N') = 'Y'");
        $this->db->order_by("DGS_GROUP_CODE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // ACTION CATEGORY DD
    public function getActCat()
    {
        $this->db->select("DCA_CATEGORY_CODE, 
        DCA_CATEGORY_DESC, 
        DCA_CATEGORY_CODE||' - '||DCA_CATEGORY_DESC AS DCA_CATEGORY_CODE_DESC");
        $this->db->from("DISC_CATEGORY_ACTION");
        $this->db->where("COALESCE(DCA_STATUS,'N') = 'Y'");
        $this->db->order_by("DCA_CATEGORY_CODE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // PUNISHMENT TYPE DD
    public function getPunishmentType()
    {
        $this->db->select("DPM_PENALTY_CODE, 
        DPM_PENALTY_DESC, 
        DPM_PENALTY_CODE||' - '||DPM_PENALTY_DESC AS DPM_PENALTY_CODE_DESC");
        $this->db->from("DISC_PENALTY_MAIN");
        $this->db->order_by("DPM_PENALTY_CODE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // DCM STATUS DESC
    public function getDcmStsDesc($dcm_sts)
    {
        $this->db->select("SM_STATUS_DESC");
        $this->db->from("STATUS_MAIN");
        $this->db->where("SM_STATUS_CODE = '$dcm_sts'");
        $this->db->where("SM_MODULE_CODE = 'HRA_AF'");
        $this->db->where("SM_FUNCTION = 'DISCIPLINARY'");

        $q = $this->db->get();
        
        return $q->row();
    }

    // GENERATE DCM CASE ID
    public function genDcmCaseID()
    {
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'D'||ltrim(to_char(DISC_C_MAIN_D_SEQ.nextval,'0000000000')) AS CASE_ID");
        $this->db->from("DUAL");

        $q = $this->db->get();
        
        return $q->row();
    }

    // INSERT DCM
    public function insertDcm($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        $curr_usrname = $this->username;

        $this->db->select("SM_STAFF_ID, SM_DEPT_CODE");
        $this->db->from("STAFF_MAIN");
        $this->db->where("UPPER(SM_APPS_USERNAME) = UPPER('$curr_usrname')");
        $usr_inf = $this->db->get()->row();

        if (!empty($usr_inf)) {
            $usr_dept = $usr_inf->SM_DEPT_CODE;
        } else {
            $usr_dept = '';
        }
        

        $data = array(
            "DCM_CASE_ID" => $case_id,
            "DCM_CAT_CODE" => $form['case_type'],
            "DCM_CASE_YEAR" => $form['case_year'],
            "DCM_STATUS" => $form['status'],

            "DCM_ENTER_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );

        if(!empty($form['status_date'])) {
            $date = "TO_DATE('".$form['status_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        }
        
        $this->db->set("DCM_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_MAIN", $data);
    }

    // INSERT DCP
    public function insertDcp($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCP_CASE_ID" => $case_id,
            "DCP_SEQ" => '1',
            "DCP_STATUS" => $form['status'],
            "DCP_NOTES" => $form['status_desc'],
            "DCP_ENTER_BY" => $curr_usr_id
        );

        if(!empty($form['status_date'])) {
            $date = "TO_DATE('".$form['status_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCP_STATUS_DATE", $date, false);
        }
        
        $this->db->set("DCP_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_PROGRESS", $data);
    }

    // INSERT DCS
    public function insertDcs($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCS_CASE_ID" => $case_id,
            "DCS_REF" => $form['file_reference'],
            "DCS_STAFF_ID" => $form['staff_id'],
            "DCS_JOBCODE" => $form['service_id'],
            "DCS_DEPT" => $form['department_id'],
            "DCS_GROUP_SERVICE" => $form['service_group'],
            "DCS_CATEGORY_ACTION" => $form['action_category'],

            "DCS_GUILTY" => $form['guilty'],
            "DCS_SENTENCE" => $form['offense_type'],
            "DCS_RULES_A605" => $form['rule_a605'],
            "DCS_PENALTY_CODE" => $form['punishment_type'],

            "DCS_ENTER_BY" => $curr_usr_id
        );


        if(!empty($form['punishment_enforcement_date'])) {
            $date = "TO_DATE('".$form['punishment_enforcement_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_SENTENCE_FROM", $date, false);
        }

        if(!empty($form['punishment_end_date'])) {
            $date = "TO_DATE('".$form['punishment_end_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_SENTENCE_TO", $date, false);
        }
        
        $this->db->set("DCS_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_SUSPECT", $data);
    }

    // DISCIPLINARY CASE DETL
    public function getRpDiscDetl($case_id)
    {
        $this->db->select("DCM_CASE_ID,
        DCM_CAT_CODE,
        DCM_CASE_YEAR,
        DCM_STATUS,
        DCM_STATUS_DATE,
        TO_CHAR(DCM_STATUS_DATE, 'DD/MM/YYYY') AS DCM_STATUS_DATE2,

        DCS_REF,
        DCS_STAFF_ID,
        DCS_JOBCODE,
        DCS_DEPT,
        DCS_GROUP_SERVICE,
        DCS_CATEGORY_ACTION,

        DCS_GUILTY,
        DCS_SENTENCE,
        DCS_RULES_A605,
        DCS_PENALTY_CODE,
        DCS_SENTENCE_FROM,
        TO_CHAR(DCS_SENTENCE_FROM, 'DD/MM/YYYY') AS DCS_SENTENCE_FROM2,
        DCS_SENTENCE_TO,
        TO_CHAR(DCS_SENTENCE_TO, 'DD/MM/YYYY') AS DCS_SENTENCE_TO2");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_SUSPECT", "DCM_CASE_ID = DCS_CASE_ID", "LEFT");
        $this->db->where("DCM_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // SEARCH STAFF
    public function stfDetl($stf_id)
    {
        $this->db->select("SM_STAFF_ID, SM_STAFF_NAME, SM_STAFF_ID ||' - '||SM_STAFF_NAME AS SM_STAFF_ID_NAME,
        SS_SERVICE_CODE,
        SS_SERVICE_DESC,
        SM_DEPT_CODE,
        DM_DEPT_DESC");
        $this->db->from("STAFF_MAIN, SERVICE_SCHEME, DEPARTMENT_MAIN");
        $this->db->where("SM_JOB_CODE = SS_SERVICE_CODE");
        $this->db->where("SM_DEPT_CODE = DM_DEPT_CODE");
        $this->db->where("SM_STAFF_TYPE = 'STAFF'");
        $this->db->where("SM_STAFF_ID", $stf_id);

        $q = $this->db->get();
        return $q->row();
    }

    // UPDATE DCM
    public function updDcm($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        $curr_usrname = $this->username;

        $this->db->select("SM_STAFF_ID, SM_DEPT_CODE");
        $this->db->from("STAFF_MAIN");
        $this->db->where("UPPER(SM_APPS_USERNAME) = UPPER('$curr_usrname')");
        $usr_inf = $this->db->get()->row();

        if (!empty($usr_inf)) {
            $usr_dept = $usr_inf->SM_DEPT_CODE;
        } else {
            $usr_dept = '';
        }
        
        $data = array(
            "DCM_CAT_CODE" => $form['case_type'],
            "DCM_CASE_YEAR" => $form['case_year'],
            "DCM_STATUS" => $form['status'],

            "DCM_ENTER_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );


        if(!empty($form['status_date'])) {
            $date = "TO_DATE('".$form['status_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        }
        
        $this->db->set("DCM_ENTER_DATE", $curr_date, false);

        $this->db->where("DCM_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_MAIN", $data);
    }

    // UPDATE DCS
    public function updDcs($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCS_REF" => $form['file_reference'],
            "DCS_STAFF_ID" => $form['staff_id'],
            "DCS_JOBCODE" => $form['service_id'],
            "DCS_DEPT" => $form['department_id'],
            "DCS_GROUP_SERVICE" => $form['service_group'],
            "DCS_CATEGORY_ACTION" => $form['action_category'],

            "DCS_GUILTY" => $form['guilty'],
            "DCS_SENTENCE" => $form['offense_type'],
            "DCS_RULES_A605" => $form['rule_a605'],
            "DCS_PENALTY_CODE" => $form['punishment_type'],

            "DCS_ENTER_BY" => $curr_usr_id
        );


        if(!empty($form['punishment_enforcement_date'])) {
            $date = "TO_DATE('".$form['punishment_enforcement_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_SENTENCE_FROM", $date, false);
        }

        if(!empty($form['punishment_end_date'])) {
            $date = "TO_DATE('".$form['punishment_end_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_SENTENCE_TO", $date, false);
        }
        
        $this->db->set("DCS_ENTER_DATE", $curr_date, false);

        $this->db->where("DCS_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_SUSPECT", $data);
    }

    // GET DCP
    public function getDCP($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_PROGRESS");
        $this->db->where("DCP_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // GET DCS
    public function getDCS($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_SUSPECT");
        $this->db->where("DCS_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // DELETE CASE REPORT ENTRY (DISCIPLINARY)
    public function delCaseDiscForm($case_id) 
    {
        $this->db->where("DCM_CASE_ID", $case_id);
        return $this->db->delete('DISC_CASE_MAIN');
    }

    /*===========================================================
       CASE REPORT ENTRY (ABSENCE FROM DUTY) - AFF019
    =============================================================*/

    // CASE REPORT ENTRY (ABSENCE FROM DUTY) LIST
    public function getRpAFDList()
    {
        $this->db->select("DCM_CASE_ID, 
        DCS_STAFF_ID, 
        SM_STAFF_NAME, 
        DCM_CAT_CODE, 
        DCM_CASE_YEAR,
        DCS_GUILTY, 
        CASE DCS_GUILTY
        WHEN 'Y' THEN 'Yes'
        WHEN 'N' THEN 'No'
        ELSE ''
        END AS DCS_GUILTY_DESC");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_SUSPECT", "DCM_CASE_ID = DCS_CASE_ID", "LEFT");
        $this->db->join("STAFF_MAIN", "DCS_STAFF_ID = SM_STAFF_ID", "LEFT");
        $this->db->where("DCM_CAT_CODE = 'ABSENCE'");
        $this->db->where("DCM_STATUS = 'PRELIMINARY REPORT'");

        $q = $this->db->get();
        
        return $q->result();
    }

    // GENERATE AFD CASE ID
    public function genAFDCaseID()
    {
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'A'||ltrim(to_char(DISC_C_MAIN_D_SEQ.nextval,'0000000000')) AS CASE_ID");
        $this->db->from("DUAL");

        $q = $this->db->get();
        
        return $q->row();
    }

    // INSERT DCM AFD
    public function insertDcmAFD($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        $curr_usrname = $this->username;

        $this->db->select("SM_STAFF_ID, SM_DEPT_CODE");
        $this->db->from("STAFF_MAIN");
        $this->db->where("UPPER(SM_APPS_USERNAME) = UPPER('$curr_usrname')");
        $usr_inf = $this->db->get()->row();

        if (!empty($usr_inf)) {
            $usr_dept = $usr_inf->SM_DEPT_CODE;
        } else {
            $usr_dept = '';
        }
        
        $data = array(
            "DCM_CASE_ID" => $case_id,
            "DCM_CAT_CODE" => $form['case_type'],
            "DCM_CASE_YEAR" => $form['case_year'],
            "DCM_STATUS" => $form['status'],

            "DCM_ENTER_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );

        if(!empty($form['administration_warning_date'])) {
            $date = "TO_DATE('".$form['administration_warning_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        } else {
            $this->db->set("DCM_STATUS_DATE", '', true);
        }
        
        $this->db->set("DCM_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_MAIN", $data);
    }

    // INSERT DCS AFD
    public function insertDcsAFD($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCS_CASE_ID" => $case_id,
            "DCS_REF" => $form['file_reference'],
            "DCS_STAFF_ID" => $form['staff_id'],
            "DCS_JOBCODE" => $form['service_id'],
            "DCS_DEPT" => $form['department_id'],

            "DCS_GUILTY" => $form['guilty'],
            "DCS_ABSENCE_DAY" => $form['absent_day'],
            "DCS_EMOLUMENT" => $form['total_emolument_deduction'],

            "DCS_ENTER_BY" => $curr_usr_id
        );


        if(!empty($form['complaint_date'])) {
            $date = "TO_DATE('".$form['complaint_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_COMPLAINT_DATE", $date, false);
        } else {
            $this->db->set("DCS_COMPLAINT_DATE", '', true);
        }

        if(!empty($form['registrar_meeting_date'])) {
            $date = "TO_DATE('".$form['registrar_meeting_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_REGISTRAR_DATE", $date, false);
        } else {
            $this->db->set("DCS_REGISTRAR_DATE", '', true);
        }

        if(!empty($form['show_cause_notice_date'])) {
            $date = "TO_DATE('".$form['show_cause_notice_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_NOTICE_DATE", $date, false);
        } else {
            $this->db->set("DCS_NOTICE_DATE", '', true);
        }

        if(!empty($form['administration_warning_date'])) {
            $date = "TO_DATE('".$form['administration_warning_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_ALERT_DATE", $date, false);
        } else {
            $this->db->set("DCS_ALERT_DATE", '', true);
        }
        
        $this->db->set("DCS_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_SUSPECT", $data);
    }

    // AFD CASE DETL
    public function getRpAFDDetl($case_id)
    {
        $this->db->select("DCM_CASE_ID,
        DCM_CAT_CODE,
        DCM_CASE_YEAR,
        DCM_STATUS,

        DCS_REF,
        DCS_STAFF_ID,
        DCS_JOBCODE,
        DCS_DEPT,

        DCS_GUILTY,
        DCS_COMPLAINT_DATE,
        DCS_REGISTRAR_DATE,
        DCS_NOTICE_DATE,
        DCS_ALERT_DATE,
        TO_CHAR(DCS_COMPLAINT_DATE, 'DD/MM/YYYY') AS DCS_COMPLAINT_DATE2,
        TO_CHAR(DCS_REGISTRAR_DATE, 'DD/MM/YYYY') AS DCS_REGISTRAR_DATE2,
        TO_CHAR(DCS_NOTICE_DATE, 'DD/MM/YYYY') AS DCS_NOTICE_DATE2,
        TO_CHAR(DCS_ALERT_DATE, 'DD/MM/YYYY') AS DCS_ALERT_DATE2,

        DCS_ABSENCE_DAY,
        DCS_EMOLUMENT");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_SUSPECT", "DCM_CASE_ID = DCS_CASE_ID", "LEFT");
        $this->db->where("DCM_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // UPDATE DCM AFD
    public function updateDcmAFD($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        $curr_usrname = $this->username;

        $this->db->select("SM_STAFF_ID, SM_DEPT_CODE");
        $this->db->from("STAFF_MAIN");
        $this->db->where("UPPER(SM_APPS_USERNAME) = UPPER('$curr_usrname')");
        $usr_inf = $this->db->get()->row();

        if (!empty($usr_inf)) {
            $usr_dept = $usr_inf->SM_DEPT_CODE;
        } else {
            $usr_dept = '';
        }
        
        $data = array(
            // "DCM_CASE_ID" => $case_id,
            "DCM_CAT_CODE" => $form['case_type'],
            "DCM_CASE_YEAR" => $form['case_year'],
            "DCM_STATUS" => $form['status'],

            "DCM_UPDATE_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );

        if(!empty($form['administration_warning_date'])) {
            $date = "TO_DATE('".$form['administration_warning_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        } else {
            $this->db->set("DCM_STATUS_DATE", '', true);
        }
        
        $this->db->set("DCM_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCM_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_MAIN", $data);
    }

    // UPDATE DCS AFD
    public function updateDcsAFD($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            // "DCS_CASE_ID" => $case_id,
            "DCS_REF" => $form['file_reference'],
            "DCS_STAFF_ID" => $form['staff_id'],
            "DCS_JOBCODE" => $form['service_id'],
            "DCS_DEPT" => $form['department_id'],

            "DCS_GUILTY" => $form['guilty'],
            "DCS_ABSENCE_DAY" => $form['absent_day'],
            "DCS_EMOLUMENT" => $form['total_emolument_deduction'],

            "DCS_UPDATE_BY" => $curr_usr_id
        );


        if(!empty($form['complaint_date'])) {
            $date = "TO_DATE('".$form['complaint_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_COMPLAINT_DATE", $date, false);
        } else {
            $this->db->set("DCS_COMPLAINT_DATE", '', true);
        }

        if(!empty($form['registrar_meeting_date'])) {
            $date = "TO_DATE('".$form['registrar_meeting_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_REGISTRAR_DATE", $date, false);
        } else {
            $this->db->set("DCS_REGISTRAR_DATE", '', true);
        }

        if(!empty($form['show_cause_notice_date'])) {
            $date = "TO_DATE('".$form['show_cause_notice_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_NOTICE_DATE", $date, false);
        } else {
            $this->db->set("DCS_NOTICE_DATE", '', true);
        }

        if(!empty($form['administration_warning_date'])) {
            $date = "TO_DATE('".$form['administration_warning_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCS_ALERT_DATE", $date, false);
        } else {
            $this->db->set("DCS_ALERT_DATE", '', true);
        }
        
        $this->db->set("DCS_UPDATE_DATE", $curr_date, false);
        $this->db->where("DCS_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_SUSPECT", $data);
    }

    // DELETE CASE REPORT ENTRY (AFD)
    public function delCaseAfdForm($case_id) 
    {
        $this->db->where("DCM_CASE_ID", $case_id);
        return $this->db->delete('DISC_CASE_MAIN');
    }

    /*===========================================================
       CASE REPORT ENTRY (ASSET LOSS) - AFF018
    =============================================================*/

    // CASE REPORT ENTRY (ASSET LOSS) LIST
    public function getRpALList()
    {
        $this->db->select("DCM_CASE_ID, 
        DCM_CAT_CODE, 
        DCM_CASE_YEAR,
        DCI_ITEMTYPE
        ");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_ITEMLOST", "DCM_CASE_ID = DCI_CASE_ID", "LEFT");
        // $this->db->join("STAFF_MAIN", "DCS_STAFF_ID = SM_STAFF_ID", "LEFT");
        $this->db->where("DCM_CAT_CODE = 'ASSET_LOSS'");
        $this->db->where("DCM_STATUS = 'PRELIMINARY REPORT'");

        $q = $this->db->get();
        
        return $q->result();
    }

    // ASSET LIST (ASSET LOSS) DD
    public function getAssetList($asset_id)
    {
        $this->db->select("AIH_ASET_CODE,
        AIH_SERIAL_NO,
        AIH_BRAND_NAME,
        COALESCE(AIH_BIL,TO_CHAR(1)) AIH_BIL,
        AIH_INSTALL_COST,
        AIH_ASET_DESC
        ");
        $this->db->from("ASET_INV_HEAD");
        $this->db->where("AIH_ASET_TYPE = 'ASSET'");
        $this->db->where("UPPER(AIH_ASET_CODE) LIKE UPPER('%$asset_id%') OR UPPER(AIH_SERIAL_NO) LIKE UPPER('%$asset_id%') OR UPPER(AIH_BRAND_NAME) LIKE UPPER('%$asset_id%')");
        $this->db->order_by("AIH_ASET_DESC");

        $q = $this->db->get();
        
        return $q->result();
    }

}

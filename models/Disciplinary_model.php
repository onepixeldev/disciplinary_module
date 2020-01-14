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
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'D'||LTRIM(TO_CHAR(DISC_C_MAIN_D_SEQ.nextval,'0000000000')) AS CASE_ID");
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
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'A'||LTRIM(TO_CHAR(DISC_C_MAIN_A_SEQ.nextval,'0000000000')) AS CASE_ID");
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
        AIH_ASET_DESC,
        AIH_CUSTODIAN,
        SM_STAFF_NAME
        ");
        $this->db->from("ASET_INV_HEAD");
        $this->db->join("STAFF_MAIN", "AIH_CUSTODIAN = SM_STAFF_ID", "LEFT");
        $this->db->where("AIH_ASET_TYPE = 'ASSET'");
        $this->db->where("UPPER(AIH_ASET_CODE) LIKE UPPER('%$asset_id%') OR UPPER(AIH_SERIAL_NO) LIKE UPPER('%$asset_id%') OR UPPER(AIH_BRAND_NAME) LIKE UPPER('%$asset_id%')");
        $this->db->order_by("AIH_ASET_DESC");

        $q = $this->db->get();
        
        return $q->result();
    }

    // GENERATE AL CASE ID
    public function genALCaseID()
    {
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'AL'||LTRIM(TO_CHAR(DISC_C_MAIN_AL_SEQ.nextval,'0000000000')) AS CASE_ID");
        $this->db->from("DUAL");

        $q = $this->db->get();
        
        return $q->row();
    }

    // INSERT DCM AL
    public function insertDcmAL($case_id, $dcm_sts, $dcm_sts_date, $form) 
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
            "DCM_STATUS" => $dcm_sts,

            "DCM_ENTER_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );

        if(!empty($dcm_sts_date)) {
            $date = "TO_DATE('".$dcm_sts_date."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        }
        
        $this->db->set("DCM_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_MAIN", $data);
    }

    // INSERT DCL AL
    public function insertDclAL($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCL_CASE_ID" => $case_id,
            "DCL_REF_CODE" => $form['file_reference'],
            "DCL_ACTUAL_LOC" => $form['loss_location'],
            "DCL_LOST_METHOD" => $form['how_the_loss_happened'],
            "DCL_STAFF_LAST" => $form['staff_id'],

            "DCL_ENTER_BY" => $curr_usr_id
        );

        if(!empty($form['police_report_date'])) {
            $date = "TO_DATE('".$form['police_report_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_POLICE_REPORT_DATE", $date, false);
        } 
        
        $this->db->set("DCL_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_LOSTREPORT", $data);
    }

    // INSERT DCI AL
    public function insertDcItlAL($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCI_CASE_ID" => $case_id,
            "DCI_ITEMTYPE" => $form['item_type'],
            "DCI_ITEM" => $form['item_details'],
            "DCI_ITEM_DESC" => $form['item_description'],
            "DCI_ASSET_CODE" => $form['asset_id'],
            "DCI_ASSET_DESC" => $form['asset_type'],
            "DCI_ASSET_SERIAL" => $form['serial_no'],
            "DCI_BRAND_NAME" => $form['brand'],
            "DCI_BIL" => $form['quantity'],
            "DCI_AMOUNT" => $form['amount'],

            "DCI_ENTER_BY" => $curr_usr_id
        );
        
        $this->db->set("DCI_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_ITEMLOST", $data);
    }

    // AL CASE DETL
    public function getRpALDetl($case_id)
    {
        $this->db->select("DCM_CASE_ID,
        DCM_CAT_CODE,
        DCM_CASE_YEAR,
        DCM_STATUS,

        DCL_REF_CODE,

        DCI_ITEMTYPE,
        DCI_ITEM,
        DCI_ITEM_DESC,
        DCI_ASSET_CODE,
        DCI_ASSET_DESC,
        DCI_ASSET_SERIAL,
        DCI_BRAND_NAME,
        DCI_BIL,
        DCI_AMOUNT,

        DCL_ACTUAL_LOC,
        DCL_LOST_METHOD,
        DCL_STAFF_LAST,
        DCL_POLICE_REPORT_DATE,

        TO_CHAR(DCL_POLICE_REPORT_DATE, 'DD/MM/YYYY') AS DCL_POLICE_REPORT_DATE2");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_LOSTREPORT", "DCM_CASE_ID = DCL_CASE_ID", "LEFT");
        $this->db->join("DISC_CASE_ITEMLOST", "DCM_CASE_ID = DCI_CASE_ID", "LEFT");
        $this->db->where("DCM_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // UPDATE DCM AL
    public function updateDcmAL($case_id, $dcm_sts, $dcm_sts_date, $form) 
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
            "DCM_STATUS" => $dcm_sts,

            "DCM_UPDATE_BY" => $curr_usr_id,
        );

        if(!empty($dcm_sts_date)) {
            $date = "TO_DATE('".$dcm_sts_date."', 'DD/MM/YYYY')";
            $this->db->set("DCM_STATUS_DATE", $date, false);
        }
        
        $this->db->set("DCM_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCM_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_MAIN", $data);
    }

    // UPDATE DCL AL
    public function updateDclAL($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCL_REF_CODE" => $form['file_reference'],
            "DCL_ACTUAL_LOC" => $form['loss_location'],
            "DCL_LOST_METHOD" => $form['how_the_loss_happened'],
            "DCL_STAFF_LAST" => $form['staff_id'],

            "DCL_UPDATE_BY" => $curr_usr_id
        );

        if(!empty($form['police_report_date'])) {
            $date = "TO_DATE('".$form['police_report_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_POLICE_REPORT_DATE", $date, false);
        } 
        
        $this->db->set("DCL_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCL_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_LOSTREPORT", $data);
    }

    // UPDATE DCI AL
    public function updateDcItlAL($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCI_ITEMTYPE" => $form['item_type'],
            "DCI_ITEM" => $form['item_details'],
            "DCI_ITEM_DESC" => $form['item_description'],
            "DCI_ASSET_CODE" => $form['asset_id'],
            "DCI_ASSET_DESC" => $form['asset_type'],
            "DCI_ASSET_SERIAL" => $form['serial_no'],
            "DCI_BRAND_NAME" => $form['brand'],
            "DCI_BIL" => $form['quantity'],
            "DCI_AMOUNT" => $form['amount'],

            "DCI_UPDATE_BY" => $curr_usr_id
        );
        
        $this->db->set("DCI_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCI_CASE_ID", $case_id);

        return $this->db->update("DISC_CASE_ITEMLOST", $data);
    }

    // AL SUSPECT LIST
    public function getSpListAL($case_id)
    {
        $this->db->select("DCS_CASE_ID,
        DCS_STAFF_ID,
        SM_STAFF_NAME,
        DCS_DEPT,
        DM_DEPT_DESC,
        DCS_JOBCODE,
        SS_SERVICE_DESC,
        DCS_GUILTY,
        CASE DCS_GUILTY
        WHEN 'Y' THEN 'Yes'
        WHEN 'N' THEN 'No'
        ELSE ''
        END As DCS_GUILTY_DESC");
        $this->db->from("DISC_CASE_SUSPECT");
        $this->db->join("STAFF_MAIN", "SM_STAFF_ID = DCS_STAFF_ID", "LEFT");
        $this->db->join("DEPARTMENT_MAIN", "DM_DEPT_CODE = DCS_DEPT", "LEFT");
        $this->db->join("SERVICE_SCHEME", "DCS_JOBCODE = SS_SERVICE_CODE", "LEFT");
        $this->db->where("DCS_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->result();
    }

    // INSERT DCS AL
    public function insertDcsAL($form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCS_CASE_ID" => $form['case_id'],
            "DCS_STAFF_ID" => $form['staff_id_form'],
            "DCS_DEPT" => $form['staff_dept'],
            "DCS_JOBCODE" => $form['staff_svc'],
            "DCS_GUILTY" => $form['guilty'],

            "DCS_ENTER_BY" => $curr_usr_id
        );

        $this->db->set("DCS_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_SUSPECT", $data);
    }

    // AL SUSPECT DETL
    public function getSpdetl($case_id, $staff_id)
    {
        $this->db->select("DCS_CASE_ID,
        DCS_STAFF_ID");
        $this->db->from("DISC_CASE_SUSPECT");
        $this->db->where("DCS_CASE_ID",$case_id);
        $this->db->where("DCS_STAFF_ID",$staff_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // DELETE SUSPECT DETL
    public function delSpDetl($case_id, $staff_id) 
    {
        $this->db->where("DCS_CASE_ID",$case_id);
        $this->db->where("DCS_STAFF_ID",$staff_id);
        return $this->db->delete('DISC_CASE_SUSPECT');
    }

    // COMMITTEE LIST
    public function getComList($case_id)
    {
        $this->db->select("DCC_CASE_ID,
        DCC_SEQ, DCC_COMMITTEE_ID, SM_STAFF_NAME, SM_DEPT_CODE");
        $this->db->from("DISC_CASE_COMMITTEE");
        $this->db->join("STAFF_MAIN", "SM_STAFF_ID = DCC_COMMITTEE_ID", "LEFT");
        $this->db->where("DCC_CASE_ID",$case_id);
        $this->db->order_by("DCC_SEQ");

        $q = $this->db->get();
        
        return $q->result();
    }

    // COMMITTEE DETL
    public function getComDetl($case_id)
    {
        $this->db->select("DCM_CASE_ID,
        DCM_STATUS,
        DCL_CASE_ID, 
        TO_CHAR(DCL_APPOINTS_COMMITTEE_DATE, 'DD/MM/YYYY') AS DCL_APPOINTS_COMMITTEE_DATE2,
        DCL_RECOMMED_COMMITTEE_INQUIRY,
        TO_CHAR(DCL_STATUS_DATE, 'DD/MM/YYYY') AS DCL_STATUS_DATE2,
        DCL_STATUS,
        TO_CHAR(DCL_JKTK_DATE, 'DD/MM/YYYY') AS DCL_JKTK_DATE2,
        DCL_NOTES,
        DCL_INQUIRY,
        TO_CHAR(DCL_MPE_DATE, 'DD/MM/YYYY') AS DCL_MPE_DATE2
        ");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_LOSTREPORT", "DCM_CASE_ID = DCL_CASE_ID", "LEFT");
        $this->db->where("DCM_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // DECISION STATUS DD
    public function getDecStsDD()
    {
        $this->db->select("DAR_RESULT_CODE,
        DAR_RESULT_DESC");
        $this->db->from("DISC_ASSET_RESULT");
        $this->db->where("COALESCE(DAR_STATUS,'N') = 'Y'");
        $this->db->order_by("DAR_RESULT_CODE");

        $q = $this->db->get();
        
        return $q->result();
    }

    // UPDATE DCL AL 2
    public function updDclAL2($form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCL_RECOMMED_COMMITTEE_INQUIRY" => $form['recommendation_investigation_committee'],
            "DCL_STATUS" => $form['decision'],
            "DCL_NOTES" => $form['decision_jktk'],

            "DCL_UPDATE_BY" => $curr_usr_id
        );

        if(!empty($form['commitee_appointment_date'])) {
            $date = "TO_DATE('".$form['commitee_appointment_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_APPOINTS_COMMITTEE_DATE", $date, false);
        } else {
            $this->db->set("DCL_APPOINTS_COMMITTEE_DATE", '', true);
        }
        
        if(!empty($form['decision_date'])) {
            $date = "TO_DATE('".$form['decision_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_STATUS_DATE", $date, false);
        } else {
            $this->db->set("DCL_STATUS_DATE", '', true);
        }

        if(!empty($form['decision_date_jktk'])) {
            $date = "TO_DATE('".$form['decision_date_jktk']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_JKTK_DATE", $date, false);
        } else {
            $this->db->set("DCL_JKTK_DATE", '', true);
        }
        
        $this->db->set("DCL_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCL_CASE_ID", $form['case_id']);

        return $this->db->update("DISC_CASE_LOSTREPORT", $data);
    }

    // UPDATE DCM AL 2
    public function updDcmAL2($form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCM_STATUS" => $form['status'],

            "DCM_UPDATE_BY" => $curr_usr_id,
        );
        
        $this->db->set("DCM_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCM_CASE_ID", $form['case_id']);

        return $this->db->update("DISC_CASE_MAIN", $data);
    }

    // SEARCH STAFF COMMITTEE
    public function getStaffSearchCom($staffID)
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

    // AL SUSPECT DETL
    public function getCommMemDetl($case_id, $staff_id)
    {
        $this->db->select("DCC_CASE_ID,
        DCC_COMMITTEE_ID");
        $this->db->from("DISC_CASE_COMMITTEE");
        $this->db->where("DCC_CASE_ID",$case_id);
        $this->db->where("DCC_COMMITTEE_ID",$staff_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // INSERT DCC AL
    public function insertDccAL($form) 
    {
        $this->db->select("MAX(DCC_SEQ) AS MAX_SEQ");
        $this->db->where("DCC_CASE_ID", $form['case_id']);
        $this->db->from("DISC_CASE_COMMITTEE");

        $q = $this->db->get()->row();

        if(!empty($q)) {
            $seq = $q->MAX_SEQ;
            $seq++;
            $seq_rec = $seq;
        } else {
            $seq_rec = 0;
        }

        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCC_CASE_ID" => $form['case_id'],
            "DCC_SEQ" => $seq_rec,
            "DCC_COMMITTEE_ID" => $form['staff_id_form'],

            "DCC_ENTER_BY" => $curr_usr_id
        );

        $this->db->set("DCC_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_COMMITTEE", $data);
    }

    // INSERT DCC IQ
    public function updSeqCmAl($case_id, $seq_count, $cur_seq) 
    {   
        $data = array(
            "DCC_SEQ" => $seq_count,
        );

        $this->db->where("DCC_CASE_ID", $case_id);
        $this->db->where("DCC_SEQ", $cur_seq);

        return $this->db->update("DISC_CASE_COMMITTEE", $data);
    }

    // DELETE COMMITTEE MEMBER
    public function delCmmMem($case_id, $seq) 
    {
        $this->db->where("DCC_SEQ",$seq);
        $this->db->where("DCC_CASE_ID",$case_id);
        return $this->db->delete('DISC_CASE_COMMITTEE');
    }

    // GET VERIFY DCL
    public function verDCL($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_LOSTREPORT");
        $this->db->where("DCL_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // GET VERIFY DCI
    public function verDCI($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_ITEMLOST");
        $this->db->where("DCI_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // GET VERIFY DCC
    public function verDCC($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_COMMITTEE");
        $this->db->where("DCC_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // GET VERIFY DCS
    public function verDCS($case_id)
    {
        $this->db->select("1");
        $this->db->from("DISC_CASE_SUSPECT");
        $this->db->where("DCS_CASE_ID", $case_id);

        $q = $this->db->get();
        return $q->row();
    }

    // DELETE CASE REPORT ENTRY (ASSET LOSS)
    public function delCaseALForm($case_id) 
    {
        $this->db->where("DCM_CASE_ID", $case_id);
        return $this->db->delete('DISC_CASE_MAIN');
    }

    /*===========================================================
       CASE REPORT ENTRY (INQUIRY) - AFF017
    =============================================================*/

    // CASE REPORT ENTRY (INQUIRY) LIST
    public function getRpIQList()
    {
        $this->db->select("DCM_CASE_ID, 
        DCM_CAT_CODE, 
        DCM_CASE_YEAR,
        TO_CHAR(DCL_COMPLAINT_DATE, 'DD/MM/YYYY') AS DCL_COMPLAINT_DATE2
        ");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_LOSTREPORT", "DCM_CASE_ID = DCL_CASE_ID", "LEFT");
        $this->db->where("DCM_CAT_CODE = 'INQUIRY_SHOWCAUSE'");
        $this->db->where("DCM_STATUS = 'PRELIMINARY REPORT'");

        $q = $this->db->get();
        
        return $q->result();
    }

    // GENERATE IQ CASE ID
    public function genIQCaseID()
    {
        $this->db->select("TO_CHAR(SYSDATE, 'YYYY')||'-'||'IS'||LTRIM(TO_CHAR(DISC_C_MAIN_IS_SEQ.nextval,'0000000000')) AS CASE_ID");
        $this->db->from("DUAL");

        $q = $this->db->get();
        
        return $q->row();
    }

    // INSERT DCM IQ
    public function insertDcmIQ($case_id, $form) 
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
            "DCM_STATUS" => 'PRELIMINARY REPORT',

            "DCM_ENTER_BY" => $curr_usr_id,
            "DCM_DEPT" => $usr_dept
        );
        
        $this->db->set("DCM_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_MAIN", $data);
    }

    // INSERT DCL IQ
    public function insertDclIQ($case_id, $form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCL_CASE_ID" => $case_id,
            "DCL_REF_CODE" => $form['file_reference'],

            "DCL_ENTER_BY" => $curr_usr_id
        );

        if(!empty($form['complaint_date'])) {
            $date = "TO_DATE('".$form['complaint_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_COMPLAINT_DATE", $date, false);
        } 

        if(!empty($form['audit_report_date'])) {
            $date = "TO_DATE('".$form['audit_report_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_AUDIT_DATE", $date, false);
        } 
        
        $this->db->set("DCL_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_LOSTREPORT", $data);
    }

    // IQ CASE DETL
    public function getRpIQDetl($case_id)
    {
        $this->db->select("DCM_CASE_ID,
        DCM_CAT_CODE,
        DCM_CASE_YEAR,
        DCL_REF_CODE,
        TO_CHAR(DCL_COMPLAINT_DATE, 'DD/MM/YYYY') AS DCL_COMPLAINT_DATE2,
        TO_CHAR(DCL_AUDIT_DATE, 'DD/MM/YYYY') AS DCL_AUDIT_DATE2");
        $this->db->from("DISC_CASE_MAIN");
        $this->db->join("DISC_CASE_LOSTREPORT", "DCM_CASE_ID = DCL_CASE_ID", "LEFT");
        $this->db->where("DCM_CASE_ID",$case_id);

        $q = $this->db->get();
        
        return $q->row();
    }

    // UPDATE DCL IQ 2
    public function updDclIQ2($form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCL_INQUIRY" => $form['investigation_scope'],
            "DCL_RECOMMED_COMMITTEE_INQUIRY" => $form['investigation_committee_rec'],
            "DCL_NOTES" => $form['decision_mpe'],

            "DCL_UPDATE_BY" => $curr_usr_id
        );

        if(!empty($form['commitee_appointment_date'])) {
            $date = "TO_DATE('".$form['commitee_appointment_date']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_APPOINTS_COMMITTEE_DATE", $date, false);
        } else {
            $this->db->set("DCL_APPOINTS_COMMITTEE_DATE", '', true);
        }
        
        if(!empty($form['decision_date_mpe'])) {
            $date = "TO_DATE('".$form['decision_date_mpe']."', 'DD/MM/YYYY')";
            $this->db->set("DCL_MPE_DATE", $date, false);
        } else {
            $this->db->set("DCL_MPE_DATE", '', true);
        }
        
        $this->db->set("DCL_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCL_CASE_ID", $form['case_id']);

        return $this->db->update("DISC_CASE_LOSTREPORT", $data);
    }

    // UPDATE DCM IQ 2
    public function updDcmIQ2($form) 
    {
        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCM_STATUS" => $form['status'],

            "DCM_UPDATE_BY" => $curr_usr_id,
        );
        
        $this->db->set("DCM_UPDATE_DATE", $curr_date, false);

        $this->db->where("DCM_CASE_ID", $form['case_id']);

        return $this->db->update("DISC_CASE_MAIN", $data);
    }

    // INSERT DCC IQ
    public function insertDccIQ($form) 
    {
        $this->db->select("MAX(DCC_SEQ) AS MAX_SEQ");
        $this->db->where("DCC_CASE_ID", $form['case_id']);
        $this->db->from("DISC_CASE_COMMITTEE");

        $q = $this->db->get()->row();

        if(!empty($q)) {
            $seq = $q->MAX_SEQ;
            $seq++;
            $seq_rec = $seq;
        } else {
            $seq_rec = 0;
        }

        $curr_date = "SYSDATE";
        $curr_usr_id = $this->staff_id;
        
        $data = array(
            "DCC_CASE_ID" => $form['case_id'],
            "DCC_SEQ" => $seq_rec,
            "DCC_COMMITTEE_ID" => $form['staff_id_form'],

            "DCC_ENTER_BY" => $curr_usr_id
        );

        $this->db->set("DCC_ENTER_DATE", $curr_date, false);

        return $this->db->insert("DISC_CASE_COMMITTEE", $data);
    }

}

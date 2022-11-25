<?php 

class User_model extends CI_Model {

    protected $User_table_name = "users";

    /**
     * Insert User Data in Database
     * @param: {array} userData
     */
    public function insert_user($userData) {
       
           return $this->db->insert($this->User_table_name, $userData);
    }

    /**
     * Check User Login in Database
     * @param: {array} userData
     */
    public function check_login($userData) {

        /**
         * First Check Email is Exists in Database
         */
        $query = $this->db->get_where($this->User_table_name, array('email' => $userData['email']));
        //echo $this->db->last_query();die;
        //echo $this->db->affected_rows();die;
        if ($this->db->affected_rows() > 0) {

             $password = $query->row('password');
             $base64 = base64_encode($userData['password']);
            //echo base64_encode($userData['password']);die;
            /**
             * Check Password Hash 
             */

            if ($base64 === $password) {
                
                /**
                 * Password and Email Address Valid
                 */
                $cquery = $this->db->get_where("captcha", array('id' => 1));
                $cdata = $cquery->row_array();
                if($cdata['captcha_val']===$userData['captcha'])
                {
                    return [
                    'status' => 1,
                    'data' => $query->row(),
                    ];
                }else{
                        return ['status' => 4,'data' => FALSE];
                }

            } else {
                return ['status' => 3,'data' => FALSE];
            }

        } else {
            return ['status' => 2,'data' => FALSE];
        }
    }

     public function update_captcha($captchaData) {
        //print_r($userData);
        $this->db->where('id',1);
        $this->db->update("captcha", $captchaData);
    }

    public function get_list(){

        $query = $this->db->get_where('users',array('is_active'=>1));
        return $query->result_array();
    }
    public function search_list($date=""){
        if($date!=''){
           $this->db->where("DATE_FORMAT(created_at,'%d-%m-%Y')",date("d-m-Y",strtotime($date))); 
        }
        $query = $this->db->get('users');
        return $query->result_array();
    }
}

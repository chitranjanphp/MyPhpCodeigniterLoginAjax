<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('User_model','UserModel');
    }

    public function _generateCaptcha() {

        //value 1
        $numeroa = rand(1, 9);
        //value2
        $numerob = rand(1, 9);
        $numero = $numeroa + $numerob;
        $display = $numeroa . ' + ' . $numerob;
        $this->UserModel->update_captcha(array("captcha_val"=>$numero));
        return $display;
        
    }

    // refresh
    public function refresh(){
        // Captcha configuration
         //value 1
        $numeroa = rand(1, 9);
        //value2
        $numerob = rand(1, 9);
        $numero = $numeroa + $numerob;
        $display = $numeroa . ' + ' . $numerob;
        $this->UserModel->update_captcha(array("captcha_val"=>$numero));
        echo $display;
    }
    
    public function signup()
    {
            $data['captchaImg'] = $this->_generateCaptcha();
             $data['page_title'] = "User Registration";
             $this->load->view('_Layout/home/header.php', $data); // Header File
            $this->load->view("user/signup");
            $this->load->view('_Layout/home/footer.php'); // Footer File
    }

    public function ajax_signup()
    {
        // Validation code
       $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', [
            'is_unique' => 'The %s already exists. Please use a different username',
        ]); // Unique Field

        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'The %s already exists. Please use a different email',
        ]); // // Unique Field

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        
        if ($this->form_validation->run() == FALSE):
                $this->load->view("user/signup");     
        else :

            //Check whether user upload picture
            if(!empty($_FILES['file']['name'])){
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|pdf|docx';
                $config['file_name'] = $_FILES['file']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }

           $insert_data = array(
                'fullname' => $this->input->post('full_name', TRUE),
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'mobile' => $this->input->post('mobile', TRUE),
                'password' => base64_encode($this->input->post('password')),
                'is_active' => 1,
                'filename'    => $picture

            );
           

            /**
             * Load User Model
             */
             $this->load->model('User_model', 'UserModel');
             $result = $this->UserModel->insert_user($insert_data);
            if ($result == TRUE) {
               echo 1;
            }else{
                echo 0;
            } 
            //success page. 
        endif;
        
    }


    function upload_file() {

        //upload file
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'pdf|jpg|docx';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('assets/uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }


    

    /**Ajax Login **/

    public function ajax_login()
    {
        if(!empty($this->session->userdata('USER_ID'))):      
            redirect('User/Panel');
        else :          
            $data['page_title'] = "User Login";
            $data['captchaImg'] = $this->_generateCaptcha();
            $this->load->view('_Layout/home/header.php', $data); // Header File
            $this->load->view("user/login");
            $this->load->view('_Layout/home/footer.php'); // Footer File
        endif;          
    }
    
    public function user_login()
    {
            $login_data = array(
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'captcha' => $this->input->post('captcha', TRUE),
            );
            
            /**
             * Load User Model
             */
            $this->load->model('User_model', 'UserModel');
            $result = $this->UserModel->check_login($login_data);

            if (!empty($result['status']) && $result['status'] === 1) {

                /**
                 * Create Session
                 * -----------------
                 * First Load Session Library
                 */
                $session_array = array(
                    'USER_ID'  => $result['data']->user_id,
                    'USER_NAME'  => $result['data']->fullname,
                    'USERNAME'  => $result['data']->username,
                    'USER_EMAIL' => $result['data']->email,
                    'IS_ACTIVE'  => $result['data']->is_active,
                );
                
                $this->session->set_userdata($session_array);
                echo $result['status'];
            }elseif(!empty($result['status']) && $result['status'] === 2){
                echo $result['status'];
            }
            elseif(!empty($result['status']) && $result['status'] === 3){
                echo $result['status'];
            }
            elseif(!empty($result['status']) && $result['status'] === 4){
                echo $result['status'];
            }
            else {
                echo 0;
            }
             
    }
    /** END Ajax Login **/
    /**
     * User Logout
     */
    public function logout() {

        /**
         * Remove Session Data
         */
        $remove_sessions = array('USER_ID', 'USERNAME','USER_EMAIL','IS_ACTIVE', 'USER_NAME');
        $this->session->unset_userdata($remove_sessions);

        redirect('User/ajax_login');
    }

    /**
     * User Panel
     */
    public function panel() {

        if (empty($this->session->userdata('USER_ID'))) {
            redirect('user/ajax_login');
        }

        $data['page_title'] = "Welcome to User Panel";
        $this->load->view('_Layout/home/header.php', $data); // Header File
        $this->load->view("user/panel");
        $this->load->view('_Layout/home/footer.php'); // Footer File
    }

    public function res_list(){

        if (empty($this->session->userdata('USER_ID'))) {
            redirect('user/ajax_login');
        }
        $this->load->model('User_model', 'UserModel');
        $result = $this->UserModel->get_list();
        $data['page_title'] = "Registered List";
        $data['result'] = $result;
        //print_r($data);die;
        $this->load->view('_Layout/home/header.php', $data); // Header File
        $this->load->view("user/res_list");
        $this->load->view('_Layout/home/footer.php'); // Footer File
    }
    public function search_list(){
      $date = $this->input->post('date');
      $this->load->model('User_model', 'UserModel');
      $result = $this->UserModel->search_list($date);
      $data['result'] = $result;
      $this->load->view("user/search_list",$data);
    }
}
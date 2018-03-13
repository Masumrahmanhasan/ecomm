<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/23/2018
 * Time: 12:11 AM
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Admin_model');
        $this->load->library('My_PHPMailer');
    }

    /*===== HOME PAGE ======*/
    public function index()
    {
        //$data['get_fet'] = $this->Home_model->get_featured_products();
        $data['cats'] = $this->Home_model->get_all_categories();
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Home";
        $data['slides'] = $this->Home_model->getAll('slider');
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/static/footer');
    }

    /*===== ABOUT US =====*/
    public function About_us()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | About Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/about_us');
        $this->load->view('frontend/static/footer');
    }

    /*===== Contact Us =====*/
    public function Contact_us()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Contact Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/contact_us');
        $this->load->view('frontend/static/footer');
    }

    /*====== GET SINGLE PRODUCT DETAIL PAGE ======*/
    /*public function get_product_detail()
    {
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Contact Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/product_detail');
        $this->load->view('frontend/static/footer');
    }*/

    /*===== SIGN_IN / REGISTER =====*/
    public function Sign_up()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Sign In / Register";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/Sign_up');
        $this->load->view('frontend/static/footer');
    }

    /*===== REGISTER USER AJAX CALL ======*/
    public function register_user()
    {
        if($_POST)
        {
            $config = array(
                array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'confirm_pass',
                    'label' => 'Conform Password',
                    'rules' => 'trim|required|matches[password]'
                ),
                array(
                    'field' => 'address1',
                    'label' => 'Address Line 1',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'address2',
                    'label' => 'Address Line 2',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'city',
                    'label' => 'City',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'country',
                    'label' => 'Country',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'zip',
                    'label' => 'Zip',
                    'rules' => 'trim|required'
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false){
                echo json_encode((["msg_type" => "errors" , "message" => validation_errors()]));
            }else{

                $id = $this->Home_model->register_customer($_POST);
                $this->thank($id);
                echo json_encode((["msg_type" => "success" , "message" => "Register successfully Kindly check your Email"]));
            }
        }
    }

    public function test_email($id)
    {
        $data['user']=$this->Admin_model->getById('customer',$id);
        $settings=$this->Admin_model->getEmailSettings();
        //echo '<pre>'; print_r($settings); exit;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $settings->host,
            'smtp_port' => $settings->port,
            'smtp_user' => $settings->email,
            'smtp_pass' => $settings->password,
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'newline'  => '\r\n',
            'validation'  => 'TRUE',
            'smtp_timeout' => '7'
        );

        $subject    = "Please verify your email address to Activate your Account";
        $body = $this->load->view('backend/emails/thanks_email', $data, true);
        $destination = $data['user']['email'];


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($settings->email); // change it to yours
        $this->email->to($destination);// change it to yours
        $this->email->subject($subject);
        $this->email->message($body);
        if($this->email->send())
        {
            echo 'Email sent.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }

    /*====== SENDING VERIFICATION LINK =======*/
    public function thank($id)
    {
        $data['user']=$this->Admin_model->getById('customer',$id);
        $settings=$this->Admin_model->getEmailSettings();
        //echo '<pre>'; print_r($settings); exit;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $settings->host,
            'smtp_port' => $settings->port,
            'smtp_user' => $settings->email,
            'smtp_pass' => $settings->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $subject    = "Please verify your email address to Activate your Account";
        $body = $this->load->view('backend/emails/thanks_email', $data, true);
        $destination = $data['user']['email'];


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($settings->email); // change it to yours
        $this->email->to($destination);// change it to yours
        $this->email->subject($subject);
        $this->email->message($body);
        if($this->email->send())
        {
            echo 'Email sent.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }


    /*====== ACTIVATE USER =======*/
    public function activate()
    {
        $id=$this->uri->segment(3);
        $hash=$this->uri->segment(4);
        $this->Home_model->activateUser($id,$hash);
        $user=$this->Home_model->getById($id);
        $this->success($user);
        redirect(base_url().'Home/login');
    }

    /*===== SEND SUCCESSFUL REGISTRATION MESSAGE ======*/
    public function success($reply)
    {
        $settings=$this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = $settings->host;
        $mail->Port       = $settings->port;
        $mail->Username   = $settings->email;
        $mail->Password   = $settings->password;
        $mail->SetFrom($settings->sent_email, $settings->sent_title);
        $mail->AddReplyTo($settings->reply_email,$settings->reply_email);
        $mail->Subject    = "Congratulations! Your account is active now";
        $mail->IsHTML(true);
        $body = $this->load->view('backend/emails/success_email', $reply, true);
        $mail->MsgHTML($body);
        $destination = $reply['email'];
        $mail->AddAddress($destination);
        if(!$mail->Send()) {
            $data['code']=300;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        }
    }

    /*==== FUNCTION CHECK USER SESSION =====*/
    public function isLoggedIn()
    {
        if (!empty($this->session->userdata['id']) && $this->session->userdata['type'] == 'Customer') {
            return true;
        } else {
            return false;
        }
    }
}
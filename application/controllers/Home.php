<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/23/2018
 * Time: 12:11 AM
 */

/**
 * @property Home_model Home_model
 * */
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
        /*$data['cats'] = $this->Home_model->get_all_categories();
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Home";
        $data['slides'] = $this->Home_model->getAll('slider');*/

        $data['category'] = $this->Admin_model->getAll('category');
        $data['product_details'] = $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image as pi
WHERE p.`brand_id` = b.`id`
AND pi.product_id = p.product_id
AND pi.class= 'primary'")->result_array();
        $data['featured'] = $this->Home_model->featured_products();
        $data['category'] = $this->Admin_model->getAll('category');// print_r($data);die;
        /*  foreach ($data['category'] as $item) {
                                   echo $item['name']."<br>";
              $data['sub'] = $this->Home_model->getByIdImran('sub_category',array('cat_id',$item['id']));
              foreach ($data['sub'] as $subs) {

                  echo $subs['name']."<br>";

                  $data['brands'] = $this->Home_model->getByIdImran('brands',array('sub_cat_id',$subs['id']));
                  foreach ($data['brands'] as $brand) {

                      echo $brand['name']."<br>";
                  }

              }

          }
          exit;*/
        //$data['sub_category'] = $this->Home_model->get('sub_category');
        $data['title'] = 'Home';
        $this->load->view('frontend/header/header_1', $data);
        //$this->load->view('frontend/static/header');
        $this->load->view('frontend/home_new');
        $this->load->view('frontend/footer/footer_1');
    }

    public function all_categories()
    {
        $data['products'] = $this->Home_model->getAllProducts();
        $data['categories'] = $this->Admin_model->getAll('category');
        $data['title'] = 'Home';
        $this->load->view('frontend/static/head', $data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/all_categories');
        $this->load->view('frontend/static/footer');

    }

    /*===== ABOUT US =====*/
    public function About_us()
    {
        /*$data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | About Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/about_us');
        $this->load->view('frontend/static/footer');*/
    }

    /*===== Contact Us =====*/
    public function Contact_us()
    {
        /*$data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Contact Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/contact_us');
        $this->load->view('frontend/static/footer');*/
    }

    /*====== GET SINGLE PRODUCT DETAIL PAGE ======*/
    public function get_product_detail($para1 = '', $para2 = '')
    {
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['product_details'] = $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image as pi
WHERE p.`brand_id` = b.`id`
AND pi.product_id = p.product_id
AND pi.class= 'primary'
AND p.`product_id` = $para1")->result_array();

        //echo $this->db->last_query();
        //                   echo "<pre>";print_r($data['product_details']);exit;

        $data['review'] = $this->db->query('select * from product_review where product_id='.$para1)->result();
//     echo "<pre>";print_r($data['reviews']);exit;

        $data['title'] = $data['company_info']['name'] . " | Contact Us";
        $this->load->view('frontend/static/head', $data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/product_detail');
        $this->load->view('frontend/static/footer');
    }

    /*===== SIGN_IN / REGISTER =====*/
    public function Sign_up()
    {
        /*$data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Sign In / Register";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/Sign_up');
        $this->load->view('frontend/static/footer');*/
    }

    /*===== REGISTER USER AJAX CALL ======*/
    /*public function register_user()
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
    }*/

    public function test_email($id)
    {
        $data['user'] = $this->Admin_model->getById('customer', $id);
        $settings = $this->Admin_model->getEmailSettings();
        //echo '<pre>'; print_r($settings); exit;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $settings->host,
            'smtp_port' => $settings->port,
            'smtp_user' => $settings->email,
            'smtp_pass' => $settings->password,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => '\r\n',
            'validation' => 'TRUE',
            'smtp_timeout' => '7'
        );

        $subject = "Please verify your email address to Activate your Account";
        $body = $this->load->view('backend/emails/thanks_email', $data, true);
        $destination = $data['user']['email'];


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($settings->email); // change it to yours
        $this->email->to($destination);// change it to yours
        $this->email->subject($subject);
        $this->email->message($body);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    /*====== SENDING VERIFICATION LINK =======*/
    public function thank($id)
    {
        $data['user'] = $this->Admin_model->getById('customer', $id);
        $settings = $this->Admin_model->getEmailSettings();
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
        $subject = "Please verify your email address to Activate your Account";
        $body = $this->load->view('backend/emails/thanks_email', $data, true);
        $destination = $data['user']['email'];


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($settings->email); // change it to yours
        $this->email->to($destination);// change it to yours
        $this->email->subject($subject);
        $this->email->message($body);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }


    /*====== ACTIVATE USER =======*/
    public function activate()
    {
        $id = $this->uri->segment(3);
        $hash = $this->uri->segment(4);
        $this->Home_model->activateUser($id, $hash);
        $user = $this->Home_model->getById($id);
        $this->success($user);
        redirect(base_url() . 'Home/login');
    }

    /*===== SEND SUCCESSFUL REGISTRATION MESSAGE ======*/
    public function success($reply)
    {
        $settings = $this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = $settings->host;
        $mail->Port = $settings->port;
        $mail->Username = $settings->email;
        $mail->Password = $settings->password;
        $mail->SetFrom($settings->sent_email, $settings->sent_title);
        $mail->AddReplyTo($settings->reply_email, $settings->reply_email);
        $mail->Subject = "Congratulations! Your account is active now";
        $mail->IsHTML(true);
        $body = $this->load->view('backend/emails/success_email', $reply, true);
        $mail->MsgHTML($body);
        $destination = $reply['email'];
        $mail->AddAddress($destination);
        if (!$mail->Send()) {
            $data['code'] = 300;
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

    function getProducts()
    {

        $id = $this->input->post('id');

        $data['products'] = $this->Home_model->getByIdAjax($id);

        $this->load->view('frontend/ajax_products', $data);
        //echo json_encode((["result"=>$data]));

    }

    function add_to_cart($para1 = '', $para2 = '', $para3 = '', $para4 = '')
    {
        $this->load->library('cart');
        $data = array(
            'id' => $_POST['product_id'],
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'qty' => $_POST['quantity']
        );

        $this->cart->insert($data); // return rowid uniquely
        echo $this->view();
    }

    function view()
    {
        $this->load->library('cart');
        $output = '';
        $count = 0;
        foreach ($this->cart->contents() as $items) {
            $count++;

            $output .= '<div class="cart-item product-summary">
	<div class="row media" data-rowid="2b24d495052a8ce66358eb576b8912c8">		
	<div class="col-xs-7">		
	 <h3 class="name"><a href="#">' . $items['qty'] . ' X ' . $items['name'] . '</a></h3>	
<div class="price">Rs.' . $items['price'] . '</div>
	</div> 
	<div class="col-xs-1 action">
	 <a href="#"><i class="fa fa-trash remove_one"></i></a> 
	 </div>
	  </div>
	  </div>';

        }
        $output .= '<div class="clearfix cart-total">
                                    <div class="pull-right"><span class="text">Sub Total :</span><span class="price shopping-cart__total">Rs.' . $this->cart->total() . '</span>
                                    </div>
                                  
                                </div>';

        if ($count == 0) {
            $output .= '<h3 align="center">Cart is Empty</h3>';
        }
        return $output;
    }

    function load()
    {
        echo $this->view();
    }

    function remove()
    {
        $this->load->library('cart');
        $row_id = $_POST['row_id'];
        $data = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        $this->cart->update($data);
        echo $this->view();
    }

    function clear()
    {
        $this->load->library('cart');
        $this->cart->destroy();
        echo $this->view();
    }
    function add_review(){
        extract($_POST);
        $data = array(
            'customer_id' => 2,
            'product_id'  => $product_id,
            'stars'       => $star,
            'review'        => $review,
            'name'          => $name,
            'email'         => $email
        );
        $status = $this->Home_model->insert_data('product_review',$data);
        if($status == true):
            echo 1;
        else:
            echo 2;
        endif;
    }
}
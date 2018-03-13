<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/22/2018
 * Time: 9:53 PM
 */
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('My_PHPMailer');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*===== DASHBOARD ======*/
    public function index()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Dashboard";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/dashboard');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///      Menu Section Starts        ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== ADD ADMIN SIDEBAR MENU ====*/
    public function add_menu()
    {
        if ($this->isLoggedIn()) {
            $data['parents'] = $this->Admin_model->getMenuParents('admin_menu');
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE MENU ITEM VIA AJAX CALL =====*/
    public function save_menu()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'parent',
                    'label' => 'Parent',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $this->Admin_model->addMenuItem($_POST, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Added Successfully" ]));
            }
        }
    }

    /*==== EDIT ADMIN SIDEBAR MENU =====*/
    public function edit_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->uri->segment(3);
            $data['parents'] = $this->Admin_model->getMenuParents('admin_menu');
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['menu_item'] = $this->Admin_model->getMenuItemDetail('admin_menu', $menuId);
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_admin_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT ADMIN MENU VIA AJAX =====*/
    public function save_admin_edit_menu()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'parent',
                    'label' => 'Parent',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id2');
                $this->Admin_model->updateMenuItem($_POST, $id, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Updated Successfully" ]));
            }
        }
    }

    /*==== DEL ADMIN SIDEBAR MENU ====*/
    public function del_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->input->post('id');
            $this->Admin_model->delete_menu('admin_menu', $menuId);
        } else {
            redirect(base_url());
        }
    }

    /*==== MANAGE ADMIN SIDEBAR MENU ====*/
    public function manage_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['menu_items'] = $this->Admin_model->getAllMenuItems('admin_menu');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_admin_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       Menu Section End          ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///       Menu Section Ends         ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== FUNCTION CHECK USER SESSION =====*/
    public function isLoggedIn()
    {
        if (!empty($this->session->userdata['id']) && $this->session->userdata['type'] == 'Admin') {
            return true;
        } else {
            return false;
        }
    }

    /*==== FUNCTION LOGOUT CURRENT USER =====*/
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    /*==== FUNCTION CHANGE CURRENT THEME ====*/
    public function changeTheme()
    {
        $id = $this->uri->segment(3);
        $path = $_SERVER['HTTP_REFERER'];
        $this->Admin_model->activateTheme($id);
        redirect($path);
    }


    ///////////////////////////////////////
    ///                                 ///
    ///     Product Section Start       ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD CATEGORY LOAD FORM =====*/
    public function add_category()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD CATEGORY VIA AJAX CALL =====*/
    public function save_category()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'icon',
                        'label' => 'Font Icon',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Category Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE CATEGORY LOAD FORM =====*/
    public function edit_category()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat_detail'] = $this->Admin_model->getById('category', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE CATEGORY AJAX CALL =====*/
    public function save_update_category()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'icon',
                    'label' => 'icon',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id');
                $this->Admin_model->update_category($_POST, $id);
                echo json_encode((["msg_type" => "success", "message" => "Category Updated Successfully" ]));
            }
        }
    }

    /*===== DELETE CATEGORY ======*/
    public function del_category()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('category', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== MANAGE CATEGORY ======*/
    public function manage_categories()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_categories');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD BRAND =====*/
    /*public function add_brand()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_category'] = $this->Admin_model->getAll('sub_category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Brand";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_brand');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }*/

    /*===== SAVE BRAND AJAX CALL =====*/
    /*public function save_brand()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sub_cat_id',
                        'label' => 'Sub Category',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_brand($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Brand Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }*/

    /*===== UPDATE BRAND =====*/
    /*public function edit_brand()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['brand_detail'] = $this->Admin_model->getById('brands', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Brand";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_brand');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }*/

    /*===== SAVE BRAND AJAX CALL =====*/
    /*public function save_update_brand()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id');
                $this->Admin_model->update_brand($_POST, $id);
                echo json_encode((["msg_type" => "success", "message" => "Brand Updated Successfully" ]));
            }
        }
    }*/

    /*===== DELETE BRAND =====*/
    /*public function delete_brand()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('brands', $id);
        } else {
            redirect(base_url());
        }
    }*/

    /*===== MANAGE BRANDS ======*/
    /*public function manage_brands()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage brands";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_brands');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }*/

    /*===== ADD SUB CATEGORY =====*/
    public function add_sub_category()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['category'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY AJAX CALL ====*/
    public function save_sub_category()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_sub_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY =====*/
    public function add_brand_sub_cat()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_category'] = $this->Admin_model->getAll('sub_category');
            $data['brand'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== MANAGE SUB CATEGORY ======*/
    public function manage_sub_categories()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_cats'] = $this->Admin_model->getAll('sub_category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Sub_Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_sub_categories');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT SUB CATEGORY =====*/
    public function edit_sub_category()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['categories'] = $this->Admin_model->getAll('category');
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['sub_cat_detail'] = $this->Admin_model->getById('sub_category', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT CATEGORY AJAX CALL =====*/
    public function save_edit_sub_cat()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'brand_id',
                        'label' => 'Brand',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_sub_category($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== DELETE SUB CATEGORY =====*/
    public function delete_sub_cat()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('sub_category', $id);
        } else {
            redirect(base_url());
        }
    }

    

    ///////////////////////////////////////
    ///                                 ///
    ///  SMTP/SMS Api Settings  Start   ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== EDIT SMTP CONFIG ====*/
    public function edit_smtp_config()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['smtp_config'] = $this->Admin_model->getConfig_Byid($menuId);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit SMTP Config";
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_smtp_config');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    public function save_smtp_setting()
    {
        if($this->isLoggedIn())
        {
            if($_POST)
            {
                $config = array(
                    array(
                        'field' => 'host',
                        'label' => 'Host',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'port',
                        'label' => 'Port',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sent_email',
                        'label' => 'Sent_Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sent_title',
                        'label' => 'Sent_Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'reply_email',
                        'label' => 'Reply_Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'reply_title',
                        'label' => 'Reply_Title',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run() == false)
                {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                }
                else
                {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_smtp_config($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "SMTP Updated Successfully" ]));
                }

            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT COMPANY INFO LOAD FORM ======*/
    public function edit_company_info(){
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['detail']= $this->Admin_model->getById('company_information', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Company Info";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_company_info');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT COMPANY INFORMATION =====*/
    public function save_edit_info()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'contact',
                        'label' => 'Contact No.',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'website',
                        'label' => 'Website url',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id2');
                    $this->Admin_model->update_company($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Info Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== UPDATE LOGO ======*/
    public function change_logo()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_logo');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE LOGO AJAX CALL =====*/
    public function update_logo()
    {
        if($this->isLoggedIn())
        {
            if($_FILES)
            {
                $id = 1;
                $this->Admin_model->update_logo($id);
                echo json_encode((["msg_type" => "success", "message" => "Logo Updated Successfully" ]));
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       SMTP Settings End         ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///    Frontend Settings Start      ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD NEW SLIDE =====*/
    public function add_slide()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_slider_image');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE SLIDER IMAGE AJAX CALL =====*/
    public function save_slide()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'title',
                        'label' =>  'Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'sub_title',
                        'label' =>  'Sub Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'quote',
                        'label' =>  'Quote',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_slide($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== MANAGE SLIDES =====*/
    public function manage_slides()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slider'] = $this->Admin_model->getAll('slider');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Slides";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_slider');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT SLIDE =====*/
    public function edit_slide()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slide_detail'] = $this->Admin_model->getById('slider', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_slider_image');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== SAVE EDIT SLIDE ======*/
    public function save_edit_slide()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'title',
                        'label' =>  'Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'sub_title',
                        'label' =>  'Sub Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'quote',
                        'label' =>  'Quote',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_slide($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*==== ENABLE SLIDER IMAGE ====*/
    public function enable_slider_image()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->enable_slider($id);
        } else {
            redirect(base_url());
        }
    }

    /*===== DISABLE SLIDER IMAGE ====*/
    public function disable_slider_image()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->disable_slider($id);
        } else {
            redirect(base_url());
        }
    }

    /*==== DELETE SLIDER IMAGE ====*/
    public function del_sliderImage()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('slider', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== UPDATE SOCIAL LINKS =====*/
    public function update_social_links()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['social_links'] = $this->Admin_model->getById('social_links', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Social Links";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_social_links');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*=====  UPDATE SOCIAL ICONS AJAX CALL =====*/
    public function save_update_social_link()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'facebook',
                        'label' =>  'Facebook Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'twitter',
                        'label' =>  'Twitter Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'google',
                        'label' =>  'GooglePlus+ Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'linkedin',
                        'label' =>  'LinkedIn Link',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_social_links($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Links Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Frontend Settings End       ///
    ///                                 ///
    ///////////////////////////////////////

    /*====== MANAGE CUSTOMERS ======*/
    public function manage_customers()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['customers'] = $this->Admin_model->getAll('customer');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Customers";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_customers');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }


}
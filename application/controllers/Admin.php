<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/22/2018
 * Time: 9:53 PM
 */

/**
 * @property Admin_model Admin_model
 * */
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Dashboard";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/dashboard');
            $this->load->view('backend/static/footer');
        } else {
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
            $data['title'] = $data['company_info']['name'] . " | Add Admin Menu";
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
                echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
            } else {
                $this->Admin_model->addMenuItem($_POST, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Added Successfully"]));
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
            $data['title'] = $data['company_info']['name'] . " | Edit Admin Menu";
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
                echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
            } else {
                $id = $this->input->post('id2');
                $this->Admin_model->updateMenuItem($_POST, $id, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Updated Successfully"]));
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
            $data['title'] = $data['company_info']['name'] . " | Manage Admin Menu";
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Add Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_category');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== ADD CATEGORY VIA AJAX CALL =====*/
    public function save_category()
    {
        if ($this->isLoggedIn()) {
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
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $this->Admin_model->add_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Category Added Successfully"]));
                }
            }
        } else {
            redirect(base_url());
        }
    }

    /*===== UPDATE CATEGORY LOAD FORM =====*/
    public function edit_category()
    {
        if ($this->isLoggedIn()) {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat_detail'] = $this->Admin_model->getById('category', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Update Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_category');
            $this->load->view('backend/static/footer');
        } else {
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
                echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
            } else {
                $id = $this->input->post('id');
                $this->Admin_model->update_category($_POST, $id);
                echo json_encode((["msg_type" => "success", "message" => "Category Updated Successfully"]));
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Manage Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_categories');
            $this->load->view('backend/static/footer');
        } else {
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['category'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Add Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY AJAX CALL ====*/
    public function save_sub_category()
    {
        if ($this->isLoggedIn()) {
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
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $this->Admin_model->add_sub_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Added Successfully"]));
                }
            }
        } else {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY =====*/
    public function add_brand_sub_cat()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_category'] = $this->Admin_model->getAll('sub_category');
            $data['brand'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Add Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== MANAGE SUB CATEGORY ======*/
    public function manage_sub_categories()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_cats'] = $this->Admin_model->getAll('sub_category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Manage Sub_Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_sub_categories');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== EDIT SUB CATEGORY =====*/
    public function edit_sub_category()
    {
        if ($this->isLoggedIn()) {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['categories'] = $this->Admin_model->getAll('category');
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['sub_cat_detail'] = $this->Admin_model->getById('sub_category', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Edit Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT CATEGORY AJAX CALL =====*/
    public function save_edit_sub_cat()
    {
        if ($this->isLoggedIn()) {
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
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_sub_category($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Updated Successfully"]));
                }
            }
        } else {
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
            $data['title'] = $data['company_info']['name'] . " | Edit SMTP Config";
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
        if ($this->isLoggedIn()) {
            if ($_POST) {
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
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_smtp_config($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "SMTP Updated Successfully"]));
                }

            }
        } else {
            redirect(base_url());
        }
    }

    /*===== EDIT COMPANY INFO LOAD FORM ======*/
    public function edit_company_info()
    {
        if ($this->isLoggedIn()) {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['detail'] = $this->Admin_model->getById('company_information', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Edit Company Info";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_company_info');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT COMPANY INFORMATION =====*/
    public function save_edit_info()
    {
        if ($this->isLoggedIn()) {
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
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $id = $this->input->post('id2');
                    $this->Admin_model->update_company($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Info Updated Successfully"]));
                }
            }
        } else {
            redirect(base_url());
        }
    }

    /*====== UPDATE LOGO ======*/
    public function change_logo()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_logo');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== UPDATE LOGO AJAX CALL =====*/
    public function update_logo()
    {
        if ($this->isLoggedIn()) {
            if ($_FILES) {
                $id = 1;
                $this->Admin_model->update_logo($id);
                echo json_encode((["msg_type" => "success", "message" => "Logo Updated Successfully"]));
            }
        } else {
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_slider_image');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE SLIDER IMAGE AJAX CALL =====*/
    public function save_slide()
    {
        if ($this->isLoggedIn()) {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sub_title',
                        'label' => 'Sub Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'quote',
                        'label' => 'Quote',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $this->Admin_model->add_slide($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Added Successfully"]));
                }
            }
        } else {
            redirect(base_url());
        }
    }

    /*===== MANAGE SLIDES =====*/
    public function manage_slides()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slider'] = $this->Admin_model->getAll('slider');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Manage Slides";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_slider');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== EDIT SLIDE =====*/
    public function edit_slide()
    {
        if ($this->isLoggedIn()) {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slide_detail'] = $this->Admin_model->getById('slider', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_slider_image');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*====== SAVE EDIT SLIDE ======*/
    public function save_edit_slide()
    {
        if ($this->isLoggedIn()) {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sub_title',
                        'label' => 'Sub Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'quote',
                        'label' => 'Quote',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_slide($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Updated Successfully"]));
                }
            }
        } else {
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
        if ($this->isLoggedIn()) {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['social_links'] = $this->Admin_model->getById('social_links', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Update Social Links";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_social_links');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*=====  UPDATE SOCIAL ICONS AJAX CALL =====*/
    public function save_update_social_link()
    {
        if ($this->isLoggedIn()) {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'facebook',
                        'label' => 'Facebook Link',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'twitter',
                        'label' => 'Twitter Link',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'google',
                        'label' => 'GooglePlus+ Link',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'linkedin',
                        'label' => 'LinkedIn Link',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_social_links($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Links Updated Successfully"]));
                }
            }
        } else {
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
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['customers'] = $this->Admin_model->getAll('customer');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Manage Customers";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_customers');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*
     * Product */
    /*===== MANAGE CATEGORY ======*/
    public function all_products($para1 = '')
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['product'] = $this->Admin_model->getAll('product',array('delete' => 0));
            $data['title'] = $data['company_info']['name'] . " | Manage Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/all_products');
            $this->load->view('backend/static/footer');

        } else {
            redirect(base_url());
        }
    }

    function get_stock($id)
    {


    }

    function statuses($para1 = '', $para2 = '', $para3 = '')
    {
        if ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            // echo $this->db->last_query();
            //$this->crud_model->set_category_data(0);

        } elseif ($para1 == 'product_deal_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            //echo $this->db->last_query();
        } elseif ($para1 == 'product_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
        }
    }

    /*===== ADD CATEGORY LOAD FORM =====*/
    public function add_products()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['sub_cat'] = $this->Admin_model->getAll('sub_category');
            $data['brand'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Add Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/product_add');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    public function edit_products()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['sub_cat'] = $this->Admin_model->getAll('sub_category');
            $data['brand'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name'] . " | Add Category"; 
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/product_edit');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    function sub_by_cat()
    {
        extract($_POST);
        $id = $this->uri->segment(3);
        $data = $this->Admin_model->getByIdSub('sub_category', array('cat_id' => $id));
        //print_r($data);
        $option = '<option>Select Sub category</option>';
        foreach ($data as $item) {
            $option .= "<option value='$item->id'>$item->name</option>";
        }
        echo $option;
    }

    function brand_by_sub()
    {
        extract($_POST);
        $id = $this->uri->segment(3);
        $data = $this->Admin_model->getByIdSub('brands', array('sub_cat_id' => $id));
        //print_r($data);
        $option = '';
        foreach ($data as $item) {
            $option .= "<option value='$item->id'>$item->name</option>";
        }
        echo $option;
    }

    public function do_add()
    {
        if ($this->isLoggedIn()) {
            if ($_POST) {
                //echo "<pre>";   print_r($_POST);exit;
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors()]));
                } else {


                    if ($_FILES["images"]['name'][0] == '') {
                        $num_of_imgs = 0;
                    } else {
                        $num_of_imgs = count($_FILES["images"]['name']);
                    }
                    $color = $this->input->post('color');
                    $c = implode(",", $color);
                    $size = $this->input->post('size');
                    $s = implode(",", $size);
                    //print_r($c);
                    $data['product_name'] = $this->input->post('title');
                    $data['cat_id'] = $this->input->post('category');
                    $data['description'] = $this->input->post('description');
                    $data['sub_cat_id'] = $this->input->post('sub_category');
                    $data['brand_id'] = $this->input->post('brand');
                    $data['sale_price'] = $this->input->post('sale_price');
                    $data['purchase_price'] = $this->input->post('purchase_price');
                    $data['date_of_added'] = date("Y-m-d");
                    $data['featured'] = 'no';
                    $data['status'] = 'ok';
                    //$data['rating_user'] = '[]';
                    $data['date_of_updated'] = date('Y-m-d');
                    $data['tax'] = $this->input->post('tax');
                    $data['discount'] = $this->input->post('discount');
                    $data['discount_type'] = $this->input->post('discount_type');
                    $data['tax_type'] = $this->input->post('tax_type');
                    $data['shipping_cost'] = 0;
                    $data['tags'] = $this->input->post('tag');
                    $data['num_of_imgs'] = $num_of_imgs;
                    $data['color'] = $c;
                    $data['size'] = $s;
                    //$data['ad_field_names'] = $optTit;
                    //$data['ad_field_values'] = $optValue;
                    //echo "<pre>";print_r($data);exit;
                    //echo "<pre>";print_r($data);exit;
                    //$data['front_image'] = $this->input->post('front_image');
                    // $additional_fields['op_title'] = json_encode($this->input->post('ad_field_names'));
                    //$additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
                    //$data['additional_fields'] = json_encode($additional_fields);
                    //$data['requirements'] = '[]';
                    //$data['video'] = '[]';

                    //$data['added_by'] = json_encode(array('type' => 'admin', 'id' => $this->session->userdata('admin_id')));
                    //echo "<pre>";
                    // print_r($data);exit;

                    $this->db->insert('product', $data);
                    $id = $this->db->insert_id();
                    // $query = $this->db->get('product')->row();
                    // $id = $query->product_id;
                   
                    //$this->benchmark->mark_time();

                    $this->Admin_model->file_up("images", "product", $id, 'multi');

                    /*$path = $_FILES['logo']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $data_logo['logo'] = 'digital_logo_' . $id . '.' . $ext;
                    $this->db->where('product_id', $id);
                    $this->db->update('product', $data_logo);
                    $this->Admin_model->file_up("logo", "digital_logo", $id, '', 'no', '.' . $ext);
                         */
                    //Requirements add
                    $requirements = array();
                    $req_title = $this->input->post('req_title');
                    $req_desc = $this->input->post('req_desc');
                    if (!empty($req_title)) {
                        foreach ($req_title as $i => $row) {
                            $requirements[] = array('index' => $i, 'field' => $row, 'desc' => $req_desc[$i]);
                        }
                    }

                    $data_req['requirements'] = json_encode($requirements);
                    $this->db->where('product_id', $id);
                    $this->db->update('product', $data_req);

                    //File upload
                    /*
$rand = substr(hash('sha512', rand()), 0, 20);
$name = $id . '_' . $rand . '_' . $_FILES['product_file']['name'];
$da['download_name'] = $name;
$da['download'] = 'ok';
$folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder . '/' . $name);
$this->db->where('product_id', $id);
$this->db->update('product', $da); */
                    //$this->Admin_model->set_category_data(0);
                    $product_id = $this->db->query('SELECT MAX(product_id) AS p_id FROM product')->row()->p_id; 

                     foreach ($this->input->post('color') as $color) {
                         foreach ($this->input->post('size') as $size) {
                            $id = $this->db->insert_id();
                            $option_data['product_name'] = $this->input->post('title')."_".ucfirst($color)."_".ucfirst($size);
                            $option_data['cat_id'] = $this->input->post('category');
                            $option_data['product_id'] = $product_id;
                            $option_data['description'] = $this->input->post('description');
                            $option_data['sub_cat_id'] = $this->input->post('sub_category');
                            $option_data['brand_id'] = $this->input->post('brand');
                            $option_data['sale_price'] = $this->input->post('sale_price');
                            $option_data['purchase_price'] = $this->input->post('purchase_price');
                            $option_data['date_of_added'] = date("Y-m-d");
                            $option_data['featured'] = 'no';
                            $option_data['status'] = 'ok';
                            $option_data['date_of_updated'] = date('Y-m-d');
                            $option_data['tax'] = $this->input->post('tax');
                            $option_data['discount'] = $this->input->post('discount');
                            $option_data['discount_type'] = $this->input->post('discount_type');
                            $option_data['tax_type'] = $this->input->post('tax_type');
                            $option_data['shipping_cost'] = 0;
                            $option_data['tags'] = $this->input->post('tag');
                            $option_data['num_of_imgs'] = $num_of_imgs;
                            $option_data['color'] = ucfirst($color);
                            $option_data['size'] =  ucfirst($size);
                            
                            $this->db->insert('product_options', $option_data); 
                         }
                     }
                     
                    echo json_encode((["msg_type" => "success", "message" => "Product Added Successfully"]));
                }
            }


        } else {

            redirect(base_url());
        }
    }

    public function take_payments($param2 = '')
    {
        $data['edit_data'] = $this->db->get_where('product', array('product_id' => $param2))->result_array();

        $this->load->view('backend/modal_take_payment', $data);

    }

    /* Product Stock add, edit, view, delete, stock increase, decrease, discount */
    function stock($para1 = '', $para2 = '')
    {

        if ($para1 == 'do_add') {
            //print_r($_POST);exit;
            //$data['type']         = 'add';
            //$data['category']     = $this->input->post('category');
            //$data['sub_category'] = $this->input->post('sub_category');
            $data['product_id'] = $this->input->post('product');
            $data['quantity'] = $this->input->post('quantity');
            //$data['rate']         = $this->input->post('rate');
            $data['purchase_rate'] = $this->input->post('total');
            //$data['sales_rate']        = $this->input->post('total');
            //$data['reason_note']  = $this->input->post('reason_note');
            //$data['datetime']     = time();
            $this->db->insert('stock', $data);
            $prev_quantity = $this->Admin_model->get_type_name_by_id('product', $data['product_id'], 'current_stock');
            $data1['current_stock'] = $prev_quantity + $data['quantity'];
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('product', $data1);
            redirect(base_url() . 'Admin/all_products');
        }
        else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();

            $page_data['company_info'] = $this->Admin_model->get_company_info();
            $page_data['title'] = $page_data['company_info']['name'] . " | Add Category";
            $page_data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $page_data['theme'] = $this->Admin_model->getActiveTheme(); 
            $this->load->view('backend/static/head', $page_data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/product_view');
            $this->load->view('backend/static/footer');

        }
        elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('backend/product_add_discount', $data);
        }
        elseif ($para1 == 'add_discount_set') {
            $product = $this->input->post('product');
            $data['discount'] = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            //echo $this->db->last_query();
            $this->session->set_flashdata('success', "Discount Added Successfully");
            redirect(base_url() . 'Admin/all_products');
            //$this->crud_model->set_category_data(0);
            //recache();
        }
        else if ($para1 == 'edit') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $page_data['product_options'] = $this->db->get_where('product_options', array(
                'product_id' => $para2
            ))->result_array(); 
            // echo "<pre>";print_r($page_data); die;
            $page_data['company_info'] = $this->Admin_model->get_company_info();
            $page_data['title'] = $page_data['company_info']['name'] . " | Add Category";
            $page_data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $page_data['theme'] = $this->Admin_model->getActiveTheme();
            $this->load->view('backend/static/head', $page_data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/product_edit');
            $this->load->view('backend/static/footer');

        }
        else if ($para1 == 'do_destroy') {
            $data['type'] = 'destroy';
            $data['category'] = $this->input->post('category');
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product'] = $this->input->post('product');
            $data['quantity'] = $this->input->post('quantity');
            $data['total'] = $this->input->post('total');
            $data['reason_note'] = $this->input->post('reason_note');
            $data['datetime'] = time();
            $this->db->insert('stock', $data);
            $prev_quantity = $this->crud_model->get_type_name_by_id('product', $data['product'], 'current_stock');
            $current = $prev_quantity - $data['quantity'];
            if ($current <= 0) {
                $current = 0;
            }
            $data1['current_stock'] = $current;
            $this->db->where('product_id', $data['product']);
            $this->db->update('product', $data1);
            recache();
        }
        elseif ($para1 == 'delete') {
            $quantity = $this->crud_model->get_type_name_by_id('stock', $para2, 'quantity');
            $product = $this->crud_model->get_type_name_by_id('stock', $para2, 'product');
            $type = $this->crud_model->get_type_name_by_id('stock', $para2, 'type');
            if ($type == 'add') {
                $this->crud_model->decrease_quantity($product, $quantity);
            } else if ($type == 'destroy') {
                $this->crud_model->increase_quantity($product, $quantity);
            }
            $this->db->where('stock_id', $para2);
            $this->db->delete('stock');
            recache();
        }
        elseif ($para1 == 'list') {
            $this->db->order_by('stock_id', 'desc');
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/admin/stock_list', $page_data);
        }
        elseif ($para1 == 'add') {
            $this->load->view('back/admin/stock_add');
        }
        elseif ($para1 == 'destroy') {
            $this->load->view('back/admin/stock_destroy');
        }
        elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_product');
        }
        elseif ($para1 == 'pro_by_sub') {

            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        }
        else if ($para1 == "update") {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->Admin_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $download                   = $this->Admin_model->get_type_name_by_id('product', $para2, 'download');
//            $color = $this->input->post('color');
//            $c = implode(",", $color);
//            $size = $this->input->post('size');
//            $s = implode(",", $size);
            $data['product_name'] = $this->input->post('title');
            $data['cat_id'] = $this->input->post('category');
            $data['description'] = $this->input->post('description');
            $data['sub_cat_id'] = $this->input->post('sub_category');
            $data['brand_id'] = $this->input->post('brand');
            $data['sale_price'] = $this->input->post('sale_price');
            $data['purchase_price'] = $this->input->post('purchase_price');
            $data['date_of_added'] = date("Y-m-d");
            $data['featured'] = 'no';
            $data['status'] = 'ok';
            //$data['rating_user'] = '[]';
            $data['date_of_updated'] = date('Y-m-d');
            $data['tax'] = $this->input->post('tax');
            $data['discount'] = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $data['tax_type'] = $this->input->post('tax_type');
            $data['shipping_cost'] = 0;
            $data['tags'] = $this->input->post('tag');
            $data['num_of_imgs'] = $num_of_imgs;
//            $data['color'] = $c;
//            $data['size'] = $s;
            $p_id = $this->input->post('product_id');
             //print_r($data);exit;
            $this->Admin_model->file_up("images", "product", $para2, 'multi');

            $this->db->where('product_id', $p_id);
            $this->db->update('product', $data);
            //echo $this->db->last_query();exit;
           // $this->crud_model->set_category_data(0);
           // recache();
            echo json_encode((["msg_type" => "success", "message" => "Product Updated Successfully"]));

            //redirect(base_url() . 'Admin/all_product');
        }else if($para1 == "edit_option") {
            $id = $_POST['id'];
            $data['option']= $this->db->get_where('product_options', array(
                'options_id' => $id
            ))->result(); 
            $this->load->view('backend/static/edit_option',$data);
            
        }else if ($para1 == "update_option_save") {
            $data = array(
                'product_name' => $this->input->post('name'),
                'sale_price' => $this->input->post('sale_price'),
                'discount' => $this->input->post('purchase_price'),
                'date_of_updated' => date('Y-m-d'),
                'status' => $this->input->post('status'),
                'tax' => $this->input->post('tax'),
                'color' => $this->input->post('color'),
                'size' => $this->input->post('size'),
                'current_stock' => $this->input->post('quantity'),
                'shipping_cost' => $this->input->post('shipping')
            );          
            $where = array('options_id' => $this->input->post('id'));
            $this->db->where($where);
            $this->db->update('product_options', $data); 
            echo 1;
//            echo json_encode(array("status" => 1));
//            echo json_encode($data);
           
        }

        else {
            redirect(base_url() . 'Admin/all_product');
        }
    }

    function dlt_img($para2){
            $a = explode('_', $para2);
            $this->Admin_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);


    }
    function soft_delete(){
        $id = $this->input->post('id');
        $this->db->where('product_id',$id);
        $this->db->update('product',array('delete'  => 1 ));
        echo 1;
    }

}
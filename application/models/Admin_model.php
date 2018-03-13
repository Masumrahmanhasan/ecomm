<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/22/2018
 * Time: 10:00 PM
 */
class Admin_model extends CI_Model
{
    ///////////////////////////////////////
    ///                                 ///
    ///     Admin Menu Section Starts   ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== GET MENU PARENTS ====*/
    public function getMenuParents($table)
    {
        return $this->db->select('*')->from($table)->where('parent', 0)->get()->result_array();
    }

    /*==== ADD ADMIN MENU ITEM ====*/
    public function addMenuItem($data,$table)
    {
        $item = array(
            'parent' => $data['parent'],
            'name' => $data['name'],
            'class' => $data['class'],
            'url' => $data['url']
        );

        $this->db->insert($table, $item);
    }

    /*==== UPDATE ADMIN MENU ITEM =====*/
    public function updateMenuItem($data, $menuId, $table)
    {
        $item = array(
            'parent' => $data['parent'],
            'name' => $data['name'],
            'class' => $data['class'],
            'url' => $data['url']
        );

        $this->db->WHERE('id', $menuId)->update($table, $item);
    }

    /*==== GET ADMIN MENU ITEMS =====*/
    public function getMenuItems($table)
    {
        $st = $this->db->select('*')->from($table)->where('parent', 0)->get()->result_array();
        if (count($st) > 0) {
            for ($i = 0; $i < count($st); $i++) {
                $st[$i]['child'] = $this->db->select('*')->from($table)->where('parent', $st[$i]['id'])->get()->result_array();
            }
        } else {
            return false;
        }

        return $st;
    }

    /*==== GET ALL ADMIN MENU ITEMS ====*/
    public function getAllMenuItems($table)
    {
        return $this->db->query("SELECT ".$table.".*, a.name as parent from ".$table." left join ".$table." a on a.id=$table.parent")->result_array();
    }

    /*==== GET MENU ITEM DETAIL ====*/
    public function getMenuItemDetail($table, $menuId)
    {
        $st = $this->db->select('*')->from($table)->WHERE('id', $menuId)->get()->result_array();
        return $st[0];
    }

    /*===== DEL ADMIN MENU =====*/
    public function delAdminMenu($id)
    {
        $this->db->query('DELETE from admin_menu WHERE id=' . $id);
    }

    public function delete_menu($table,$id)
    {
        $this->db->query("DELETE from $table WHERE id='$id'");
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Admin Menu Section Ends     ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== FUNCTION GET ALL DATA ====*/
    public function getAll($table)
    {
        return $this->db->select('*')->from($table)->get()->result_array();
    }

    /*==== FUNCTION GET ACTIVE THEME ====*/
    public function getActiveTheme()
    {
        $st=$this->db->select('name')->from('theme')->where('status','Active')->get()->result_array();
        return $st[0]['name'];
    }

    /*==== FUNCTION GET ACTIVE THEME ID ====*/
    public function getActiveThemeId()
    {
        $st=$this->db->select('*')->from('theme')->where('status','Active')->get()->result_array();
        return $st[0]['id'];
    }

    /*==== FUNCTION ACTIVATE THEME ====*/
    public function activateTheme($id)
    {
        $theme=$this->getActiveThemeId();
        $data=array(
            'status'=> 'Inactive'
        );
        $this->db->WHERE('id',$theme)->update('theme',$data);

        $data=array(
            'status'=> 'Active'
        );
        $this->db->WHERE('id',$id)->update('theme',$data);
    }

    /*==== CHECK OLD PASSWORD ====*/
    public function checkOldPass($email, $oldPass)
    {
        $array = array(
            'email' => $email,
            'password' => $oldPass
        );
        $st = $this->db->select('id')->from('users')->WHERE($array)->get()->result_array();
        return $this->db->affected_rows();
    }

    /*==== UPDATE PASSWORD ====*/
    public function updatePass($id, $pass)
    {
        $update = array(
            'password' => $pass
        );
        $this->db->WHERE('id', $id)->update('users', $update);
    }

    /*==== GET USER ID ====*/
    public function getUserId($email)
    {
        $st = $this->db->select('id')->from('users')->WHERE('email', $email)->get()->result_array();
        return $st[0];
    }

    /*==== GET EMAIL SETTINGS ====*/
    public function getEmailSettings()
    {
        return $this->db->select('*')->from('email_settings')->WHERE('id', 1)->get()->row();
    }

    public function getConfig_Byid($id)
    {
        $st = $this->db->query('SELECT * from email_settings where id=' . $id)->result_array();
        return $st[0];
    }


    /*===== UPDATE SOCIAL LINKS =====*/
    public function update_social_links($data, $id)
    {
        $item = array(
            'facebook'   => $data['facebook'],
            'twitter'    => $data['twitter'],
            'google_plus' => $data['google'],
            'linkedin'   => $data['linkedin']
        );
        $this->db->WHERE('id', $id)->update('social_links', $item);
    }

    /*==== UPDATE SMTP CONFIG ====*/
    public function update_smtp_config($data, $menuId)
    {
        $item = array(
            'host' => $data['host'],
            'port' => $data['port'],
            'email' => $data['email'],
            'password' => $data['password'],
            'sent_email' => $data['sent_email'],
            'sent_title' => $data['sent_title'],
            'reply_email' => $data['reply_email'],
            'reply_title' => $data['reply_title']
        );
        $this->db->WHERE('id', $menuId)->update('email_settings', $item);
    }

    /*===== UPDATE COMPANY INFO =====*/
    public function update_company($data, $id)
    {
        $item = array(
            'name'      => $data['name'],
            'email'     => $data['email'],
            'contact'   => $data['contact'],
            'address'   => $data['address'],
            'website'   => $data['website'],
        );
        $this->db->WHERE('id', $id)->update('company_information', $item);
    }

    public function update_logo($row_id)
    {
        $configUpload['upload_path'] = './uploads/';
        $configUpload['allowed_types'] = 'jpg|png|jpeg';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '0';
        $configUpload['max_height'] = '0';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update('company_information', ['logo' => $image_name], ['id' => $row_id]);

        }
    }

    public function get_company_info()
    {
        $st = $this->db->query('SELECT * from company_information where id= 1')->result_array();
        return $st[0];
    }

    /*==== DELETE SINGLE DATA =====*/
    public function delete($table,$id)
    {
        $this->db->query("DELETE from $table WHERE id='$id'");
    }

    /*===== GET RECORD BY ID =====*/
    public function getById($table, $id)
    {
        $st = $this->db->select('*')->from($table)->WHERE('id', $id)->get()->result_array();
        return $st[0];
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Product Section Start       ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD CATEGORY =====*/
    public function add_category($data)
    {
        $item = array(
            'name' => $data['name'],
            'icon' => $data['icon']
        );
        $this->db->insert('category', $item);
    }

    /*===== UPDATE CATEGORY =====*/
    public function update_category($data, $id)
    {
        $item = array(
            'name' => $data['name'],
            'icon' => $data['icon']
        );
        $this->db->WHERE('id', $id)->update('category', $item);
    }

    
    /*===== ADD BRAND =====*/
    /*public function add_brand($data)
    {
        $item = array(
            'name'  =>  $data['name'],
            'sub_cat_id'  => $data['sub_cat_id']
        );
        $this->db->insert('brands',$item);
        $row_id = $this->db->insert_id();
        $this->upload_img('brands',$row_id);
        return $row_id;
    }*/

    /*===== UPDATE BRAND =====*/
    /*public function update_brand($data, $id)
    {
        $item = array(
            'name' => $data['name']
        );
        $this->db->WHERE('id', $id)->update('brands', $item);
    }*/

    /*===== ADD SUB CATEGORY =====*/
    public function add_sub_category($data)
    {
        $item = array(
            'name'      => $data['name'],
            'cat_id'    => $data['cat_id']
        );
        $this->db->insert('sub_category', $item);
    }

    /*==== UPDATE SUB CATEGORY =====*/
    public function update_sub_category($data, $id)
    {
        $item = array(
            'name'      => $data['name'],
            'cat_id'    => $data['cat_id']
        );
        $this->db->WHERE('id', $id)->update('sub_category', $item);
    }

    
    ///////////////////////////////////////
    ///                                 ///
    ///      Product Section Ends       ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///       Upload section start      ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== IMAGE UPLOAD =====*/
    public function upload_img($table, $row_id)
    {
        $configUpload['upload_path'] = './uploads/';
        $configUpload['allowed_types'] = 'jpg|png|jpeg';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '0';
        $configUpload['max_height'] = '0';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update($table, ['image' => $image_name], ['id' => $row_id]);

        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       Upload section End        ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///      Frontend Section Start     ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD SLIDE =====*/
    public function add_slide($data)
    {
       $item = array(
           'title'      => $data['title'],
           'sub_title'  => $data['sub_title'],
           'quote'      => $data['quote'],
           'link'       => $data['link']
       );
       $this->db->insert('slider', $item);
       $row_id = $this->db->insert_id();
       $this->upload_img('slider',$row_id);
       return $row_id;
    }

    /*===== UPDATE SLIDE =====*/
    public function update_slide($data, $id)
    {
        $item = array(
            'title'      => $data['title'],
            'sub_title'  => $data['sub_title'],
            'quote'      => $data['quote'],
            'link'       => $data['link']
        );
        $this->db->WHERE('id', $id)->update('slider', $item);
    }

    /*==== ENABLE SLIDER IMAGE ====*/
    public function enable_slider($id)
    {
        $item = array(
            'status' => 'Enable'
        );
        $this->db->WHERE('id',$id)->update('slider',$item);
    }

    /*==== DISABLE SLIDER IMAGE ====*/
    public function disable_slider($id)
    {
        $item = array(
            'status' => "Disable"
        );
        $this->db->WHERE('id',$id)->update('slider',$item);
    }

    ///////////////////////////////////////
    ///                                 ///
    ///      Frontend section End       ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///        User Section Start       ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD NEW USER =====*/
    public function add_user($data)
    {
        $item = array(
            'name'     => $data['name'],
            'email'    => $data['email'],
            'contact'  => $data['contact'],
            'password' => md5(sha1($data['password'])),
            'hash'     => md5(sha1($data['email'])),
            'status'  => $data['Approved']
        );
        $this->db->insert('users', $item);
        $row_id = $this->db->insert_id();
        $this->upload_img('users', $row_id);
        return $row_id;
    }

    public function approve_user($id)
    {
        $item = array(
            'status' => 'Approved'
        );
        $this->db->WHERE('id',$id)->update('users',$item);
    }

    /*==== DISABLE SLIDER IMAGE ====*/
    public function disable_user($id)
    {
        $item = array(
            'status' => "Pending"
        );
        $this->db->WHERE('id',$id)->update('users',$item);
    }
}
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
    public function getAll($table,$where=NULL)
    {
        if($where != NULL):
            $this->db->where($where);
        endif;
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
        //echo $this->db->last_query();
        return $st[0];
    }

    public function getByIdSub($table, $id)
    {
        $st = $this->db->select('*')->from($table)->WHERE($id)->get()->result();
        return $st;
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


    // FILE_VIEW
    function file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                if ($thumb == 'no') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
                } elseif ($thumb == 'thumb') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_thumb' . $ext;
                }

                if ($src == 'no') {
                    return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                } elseif ($src == 'src') {
                    return $srcl;
                }
            } else {
                return base_url() . 'uploads/' . $type . '_image/default.jpg';
            }

        } else if ($multi == 'multi') {
            $num = $this->Admin_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            //$num = 2;
            $i = 0;
            $p = 0;
            $q = 0;
            $return = array();
            while ($p < $num) {
                $i++;
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                    }

                    if ($src == 'no') {
                        $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        $return[] = $srcl;
                    }
                    $p++;
                } else {
                    $q++;
                    if ($q == 10) {
                        break;
                    }
                }

            }
            if (!empty($return)) {
                if ($multi_num == 'one') {
                    return $return[0];
                } else if ($multi_num == 'all') {
                    return $return;
                } else {
                    $n = $multi_num - 1;
                    unset($return[$n]);
                    return $return;
                }
            } else {
                if ($multi_num == 'one') {
                    return base_url() . 'uploads/' . $type . '_image/default.jpg';
                } else if ($multi_num == 'all') {
                    return array(base_url() . 'uploads/' . $type . '_image/default.jpg');
                } else {
                    return array(base_url() . 'uploads/' . $type . '_image/default.jpg');
                }
            }
        }
    }

    /////////GET NAME BY TABLE NAME AND ID/////////////
    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type_id => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                //echo $this->db->last_query();
                return $l->row()->$field;
            }
        }
    }

    function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '', $condition_type = 'single')
    {
        $return = '';
        $other = '';
        $multi = 'no';
        $phrase = 'Choose a ' . $name;
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" >';
        if (!is_array($from)) {
            if ($condition == '') {
                $all = $this->db->get($from)->result_array();
            } else if ($condition !== '') {
                if ($condition_type == 'single') {
                    $all = $this->db->get_where($from, array(
                        $condition => $c_match
                    ))->result_array();
                } else if ($condition_type == 'multi') {
                    $this->db->where_in($condition, $c_match);
                    $all = $this->db->get($from)->result_array();
                }
            }

            $return .= '<option value="">Choose one</option>';

            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row['id'] . '">' . $row[$field] . '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row['id'] . '" ';
                    if ($multi == 'no') {
                        if ($row['id'] == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$from . '_id'], $e_match)) {
                            $return .= 'selected=."selected"';
                        }
                    }
                    $return .= '>' . $row[$field] . '</option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';

                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }

                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }


    // FILE_UPLOAD
    function img_thumb($type, $id, $ext = '.jpg', $width = '700', $height = '700')
    {
        $this->load->library('image_lib');
        ini_set("memory_limit", "-1");

        $config1['image_library'] = 'gd2';
        $config1['create_thumb'] = TRUE;
        $config1['maintain_ratio'] = TRUE;
        $config1['width'] = $width;
        $config1['height'] = $height;
        $config1['source_image'] = 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;

        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    // FILE_UPLOAD
    function img_thumb_slides($type, $id, $ext = '.jpg', $width = '700', $height = '700')
    {
        $this->load->library('image_lib');
        ini_set("memory_limit", "-1");

        $config1['image_library'] = 'gd2';
        $config1['create_thumb'] = TRUE;
        $config1['maintain_ratio'] = TRUE;
        //$config1['width'] = $width;
        //$config1['height'] = $height;
        $config1['source_image'] = 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;

        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    // FILE_UPLOAD
    function file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->Admin_model->img_thumb($type, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                $image = 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext;
                //$image = $_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext;
                $images_data = array(
                    'image_name'=>$image,
                    'product_id'=>$id
                );
                $this->db->insert('product_image',$images_data);
                if ($no_thumb == '') {
                    $this->Admin_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }

    function file_up_slides($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->Admin_model->img_thumb($type, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->admin_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }

    // FILE_UPLOAD : EXT :: FILE EXISTS
    function file_exist_ret($type, $id, $ib, $ext = '.jpg')
    {
        if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
            $ib = $ib + 1;
            $ib = $this->file_exist_ret($type, $id, $ib);
            return $ib;
        } else {
            return $ib;
        }
    }

    //GETTING ADDITIONAL FIELDS FOR PRODUCT ADD
    function get_additional_fields($product_id)
    {
        $additional_fields = $this->Admin_model->get_type_name_by_id('product', $product_id, 'additional_fields');
        $ab = json_decode($additional_fields, true);
        $name = json_decode($ab['name']);
        $value = json_decode($ab['value']);
        $final = array();
        if (!empty($name)) {
            foreach ($name as $n => $row) {
                $final[] = array(
                    'name' => $row,
                    'value' => $value[$n]
                );
            }
        }
        return $final;
    }

    function file_dlt($type, $id, $ext = '.jpg', $multi = '', $m_sin = '')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . $ext);
            }
            if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext);
            }

        } else if ($multi == 'multi') {
            $num = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            if ($m_sin == '') {
                $i = 0;
                $p = 0;
                while ($p < $num) {
                    $i++;
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . $ext);
                        $p++;
                        $data['num_of_imgs'] = $num - 1;
                        $this->db->where($type . '_id', $id);
                        $this->db->update($type, $data);
                    }

                    if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext);
                    }
                    if ($i > 50) {
                        break;
                    }
                }
            } else {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $m_sin . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . $ext);
                }
                if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext);
                }
                $data['num_of_imgs'] = $num - 1;
                $this->db->where($type . '_id', $id);
                $this->db->update($type, $data);
            }
        }
    }


}
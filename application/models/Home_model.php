<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/23/2018
 * Time: 12:12 AM
 */
class Home_model extends CI_Model
{
    /*==== FUNCTION GET ALL DATA ====*/
    public function getAll($table)
    {
        return $this->db->select('*')->from($table)->get()->result_array();
    }

    public function getAllImran($table,$limit = '')
    {
        $this->db->select('*')->from($table);
        if($limit)
            $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /*===== GET SOCIAL LINKS ====*/
    public function get_social_links()
    {
        $st = $this->db->query('SELECT * from social_links where id=?', [1])->result_array();
        return $st[0];
    }

    /*===== GET ALL CATEGORIES =====*/
    public function get_all_categories()
    {
        $cats = $this->db->get("category")->result();
        $all_cats = [];
        foreach ($cats as $key => $cat){
            $scats = $this->db->get_where("sub_category", ['cat_id' => $cat->id])->result();
            $all_scats = [];
            foreach ($scats as $key => $scat){
                $brands = $this->db->get_where("brands", ['sub_cat_id' => $scat->id])->result();
                $scat->brands = $brands;
                $all_scats[] = $scat;
            }
            $cat->sub_cats = $all_scats;
            $all_cats[] = $cat;
        }
        return $all_cats;
        /*echo '<pre>';
        print_r($all_cats);
        exit;*/
    }

    /*===== GET FEATURED PRODUCTS =====*/
    public function get_featured_products()
    {
        return $this->db->select('*')->from('products')->WHERE('p_feature =\'YES\'')->get()->result_array();
    }

    /*===== CUSTOMER SIGN UP ======*/
    public function register_customer($data)
    {
        $item =array(
            'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'email'       => $data['email'],
            'contact_no'  => $data['phone'],
            'password'    => md5(sha1($data['password'])),
            'hash'        => md5(sha1($data['email'])),
            'address_1'   => $data['address1'],
            'address_2'   => $data['address2'],
            'country'     => $data['country'],
            'city'        => $data['city'],
            'state'       => $data['state'],
            'zip_code'    => $data['zip']
        );
        $this->db->insert('customer', $item);
        return $this->db->insert_id();
    }

    /*===== LOGIN CUSTOMER =====*/
    public function do_login($data)
    {
        $st=$this->db->select('*')->from('customers')->WHERE('email',$data['email'])->WHERE('password',md5(sha1($data['password'])))->get()->result_array();

        if(count($st)>0)
        {
            if($st[0]['status']=='approved')
            {
                return $st[0];
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }

    /*===== UPDATE PROFILE =====*/
    public function update_profile($data, $id)
    {
        $item = array(
            'first_name'  => $data['username'],
            'last-name'  => $data['surname'],
            'email'      => $data['email'],
            'contact_no' => $data['phone'],
            'password'  => $data['password'],
            'address_1' => $data['address1'],
            'address_2' => $data['address2'],
            'country' => $data['country'],
            'city'     => $data['city'],
            'state'   => $data['zip'],
        );
        $this->db->WHERE('id', $id)->update('customers', $item);
    }

    /*==== CHECK OLD PASSWORD ====*/
    public function checkOldPass($email, $oldPass)
    {
        $array = array(
            'email' => $email,
            'password' => $oldPass
        );
        $st = $this->db->select('id')->from('customers')->WHERE($array)->get()->result_array();
        return $this->db->affected_rows();
    }

    /*==== UPDATE PASSWORD ====*/
    public function updatePass($id, $pass)
    {
        $update = array(
            'password' => $pass
        );
        $this->db->WHERE('id', $id)->update('customers', $update);
    }

    /*==== GET USER ID ====*/
    public function getUserId($email)
    {
        $st = $this->db->select('id')->from('customers')->WHERE('email', $email)->get()->result_array();
        return $st[0];
    }

    /*===== GET DATA BY ID =====*/
    public function getById($table, $id)
    {
        $st = $this->db->select('*')->from($table)->WHERE('id', $id)->get()->result_array();
        //echo $this->db->last_query();
        return $st[0];
    }

    public function getByIdImran($table, $id, $limit = '')
    {
        $this->db->select('*')->from($table)->WHERE($id);
        if($limit)
            $this->db->limit($limit);
        $st = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $st;
    }

    /*===== ACTIVATE USER ======*/
    public function activateUser($id,$hash)
    {
        $user=$this->getUserById($id);
        if($user['hash']==$hash)
        {
            $this->db->query("UPDATE customer set status='Approved' WHERE id=$id");
        }
    }

    public function getAllProducts()
    {
        return $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image AS pimg
WHERE p.`brand_id` = b.`id`
AND p.`product_id` = pimg.`product_id`
AND pimg.`class`='primary'
")->result_array();
    }
    public function getByIdAjax($id)
    {
        if($id !=''){
            $i = " AND p.cat_id = $id";
        }
        return $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image AS PI
WHERE p.`brand_id` = b.`id`
AND p.`product_id` = pi.`product_id`
$i AND pi.`class`='primary'")->result_array();
    }


    public function featured_products()
    {
       $query = $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image as pi
WHERE p.`brand_id` = b.`id`
AND pi.product_id = p.product_id
AND pi.class= 'primary' AND p.`featured` = 'ok' LIMIT 10")->result_array();
        return $query;

    }
    //GETTING MOST SOLD PRODUCTS
    function most_sold_products()
    {
        $result = array();
        $product = $this->db->get('product')->result_array();
        foreach ($product as $row) {
            $result[] = array(
                'id' => $row['product_id'],
                'sale' => $this->total_sale($row['product_id'])
            );
        }
        //echo $this->db->last_query();
        return $result;
    }
    function total_sale($product_id, $field = 'qty')
    {
        $return = 0;
        $sales = $this->db->get('sale')->result_array();
        foreach ($sales as $row) {
            if ($a = $this->product_in_sale($row['sale_id'], $product_id, $field)) {
                $return += $a;
            }
        }
        return $return;
    }
    function product_in_sale($sale_id, $product_id, $field)
    {
        $return = '';
        $product_details = json_decode($this->Admin_model->get_type_name_by_id('sale', $sale_id, 'product_details'), true);
        foreach ($product_details as $row) {
            if ($row['id'] == $product_id) {
                $return = $row[$field];
            }
        }
        if ($return == '') {
            return false;
        } else {
            return $return;
        }
    }
    public function insert_data($table,$data){
        $this->db->insert($table,$data);
        return true;
    }

}





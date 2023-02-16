<?php
//session_start();
class admin extends CI_Controller
{
    /*public function __construct()
    {
    parent::__construct();
    $_SESSION["per_page"]="10";
    if(!isset($_SESSION["admin_email"]))
    {
    //redirect(base_url().'login/login_check');
    }
    }
    */
    
    public function index()
    {

        //$_SESSION["per_page"]="10";
        /*
        $page_data['page_title'] = "Welcome";
        $page_data['page_name']  = 'dashboard_view';
        $this->load->view('admin/index', $page_data);
        */
        $this->load->view('admin/slider_view_new');
    }

    public function manage_category($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["category_name"]=$this->input->post("txt_category_name");
                if($_FILES["img_category"]["error"]==0)
                {
                    $newname = $_FILES["img_category"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/category/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_category");

                    $data["category_image"]=$newname;
                    $this->smart_resize_image("files/admin/category/".$newname,262,200,true, "files/admin/category/thumb/".$newname,false,false);
                }
                $data["category_description"]=$this->input->post("txt_category_desc");$data["category_status"]=$this->input->post("rdo_category_status");
            $this->db->insert("tbl_category",$data);
            redirect(base_url()."admin/manage_category");
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["category_name"]=$this->input->post("txt_category_name");
                if($_FILES["img_category"]["error"]==0)
                {
                    $newname = $_FILES["img_category"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/category/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_category");

                    $data["category_image"]=$newname;
                        $this->smart_resize_image("files/admin/category/".$newname,262,200,true, "files/admin/category/thumb/".$newname,false,false);
                }
                $data["category_description"]=$this->input->post("txt_category_desc");$data["category_status"]=$this->input->post("rdo_category_status");
            $this->db->where("category_id",$param3);
            $this->db->update("tbl_category",$data);
            redirect(base_url()."admin/manage_category");
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_category",array("category_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("category_id",$param2);
            $this->db->delete("tbl_category");
            redirect(base_url()."admin/manage_category");
        }

        /* paging starts here */
        $per_page="10";
        $this->db->limit($per_page,$param1);
        
        $page_data["resultset"]=$this->db->get("tbl_category");

        $resultset=$this->db->get("tbl_category");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_category",$total_rows,$per_page);


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Category View";
        $page_data["page_name"]="category_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_catalogue($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["catalogue_name"]=$this->input->post("txt_catalogue_name");
                if($_FILES["img_catalogue"]["error"]==0)
                {
                    $newname = $_FILES["img_catalogue"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/catalogue/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_catalogue");

                    $data["catalogue_image"]=$newname;
                        $this->smart_resize_image("files/admin/catalogue/".$newname,262,200,true, "files/admin/catalogue/thumb/".$newname,false,false);
                }
                $data["catalogue_description"]=$this->input->post("txt_catalogue_desc");$data["catalogue_status"]=$this->input->post("rdo_catalogue_status");$data["category_id"]=$this->input->post("cmb_category");
            $this->db->insert("tbl_catalogue",$data);
            //redirect(base_url()."admin/manage_catalogue");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["catalogue_name"]=$this->input->post("txt_catalogue_name");
                if($_FILES["img_catalogue"]["error"]==0)
                {
                    $newname = $_FILES["img_catalogue"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/catalogue/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_catalogue");

                    $data["catalogue_image"]=$newname;
                        $this->smart_resize_image("files/admin/catalogue/".$newname,262,200,true, "files/admin/catalogue/thumb/".$newname,false,false);
                }
                $data["catalogue_description"]=$this->input->post("txt_catalogue_desc");$data["catalogue_status"]=$this->input->post("rdo_catalogue_status");$data["category_id"]=$this->input->post("cmb_category");
            $this->db->where("catalogue_id",$param3);
            $this->db->update("tbl_catalogue",$data);
            //redirect(base_url()."admin/manage_catalogue");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_catalogue",array("catalogue_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("catalogue_id",$param2);
            $this->db->delete("tbl_catalogue");
            //redirect(base_url()."admin/manage_catalogue");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }

        /* paging starts here */
        /*
        $per_page="10";
        $this->db->limit($per_page,$param1);
        $this->db->join("tbl_category","tbl_catalogue.category_id=tbl_category.category_id");
        $page_data["resultset"]=$this->db->get("tbl_catalogue");

        $resultset=$this->db->get("tbl_catalogue");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_catalogue",$total_rows,$per_page);
        */

        $this->db->join("tbl_category","tbl_catalogue.category_id=tbl_category.category_id");
        $page_data["resultset"]=$this->db->get_where("tbl_catalogue",array('tbl_catalogue.category_id'=>$param1));

        $page_data['cate_id'] = $param1;

        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Catalogue View";
        $page_data["page_name"]="catalogue_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_volume($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["volume_name"]=$this->input->post("txt_volume_name");
                if($_FILES["img_volume"]["error"]==0)
                {
                    $newname = $_FILES["img_volume"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/volume/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_volume");

                    $data["volume_image"]=$newname;
                        $this->smart_resize_image("files/admin/volume/".$newname,262,200,true, "files/admin/volume/thumb/".$newname,false,false);
                }
                $data["volume_description"]=$this->input->post("txt_volume_desc");
                $data["volume_publish_date"]=$this->input->post("txt_volume_publish_date");
                $data["volume_status"]=$this->input->post("rdo_volume_status");
                $data["catalogue_id"]=$this->input->post("cmb_catalogue");
                $data["volume_price"]=$this->input->post("txt_volume_price");
                $data["volume_featured"]=$this->input->post("rdo_volume_featured");
            $this->db->insert("tbl_volume",$data);
            //redirect(base_url()."admin/manage_volume");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["volume_name"]=$this->input->post("txt_volume_name");
                if($_FILES["img_volume"]["error"]==0)
                {
                    $newname = $_FILES["img_volume"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/volume/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_volume");

                    $data["volume_image"]=$newname;
                        $this->smart_resize_image("files/admin/volume/".$newname,262,200,true, "files/admin/volume/thumb/".$newname,false,false);
                }
                $data["volume_description"]=$this->input->post("txt_volume_desc");
                $data["volume_publish_date"]=$this->input->post("txt_volume_publish_date");
                $data["volume_status"]=$this->input->post("rdo_volume_status");
                $data["catalogue_id"]=$this->input->post("cmb_catalogue");
                $data["volume_price"]=$this->input->post("txt_volume_price");
                $data["volume_featured"]=$this->input->post("rdo_volume_featured");
            $this->db->where("volume_id",$param3);
            $this->db->update("tbl_volume",$data);
            //redirect(base_url()."admin/manage_volume");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_volume",array("volume_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("volume_id",$param2);
            $this->db->delete("tbl_volume");
            //redirect(base_url()."admin/manage_volume");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }

        /* paging starts here */
        /*
        $per_page="10";
        $this->db->limit($per_page,$param1);
        $this->db->join("tbl_catalogue","tbl_volume.catalogue_id=tbl_catalogue.catalogue_id");
        $page_data["resultset"]=$this->db->get("tbl_volume");

        $resultset=$this->db->get("tbl_volume");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_volume",$total_rows,$per_page);
        */

        $this->db->join("tbl_catalogue","tbl_volume.catalogue_id=tbl_catalogue.catalogue_id");
        $page_data["resultset"]=$this->db->get_where("tbl_volume",array("tbl_volume.catalogue_id"=>$param1));


        $page_data['catalo_id'] = $param1;



        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Volume View";
        $page_data["page_name"]="volume_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_product($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["volume_product_name"]=$this->input->post("txt_product_name");$data["volume_product_description"]=$this->input->post("txt_product_desc");$data["volume_product_fabric"]=$this->input->post("txt_product_fabric");
                if($_FILES["img_product"]["error"]==0)
                {
                    $newname = $_FILES["img_product"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/product/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_product");

                    $data["volume_product_image"]=$newname;
                        $this->smart_resize_image("files/admin/product/".$newname,262,200,true, "files/admin/product/thumb/".$newname,false,false);
                    $this->smart_resize_image("files/admin/product/".$newname,0,600,true, "files/admin/product/med/".$newname,false,false);

                }
                $data["volume_product_status"]=$this->input->post("rdo_product_status");$data["volume_id"]=$this->input->post("cmb_volume");$data["volume_product_price"]=$this->input->post("txt_product_price");
            $this->db->insert("tbl_volume_product",$data);
            //redirect(base_url()."admin/manage_product");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["volume_product_name"]=$this->input->post("txt_product_name");$data["volume_product_description"]=$this->input->post("txt_product_desc");$data["volume_product_fabric"]=$this->input->post("txt_product_fabric");
                if($_FILES["img_product"]["error"]==0)
                {
                    $newname = $_FILES["img_product"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/product/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_product");

                    $data["volume_product_image"]=$newname;
                    $this->smart_resize_image("files/admin/product/".$newname,262,200,true, "files/admin/product/thumb/".$newname,false,false);
                    $this->smart_resize_image("files/admin/product/".$newname,0,600,true, "files/admin/product/med/".$newname,false,false);

                }
                $data["volume_product_status"]=$this->input->post("rdo_product_status");$data["volume_id"]=$this->input->post("cmb_volume");$data["volume_product_price"]=$this->input->post("txt_product_price");
            $this->db->where("volume_product_id",$param3);
            $this->db->update("tbl_volume_product",$data);
            //redirect(base_url()."admin/manage_product");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_volume_product",array("volume_product_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("volume_product_id",$param2);
            $this->db->delete("tbl_volume_product");
            //redirect(base_url()."admin/manage_product");
            $url=$_SERVER["HTTP_REFERER"];
            redirect($url);
        }

        /* paging starts here */
        /*
        $per_page="10";
        $this->db->limit($per_page,$param1);
        $this->db->join("tbl_volume","tbl_volume_product.volume_id=tbl_volume.volume_id");
        $page_data["resultset"]=$this->db->get("tbl_volume_product");

        $resultset=$this->db->get("tbl_volume_product");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_product",$total_rows,$per_page);
        */

        $this->db->join("tbl_volume","tbl_volume_product.volume_id=tbl_volume.volume_id");
        $page_data["resultset"]=$this->db->get_where("tbl_volume_product",array("tbl_volume_product.volume_id"=>$param1));

        $page_data['volu_id'] = $param1;


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Product View";
        $page_data["page_name"]="product_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_sms_provider($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["sms_provider_name"]=$this->input->post("txt_sms_provider_name");$data["sms_provider_url"]=$this->input->post("txt_sms_provider_url");$data["sms_provider_user"]=$this->input->post("txt_sms_provider_user");$data["sms_provider_password"]=$this->input->post("txt_sms_provider_password");$data["sms_provider_status"]=$this->input->post("rdo_sms_provider_status");
            $this->db->insert("tbl_sms_provider",$data);
            redirect(base_url()."admin/manage_sms_provider");
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["sms_provider_name"]=$this->input->post("txt_sms_provider_name");$data["sms_provider_url"]=$this->input->post("txt_sms_provider_url");$data["sms_provider_user"]=$this->input->post("txt_sms_provider_user");$data["sms_provider_password"]=$this->input->post("txt_sms_provider_password");$data["sms_provider_status"]=$this->input->post("rdo_sms_provider_status");
            $this->db->where("sms_provider_id",$param3);
            $this->db->update("tbl_sms_provider",$data);
            redirect(base_url()."admin/manage_sms_provider");
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_sms_provider",array("sms_provider_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("sms_provider_id",$param2);
            $this->db->delete("tbl_sms_provider");
            redirect(base_url()."admin/manage_sms_provider");
        }

        /* paging starts here */
        $per_page="10";
        $this->db->limit($per_page,$param1);
        
        $page_data["resultset"]=$this->db->get("tbl_sms_provider");

        $resultset=$this->db->get("tbl_sms_provider");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_sms_provider",$total_rows,$per_page);


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="SMS Provider View";
        $page_data["page_name"]="sms_provider_view";

        $this->load->view("admin/index",$page_data);
    } 

    function manage_settings($param1="",$param2="")
    {
        if($param1=="edit" && $param2=="do_update")
        {
            $data['settings_website_title']=$this->input->post('txt_title');
            $data['settings_meta_keywords']=$this->input->post('txt_keyword');
            $data['settings_meta_desc']=$this->input->post('txt_desc');
            $data['settings_website_name']=$this->input->post('txt_name');
            $data['settings_show_badges']=$this->input->post('chk_show_badges');

            if($_FILES["img_logo"]["error"]==0)
            {
                $newname = $_FILES["img_logo"]["name"];
                $newname = $this->generate_random_name($newname);
            
                //$newname=rand(100000,10000000)."_".$_FILES["img_logo"]["name"];
                //$config['file_name']='logonew.png';
                $config["file_name"]=$newname;
                $config['upload_path']='files/admin/logo/';
                //$confing['upload_path']='./template/user/img/';
                $config['allowed_types']='gif|jpg|png|bmp|jpeg|ico';
                $config['max_width']='102400';
                $config['max_height']='76800';
                $config['max_size']=1024*1024*2;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->do_upload('img_logo');
                $data['settings_logo']=$newname;

                //$data['settings_logo']='logonew.png';

                $this->smart_resize_image("files/admin/logo/".$newname,262,200,true, "files/admin/logo/".$newname,false,false);
                

            }
                
            if($_FILES["img_logo_small"]["error"]==0)
            {

                $newname_small = $_FILES["img_logo_small"]["name"];
                $newname_small = $this->generate_random_name($newname_small);
            
                //$newname_small=rand(100000,10000000)."_".$_FILES["img_logo_small"]["name"];
                $config['file_name']=$newname_small;
                $config['upload_path']='files/admin/logo/';
                $config['allowed_types']='gif|jpg|png|bmp|jpeg|ico';
                $config['max_width']='102400';
                $config['max_height']='76800';
                $config['max_size']=1024*1024*2;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->do_upload('img_logo_small');
                $data['settings_small_logo']=$newname_small;
            }
            
            if($_FILES["img_logo_footer"]["error"]==0)
            {
                $newname_footer = $_FILES["img_logo_footer"]["name"];
                $newname_footer = $this->generate_random_name($newname_footer);
            
                //$newname_footer=rand(100000,10000000)."_".$_FILES["img_logo_footer"]["name"];
                $config['file_name']=$newname_footer;
                $config['upload_path']='files/admin/logo/';
                $config['allowed_types']='gif|jpg|png|bmp|jpeg|ico';
                $config['max_width']='102400';
                $config['max_height']='76800';
                $config['max_size']=1024*1024*2;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->do_upload('img_logo_footer');
                $data['settings_footer_logo']=$newname_small;
            }       

            if($_FILES["img_favicon"]["error"]==0)
            {
                $newname_favicon = $_FILES["img_favicon"]["name"];
                $newname_favicon = $this->generate_random_name($newname_favicon);
                                
                //$newname_favicon=rand(100000,10000000)."_".$_FILES["img_favicon"]["name"];
                $config['file_name']=$newname_favicon;
                $config['upload_path']='files/admin/logo/';
                $config['allowed_types']='gif|jpg|png|bmp|jpeg|ico';
                $config['max_width']='102400';
                $config['max_height']='76800';
                $config['max_size']=1024*1024*2;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->do_upload('img_favicon');
                $data['settings_favicon']=$newname_small;
            }       


            $data['settings_currency_code']=$this->input->post('txt_code');
            $data['settings_currency_symbol']=$this->input->post('txt_symbol');
            $data['settings_address']=$this->input->post('txt_addr');
            $data['settings_phone']=$this->input->post('txt_phone');
            $data['settings_fax']=$this->input->post('txt_fax');
            $data['settings_contact_email']=$this->input->post('txt_email');
            $data['settings_map_address']=$this->input->post('txt_map_addr');
            $data['settings_toll_free']=$this->input->post('txt_toll_free');
            $data['facebook_url']=$this->input->post('txt_fb_url');
            $data['google_plus_url']=$this->input->post('txt_google_url');
            $data['twitter_url']=$this->input->post('txt_twitter_url');
            $data['linkedin_url']=$this->input->post('txt_linkedin_url');
            $data['instagram_url']=$this->input->post('txt_instagram_url');

            $data['settings_single_min_qty']=$this->input->post('txt_single_min_qty');
            $data['settings_total_min_qty ']=$this->input->post('txt_total_min_qty');
            //$data['unit_name']=$this->input->post('txt_unit');
            $this->db->update("tbl_settings",$data);

            

            redirect(base_url().'index.php/admin/manage_settings');
        }
        else if($param1=="edit")
        {
            $page_data['edit_profile']=$this->db->get('tbl_settings');
        }

        $page_data['function_name']='manage_settings';
        $page_data['page_name']='settings_view';
        $page_data['page_title']='Website Settings';
        $page_data['settings']=$this->db->get("tbl_settings");
        $this->load->view('admin/index',$page_data);
    }
    
    
    
    
    function paging_init($controller_name, $total_row, $per_page)
    {
        /* pagination class starts here */
        //echo $controller_name;
        $this->load->library('pagination');
        $config['base_url']   = base_url() . 'admin/' . $controller_name;
        $config['total_rows'] = $total_row;
        $config['per_page']   = $per_page;
        
        // this extra 
        //$config['uri_segment'] = 4;
        //$config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
        // this extra ends here
        
        $config['first_tag_open']  = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open']    = "<li class='active'><span>";
        $config['cur_tag_close']   = "</span></li>";
        
        $this->pagination->initialize($config);
        $paging_string = $this->pagination->create_links();
        return $paging_string;
        /* pagination class ends here */
    }

    public function manage_cms($param1="",$param2="",$param3="")
    {
        if($param1=="edit" && $param2=="do_update")
        {
            $data["cms_about_us"]=$this->input->post("txt_about_us");
            $data["cms_privacy_policy"]=$this->input->post("txt_privacy_policy");
            $data["cms_copy_right"]=$this->input->post("txt_copy_right");
            $data["cms_trademark"]=$this->input->post("txt_trademark");
            $data["cms_terms_conditions"]=$this->input->post("txt_terms_conditions");
            $data["cms_contact_us"]=$this->input->post("txt_contact_us");
            $data["cms_bank_details"]=$this->input->post("txt_bank_details");

            $this->db->update("tbl_cms",$data);
            redirect(base_url()."admin/manage_cms");
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_cms",array(""=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("",$param2);
            $this->db->delete("tbl_cms");
            redirect(base_url()."admin/manage_cms");
        }

        /* paging starts here */
        $per_page="10";
        $this->db->limit($per_page,$param1);
        
        $page_data["resultset"]=$this->db->get("tbl_cms");

        $resultset=$this->db->get("tbl_cms");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_cms",$total_rows,$per_page);


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="CMS View";
        $page_data["page_name"]="cms_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_inquiry($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["inquiry_name"]=$this->input->post("txt_inquiry_name");$data["inquiry_email"]=$this->input->post("txt_inquiry_email");$data["inquiry_phone"]=$this->input->post("txt_inquiry_phone");$data["inquiry_mobile"]=$this->input->post("txt_inquiry_mobile");$data["inquiry_subject"]=$this->input->post("txt_inquiry_subject");$data["inquiry_message"]=$this->input->post("txt_inquiry_message");$data["inquiry_products"]=$this->input->post("txt_inquiry_products");$data["inquiry_status"]=$this->input->post("rdo_inquiry_status");
            $this->db->insert("tbl_inquiry",$data);
            redirect(base_url()."admin/manage_inquiry");
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["inquiry_name"]=$this->input->post("txt_inquiry_name");$data["inquiry_email"]=$this->input->post("txt_inquiry_email");$data["inquiry_phone"]=$this->input->post("txt_inquiry_phone");$data["inquiry_mobile"]=$this->input->post("txt_inquiry_mobile");$data["inquiry_subject"]=$this->input->post("txt_inquiry_subject");$data["inquiry_message"]=$this->input->post("txt_inquiry_message");$data["inquiry_products"]=$this->input->post("txt_inquiry_products");$data["inquiry_status"]=$this->input->post("rdo_inquiry_status");
            $this->db->where("inquiry_id",$param3);
            $this->db->update("tbl_inquiry",$data);
            redirect(base_url()."admin/manage_inquiry");
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_inquiry",array("inquiry_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("inquiry_id",$param2);
            $this->db->delete("tbl_inquiry");
            redirect(base_url()."admin/manage_inquiry");
        }

        /* paging starts here */
        $per_page="10";
        $this->db->limit($per_page,$param1);
        
        $page_data["resultset"]=$this->db->get("tbl_inquiry");

        $resultset=$this->db->get("tbl_inquiry");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_inquiry",$total_rows,$per_page);


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Inquiry View";
        $page_data["page_name"]="inquiry_view";

        $this->load->view("admin/index",$page_data);
    } 

    public function manage_slider($param1="",$param2="",$param3="")
    {
        if($param1=="create")
        {
            $data["slider_title"]=$this->input->post("txt_slider_title");
                if($_FILES["img_slider"]["error"]==0)
                {
                    $newname = $_FILES["img_slider"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/user/slider/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_slider");

                    $data["slider_image"]=$newname;
                    $this->smart_resize_image("files/user/slider/".$newname,262,200,true, "files/user/slider/thumb/".$newname,false,false);
                }
                $data["slider_href"]=$this->input->post("txt_slider_href");$data["slider_order"]=$this->input->post("txt_slider_order");$data["slider_content"]=$this->input->post("txt_slider_content");$data["slider_content_position"]=$this->input->post("txt_slider_position");$data["slider_status"]=$this->input->post("rdo_status");
            $this->db->insert("tbl_slider",$data);
            redirect(base_url()."admin/manage_slider");
        }
        if($param1=="edit" && $param2=="do_update")
        {
            $data["slider_title"]=$this->input->post("txt_slider_title");
                if($_FILES["img_slider"]["error"]==0)
                {
                    $newname = $_FILES["img_slider"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/user/slider/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_slider");

                    $data["slider_image"]=$newname;
                    $this->smart_resize_image("files/user/slider/".$newname,262,200,true, "files/user/slider/thumb/".$newname,false,false);
                }
                $data["slider_href"]=$this->input->post("txt_slider_href");$data["slider_order"]=$this->input->post("txt_slider_order");$data["slider_content"]=$this->input->post("txt_slider_content");$data["slider_content_position"]=$this->input->post("txt_slider_position");$data["slider_status"]=$this->input->post("rdo_status");
            $this->db->where("slider_id",$param3);
            $this->db->update("tbl_slider",$data);
            redirect(base_url()."admin/manage_slider");
        }
        else if($param1=="edit")
        {
            $page_data["edit_profile"]=$this->db->get_where("tbl_slider",array("slider_id"=>$param2));
        }
        if($param1=="delete")
        {
            $this->db->where("slider_id",$param2);
            $this->db->delete("tbl_slider");
            redirect(base_url()."admin/manage_slider");
        }

        /* paging starts here */
        $per_page="10";
        $this->db->limit($per_page,$param1);
        
        $page_data["resultset"]=$this->db->get("tbl_slider");

        $resultset=$this->db->get("tbl_slider");
        $total_rows=$resultset->num_rows();
        $page_data["paging_string"]=$this->paging_init("manage_slider",$total_rows,$per_page);


        $page_data["start_position"]=intval($param1)+1;    
        $page_data["page_title"]="Slider";
        $page_data["page_name"]="slider_view";

        $this->load->view("admin/index",$page_data);
    } 
    
    
    function generate_random_name($filename)
    {
        $ext         = pathinfo($filename, PATHINFO_EXTENSION);
        //echo $ext;
        //$newfilename = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5) . "_" . substr(str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'), 0, 5) . "_" . rand(1000000, 100000000) .  "_".str_replace(" ", "", $filename)."." . $ext;
        $newfilename = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5) . "_" . substr(str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'), 0, 5) . "_" . rand(1000000, 100000000) .  "_".str_replace(" ", "", $filename);
        return $newfilename;
    }
    
    public function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false)
    {
        if ($height <= 0 && $width <= 0) {
            return false;
        }
        
        $info  = getimagesize($file);
        $image = '';
        
        $final_width  = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;
        
        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);
            
            $final_width  = round($width_old * $factor);
            $final_height = round($height_old * $factor);
            
        } else {
            $final_width  = ($width <= 0) ? $width_old : $width;
            $final_height = ($height <= 0) ? $height_old : $height;
        }
        
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
        }
        
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);
            
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                
                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);
                
                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);
                
                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);
                
                
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {
                
                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);
                
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);
                
                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }
        
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
        
        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }
        
        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }
        
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output);
                break;
            case IMAGETYPE_PNG:
                imagepng($image_resized, $output);
                break;
            default:
                return false;
        }
        
        return true;
    }

    public function readxls($file)
    {
        $this->load->library('excel');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;

        return $data;

/*      echo "<table>";
        foreach($data['header'][1] as $key => $value){
            echo "<th>".$value."</th>";
        }

        foreach($data['values'] as $datakey=>$datavalue)
        {
            echo "<tr>";
            foreach($datavalue as $key=>$value)
            {
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    */

    }
    
    /// Employee Management 
    
    
    
    /// Employee Manangement Ends
}
?>
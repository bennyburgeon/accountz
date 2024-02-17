<?php class Candidates_profile extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	  	if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');		
		if(!isset($_SESSION['reg_status']) || $_SESSION['reg_status']=='')$_SESSION['reg_status']=1;		
	}
	
	function editor($path,$width) 
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
	
	function index()
	{	
		$this->load->library('pagination');
		$this->data['limit']='100';
		$this->data['searchterm']='';
		$this->data['search_name']='';
		$this->data['search_email']='';
		$this->data['search_mobile']='';
		$this->data['reg_status']='1';
		$this->data['start']=0;
		$this->data['cur_job_status']='';
		$this->data['lead_source']='';
		$this->data['job_folder_id']='';
		$this->data['skills']='';
		$this->data['level_id']='';
		$this->data['course_id']='';
		$this->data['spcl_id']='';
		$this->data['exp_years']='';
		
		$this->data['job_cat_id']='';
		$this->data['func_id']='';
		$this->data['desig_id']='';
		$this->data['city_id']='';
		$this->data['pref_city_id']='';
		
		$this->data['expected_ctc_from']='';
		$this->data['expected_ctc_to']='';
		$this->data['notice_period_from']='';
		$this->data['notice_period_to']='';
		$this->data['total_experience_from']='';
		$this->data['total_experience_to']='';
		
		$this->data['payment_status']='';
		
		
		$this->data['rows']='';
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');


		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =50;
		}

		if($this->input->get('sort_by')!='')
		{
			$this->data['sort_by']=$this->input->get("sort_by");
		}
		else
		{
			$this->data['sort_by'] = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['rows']=$this->input->get("rows");
		}
		
		if($this->input->get('search_name'))
		{
			$this->data['search_name']=$this->input->get('search_name');
		}

		if($this->input->post('search_name'))
		{
			$this->data['search_name']=$this->input->post('search_name');
		}

		if($this->input->get('search_email'))
		{
			$this->data['search_email']=$this->input->get('search_email');
		}

		if($this->input->post('search_email'))
		{
			$this->data['search_email']=$this->input->post('search_email');
		}

		if($this->input->get('search_mobile'))
		{
			$this->data['search_mobile']=$this->input->get('search_mobile');
		}

		if($this->input->post('search_mobile'))
		{			
			$this->data['search_mobile']=$this->input->post('search_mobile');
		}
		
		if($this->input->get('reg_status')!='')
		{
			$this->data['reg_status']=$this->input->get('reg_status');
		}

		if($this->input->post('reg_status')!='')
		{
			$this->data['reg_status']=$this->input->post('reg_status');
		}
		
		if($this->input->get('skills'))
		{			
			$this->data['skills']	=	$this->input->get('skills');
		}	
		
		if($this->input->post('skills'))
		{
			$this->data['skills']	=	$this->input->post('skills');
		}
		//exp years		
		if($this->input->get('exp_years')!='')
		{
			$this->data['exp_years']	=	$this->input->get('exp_years');
		}	
		
		if($this->input->post('exp_years')!='')
		{
			$this->data['exp_years']	=	$this->input->post('exp_years');
		}
		
		//education level		
		if($this->input->get('level_id'))
		{
			$this->data['level_id']	=	$this->input->get('level_id');
		}	
		
		if($this->input->post('level_id'))
		{
			$this->data['level_id']	=	$this->input->post('level_id');
		}
		
		//course
		if($this->input->get('course_id'))
		{
			$this->data['course_id']	=	$this->input->get('course_id');
		}	
		
		if($this->input->post('course_id'))
		{
			$this->data['course_id']	=	$this->input->post('course_id');
		}
		
		if($this->input->get("cur_job_status")!='')
		{ 
			$this->data['cur_job_status']=$this->input->get("cur_job_status");
		}
		
		if($this->input->post("cur_job_status")!='')
		{ 
			$this->data['cur_job_status']=$this->input->post("cur_job_status");
		}
		
		if($this->input->get("lead_source")!='')
		{ 
			$this->data['lead_source']=$this->input->get("lead_source");
		}
		
		if($this->input->post("lead_source")!='')
		{ 
			$this->data['lead_source']=$this->input->post("lead_source");
		}

		if($this->input->get("job_folder_id")!='')
		{ 
			$this->data['job_folder_id']=$this->input->get("job_folder_id");
		}
		
		if($this->input->post("job_folder_id")!='')
		{ 
			$this->data['job_folder_id']=$this->input->post("job_folder_id");
		}
		
		//industry 
		if($this->input->get('job_cat_id'))
		{
			$this->data['job_cat_id']	=	$this->input->get('job_cat_id');
		}	
		
		if($this->input->post('job_cat_id'))
		{
			$this->data['job_cat_id']	=	$this->input->post('job_cat_id');
		}

		//industry 
		if($this->input->get('func_id'))
		{
			$this->data['func_id']	=	$this->input->get('func_id');
		}	
		
		if($this->input->post('func_id'))
		{
			$this->data['func_id']	=	$this->input->post('func_id');
		}
		
		if($this->input->get('desig_id'))
		{
			$this->data['desig_id']	=	$this->input->get('desig_id');
		}	
		
		if($this->input->post('desig_id'))
		{
			$this->data['desig_id']	=	$this->input->post('desig_id');
		}

		if($this->input->get('city_id'))
		{
			$this->data['city_id']	=	$this->input->get('city_id');
		}	
		
		if($this->input->post('city_id'))
		{
			$this->data['city_id']	=	$this->input->post('city_id');
		}

		if($this->input->get('pref_city_id'))
		{
			$this->data['pref_city_id']	=	$this->input->get('pref_city_id');
		}	
		
		if($this->input->post('pref_city_id'))
		{
			$this->data['pref_city_id']	=	$this->input->post('pref_city_id');
		}
		
		//exp salary from		
		if($this->input->get('expected_ctc_from'))
		{
			$this->data['expected_ctc_from']	=	$this->input->get('expected_ctc_from');
		}	
		
		if($this->input->post('expected_ctc_from'))
		{
			$this->data['expected_ctc_from']	=	$this->input->post('expected_ctc_from');
		}
		
		//exp salary to		
		if($this->input->get('expected_ctc_to'))
		{
			$this->data['expected_ctc_to']	=	$this->input->get('expected_ctc_to');
		}	
		
		if($this->input->post('expected_ctc_to'))
		{
			$this->data['expected_ctc_to']	=	$this->input->post('expected_ctc_to');
		}
		
		//notice period from		
		if($this->input->get('notice_period_from'))
		{
			$this->data['notice_period_from']	=	$this->input->get('notice_period_from');
		}	
		
		if($this->input->post('notice_period_from'))
		{
			$this->data['notice_period_from']	=	$this->input->post('notice_period_from');
		}
		
		//notice period to		
		if($this->input->get('notice_period_to'))
		{
			$this->data['notice_period_to']	=	$this->input->get('notice_period_to');
		}	
		
		if($this->input->post('notice_period_to'))
		{
			$this->data['notice_period_to']	=	$this->input->post('notice_period_to');
		}	
		
		//Experience from		
		if($this->input->get('total_experience_from'))
		{
			$this->data['total_experience_from']	=	$this->input->get('total_experience_from');
		}	
		
		if($this->input->post('total_experience_from'))
		{
			$this->data['total_experience_from']	=	$this->input->post('total_experience_from');
		}
		
		//Experience to		
		if($this->input->get('total_experience_to'))
		{
			$this->data['total_experience_to']	=	$this->input->get('total_experience_to');
		}	
		
		if($this->input->post('total_experience_to'))
		{
			$this->data['total_experience_to']	=	$this->input->post('total_experience_to');
		}
		
		
		if($this->input->get('payment_status'))
		{
			$this->data['payment_status']=$this->input->get('payment_status');
		}

		if($this->input->post('payment_status'))
		{
			$this->data['payment_status']=$this->input->post('payment_status');
		}		
		

					
		$this->data['total_rows']= $this->candidatesprofile_model->record_count($this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['cur_job_status'],$this->data['reg_status'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id'],$this->data['exp_years'],$this->data['lead_source'],$this->data['job_folder_id'],$this->data['job_cat_id'],$this->data['func_id'], $this->data['desig_id'], $this->data['city_id'], $this->data['pref_city_id'], $this->data['expected_ctc_from'], $this->data['expected_ctc_to'], $this->data['notice_period_from'], $this->data['notice_period_to'], $this->data['total_experience_from'], $this->data['total_experience_to'], $this->data['payment_status']);
			
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."candidates_profile/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name']."&search_email=".$this->data['search_email']."&search_mobile=".$this->data['search_mobile']."&"."cur_job_status=".$this->data['cur_job_status']."&reg_status=".$this->data['reg_status']."&skills=".$this->data["skills"]."&level_id=".$this->data["level_id"]."&course_id=".$this->data["course_id"]."&spcl_id=".$this->data["spcl_id"]."&exp_years=".$this->data["exp_years"]."&lead_source=".$this->data['lead_source']."&job_folder_id=".$this->data['job_folder_id']."&job_cat_id=".$this->data['job_cat_id']."&func_id=".$this->data['func_id']."&desig_id=".$this->data['desig_id']."&city_id=". $this->data['city_id']."&pref_city_id=".$this->data['pref_city_id']."&expected_ctc_from=".$this->data['expected_ctc_from']."&expected_ctc_to=".$this->data['expected_ctc_to']."&notice_period_from=".$this->data['notice_period_from']."&notice_period_to=".$this->data['notice_period_to']."&total_experience_from=".$this->data['total_experience_from']."&total_experience_to=".$this->data['total_experience_to']."payment_status=".$this->data['payment_status'];
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
		$config['num_links'] = 10;
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
	
		$this->data["records"] = $this->candidatesprofile_model->get_list($this->data['start'],$this->data['limit'],$this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['sort_by'],$this->data['cur_job_status'],$this->data['reg_status'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id'],$this->data['exp_years'],$this->data['lead_source'],$this->data['job_folder_id'],$this->data['job_cat_id'],$this->data['func_id'], $this->data['desig_id'], $this->data['city_id'], $this->data['pref_city_id'], $this->data['expected_ctc_from'], $this->data['expected_ctc_to'], $this->data['notice_period_from'], $this->data['notice_period_to'], $this->data['total_experience_from'], $this->data['total_experience_to'], $this->data['payment_status']);
			
		$this->load->model('candidatesprofile_model'); 
		
		$this->data['page_head']= 'Manage Candidates';		
		$this->data['formdata']=array('admin_id' =>'');
		$this->data['admin_users_lists']= $this->candidatesprofile_model->get_admin_users_lists();
		$this->data['all_jobs_list']= $this->candidatesprofile_model->all_jobs_list();
		
		$this->data["reg_status_list"] = $this->candidatesprofile_model->reg_status_list();
		
		// Technical Skils		
		$this->data['skill_list']=$this->candidatesprofile_model->get_parent_skills();
		
		$skills=array();
		
		if(!empty($this->data['skills']))
		{
			$this->data['skills']	=	explode(',',$this->data['skills']);
		}
		else{
				$this->data['skills']	= array();
			}
		
		foreach($this->data['skills'] as $skill)
		{
			$skills[]=$skill;
		}
		$this->data['candidate_skills']	=	$skills;

		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
			$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
			$this->data['res']	= $res	=	$qry->result_array();
			
			$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
			$this->data['res1']	= $res1 =	$qry1->result_array();
			
			$this->data['child_skills']	=	$this->candidatesprofile_model->get_child_skills($res1[0]['skill_id']);
		}

		//Education details
		$this->data["edu_level_list"] = $this->candidatesprofile_model->edu_level_list();
	
		
		if($this->data['level_id'] !='')
		{
			$this->data["edu_course_list"] = $this->coursemodel->get_course_list($this->data['level_id'],1);
		}
		else
		{
			$this->data["edu_course_list"]  = array('' => 'Course');
		}

		$this->data["city_list"]                  = $this->candidatesprofile_model->city_list();
		$this->data["pref_city_list"]             = $this->candidatesprofile_model->pref_city_list();
		$this->data["industry_list"]              = $this->candidatesprofile_model->industries_list();
		$this->data["department_list"]            = $this->candidatesprofile_model->functional_list();
		
		$this->data["department_list"]            = array('' => 'Select Department');
		$this->data["roles_list"]            = array('' => 'Select Designation');
		
		$this->data["roles_list"]                 = $this->candidatesprofile_model->fill_roles();
		
		
		$expected_ctc_from_array=array(''  =>  'CTC From', '5000'  =>  'INR 5000', '10000'  =>  'INR 10000', '15000'  =>  'INR 15000', '20000'  =>  'INR 20000', '25000'  =>  'INR 25000', '30000'  =>  'INR 30000', '35000'  =>  'INR 35000', '40000'  =>  'INR 40000', '45000'  =>  'INR 45000', '50000'  =>  'INR 50000', '55000'  =>  'INR 55000', '60000'  =>  'INR 60000', '60000'  =>  'INR 60000', '65000'  =>  'INR 65000', '70000'  =>  'INR 70000');
		 $this->data["expected_ctc_from_array"]  =$expected_ctc_from_array; 
		 
		$expected_ctc_to_array=array(''  =>  'CTC To', '10000'  =>  'INR 10000', '15000'  =>  'INR 15000', '20000'  =>  'INR 20000', '25000'  =>  'INR 25000', '30000'  =>  'INR 30000', '35000'  =>  'INR 35000', '40000'  =>  'INR 40000', '45000'  =>  'INR 45000', '50000'  =>  'INR 50000', '55000'  =>  'INR 55000', '60000'  =>  'INR 60000', '60000'  =>  'INR 60000', '65000'  =>  'INR 65000', '70000'  =>  'INR 70000');
		 $this->data["expected_ctc_to_array"]  =$expected_ctc_to_array;
		 
		  $notice_period_from_array=array(''  =>  'Notice From', '10'  =>  '10 DAYS',  '15'  =>  '15 DAYS', '20'  =>  '20 DAYS', '30'  =>  '30 DAYS', '45'  =>  '45 DAYS', '60'  =>  '60 DAYS', '75'  =>  '75 DAYS', '90'  =>  '90 DAYS');
		 $this->data["notice_period_from_array"]  =$notice_period_from_array; 
		 
		$notice_period_to_array=array(''  =>  'Notice To', '15'  =>  '15 DAYS', '20'  =>  '20 DAYS', '30'  =>  '30 DAYS', '45'  =>  '45 DAYS', '60'  =>  '60 DAYS', '75'  =>  '75 DAYS', '90'  =>  '90 DAYS');
		 $this->data["notice_period_to_array"]  =$notice_period_to_array; 
		 
		 $total_experience_from_array=array(''  =>  'Exp From', '0'  =>  'Fresher',  '1'  =>  '1 Year', '2'  =>  '2 Year', '3'  =>  '3 Year', '4'  =>  '4 Year', '5'  =>  '5 Year', '6'  =>  '6 Year', '7'  =>  '7 Year', '8'  =>  '8 Year', '9'  =>  '9 Year', '10'  =>  '10 Year');
		 $this->data["total_experience_from_array"]  =$total_experience_from_array; 
		 
		$total_experience_to_array=array(''  =>  'Exp To', '1'  =>  '1 Year', '2'  =>  '2 Year', '3'  =>  '3 Year', '4'  =>  '4 Year', '5'  =>  '5 Year', '6'  =>  '6 Year', '7'  =>  '7 Year', '8'  =>  '8 Year', '9'  =>  '9 Year', '10'  =>  '10 Year', '15'  =>  '15 Year');
		 $this->data["total_experience_to_array"]  =$total_experience_to_array;
		

		
		$this->data['job_folders']=$this->candidatesprofile_model->get_job_folders();
		$this->data['job_status_list']=$this->candidatesprofile_model->get_job_status();
		
		
		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_profile/candidateslist',$this->data);				
		$this->load->view('include/footer',$this->data);	
	}
		
	function add()
	{	
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');
		
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
			'title'                  => '',
			'first_name'             => '',
			'last_name'              => '',
			'username'               => '',
			'password'               => '',
			'cpassword'              => '',	
			'gender'                 => '1' ,
			'marital_status'         => '',	
			'mobile'                 => '',	
			'date_of_birth'          => '',
			'age'                    => '',
			'children'               => '',
			'course_id'              => '',
			'lead_source'            => '1',
			'reg_status'             => '1',
			'cur_job_status'         => '1',
			'lead_opportunity'       => '0',
			'city_id'                => '',
			'pref_city_id'           => '',
			'job_cat_id'             => '',
			'job_folder_id'          => '',
			'desig_id'               => '',
			'func_id'                => '',
			'level_study'            => '',
			'facebook_url'           => '',
			'linkedin_url'           => '',
			'current_ctc'            => '',
			'expected_ctc'           => '',
			'notice_period'          => '',
			'total_experience'       => '',
			'gcc_experience'         => '',
			'admin_id'               => '',
			'payment_status'         => '',
		);
		
		$this->data['job_folders']                =$this->candidatesprofile_model->get_job_folders();
		$this->data['job_status']                 =$this->candidatesprofile_model->get_job_status();
		
		$this->data["edu_course_list"]            = $this->candidatesprofile_model->edu_course_list();
		$this->data["level_list"]                 = $this->coursemodel->fill_levels();
		$this->data['admin_users_lists']          = $this->candidatesprofile_model->get_admin_users_lists();
		$this->data["reg_status_list"]            = $this->candidatesprofile_model->reg_status_list();
		$this->data['all_jobs_list']              = $this->candidatesprofile_model->all_jobs_list();
		
		$this->data["edu_level_list"]             = $this->candidatesprofile_model->edu_level_list();	
		$this->data["city_list"]                  = $this->candidatesprofile_model->city_list();
		$this->data["industry_list"]              = $this->candidatesprofile_model->industries_list();
		//$this->data["department_list"]            = $this->candidatesprofile_model->functional_list();
		$this->data["department_list"]            = array('' => 'Select Department');
		$this->data["roles_list"]                 = $this->candidatesprofile_model->fill_roles();

		$this->data["years_list"]                 = $this->candidatesprofile_model->years_list();
		$this->data["months_list"]                = $this->candidatesprofile_model->months_list();	
		
		$this->data['page_head']= 'Add Candidate';
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_profile/addcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}

	// add candidate
	function addCandidate(){

		$this->load->model('candidatesprofile_model');
		$this->load->library('upload');
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules('check_dups', 'Email Address', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			
			$id = $this->candidatesprofile_model->insert_candidate_record();
			if ($id != '') { 			
			
				if(isset($_FILES['cv_file'])){
					if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = 'uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
					
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $id,
								'upload_date' => date('Y-m-d'),
							);
							$this->candidatesprofile_model->insert_files($dataArr);
									$cv_file=1;
						}
					}
				}	
					
				if(isset($_FILES['client_cv_file'])){
					if (is_uploaded_file($_FILES['client_cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = 'uploads/client_cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
					
						if ($this->upload->do_upload('client_cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set client_cv_file='".$this->upload_file_name."' where candidate_id=".$id);
						}
					}
				}		
	
				if(isset($_FILES['photo']))
				{	
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{         
					$photo['upload_path'] = 'uploads/photos/';
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
				
					$this->upload->initialize($photo);
					if ($this->upload->do_upload('photo'))
					{
					
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$id);
					}
				}
			}	
			// insert designation
					$desig_id=$this->input->post('desig_id');
					if(is_array($desig_id))
					{
						foreach($desig_id as $key => $val)
						{
							$this->db->where('desig_id',$val);
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_designation');
							
							$data =array(
							'candidate_id'=> $id,
							'desig_id'=> $val,
							);
							$this->db->insert('pms_candidate_to_designation', $data);
						}			
					}

					// insert qualification 
					$level_id=$this->input->post('level_id');
					if(is_array($level_id))
					{
						foreach($level_id as $key => $val)
						{
							$this->db->where('level_id',$val);
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_edu_level');
							
							$data =array(
							'candidate_id'=> $id,
							'level_id'=> $val,
							);
							$this->db->insert('pms_candidate_to_edu_level', $data);
						}			
					}		
				
			//success
				$this->session->set_flashdata('msg','Candidate added successfully!');
				$status = array("STATUS" => "1", "SUCCESS_ID" => $id);
				echo json_encode($status);
			} 
			else { //failure
				$status = array("STATUS" => "0");
				echo json_encode($status);
			}
		}else
		{
			$status = array("STATUS" => "2", "SUCCESS_ID" => '0');
			echo json_encode($status);
		}
	}

	function update_candidate_profile()
	{
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidatesprofile_model');
			$age=$this->input->post('age');
			$candidate_id = $this->input->post('candidate_id');

			$age = $this->input->post('age');

		 	if($this->input->post('date_of_birth')!='' && $this->input->post('date_of_birth')!='0000-00-00') 
				$age = $this->get_age($this->input->post('date_of_birth'));

			$data_profile =array(
				'first_name'               => $this->input->post('first_name'),
				'gender'                   => $this->input->post('gender') ,
				'marital_status'           => $this->input->post('marital_status'),
				'mobile'                   => $this->input->post('mobile'),
				'age'                      => $age,
				'date_of_birth'            => $this->input->post('date_of_birth'),	
				'passportno'               => $this->input->post('passportno'),
				'visa_type_id'             => $this->input->post('visa_type_id'),
				'nationality'              => $this->input->post('nationality'),
				'city_id'                  => $this->input->post('city_id'),
				'skills'                   => '',
				'status_updated_on'        => date('Y-m-d'),
				'fee_comments'             => '',
				'driving_license'          => $this->input->post('driving_license'),
				'driving_license_country'  => $this->input->post('driving_license_country'),	
				'passport_nationality'     => $this->input->post('passport_nationality'),			
				'job_folder_id'            => $this->input->post('job_folder_id'),
				'cur_job_status'           => $this->input->post('cur_job_status'),
				'reg_status'            => 1,
				'payment_status'        => $this->input->post('payment_status') 
			);
			
			if($this->input->post('driving_license')=='0')$data_profile['driving_license_country']='';
			
			$data_job = array(
					'candidate_id'      => $candidate_id,
					'current_ctc'       => $this->input->post('current_ctc'),
					'expected_ctc'      => $this->input->post('expected_ctc'),
					'ctc_updated_on'    => date('Y-m-d'),
					'ctc_updated_by'    => $_SESSION['vendor_session'],
					'notice_period'     => $this->input->post('notice_period'),
					'total_experience'  => $this->input->post('total_experience'),
			);

			$this->candidatesprofile_model->update_candidate_record($candidate_id,$data_profile,$data_job);
			$this->candidatesprofile_model->update_role_designation($candidate_id, $this->input->post('desig_id'));
			$this->candidatesprofile_model->update_job_location($candidate_id, $this->input->post('pref_city_id'));	
			$this->candidatesprofile_model->update_industry($candidate_id, $this->input->post('job_cat_id'));	
			$this->candidatesprofile_model->update_functional_area($candidate_id, $this->input->post('func_id'));
			$this->candidatesprofile_model->update_qualification_level($candidate_id, $this->input->post('level_id'));
					
					
			redirect('candidates_profile/summary/'.$candidate_id.'?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
	}

	// Manage Summary & Reports
	function summary($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='summary';
	    $this->data['msg']='';
		
		$this->load->model('candidatesprofile_model');
		$this->load->model('countrymodel');
		
		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		
		if($this->input->get('del_cv')==1)$this->data['msg']='CV Deleted Successfully';
		if($this->input->get('del_photo')==1)$this->data['msg']='Photo Deleted Successfully';
		
		$this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		
		
		
		$this->data["formdata"]               = $this->candidatesprofile_model->get_single_record($candidate_id);		

		$this->data["formdata"]['desig_id']      = $this->candidatesprofile_model->get_role($candidate_id);
		$this->data["formdata"]['func_id']       = $this->candidatesprofile_model->get_functional_area($candidate_id);
		$this->data["formdata"]['job_cat_id']    = $this->candidatesprofile_model->get_industry($candidate_id);
		
		$this->data['job_folders']            = $this->candidatesprofile_model->get_job_folders();
		$this->data['visa_type_list']         = $this->candidatesprofile_model->visa_type_list();
		$this->data['job_status']             = $this->candidatesprofile_model->get_job_status();

		
		$this->data["roles_list"]      = $this->candidatesprofile_model->fill_roles();
		$this->data['candidate_roles'] =$this->candidatesprofile_model->candidate_roles($candidate_id);
		
		$this->data["edu_level_list"]   = $this->candidatesprofile_model->edu_level_list();
		$this->data['qualification_level'] =$this->candidatesprofile_model->qualification_level($candidate_id);
		
		$this->data['candidate_languages']    = $this->candidatesprofile_model->candidate_languages($candidate_id);
		$this->data['education_details']      = $this->candidatesprofile_model->education_deatils($candidate_id);
		
		$this->data['job_history']            = $this->candidatesprofile_model->job_list($candidate_id);
		$this->data['followup_history']       = $this->candidatesprofile_model->get_followup_detail($candidate_id);
		
		$this->data['all_calls']              = $this->candidatesprofile_model->all_calls($candidate_id);
	
		$this->data['all_messages']           = $this->candidatesprofile_model->all_messages($candidate_id);
		$this->data['all_notes']              = $this->candidatesprofile_model->all_notes($candidate_id);
	
		$this->data['candidate_skill']        = $this->candidatesprofile_model->candidate_skills($candidate_id);
		
		//candidate doamin knowledge
		$this->data['candidate_domain']       = $this->candidatesprofile_model->candidate_domains($candidate_id);
		$this->data['admin_user_list']        =$this->candidatesprofile_model->admin_user_list();
		//Certification 
		
		$this->data['cerifications']          =$this->candidatesprofile_model->get_cert();
		$candidate_certifications             = $this->candidatesprofile_model->candidate_certifications($candidate_id);
		
		$cerifications=array();
		
		foreach($candidate_certifications as $cert)
		{
			$cerifications[]=$cert['cert_id'];
		}
		
		$this->data['candidate_certifications_id']	=	$cerifications;
		$this->data['candidate_certifications']	    =	$candidate_certifications;
		
		$this->data['candidate_questionnaire_summary'] = $this->candidatesprofile_model->get_survey_result($candidate_id);
		$this->data['candidate_files_summary']         = $this->candidatesprofile_model->get_files($candidate_id);
		$this->data['candidate_complaints_summary']    = $this->candidatesprofile_model->ticket_list($candidate_id);

		//Job Search details(candidate_job_serach)
		$this->data['job_search'] = $this->candidatesprofile_model->job_search($candidate_id);		

		$this->data['skill_list']=$this->candidatesprofile_model->get_parent_skills();
		
		$candidate_skills = $this->candidatesprofile_model->candidate_skills($candidate_id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;
				
		//all child skills		
		$this->data['all_child_skills']	=	$this->candidatesprofile_model->child_skills();
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->candidatesprofile_model->get_language_set();
		$candidate_languages =$this->candidatesprofile_model->candidate_languages($candidate_id);
		
		$this->data['candidate_locations'] =$this->candidatesprofile_model->candidate_locations($candidate_id);
		$this->data['candidate_industries'] =$this->candidatesprofile_model->candidate_industries($candidate_id);
		$this->data['candidate_functional_areas'] =$this->candidatesprofile_model->candidate_functional_areas($candidate_id);
		$this->data['candidate_roles'] =$this->candidatesprofile_model->candidate_roles($candidate_id);
	
		$languages=array();
		foreach($candidate_languages as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		
		
		//Edit Education Modal
						
		$this->data["edu_level_list"]   = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidatesprofile_model->edu_years_list();
		
		//$this->data["edu_course_list"]  = $this->candidatesprofile_model->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Course');

		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();
		//Job History Modal
		
		//employment
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["functional_list"]            = array('' => 'Select Department');
		$this->data["roles_list"]      = $this->candidatesprofile_model->fill_roles();

		$this->data["country_list"] 	= $this->countrymodel->country_list();
		$this->data["nationality_list"] 	= $this->countrymodel->country_list();
		$this->data["current_location_list"] 	= $this->candidatesprofile_model->city_list();		
		
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();	
		
			
		//suggested jobs to candidate		
		$this->data['suggested_jobs']=$this->candidatesprofile_model->get_suggested_jobs($candidate_id);	
		//applied jobs of candidate		
		$this->data['applied_jobs']=$this->candidatesprofile_model->get_job_list($candidate_id);
		//shortlisted jobs
		$this->data['shortlisted']=$this->candidatesprofile_model->get_shortlisted($candidate_id);
		//interview scheduled jobs
		$this->data['interview_list']=$this->candidatesprofile_model->get_interview_list($candidate_id);
		//selected jobs
		$this->data['jobs_selected']=$this->candidatesprofile_model->jobs_selected($candidate_id);
		//offer letters issued
		$this->data['offer_letters_issued']=$this->candidatesprofile_model->offer_letters_issued($candidate_id);		
		//offer accepted
		$this->data['offer_accepted']=$this->candidatesprofile_model->offer_accepted($candidate_id);
		//invoice genereted
		$this->data['invoice_generated']=$this->candidatesprofile_model->invoice_generated($candidate_id);
		//all child skills		
		$this->data['all_child_skills']	=	$this->candidatesprofile_model->child_skills();
		//present contract details
		$this->data['contract']=$this->candidatesprofile_model->get_contract_detail($candidate_id);

		//contracts months	
		$this->data['contract_months']=array(
						'0' => 'Select Total Months',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						'32' => '32',
						'33' => '33',
						'34' => '34',
						'35' => '35',
						'36' => '36'
						);
		
/*--------------------------------------------------------------------------*/		
	//category 
		$category = $this->candidatesprofile_model->get_cat_fun_list($candidate_id);
		
		$cat_list=array();
		
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		$this->data['category_name']	=	$category;
		
		
	// funcional area
		$function = $this->candidatesprofile_model->get_cat_fun_list($candidate_id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		$this->data['function_name']	=	$function;
		
		
/*-----------------------------------------------------------------*/
		
//primary_skills
		$candidate_skills_primary = $this->candidatesprofile_model->candidate_skills_primary($candidate_id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary; 
		
		$this->data['skills_primary']	        =	$candidate_skills_primary;
	

//secondary skills
		$candidate_skills_secondary = $this->candidatesprofile_model->candidate_skills_secondary($candidate_id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
		$this->data['skills_secondary']	            =	$candidate_skills_secondary;

//Language Deatails pms_candidate_language
		$this->data['lang_details'] = $this->candidatesprofile_model->get_lang_details($candidate_id);
		

/*--------------------------------------------------------------------------*/
		
		if($this->input->post('candidate_id')!=''){
				foreach($this->input->post('admin_id') as $key => $val)
				{
					$this->db->where('admin_id',$val);
					$this->db->where('candidate_id',$this->input->post('candidate_id'));
					$this->db->delete('pms_admin_candidates');
					
						if($this->input->post('action')=='Add')
						{
							$data=array(
							'candidate_id'   =>$this->input->post('candidate_id'),
							'admin_id'        =>$val,
							'assigned_date'   => date('Y-m-d'),
							);			
							$this->db->insert('pms_admin_candidates',$data);
						}
				}
			redirect('candidates_profile/summary/'.$candidate_id);
		}

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
					
		$this->load->view("include/header",$this->data);
		//$this->load->view("include/candidate_sidebar",$this->data);
		
		$this->load->view("candidates_profile/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}
			
	// Edita Cnadidate
	function edit($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='profile';
		
		$this->data['candidate_id'] = $id;
		$this->data['formdata']=array(
			'title' => '',
			'first_name' => '',
			'last_name' => '',
			'username'=> '',
			'password'=> '',
			'cpassword'=> '',	
			'gender' => '1' ,
			'marital_status' => '',	
			'mobile' => '',		
			'date_of_birth' => '',
			'linkedin_url'  => '',
			'facebook_url'  => '',
			'age' => '',
			'children' => '',
			'course_id' => '',
			'lead_source' => '',
			'lead_opportunity' => '0',
			'level_study' => '',
		);
		$this->data['page_head']= 'Edit Profile';

//Loading Models
		$this->load->model('candidatesprofile_model');  
		$this->load->model('coursemodel'); 
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->load->model('visatypemodel');
		$this->load->model('jobsmodel');
		
		$this->data["formdata"] = $this->candidatesprofile_model->get_single_record($id);
	
//Certification and Technical Skilss
		
		$this->data['cerifications']=$this->jobsmodel->get_cert();
		$candidate_certifications = $this->candidatesprofile_model->candidate_certifications($id);
		
		$cerifications=array();
		foreach($candidate_certifications as $cert)
		{
			$cerifications[]=$cert['cert_id'];
		}
		$this->data['candidate_certifications']	=	$cerifications;

//skills
		
		$this->data['skill_list']=$this->candidatesprofile_model->get_parent_skills();
		
		$candidate_skills = $this->candidatesprofile_model->candidate_skills($id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;
		
		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		//all child skills		
		$this->data['all_child_skills']	=	$this->candidatesprofile_model->child_skills();
		//domain knowledge
		
		
		$this->data['job_folders']=$this->candidatesprofile_model->get_job_folders();
		
		$this->data['domain']=$this->candidatesprofile_model->get_domain();
		$candidate_domain = $this->candidatesprofile_model->get_domain_details($id);
		
		$domain=array();
		foreach($candidate_domain as $dom)
		{
			$domain[]=$dom['domain_id'];
		}
		$this->data['candidate_domain']	=	$domain;
		
//Planning Job Change Details
		$this->data["formdata8"] = $this->candidatesprofile_model->job_search($id);
		if(count($this->data["formdata8"])<1)
		{
			$this->data["formdata8"]['job_date']='';
			$this->data["formdata8"]['current_ctc']='';
			$this->data["formdata8"]['expected_ctc']='';
			$this->data["formdata8"]['notice_period']='';
			$this->data["formdata8"]['total_experience']='';
			$this->data["formdata8"]['present_location']='';
			$this->data["formdata8"]['preferred_location']='';
			$this->data["formdata8"]['immediate_join']='';
		}
		
//Language Deatils
		$this->data['lang_list']=$this->candidatesprofile_model->get_language_set();
		$candidate_certifications =$this->candidatesprofile_model->candidate_languages($id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
//Contact Details
		$location_id = $this->data['formdata']['current_location'];
		$query1=$this->db->query("select a.*,b.*,c.* from pms_locations a join pms_city b  on a.city_id = b.city_id inner join pms_state c  on c.state_id = b.state_id   where a.location_id=".$location_id);			
        $this->data['formdata2']=$query1->row_array();	
			
		if(!isset($this->data['formdata']['nationality'])) $this->data['formdata']['nationality'] = 0;
		if(!isset($this->data['formdata']['state']))$this->data['formdata']['state'] = 0;
		if(!isset($this->data['formdata']['city_id']))$this->data['formdata']['city_id'] = 0;
		
		$this->data["city_list"] = $this->cittymodel->city_list_by_state($this->data['formdata']['state']);
		$this->data["state_list"] = $this->statmodel->state_list($this->data['formdata']['nationality']);		
		$this->data["location_list"] = $this->locationmodel->location_list($this->data['formdata']['city_id']); 
		$this->data["country_list"] = $this->countrymodel->country_list_by_state_city_location();
		
		$this->data["formdata3"] = $this->candidatesprofile_model->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}

		//Passport Details
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatesprofile_model->country_list();
		$this->data["formdata4"] = $this->candidatesprofile_model->get_passport_single_record($id);

		//Education Details
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"] = $this->candidatesprofile_model->edu_years_list();
		//$this->data["edu_course_list"] = $this->candidatesprofile_model->edu_course_list();
		$this->data["edu_course_list"]  = array('' => 'Course');
		
		$this->data["edu_spec_list"]        = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"]        = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_coll_list"]        = $this->candidatesprofile_model->edu_coll_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();
		$this->data["formdata5"]            = $this->candidatesprofile_model->get_education_single_record($id);
		
		if(count($this->data["formdata5"])<1)
		{
				$this->data['formdata5']['level_id']         = '';
				$this->data['formdata5']['course_id']        = '';
				$this->data['formdata5']['spcl_id']          = '';
				$this->data['formdata5']['univ_id']          = '';
				$this->data['formdata5']['college_id']       = '';
				$this->data['formdata5']['edu_year']         = '';
				$this->data['formdata5']['edu_country']      = '';
				$this->data['formdata5']['course_type_id']   = '';
				$this->data['formdata5']['arrears']          = '';
				$this->data['formdata5']['absesnse']         = '';
				$this->data['formdata5']['repeat']           = '';
				$this->data['formdata5']['year_back']        = '';
				$this->data['formdata5']['mark_percentage']  = '';
				$this->data['formdata5']['grade']            = '';
		}
//Job Details
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["industry_list"] = $this->candidatesprofile_model->industry_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();
		$this->data["formdata6"] = $this->candidatesprofile_model->get_job_single_record($id);
		
		if(count($this->data["formdata6"])<1)
		{
			$this->data['formdata6']['organization'] = '';
			$this->data['formdata6']['job_cat_id'] = '';
			$this->data['formdata6']['designation'] = '';
			$this->data['formdata6']['func_id'] = '';
			$this->data['formdata6']['responsibility'] = '';
			$this->data['formdata6']['from_date'] = '';
			$this->data['formdata6']['to_date'] = '';
			$this->data['formdata6']['monthly_salary'] = '';
			$this->data['formdata6']['currency_id'] = '';
			$this->data['formdata6']['present_job'] = '';
			$this->data['formdata6']['exp_years'] = '';
			$this->data['formdata6']['exp_months'] = '';
			$this->data['formdata6']['skills'] = '';		
		}
		
//FILE DEATILS
		$this->data['survey_result']=$this->candidatesprofile_model->get_survey_result($id);
		$this->data["formdata7"] = $this->candidatesprofile_model->get_file_single_record($id);
		
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"],$this->data["formdata4"],$this->data["formdata5"],$this->data["formdata6"],$this->data["formdata7"],$this->data["formdata8"]);		
		
		// fetch profile data
		$this->data["formdata"]['profile_list'] = $this->candidatesprofile_model->profile_list($id);
		
		$this->data["edu_view"]	=	$this->educationDetails($id);
		$this->data["job_view"]	=	$this->jobDetails($id);
		
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_profile/editcandidates_auto_complete',$this->data);	
		$this->load->view('include/footer',$this->data);
	}

	function check_email(){
		
		$this->db->where('username', $this->input->post('email'));

		$query = $this->db->get('pms_candidate');
		$result	=	$query->row();
			
			if ($query->num_rows() != 0) { //avilable
				
				$status = array("STATUS" => "1", "candidate_id" => $result->candidate_id);
				echo json_encode($status);
			} 
			else { //doesn't exist
				$status = array("STATUS" => "0");
				echo json_encode($status);
			}
		
	}

	function download_cv_content($id=null)
	{
		$this->load->model('candidatesprofile_model');  
		$this->data["personal"] = $this->candidatesprofile_model->get_single_record($id);
		$file_text='';
		if($this->data["personal"]['cv_file']!='' && file_exists('uploads/cvs/'.$this->data["personal"]['cv_file']))
		{
			$ext = pathinfo('uploads/cvs/'.$this->data["personal"]['cv_file'], PATHINFO_EXTENSION);			
			if($ext=='doc')
			{
				$file_text=$this->read_doc('uploads/cvs/'.$this->data["personal"]['cv_file']);
			}else if($ext=='docx')
			{
				$file_text=$this->read_docx('uploads/cvs/'.$this->data["personal"]['cv_file']);
			}
			else if($ext=='pdf')
			{
				$file_text='<embed src="http://localhost/ats-main/manage/uploads/sample.pdf" width="1000px" height="2100px" />';
				//'uploads/cvs/'.$this->data["personal"]['cv_file']
			}
			echo $file_text;
		}
		exit();
	}

	function read_doc($file_name)  
	{
		
		$fileHandle = fopen($file_name, "r");
		$line = @fread($fileHandle, filesize($file_name));   
		$lines = explode(chr(0x0D),$line);
		$outtext = array();
		foreach($lines as $thisline)
		  {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE)||(strlen($thisline)==0))
			  {
			  } else {
				$outtext[]= trim(htmlspecialchars(strip_tags($thisline))).nl2br(' ');
			  }
		  }
		  $line_array= implode("<br>", $outtext);
		return $line_array;
	}

	function read_docx($file_name)
	{
			$striped_content = '';
			$content = '';
	
			$zip = zip_open($file_name);
	
			if (!$zip || is_numeric($zip)) return false;
	
			while ($zip_entry = zip_read($zip)) {
	
				if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
	
				if (zip_entry_name($zip_entry) != "word/document.xml") continue;
	
				$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
	
				zip_entry_close($zip_entry);
			}// end while
	
			zip_close($zip);
	
			$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
			$content = str_replace('</w:r></w:p>', "\r\n", $content);
			$striped_content = strip_tags($content);
			$striped_content = nl2br($striped_content);
			return $striped_content;
		}
				
	function loadContacthtml($id) {
        $this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->candidatesprofile_model->religion_list();

		$this->data['formdata']=array(
				'address' =>'',
				'mobile_prefix' =>'',
				'mobile' => '',
				'land_prefix' =>'',
				'land_phone' =>'',
				'work_prefix' => '',
				'workphone' =>'',
				'fax_prefix'=> '',
				'fax' => '',
				'zipcode' =>'',
				'nationality'=> '',
				'state' => '',
				'city_id' =>'',
				'current_location' =>'',
				'religion_id' =>'',

		);
        $this->load->view('candidates_profile/addcontactdetail', $this->data);
    }
	
	function skip_step2($candidateId){
		$this->load->model('candidatesprofile_model');
		//$this->candidatesprofile_model->insert_contact_detail_skip($candidateId);		
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	function step_back($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	function addCandidateDetail($candidateId)
	{
		$this->load->model('candidatesprofile_model');

		$id  = $this->candidatesprofile_model->insert_contact_detail($candidateId);
		$uid = $this->candidatesprofile_model->update_contact_detail($candidateId);

        if ($id > 0) 
		{ //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function loadPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('visatypemodel');
		$this->data["formdata"]=$this->candidatesprofile_model->get_passport_details($id);
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatesprofile_model->country_list();
		$this->load->view('candidates_profile/addpassportdetail', $this->data);
	}
	
	function skip_step3($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addPassportDetail($candidateId){
		$this->load->model('candidatesprofile_model');
		$uid = $this->candidatesprofile_model->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function loadEducationhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('countrymodel');
		
		$this->data['education']=array(
				'level_id'=> 0,
				'course_id' => 0,
				'spcl_id'=> 0,
				'univ_id' => 0,
				'edu_year' => '',
				'edu_country' => 0,
				'course_type_id' => 0,
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
				);
				
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"] = $this->candidatesprofile_model->edu_years_list();
		$this->data["edu_course_list"] = $this->candidatesprofile_model->edu_course_list();
		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();
		$this->load->view('candidates_profile/addeducationdetail',$this->data);
	}
	
	function skip_step4($candidateId){
		$this->load->model('candidatesprofile_model');
		//$this->candidatesprofile_model->insert_education_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addEducationDetail($candidateId)
	{
		print_r($_POST);
		exit();
		$this->load->model('candidatesprofile_model');
				$data = array(
				'candidate_id' => $candidateId,
				'level_id' => $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id' => $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'college_id' => $this->input->post('college_id'),
				'edu_year' => $this->input->post('edu_year'),
				'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => $this->input->post('arrears'),
				'absesnse' => $this->input->post('absesnse'),
				'repeat' => $this->input->post('repeat'),
				'year_back' => $this->input->post('year_back'),
				'mark_percentage' => $this->input->post('mark_percentage'),
				'grade' => $this->input->post('grade'),
		);
		
		$id  = $this->candidatesprofile_model->insert_education_detail($data);
		$view	=	$this->educationDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function loadJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industry_list"] = $this->candidatesprofile_model->industry_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();
		$this->load->view('candidates_profile/addjobdetail', $this->data);
	}
	
	function skip_step5($candidateId){
		$this->load->model('candidatesprofile_model');
		//$this->candidatesprofile_model->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function skip_step1($candidateId){
		$this->load->model('candidatesprofile_model');
		//$this->candidatesprofile_model->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}	
	
	function addJobDetail($candidateId)
	{
		$this->load->model('candidatesprofile_model');
		$id  = $this->candidatesprofile_model->insert_job_detail($candidateId);
		$uid = $this->candidatesprofile_model->update_job_detail($candidateId);
		$view	=	$this->jobDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }
	}
	
	function loadFilehtml($id)
	{
		if($id=='')exit();
	
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->view('candidates_profile/addfiledetail', $this->data);
	}

	// upload files from summary page.
	function upload_cv_photo($candidate_id)
	{
		$this->table_name='pms_candidate';
		$this->load->model('candidatesprofile_model');
		$this->load->library('upload');
		$candidate_id = $this->input->post('candidate_id');	
		if($candidate_id!='')
		{
			if(isset($_FILES['cv_file'])){
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
				{       				
					$config['upload_path'] = 'uploads/cvs/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
				
					if ($this->upload->do_upload('cv_file'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->candidatesprofile_model->insert_files($dataArr);
					}
				}
			}
			
			if(isset($_FILES['client_cv_file'])){
				if (is_uploaded_file($_FILES['client_cv_file']['tmp_name'])) 
				{       				
					$config['upload_path'] = 'uploads/client_cvs/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
				
					if ($this->upload->do_upload('client_cv_file'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set client_cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					}
				}
			}
			
			if(isset($_FILES['photo']))
			{	
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{         
					$photo['upload_path'] = 'uploads/photos/';
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
				
					$this->upload->initialize($photo);
					if ($this->upload->do_upload('photo'))
					{
					
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->candidatesprofile_model->insert_files($dataArr);
					}
				}
			}	
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id'));
		}else
		{
			redirect('candidates_profile');
		}		
	}

	function connect_with_jobs(){
		
		$this->load->model('candidatesprofile_model');
		$this->data['candidate_id']='';		
		$this->data["jobs_list"]=array();
		
		if($this->input->post("candidate_id")!='')
		{			
			$this->data['candidate_id']=$this->input->post("candidate_id");
			$this->data['candidate_profile']=$this->candidatesprofile_model->get_single_profile($this->data['candidate_id']);
			$this->data["jobs_list"] = $this->candidatesprofile_model->fill_job_list($this->data['candidate_id']);
			
			$this->data['candidate_locations'] =$this->candidatesprofile_model->candidate_locations($this->data['candidate_id']);
			$this->data['candidate_industries'] =$this->candidatesprofile_model->candidate_industries($this->data['candidate_id']);
			$this->data['candidate_functional_areas'] =$this->candidatesprofile_model->candidate_functional_areas($this->data['candidate_id']);
			$this->data['candidate_roles'] =$this->candidatesprofile_model->candidate_roles($this->data['candidate_id']);
			$this->data['job_search'] = $this->candidatesprofile_model->job_search($this->data['candidate_id']);
		}		
		
		$this->data['page_head'] = 'Jobs List';	
		$this->load->view('candidates_profile/get_connect_jobs',$this->data);			
	}
	
	function update_job_vacancy()
	{
		$this->load->model('candidatesprofile_model');		
		if($this->input->post("candidate_id")!='')
		{
			$job_id=$this->input->post("job_id");
			$candidate_id=$this->input->post("candidate_id");
			
			if(is_array($job_id))
			{	
				foreach($job_id as $key => $val)
				{
					$this->candidatesprofile_model->update_job_vacancy($candidate_id,$val);	
				}
				
				$response = array(
			    'data' => '',
				'status'=>'success',
				);			
				header('Content-type: application/json');
				echo json_encode($response);				
				exit();
			}else
			{				
				$response = array(
			    'data' => '',
				'status'=>'failed',
				);
				header('Content-type: application/json');
				echo json_encode($response);	
				exit();
			}				
		}
	}
	
	// add files
	function addfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidatesprofile_model');
		$this->load->library('upload');		
		$candidate_id = $this->input->post('candidate_id');	

		$survey_array=array();
		foreach($_POST as $key => $val)
		{
			if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
			{
				$key=str_replace('qt_','',$key);
				$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
			}
		}
		if(count($survey_array)>0)
		{
			$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_candidate_survey_result', $val);
			}
		}
			
		if(isset($_FILES['cv_file'])){
			if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
			{       				
				$config['upload_path'] = 'uploads/cvs/';
				$config['allowed_types'] = 'doc|docx|pdf|txt';
				$config['max_size']	= '0';
				$config['file_name'] = md5(uniqid(mt_rand()));
				$this->upload->initialize($config);	
			
				if ($this->upload->do_upload('cv_file'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];					
					$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->candidatesprofile_model->insert_files($dataArr);
				}
			}
		}
		
		if(isset($_FILES['photo'])){	
			if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
			{         
				$photo['upload_path'] = 'uploads/photos/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
			
				$this->upload->initialize($photo);
				if ($this->upload->do_upload('photo'))
				{
				
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];					
					$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->candidatesprofile_model->insert_files($dataArr);
				}
			}
		}	
		
	}

	
	
 //FETCHING ALL FUNCTIONS
	public function get_all_function_by_category() 
	{
		$keyword = $this->input->post('func');
		
			$result = $this->db->query(' SELECT a.* FROM pms_job_functional_area a  WHERE a.func_area LIKE "%'.$keyword.'%"  group by a.func_area  ORDER BY a.func_area ASC LIMIT 40')->result();
			//echo $this->db->last_query();
			
			$return = array();
				foreach( $result as $model ) 
				{
					$return[] = array(
								'label' => $model->func_area,
								'id'    => $model->func_id,			
								);
				}
		
		header('Content-type: application/json');
		die(json_encode($return));
	}
	
function profile_completion($candidateId)
	{ 
		$this->db->query("update pms_candidate set profile_completion=".$this->input->post('profile_completion')." where candidate_id=".$candidateId);

		redirect('candidates_profile/?upd=1');
		
	}
		
	function editCandidate(){
		$candidateId = $this->input->post('candidateId');
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->update_candidate_record($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	
	function get_age($birthday){ 
		$age = strtotime($birthday);
		
		if($age === false){ 
			return false; 
		} 
		
		list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
		
		$now = strtotime("now"); 
		
		list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
		
		$age = $y2 - $y1; 
		
		if((int)($m2.$d2) < (int)($m1.$d1)) 
			$age -= 1; 
			
		return $age; 
	} 
			
	function loadEditContacthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["religion_list"]    = $this->candidatesprofile_model->religion_list();
		
		
		$query=$this->db->query("select * from pms_candidate where candidate_id=".$id);			
		$this->data['formdata']=$query->row_array();
		
		$location_id = $this->data['formdata']['current_location'];
		
		$query1=$this->db->query("select a.*,b.*,c.* from pms_locations a join pms_city b  on a.city_id = b.city_id inner join pms_state c  on c.state_id = b.state_id   where a.location_id=".$location_id);			
        $this->data['formdata2']=$query1->row_array();	
			
		if(!isset($this->data['formdata']['nationality'])) $this->data['formdata']['nationality'] = 0;
		if(!isset($this->data['formdata']['state']))$this->data['formdata']['state'] = 0;
		if(!isset($this->data['formdata']['city_id']))$this->data['formdata']['city_id'] = 0;
		
		$this->data["city_list"] = $this->cittymodel->city_list_by_state($this->data['formdata']['state']);
		$this->data["state_list"] = $this->statmodel->state_list($this->data['formdata']['nationality']);		
		$this->data["location_list"] = $this->locationmodel->location_list($this->data['formdata']['city_id']); 
		$this->data["country_list"] = $this->countrymodel->country_list_by_state_city_location();
		
		$this->data["formdata3"] = $this->candidatesprofile_model->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"]);
        $this->load->view('candidates_profile/editcontactdetail', $this->data);

	}
	
	function editCandidateDetail($candidateId){
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	function loadEditPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatesprofile_model->country_list();
		$this->data["formdata"] = $this->candidatesprofile_model->get_passport_single_record($id);
		$this->load->view('candidates_profile/editpassportdetail', $this->data);
	}
	
	function editPassportDetail($candidateId)
	{
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->edit_passport_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	

	function loadEditEducationhtml()
	{
		$this->data['candidate_id'] =  $this->input->get('candidate_id');
		$this->data['edu_id'] =  $this->input->get('edu_id');
		$this->load->model('candidatesprofile_model');
		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->candidatesprofile_model->country_list();
		$this->data["edu_level_list"] = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"] = $this->candidatesprofile_model->edu_years_list();
		$this->data["edu_course_list"] = $this->candidatesprofile_model->edu_course_list();

		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();
		$this->data["formdata"] = $this->candidatesprofile_model->get_education_single_record($this->data['edu_id']);

		if(count($this->data["formdata"])<1)
		{
				$this->data['formdata']['level_id'] = '';
				$this->data['formdata']['course_id'] = '';
				$this->data['formdata']['spcl_id'] = '';
				$this->data['formdata']['univ_id'] = '';
				$this->data['formdata']['edu_year'] = '';
				$this->data['formdata']['edu_country'] = '';
				$this->data['formdata']['course_type_id'] = '';
				$this->data['formdata']['arrears'] = '';
				$this->data['formdata']['absesnse'] = '';
				$this->data['formdata']['repeat'] = '';
				$this->data['formdata']['year_back'] = '';
				$this->data['formdata']['mark_percentage'] = '';
				$this->data['formdata']['grade'] = '';
		}
		$data=$this->load->view('candidates_profile/editeducationdetail',$this->data,true);
		echo $data;
		exit();
	}
	
//EDUCATION DETAILS
	function educationDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		
		
		$edu_level = $this->candidatesprofile_model->edu_level_list();
		
		$course = $this->candidatesprofile_model->edu_course_list();

		$spec = $this->candidatesprofile_model->edu_spec_list();


		
		$results = $this->candidatesprofile_model->get_education_details($id);
		$form_data	=	array();
		
		foreach($results as $result)
		{ 
			$form_data[]	=	array(
								  'level_name'	=>	isset($edu_level[$result["level_id"]])?$edu_level[$result["level_id"]]:"",
								  'course_name'	=>	isset($course[$result["course_id"]])?$course[$result["course_id"]]:"",
								 'spec_name'	=>	isset($spec[$result["spcl_id"]])?$spec[$result["spcl_id"]]:"",
								 'grade'	=>	$result["grade"],
								 
								 'eucation_id'	=>	$result["eucation_id"],
								  );	

		}
		$this->data["form_data"]	=	$form_data;
		
		
		$education_details_view	=	$this->load->view('candidates_profile/education_details',$this->data,true);
		return $education_details_view;
	}

	function update_education()
	{
		$this->load->model('candidatesprofile_model');

		$data = array(
				'candidate_id'      => $this->input->post('candidate_id'),
				'level_id'          => $this->input->post('level_id'),
				'course_id'         => $this->input->post('course_id'),
				'spcl_id'           => $this->input->post('spcl_id'),
				'univ_id'           => $this->input->post('univ_id'),
				'edu_year'          => $this->input->post('edu_year'),
				'edu_country'       => $this->input->post('edu_country'),
				'course_type_id'    => $this->input->post('course_type_id'),
				'arrears'           => $this->input->post('arrears'),
				'absesnse'          => $this->input->post('absesnse'),
				'repeat'            => $this->input->post('repeat'),
				'year_back'         => $this->input->post('year_back'),
				'mark_percentage'   => $this->input->post('mark_percentage'),
				'grade'             => $this->input->post('grade'),
		);

		$this->candidatesprofile_model->update_education($data,$this->input->post('edu_id'),$this->input->post('candidate_id'));
//        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
		redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?edu_upd=1');
        //echo json_encode($status);
	}
		
	function editEducationDetail($candidateId)
	{
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->edit_education_detail($candidateId);
		
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function editJobChangeDetail($candidateId)
	{
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->edit_job_change_detail($candidateId);
		 $this->candidatesprofile_model->edit_passport_num_type($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditJobhtml()
	{
		$this->data['job_profile_id'] = $this->input->get('job_profile_id');
		$this->data['candidate_id'] = $this->input->get('candidate_id');
	
		$this->load->model('candidatesprofile_model');
		
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();
		$this->data["formdata"] = $this->candidatesprofile_model->get_job_single_record($this->data['job_profile_id']);

		if(count($this->data["formdata"])<1)
		{
			$this->data['formdata']['organization'] = '';
			$this->data['formdata']['job_cat_id'] = '';
			$this->data['formdata']['designation'] = '';
			$this->data['formdata']['func_id'] = '';
			$this->data['formdata']['responsibility'] = '';
			$this->data['formdata']['from_date'] = '';
			$this->data['formdata']['to_date'] = '';
			$this->data['formdata']['monthly_salary'] = '';
			$this->data['formdata']['currency_id'] = '';
			$this->data['formdata']['present_job'] = '';
			$this->data['formdata']['exp_years'] = '';
			$this->data['formdata']['exp_months'] = '';
			$this->data['formdata']['skills'] = '';		
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);

		$output_string=$this->load->view('candidates_profile/editjobdetail', $this->data,true);
		echo $output_string;
	}
	
		
//JOB DETAILS
	function jobDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		
		$industry_list = $this->candidatesprofile_model->industry_list();
		$functional_list = $this->candidatesprofile_model->functional_list();

		
		$results = $this->candidatesprofile_model->get_job_details($id);
		$form_data	=	array();
		
		foreach($results as $result)
		{ 
			$form_data[]	=	array(
								  'job_profile_id'	=>	$result["job_profile_id"],
								  'industry'	=>	isset($industry_list[$result["job_cat_id"]])?$industry_list[$result["job_cat_id"]]:"",
								  'function'	=>	isset($functional_list[$result["func_id"]])?$functional_list[$result["func_id"]]:"",
								
								 'organization'	=>	$result["organization"],
								 
								 'designation'	=>	$result["designation"],
								  );	

		}
		$this->data["form_data"]	=	$form_data;
		
		
		$job_details_view	=	$this->load->view('candidates_profile/job_details',$this->data,true);
		return $job_details_view;
	}

	function add_consultant_feedback($candidate_id)
	{
		$this->load->model('candidatesprofile_model');
		if($this->input->post('candidate_id')!='')
		{
			$this->data['candidate_id']=$this->input->post('candidate_id');

			$data=array(
				'candidate_id'            => $this->input->post('candidate_id'),
				'package_id'              => $this->input->post('package_id'),
				'current_ctc'             => $this->input->post('current_ctc'),
				'expected_ctc'            => $this->input->post('expected_ctc'),
				'notice_period'           => $this->input->post('notice_period'),
				'total_experience'        => $this->input->post('total_experience'),
				'ctc_updated_by'          => $_SESSION['vendor_session'],
				'feedback_education'      => $this->input->post('feedback_education'),
				'feedback_industry'       => $this->input->post('feedback_industry'),
				'feedback_skills'         => $this->input->post('feedback_skills'),
				'feedback_salary'         => $this->input->post('feedback_salary'),
				'feedback_general'        => $this->input->post('feedback_general'),
				'admin_id'                => $_SESSION['vendor_session'],
				'update_date'             => date('Y-m-d'),
				'maths_10th'              => $this->input->post('maths_10th'),
				'maths_12th'              => $this->input->post('maths_12th'),
				'maths_grad'              => $this->input->post('maths_grad'),
				'maths_post_grad'         => $this->input->post('maths_post_grad'),
			);
			
			$this->candidatesprofile_model->add_consultant_feedback($data,$this->data['candidate_id']);
			redirect('candidates_profile/');
		}
		exit();
	}
	
	function open_consultant_feedback($candidate_id)
	{
		$this->load->model('candidatesprofile_model');
		$this->data["package_list"]         = $this->candidatesprofile_model->fill_package();
		$this->data['candidate_id']         =$this->input->post('candidate_id');
		$this->data['feedback']             =$this->candidatesprofile_model->get_consultant_feedback($this->data['candidate_id']);
		$output_html                        =$this->load->view('candidates_profile/consultant_feedback',$this->data,true);	
		echo $output_html;
	}

	function add_candidates_notes($candidate_id)
	{
		$this->load->model('candidatesprofile_model');
		if($this->input->post('candidate_id')!='')
		{
			$this->data['candidate_id']=$this->input->post('candidate_id');
			$data=array(
				'candidate_id'   => $_POST['candidate_id'],
				'title'          => $_POST['title'],
				'note_date'      => date('Y-m-d'),
				'notes'          => $_POST['notes']
				);
			$this->candidatesprofile_model->add_candidates_notes($data);
			redirect('candidates_profile/');
		}
		exit();
	}
	
	function get_all_notes($candidate_id)
	{
		$this->load->model('candidatesprofile_model');
		$this->data['candidate_id']         = $this->input->post('candidate_id');
		$this->data['note_list']            =$this->candidatesprofile_model->select_all_notes($this->data['candidate_id']);
		$output_html                        = $this->load->view('candidates_profile/all_notes',$this->data,true);	
		echo $output_html;
	}

	function update_job_details()
	{
				$data = array(
				'candidate_id' => $this->input->post('candidate_id'),
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);

		//print_r($_POST);
		//exit();
		
		$this->load->model('candidatesprofile_model');
		
		$job_profile_id=$this->input->post('job_profile_id');
		$candidate_id=$this->input->post('candidate_id');
		
        $job_profile_id=$this->candidatesprofile_model->update_job_details($data,$job_profile_id,$candidate_id);
		
		redirect('candidates_profile/summary/'.$candidate_id.'?prof_upd=1');
		
        //$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        //echo json_encode($status);
	}

		
	function loadEditFilehtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatesprofile_model');
		$this->data['survey_result']=$this->candidatesprofile_model->get_survey_result($id);
		$this->data["formdata"] = $this->candidatesprofile_model->get_file_single_record($id);	

		$this->load->view('candidates_profile/editfiledetail', $this->data);
	}

	// edit files
	function editfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidatesprofile_model');
		$candidate_id = $this->input->post('candidate_id');		
		$this->load->library('upload');		

		$survey_array=array();
		foreach($_POST as $key => $val)
		{
			if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
			{
				$key=str_replace('qt_','',$key);
				$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
			}
		}
		
		if(count($survey_array)>0)
		{
			$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_candidate_survey_result', $val);
			}
		}
		
		if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'uploads/photos/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
				if ($this->upload->do_upload('photo'))
				{
				
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];	
					$query = $this->db->query("select photo from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}
				
					$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					
	
	$this->db->query("update pms_candidate_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['photo']."' and candidate_id=".$candidate_id);
				}
			}

			if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
			{       				
						$config['upload_path'] = 'uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];	
							
						$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
							unlink('uploads/cvs/'.$row['cv_file']);
						}
						$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$this->db->query("update pms_candidate_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['cv_file']."' ");
		
						}
			}	
		}	
		
		
		
		// import csv
	function import_csv()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;
        $config['upload_path'] = 'upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size']    = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite']  = 'TRUE';
        $config['file_name']  = date('Ymdhis');

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
			$this->load->view('include/header',$this->data);    
			$this->load->view('candidates_profile/import_csv',$this->data);                
			$this->load->view('include/footer',$this->data);        
        }
        else
        {
            $data = $this->upload->data();
            $this->fileName = $data['file_name'];
            $pathToFile = $config['upload_path'].$this->fileName;

            if( !file_exists( $pathToFile )) die( 'File could not be found at: ' . $pathToFile );
            $file = fopen($pathToFile,"r");

            $keys = fgetcsv($file);
            while (!feof($file)) {
                $contacts_data = fgetcsv($file);
				
                if(count($keys)!=count($contacts_data))
                {
                    continue;
                }
                else
                {
                    if(!empty($contacts_data))
                    {
                        $contacts[] = array_combine($keys, $contacts_data);
                    }
                }
            }
			
			
            for($i=0;$i<count($contacts);$i++)
			 {
               $res = $contacts[$i];
				if($res['mobile'] != '')
				{
						$qry	=	$this->db->query("select * from pms_candidate where mobile ='".$res['mobile']."'");
						$result	=	$qry->row_array(); 
						
							if(empty($result))
							{
								$data=array(
								'first_name' => $res['first_name'] ,
								'username'   => $res['username'] ,
								'password'   =>  md5($res['password']) ,
								'reg_date'   => date('Y-m-d'),
								'mobile'     => $res['mobile'] ,
								'date_of_birth' => date('Y-m-d', strtotime($res['date_of_birth'])),				
								'gender'     => $res['gender'],
								'marital_status' => $res['marital_status'],
								'reg_status'        => '1',
			                    'cur_job_status'    => '1',
								'status_updated_on'   => date('Y-m-d')
								);
								$id = $this->candidatesprofile_model->insert_csv_records($data);
								
								
								
								$data1=array(
								'candidate_id'   => $id,
								'current_ctc' => $res['current_ctc'] ,
								'expected_ctc' => $res['expected_ctc'] ,
								'notice_period' => $res['notice_period'] ,
								'total_experience' => $res['total_experience'],
								'ctc_updated_on'  => date('Y-m-d') 
								);
								$this->candidatesprofile_model->insert_csv_pre_jobdata($data1);
								
									
								
								$data2 = array(
								'candidate_id'      => $id,	
								'zipcode'  => $res['zipcode'],	
								'address'  => $res['address']							
								);							
								$this->candidatesprofile_model->insert_csv_address($data2);	
								
								
								/*$levels = explode('|',$res['levels']);
								
								for($j=0;$j<count($levels);$j++)								
								{								
									$data3 = array(
									'candidate_id' => $id,
									'level_id'     => (!empty($levels[$j]))?$this->check_levels('pms_education_level',$levels[$j]):'',									
									);									
									$this->candidatesprofile_model->insert_csv_levels($data3);
								}
								//print_r($data3); exit(); */
											
																
						}
						
				}
				
            }
			redirect('candidates_profile/?csv=1');
        }  
		      
    }
			

	
	

	// import csv
	function import_csv_linkedin()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;
        $config['upload_path'] = 'upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size']    = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite']  = 'TRUE';
        $config['file_name']  = date('Ymdhis');

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
			//$this->load->view('include/header',$this->data);    
			$this->load->view('candidates_profile/import_csv_linkedin',$this->data);                
			//$this->load->view('include/footer',$this->data);        
        }
        else
        {
		
            $data = $this->upload->data();
            $this->fileName = $data['file_name'];
            $pathToFile = $config['upload_path'].$this->fileName;

            if( !file_exists( $pathToFile )) die( 'File could not be found at: ' . $pathToFile );
            $file = fopen($pathToFile,"r");

            $keys = fgetcsv($file);
			
            while (!feof($file)) {
                $contacts_data = fgetcsv($file);
				
                if(count($keys)!=count($contacts_data))
                {
                    continue;
                }
                else
                {
                    if(!empty($contacts_data))
                    {
                        $contacts[] = array_combine($keys, $contacts_data);
                    }
                }
            }
			
            for($i=0;$i<count($contacts);$i++)
			 {
               $res = $contacts[$i];
				if($res['Email Address'] != '')
				{
					$qry	=	$this->db->query("select * from pms_candidate_new where username ='".$res['Email Address']."'");
					$result	=	$qry->row_array(); 
					
					if(empty($result))
					{
						$data=array(
						'username'   => $res['Email Address'] ,
						'password'   => md5('reset123'),
						'first_name' => $res['First Name'] ,
						'last_name'  => $res['Last Name'] ,
						'reg_date'   => date('Y-m-d'),
						);
					
						$id = $this->candidatesprofile_model->insert_csv_records($data);
						
						//data2 start
						$data2 = array(
						'candidate_id' => $id,
						'organization' => $res['Current Company'],
						'designation'  => $res['Current Position'],
						);
						$this->candidatesprofile_model->insert_csv_job($data2);
					}
				}
            }
			redirect('candidates_profile/import_csv_linkedin/?csv=1');
        }  
    }

	function check_profile_comapany()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;

		$qry = $this->db->query("select a.*,b.* from pms_candidate_job_profile a inner join pms_candidate b on a.candidate_id=b.candidate_id where a.company_id=0");
		
		$result	=	$qry->result_array(); 
		
		foreach($result as $key => $val)
		{
				$contact_name=$val['first_name'].' '.$val['last_name'];
				$contact_email=$val['username'];
				
				if(trim($val['organization']!=''))
				{
					$qry_comp	=	$this->db->query("select * from pms_company where company_name ='".addslashes($val['organization'])."'");
					$company_row	=	$qry_comp->row_array();
								
					$pos = strpos($val['designation'], 'CEO');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'partner');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'owner');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'founder');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'operation');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'director');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'entrepreneur');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					if(count($company_row)>0)
					{
						$company_id=$company_row['company_id'];
					}else
					{
						$company_list = array(
						'company_name' => $val['organization'],
						'contact_name' => $contact_name,
						'contact_email' => $contact_email,
						);
						$company_id=$this->candidatesprofile_model->insert_csv_company($company_list);
					}
					$this->db->query("update pms_candidate_job_profile set company_id=".$company_id." where job_profile_id=".$val['job_profile_id']);
				}				
		}
		exit();
    }
	
	function check_data()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;

		$qry = $this->db->query("select a.candidate_id from pms_candidate_new a inner join pms_candidate b on a.username=b.username order by a.candidate_id asc limit 0,500");
		
		$result	=	$qry->result_array(); 
		
		foreach($result as $key => $val)
		{
			$this->db->query("delete from pms_candidate_job_profile_new where candidate_id=".$val['candidate_id']);
			$this->db->query("delete from pms_candidate_new where candidate_id=".$val['candidate_id']);			
		}
		exit();
    }	

	function get_company_list()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;

		$qry = $this->db->query("select a.* from pms_candidate_new a limit 0,400");
		
		$result	=	$qry->result_array();
				
		foreach($result as $key => $val)
		{
			$qry	=	$this->db->query("select b.* from pms_candidate a inner join pms_candidate_job_profile b on a.candidate_id=b.candidate_id where a.username ='".$val['username']."' limit 0,10");
			$result_row	=	$qry->row_array();			
			print_r($result_row);
			//exit;
			
			$id='0';
			$company_id='';
			$contact_name='';
			$contact_email='';			
			$pos='';
			if(empty($result_row))
			{				
				$data=array(
				'username'   => $val['username'] ,
				'password'   => md5('reset123'),
				'first_name' => $val['first_name'] ,
				'last_name'  => $val['last_name'] ,
				'reg_date'   => date('Y-m-d'),
				);
				
				$id = $this->candidatesprofile_model->insert_csv_records($data);
					
				if(trim($val['company']!=''))
				{
					$qry_comp	=	$this->db->query("select * from pms_company where company_name ='".addslashes($val['company'])."'");
					$company_row	=	$qry_comp->row_array();
								
					$pos = strpos($val['designation'], 'CEO');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'partner');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'owner');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'founder');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'operation');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'director');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					$pos = strpos($val['designation'], 'entrepreneur');
					if ($pos !== false) 
					{
						$contact_name=$val['first_name'].' '.$val['last_name'];
						$contact_email=$val['username'];
					}

					if(count($company_row)>0)
					{
						$company_id=$company_row['company_id'];
					}else
					{
						$company_list = array(
						'company_name' => $val['company'],
						'contact_name' => $contact_name,
						'contact_email' => $contact_email,
						);										
						$company_id=$this->candidatesprofile_model->insert_csv_company($company_list);
					}
				}				


				$job_profile = array(
				'candidate_id' => $id,
				'company_id' => $company_id,
				'organization' => $val['company'],
				'designation'  => $val['designation'],
				);

				$this->candidatesprofile_model->insert_csv_job($job_profile);																
				$this->db->query("delete from pms_candidate_new where candidate_id=".$val['candidate_id']);							
			}
		}
		
    }

	function create_company_from_profile()
    {    
		$this->load->model('candidatesprofile_model');
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;

		$qry = $this->db->query("select a.*,b.* from pms_candidate_job_profile a inner join pms_candidate b on a.candidate_id=b.candidate_id where trim(a.organization)<> '' and designation like '%partner%' limit 0,100");
		
		$result	=	$qry->result_array(); 
		
		foreach($result as $key => $val)
		{
	
			if(strpos($val['designation'],'partner'))print_r($val);
			
			$qry	=	$this->db->query("select * from pms_company where company_name ='".htmlspecialchars($val['organization'])."'");
			$result_row	=	$qry->row_array();			
			if(empty($result_row))
			{
/*				$data=array(
				'username'   => $val['username'] ,
				'password'   => md5('reset123'),
				'first_name' => $val['first_name'] ,
				'last_name'  => $val['last_name'] ,
				'reg_date'   => date('Y-m-d'),
				);*/
					
				//$id = $this->candidatesprofile_model->insert_csv_records($data);
				
				//$this->db->query("delete from pms_candidate_job_profile_new where candidate_id=".$val['candidate_id']);
				//$this->db->query("delete from pms_candidate_new where candidate_id=".$val['candidate_id']);		
			}
		}
    }
				
	//common function for csv import
	
	function common($table_name,$field_value)
	{
		switch($table_name)
		{
			case "pms_education_level":
			$label = 'level_id';
			$field = 'level_name';
			break;
			
			case "pms_colleges":
			$label = 'college_id';
			$field = 'college_name';
			break;
			
			case "pms_candidate_certification":
			$label = 'cert_id';
			$field = 'cert_name';
			break;
			
			case "pms_candidate_domain":
			$label = 'domain_id';
			$field = 'domain_name';
			break;
			
			case "pms_languages":
			$label = 'lang_id';
			$field = 'lang_name';
			break;
			
			case "pms_job_category":
			$label = 'job_cat_id';
			$field = 'job_cat_name';
			break;
			
			case "pms_job_category":
			$label = 'job_cat_id';
			$field = 'job_cat_name';
			break;
		}
	
		 $qry	    =	$this->db->query("select ".$label." as id from ".$table_name." where ".$field." ='".$field_value."'");
		 $result	=	$qry->row_array(); 
		
			if (!empty($result))
			{
				return $result['id'];
			}
			else
			{
				$data =array(
						$field => $field_value	 
						);
				
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	//checking designation from csv 
	function check_course($table_name,$field_value,$desig_id)
	{
		$this->db->select('*');				
		$this->db->where('desig_name',$field_value);	
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				  	return $result['course_id'];
				
			}
			
			else
			{
				$data =array(
						'course_name' => $field_value	,
						'level_study' => $level_id
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
		
	}
	
	//checking functional area from csv 
	function check_fun_area($table_name,$field_value,$category_id)
	{
		$this->db->select('*'); 
		$this->db->where('func_area',$field_value);			
		$this->db->where('job_cat_id',$category_id);
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				return $result['func_id'];
			}
			else
			{
				$data =array(
						'func_area' => $field_value	,
						'job_cat_id'=> $category_id
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	//checking skills from csv 
	function check_levels($table_name,$field_value)
	{
		$this->db->select('*'); 
		$this->db->where('level_name',$field_value);			
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				return $result['level_id'];
			}
			else
			{
				$data =array(
						'level_name' => $field_value	,
						'level_status'=> 1,
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	// import xml
	function import_xml()
    {    
        $this->data['page_head'] = 'Import XML';
        $this->data['cur_page']=$this->router->class;
        if($_POST)
		{
			redirect('candidates_profile');
		}
		
			
		$this->load->view('include/header',$this->data);    
		$this->load->view('candidates_profile/import_xml',$this->data);                
		$this->load->view('include/footer',$this->data);        
		      
    }

	//Candidate View
	function candidate_view($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='follow_up';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);

		if($this->input->post('candidate_id')!='')
		{
				$data=array(
				'reg_status'      => $this->input->post('reg_status'),
				'fee_comments'    => $this->input->post('fee_comments'),
				'fee_date'        => $this->input->post('fee_date'),
				'fee_amount'      => $this->input->post('fee_amount')
				);
				
 			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update('pms_candidate', $data);
			   redirect('candidates_profile/candidate_view/'.$this->input->post('candidate_id'));
		}

		$this->data['list']               =$this->candidatesprofile_model->follow_record($candidate_id);
		$this->data['note_list']          =$this->candidatesprofile_model->notes_record($candidate_id);		
		$this->data['coe_list']           =$this->candidatesprofile_model->coe_list($candidate_id);
		$this->data['visa_approval_list'] =$this->candidatesprofile_model->visa_approval_list($candidate_id);

		$this->data['interview_list']     =$this->candidatesprofile_model->interview_record($candidate_id);
		$this->data['aplication_list']    =$this->candidatesprofile_model->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->candidatesprofile_model->interview_status_list();		
		
		$this->data['app_list']           =$this->candidatesprofile_model->aplication_list($candidate_id);
		$this->data['app_list_coe']       =$this->candidatesprofile_model->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']    =$this->candidatesprofile_model->admin_user_list();
		$this->data['interview_type_list']=$this->candidatesprofile_model->interview_type_list();
		$this->data['university_list']    =$this->candidatesprofile_model->university_list();
		$this->data['campus_list']        =array('' => 'Select Campus');
		$this->data['intake_list']        =$this->candidatesprofile_model->intake_list();
		$this->data['course_list']        =array('' => 'Select Course');;
		$this->data['level_list']         =$this->coursemodel->fill_levels();
		$this->data['status_list']        =$this->candidatesprofile_model->status_list();

		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_view",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	function remove_job_app()
	{
		$this->load->model('candidatesprofile_model');
		if($this->input->get('candidate_id')!='' && $this->input->get('job_id')!='')
		{
			$this->candidatesprofile_model->remove_job_app($this->input->get('candidate_id'),$this->input->get('job_id'));
			redirect('candidates_profile/summary/'.$this->input->get('candidate_id').'?upd=1');
		}else
		{
			echo 'No Details';
		}
	}
		
	
	// candidate programs
	function candidate_programs($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');
		
		$this->data['edit_mode']='';
		$this->data['app_id']='';

		$this->data['single_application']=array('univ_id' => '',
											'campus_id' => '',
											'level_study' => '',
											'course_id' => '',
											'candidate_course_id' => '',
											'intake_id' => '',
											'process_status_id' => '',
											'app_details' => '',
											'total_semester' => '',
											'fee_per_semester' => '',
											'annual_tution_fee' => '',
											'total_tution_fee' => '',
											 );
											 
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$data=array(
			'candidate_id'        => $this->input->post('candidate_id'),
			'campus_id'       =>  $this->input->post('campus_id'),
			'course_id'           => $this->input->post('course_id'),
			'intake_id'           =>  $this->input->post('intake_id'),
			'app_details'         => $this->input->post('app_details'),
			'process_status_id'   => $this->input->post('status_id'),	
			'candidate_course_id'   => $this->input->post('candidate_course_id'),
			'total_semester'      =>     $this->input->post('total_semester'),
			'fee_per_semester'    =>     $this->input->post('fee_per_semester'),
			'annual_tution_fee'   =>     $this->input->post('annual_tution_fee'),
			'created_by'          =>     $_SESSION['vendor_session'],
			'total_tution_fee'    =>     $this->input->post('total_tution_fee')
			);
			$this->db->where('app_id',$this->input->post('app_id'));
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->update('pms_candidate_applications',$data);

		// update suggestion logic from here
			$this->candidatesprofile_model->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here	
					
			redirect('candidates_profile/candidate_programs/'.$this->input->post('candidate_id').'/?upd=1');
		}

if($this->input->get('education')!='')
		{
			$this->data['single_application']['candidate_course_id']=$this->input->get('education');
		}
		if($this->input->get('univ_id')!='')
		{
			$this->data['single_application']['univ_id']=$this->input->get('univ_id');
		}

		if($this->input->get('campus_id')!='')
		{
			$this->data['single_application']['campus_id']=$this->input->get('campus_id');
		}
		if($this->input->get('campus_id')!='')
		{
			$this->data['single_application']['campus_id']=$this->input->get('campus_id');
		}
		if($this->input->get('course_id')!='')
		{
			$this->data['single_application']['course_id']=$this->input->get('course_id');
			$this->data['single_application']['app_details']=$this->candidatesprofile_model->create_program_name($this->data['single_application']['course_id']);
		}					

		if($this->input->get('level_study')!='')
		{
			$this->data['single_application']['level_study']=$this->input->get('level_study');
		}				
		
		$this->data['aplication_list']=$this->candidatesprofile_model->aplication_record($candidate_id); // application lists - 	
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id); // candidate details
		$this->data['university_list']=$this->candidatesprofile_model->university_list(); // university list		
		$this->data['intake_list']=$this->candidatesprofile_model->intake_list(); // intake list 		
		$this->data['level_list']=$this->coursemodel->fill_levels(); // education levels
		$this->data['status_list']=$this->candidatesprofile_model->status_list(); // application process status list
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['course_list']=array('' => 'Select Course');

		if($this->data['single_application']['univ_id']>0)
			$this->data['campus_list']=$this->candidatesprofile_model->campus_list($this->data['single_application']['univ_id']);
		if($this->data['single_application']['level_study']>0)
			$this->data['course_list']=$this->candidatesprofile_model->course_list_level($this->data['single_application']['level_study']);
			
		$this->data['candidate_qualification_list']=$this->candidatesprofile_model->candidate_qualification_list($candidate_id); 
		// candidate's qualification for higher studies
		// edit mode		
		if($this->input->get('app_id')!='')
		{
			$this->data['single_application']=$this->candidatesprofile_model->select_aplication_record($this->input->get('app_id'));
			if(count($this->data['single_application'])>0)
			{
				if($this->data['single_application']['univ_id']>0)$this->data['campus_list']=$this->candidatesprofile_model->campus_list($this->data['single_application']['univ_id']);
				if($this->data['single_application']['level_study']>0)$this->data['course_list']=$this->candidatesprofile_model->course_list_level($this->data['single_application']['level_study']);
				$this->data['app_id']=$this->input->get('app_id');
				$this->data['edit_mode']=1;
			}
		}
		// update program		
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates_profile/candidate_programs",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	// Create an application	
	function aplication()
	{
		// if no candidate id, exit from here. 
		$dataArr='Error';
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
	
		$this->load->model('candidatesprofile_model');
		
		$data=array(
		'candidate_id'        =>     $this->input->post('candidate_id'),
		'campus_id'           =>     $this->input->post('campus_id'),
		'app_created'         =>     date('Y-m-d'),
		'course_id'           =>     $this->input->post('course_id'),
		'intake_id'           =>     $this->input->post('intake_id'),
		'app_details'         =>     $this->input->post('app_details'),
		'process_status_id'   =>     $this->input->post('status_id'),
		'candidate_course_id' =>     $this->input->post('candidate_course_id'),	
		'total_semester'      =>     $this->input->post('total_semester'),
		'fee_per_semester'    =>     $this->input->post('fee_per_semester'),
		'annual_tution_fee'   =>     $this->input->post('annual_tution_fee'),
		'total_tution_fee'    =>     $this->input->post('total_tution_fee'),
		'created_by'          =>     $_SESSION['vendor_session'],
		'app_status'          =>   '0'
		);
		
		$this->db->insert('pms_candidate_applications',$data);
		
		$id=$this->db->insert_id();
		// update suggestion logic from here
		$this->candidatesprofile_model->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here
				
		$this->data['aplication_list']=$this->candidatesprofile_model->select_aplication_record($id);		
		
	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$this->input->post('candidate_id'));
		$row = $query->row_array();
		$subject = 'Application';

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='New program created successfully.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Course Name:'=> $this->data['aplication_list']['course_name'],
		'University '=> $this->data['aplication_list']['univ_name'],
		'Application Status' => $this->data['aplication_list']['status_name'],
		'Others' => $this->data['aplication_list']['app_details'],
		'Your Name: ' => $row['first_name'],
		'Your Mobile Number: ' => $row['mobile'],
		);
		// email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		// end here 
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear admin,',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		
		$dataArr = $this->load->view('candidates/candidate_aplication_list', $this->data,TRUE);	
		echo $dataArr;
		exit();		
	}

	// CoE entry.
	function candidate_coe($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

		$this->data['coe_list']=$this->candidatesprofile_model->coe_list($candidate_id);
		$this->data['app_list_coe']=$this->candidatesprofile_model->select_aplication_coe($candidate_id);
		$this->data['status_list']=$this->candidatesprofile_model->status_list();

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates_profile/candidate_coe",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	// CoE update on an application
	function create_coe(){
		
		// if no candidate id, exit from here. 
		$dataArr='Error';
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
		
		$this->load->model('candidatesprofile_model');

		$this->data=array(
		'process_status_id'       => $this->input->post('cand_app_id'),
		'coe_title'               => $this->input->post('coe_title'),
		'student_id'              => $this->input->post('student_id'),
		'course_code'             => $this->input->post('course_code'),		
		'annual_tution_fee'       => $this->input->post('annual_tution_fee'),
		'course_duration'         => $this->input->post('course_duration'),
		'course_commencement'     => $this->input->post('course_commencement'),
		'orientation_date'        => $this->input->post('orientation_date'),
		'start_date'              => $this->input->post('start_date'),
		'end_date'                => $this->input->post('end_date'),
		'course_details'          => $this->input->post('course_details'),	
		'app_status'              => '1',
		);
		
		$this->db->where('candidate_id', $this->input->post('candidate_id'));
		$this->db->where('app_id', $this->input->post('cand_app_id'));
		$this->db->update('pms_candidate_applications', $this->data); 
		
		// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*  FROM  pms_candidate a inner join pms_candidate_applications b on a.candidate_id=b.candidate_id inner join pms_courses c on b.course_id=c.course_id inner join pms_education_level d on c.level_study=d.level_id inner join pms_university_intake e on b.intake_id=e.intake_id where a.candidate_id =".$this->input->post('candidate_id')." and b.app_id=".$this->input->post('cand_app_id')." and b.app_status=1");
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='Certificate of Enrollment received for your program.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Certificate of Enrollment'   => $row['coe_title'],
		'Student ID'                  => $row['student_id'],
		'Course Code'                 => $row['course_code'],		
		'Annual Tution Fee'           => $row['annual_tution_fee'],
		'Course Duration'             => $row['course_duration'],
		'Course Commencement'         => $row['course_commencement'],
		'Orientation Date'            => $row['orientation_date'],
		'Start Date'                  => $row['start_date'],
		'End Date'                    => $row['end_date'],
		'Course Details'              => $row['course_details'],
		);
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
		exit();
	}

	//Candidate View
	function candidate_visa($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

		$this->data['visa_approval_list']=$this->candidatesprofile_model->visa_approval_list($candidate_id);
		$this->data['app_list_coe']=$this->candidatesprofile_model->select_aplication_visa($candidate_id);

		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/candidate_visa",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// VISA update on an application
	function create_visa(){

		$dataArr='Error';
		
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
	
		$this->load->model('candidatesprofile_model');

		$data=array(
		'app_id'             =>  $this->input->post('app_id'),
		'candidate_id'       =>  $this->input->post('candidate_id'),
		'visa_apprv_date'    =>  $this->input->post('visa_apprv_date'),		
		'travel_date'        =>  $this->input->post('travel_date'),
		'date_of_join'       =>  $this->input->post('date_of_join'),
		'sms_text'           =>  $this->input->post('sms_text'),
		'email_text'         =>  $this->input->post('email_text'),
		'comments'           =>  $this->input->post('comments'),
		'date_invoice'       =>  date('Y-m-d'),
		'app_won_by'         =>  $_SESSION['vendor_session'],
		);
	
		$this->db->insert('pms_candidate_visa_approval', $data); 
	
		$data=array(
		'app_status'              => '2',
		);

		$this->db->where('candidate_id', $this->input->post('candidate_id'));
		$this->db->where('app_id', $this->input->post('app_id'));
		$this->db->update('pms_candidate_applications', $data); 

		// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*  FROM  pms_candidate a inner join pms_candidate_applications b on a.candidate_id=b.candidate_id inner join pms_courses c on b.course_id=c.course_id inner join pms_education_level d on c.level_study=d.level_id inner join pms_university_intake e on b.intake_id=e.intake_id inner join pms_candidate_visa_approval f on b.app_id=f.app_id where a.candidate_id =".$this->input->post('candidate_id')." and b.app_id=".$this->input->post('app_id')." and b.app_status=2");
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='VISA approved.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Visa Approved Date'   => $row['visa_apprv_date'],
		'Travel Date'                  => $row['travel_date'],
		'Date of Join'                 => $row['date_of_join'],		
		'Details'           => $row['comments'],
		);
		
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
				
		exit();		
	}
	
	
// Manage Email & SMS
	function email_sms($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='email_sms';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		$this->data['email_sms_list']=$this->candidatesprofile_model->email_sms_list($candidate_id);
	
		if($this->input->post('send_type')!='')
		{
			$data=array(
			'candidate_id'   => $this->input->post('candidate_id'),
			'date_sent'      => date('Y-m-d H:i:s'),
			'subject'        => $this->input->post('subject'),
			'email_text'     => $this->input->post('email_text'),
			'sms_text'       => $this->input->post('sms_text'),
			'user_id'        => $_SESSION['vendor_session'],
			'send_type'      => $this->input->post('send_type'),
			);				
			$this->db->insert('pms_email_sms_history',$data);
			$id=$this->db->insert_id();

			// take all related data into the arary to send email and sms
			$query = $this->db->query("SELECT a.* FROM  pms_candidate a where a.candidate_id =".$this->input->post('candidate_id'));
			$row = $query->row_array();
			if($this->input->post('send_type')==2)
			{
				// SMS only
				$msg=$this->input->post('sms_text');
				$this->send_sms('9895251980',$row['first_name'],$msg);
			}elseif($this->input->post('send_type')==1)			
			{
				//Email Only
				$data =array(
				'Message'   => $this->input->post('email_text'),
				);
			
				//email to candidate
				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com',
					'email_to_name'          =>  $row['first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE Services',
					'email_reply_to'         =>  'info@abeservices.biz',
					'email_reply_to_name'    =>  'ABE Services',
					'subject'                =>  $this->input->post('subject'),
					'salutation'              =>  'Dear '.$row['first_name'].',',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  'You have a message from ABE services.',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);
				$this->send_email($email_array);
			}elseif($this->input->post('send_type')==3)
			{
				// sending SMS & Email

				$msg='Message From ABE.';
				$this->send_sms('9895251980',$row['first_name'],$msg);				
				$data =array(
				'Message'   => '',
				);
			
				//email to candidate
				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com',
					'email_to_name'          =>  $row['first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE Services',
					'email_reply_to'         =>  'info@abeservices.biz',
					'email_reply_to_name'    =>  'ABE Services',
					'subject'                =>  'New Program Selected',
					'salutation'              =>  'Dear '.$row['first_name'].',',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  'New program created, here is the details.',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);
				$this->send_email($email_array);
				//email function ends here.					
			}
			redirect('candidates_profile/email_sms/'.$candidate_id);
		}
		$this->data['error']="Fill subject and email content to send to the candidate.";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_email_sms",$this->data);
		$this->load->view("include/footer",$this->data);
	}
// Schedule an interview
	function interview(){
	
		if($this->input->post('candidate_id')=='')
		{
			echo 'Error';
			exit();
		}
		
		$data=array(
		'candidate_id'     => $this->input->post('candidate_id'),
		'interview_date'   => $this->input->post('interview_date'),
		'title'            => $this->input->post('title'),
		'description'      => $this->input->post('interview'),
		'duration'         => $this->input->post('duration'),
		'interview_time'   => $this->input->post('interview_time'),
		'interview_type_id'=> $this->input->post('interview_type'),
		'int_status_id'    => $this->input->post('interview_status'),
		'location'         => $this->input->post('location'),
		);

		$this->db->insert('pms_candidate_interviews',$data);
		$id=$this->db->insert_id();
		$this->load->model('candidatesprofile_model');
		$this->data['interview_list']=$this->candidatesprofile_model->select_interview_record($id);
		$dataArr = $this->load->view('candidates/candidateinterview_list', $this->data,TRUE);
	
	
	// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*  FROM  pms_candidate a where a.candidate_id =".$this->input->post('candidate_id'));
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='An interview scheduled from ABE srvices, please contact for further details.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Interview Date'        => $this->input->post('interview_date'),
		'Interview for'         => $this->input->post('title'),
		'Details'               => $this->input->post('interview'),		
		'Duration'              => $this->input->post('duration'),
		'Interview Time'        => $this->input->post('interview_time'),
		);
		
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'An Interview Scheduled',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'An interview scheduled, please find details below.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
		echo $dataArr;
		exit();
	}
	
	
	// Manage complaints
	function tickets($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='complaints';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

			$this->data['ticket_list']=$this->candidatesprofile_model->ticket_list($candidate_id);
		
			if($this->input->post('send_type')!='')
			{
				$data=array(
				'candidate_id'   => $this->input->post('candidate_id'),
				'ticket_date'      => date('Y-m-d H:i:s'),
				'ticket_title'        => $this->input->post('ticket_title'),
				'ticket_description'      => $this->input->post('ticket_description'),
				);
					
				$this->db->insert('pms_tickets',$data);
				$id=$this->db->insert_id();
				redirect('candidates_profile/tickets/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill appropriate details and send to candidates.";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_complaints",$this->data);
			$this->load->view("include/footer",$this->data);
	}
	

	// Manage Summary & Reports
	function invoice($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		$this->data['education_details'] = $this->candidatesprofile_model->education_deatils($candidate_id);
		$this->data['job_history'] = $this->candidatesprofile_model->job_list($candidate_id);
		$this->data['all_counselor'] = $this->candidatesprofile_model->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->candidatesprofile_model->candidate_counselor($candidate_id);

		if($this->input->post('candidate_id')!=''){
		
		foreach($this->input->post('admin_id') as $key => $val)
		{
			$this->db->where('admin_id',$val);
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->delete('pms_admin_candidates');
			
			if($this->input->post('action')=='Add')
			{
				$data=array(
				'candidate_id'   =>$this->input->post('candidate_id'),
				'admin_id'        =>$val,
				'assigned_date'=> date('Y-m-d'),
				);			
				$this->db->insert('pms_admin_candidates',$data);
			}
		}
			
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_profile/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_profile/candidate_invoice",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

		
	// Manage CV File
	function cvfile($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='profile_info';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->candidatesprofile_model->cvfile_list($candidate_id);
		
		if($this->input->post('cvfile')!=''){
			$data=array(
			'candidate_id'   =>$this->input->post('candidate_id'),
			'cv_file'        =>$this->input->post('cvfile'),
			);
			
			$this->db->insert('pms_candidate_cvfile',$data);
			$id=$this->db->insert_id();
			
			redirect('candidates_profile/cvfile/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '100%';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_profile/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_profile/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Job History
	function job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='job_history';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');


		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["industry_list"] = $this->candidatesprofile_model->industry_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();

		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);

		if($this->input->post('candidate_id')!=''){
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'monthly_salary' => $this->input->post('monthly_salary'),
						'currency_id' => $this->input->post('currency_id'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('candidates_profile/job_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	function job_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='job_history';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');


		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["industry_list"] = $this->candidatesprofile_model->industry_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();

		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);

		if($this->input->post('candidate_id')!=''){
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'monthly_salary' => $this->input->post('monthly_salary'),
						'currency_id' => $this->input->post('currency_id'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	function add_job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='job_history';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');

		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industries_list"] = $this->candidatesprofile_model->industries_list();
		$this->data["industry_list"] = $this->candidatesprofile_model->industry_list();
		$this->data["functional_list"] = $this->candidatesprofile_model->functional_list();
		$this->data["currecy_list"] = $this->candidatesprofile_model->currency_list();
		$this->data["years_list"] = $this->candidatesprofile_model->years_list();
		$this->data["months_list"] = $this->candidatesprofile_model->months_list();

		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);

		if($this->input->post('candidate_id')!=''){
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'monthly_salary' => $this->input->post('monthly_salary'),
						'currency_id' => $this->input->post('currency_id'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	// Manage Education History
	function edu_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='education';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');

		$this->data['formdata']=array(
				'level_id'=> '',
				'course_id' => '',
				'spcl_id'=> '',
				'univ_id' => '',
				'edu_year' => '',
				'edu_country' => '',
				'course_type_id' => '',
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
		);

		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"]   = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidatesprofile_model->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidatesprofile_model->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatesprofile_model->education_list($candidate_id);
		//print_r($this->data['cv_fileist']);
		//exit();
		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'level_id'     => $this->input->post('level_id'),
						'course_id'    => $this->input->post('course_id'),
						'spcl_id'      => $this->input->post('spcl_id'),
						'univ_id'      => $this->input->post('univ_id'),
						'edu_year'     => $this->input->post('edu_year'),
						'edu_country'  => $this->input->post('edu_country'),
						'course_type_id' => $this->input->post('course_type_id'),
						'arrears' => $this->input->post('arrears'),
						'absesnse' => $this->input->post('absesnse'),
						'repeat' => $this->input->post('repeat'),
						'year_back' => $this->input->post('year_back'),
						'mark_percentage' => $this->input->post('mark_percentage'),
						'grade' => $this->input->post('grade'),
				);

			$this->db->insert('pms_candidate_education', $data);
			redirect('candidates_profile/edu_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	function edu_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='education';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');

		$this->data['formdata']=array(
				'level_id'=> '',
				'course_id' => '',
				'spcl_id'=> '',
				'univ_id' => '',
				'edu_year' => '',
				'edu_country' => '',
				'course_type_id' => '',
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
		);

		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"]   = $this->candidatesprofile_model->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidatesprofile_model->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidatesprofile_model->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Course');

		$this->data["edu_spec_list"] = $this->candidatesprofile_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatesprofile_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatesprofile_model->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatesprofile_model->education_list($candidate_id);
		//print_r($this->data['cv_fileist']);
		//exit();
		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'level_id'     => $this->input->post('level_id'),
						'course_id'    => $this->input->post('course_id'),
						'spcl_id'      => $this->input->post('spcl_id'),
						'univ_id'      => $this->input->post('univ_id'),
						'edu_year'     => $this->input->post('edu_year'),
						'edu_country'  => $this->input->post('edu_country'),
						'course_type_id' => $this->input->post('course_type_id'),
						'arrears' => $this->input->post('arrears'),
						'absesnse' => $this->input->post('absesnse'),
						'repeat' => $this->input->post('repeat'),
						'year_back' => $this->input->post('year_back'),
						'mark_percentage' => $this->input->post('mark_percentage'),
						'grade' => $this->input->post('grade'),
				);

			$this->db->insert('pms_candidate_education', $data);
			//redirect('candidates_profile/edu_history/'.$this->input->post('candidate_id'));
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Lang History
	function lang_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='lang_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatesprofile_model->country_list();
		$this->data["formdata"] = $this->candidatesprofile_model->get_passport_single_record($candidate_id);
		
		
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->candidatesprofile_model->get_language_set();
		$candidate_certifications =$this->candidatesprofile_model->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		//employment
		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		
		if($this->input->post('candidate_id')!=''){

			   $this->candidatesprofile_model->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('candidates_profile/lang_history/'.$this->input->post('candidate_id'));
		}
		else
		{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_lang_history",$this->data);
			$this->load->view("include/footer",$this->data);


		}	
	}
	
	function lang_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='lang_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');

		if($this->input->post('candidate_id')!=''){

			   $this->candidatesprofile_model->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('candidates_profile/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_profile/candidate_lang_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Questionnaire
	function questionnaire($candidate_id)
	{
		$this->load->library('upload');
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['survey_result']=$this->candidatesprofile_model->get_survey_result($candidate_id);
		
		$this->data['cv_file']='';
		$this->data['photo_file']='';
		
		$cv_file=0;
		$photo_file=0;
		if($this->input->get('cv_file')==1)$this->data['cv_file']='CV Uploaded Successfully, please view it from summary page.';
		if($this->input->get('photo_file')==1)$this->data['photo_file']='Photo Uploaded Successfully, please view it from summary page.';
		
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);
		
		if($this->input->post('candidate_id')!='')
		{
				$survey_array=array();
				foreach($_POST as $key => $val)
				{
					if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
					{
						$key=str_replace('qt_','',$key);
						$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
					}
				}
				if(count($survey_array)>0)
				{
					$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
					foreach($survey_array as $item => $val)
					{
						$this->db->insert('pms_candidate_survey_result', $val);
					}
				}
					
				if(isset($_FILES['cv_file'])){
					if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = 'uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
					
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->candidatesprofile_model->insert_files($dataArr);
									$cv_file=1;
						}
					}
				}
				
				if(isset($_FILES['photo'])){	
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
					{         
						$photo['upload_path'] = 'uploads/photos/';
						$photo['allowed_types'] = 'png|jpg|jpeg|gif';
						$photo['max_size']	= '0';
						$photo['file_name'] = md5(uniqid(mt_rand()));
					
						$this->upload->initialize($photo);
						if ($this->upload->do_upload('photo'))
						{
						
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->candidatesprofile_model->insert_files($dataArr);
							$photo_file=1;
						}
					}
				}
			   redirect('candidates_profile/questionnaire/'.$this->input->post('candidate_id').'?cv_file='.$cv_file.'&photo_file='.$photo_file);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_profile/candidate_questionnaire",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

// tech skills

	function skills($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='tech_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('skill')))
			{
				$this->db->query("delete from pms_candidate_to_skills where candidate_id=".$candidate_id);
				foreach($this->input->post('skill') as $key => $val)
				{				
					$data=array('skill_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					
					$this->db->insert('pms_candidate_to_skills', $data);
				}
			}else
			{
				
				$this->db->query("delete from pms_candidate_to_skills where candidate_id=".$candidate_id);
				
			}
			   redirect('candidates_profile/skills/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['skill_list']=$this->candidatesprofile_model->get_skill_set();
		$this->data['skill_list_current']=$this->candidatesprofile_model->get_skill_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);
				
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add_certification($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		
		if($this->input->post('candidate_id'))
		{
			
			$this->candidatesprofile_model->insert_cert_details($this->input->post('candidate_id'));
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update certification here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function skills_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		
		if($this->input->post('candidate_id'))
		{
			
			$this->candidatesprofile_model->insert_skill_details($this->input->post('candidate_id'));
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
// certifications

function certifications($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='certification';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('certifications')))
			{
				$this->db->query("delete from pms_candidate_to_certification where candidate_id=".$candidate_id);
				foreach($this->input->post('certifications') as $key => $val)
				{				
					$data=array('cert_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					$this->db->insert('pms_candidate_to_certification', $data);
				}
			}else
			{
				$this->db->query("delete from pms_candidate_to_certification where candidate_id=".$candidate_id);
			}
			   redirect('candidates_profile/certifications/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['certifications_list']=$this->candidatesprofile_model->get_certifications_set();
		$this->data['certifications_list_current']=$this->candidatesprofile_model->get_certifications_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidatesprofile_model->job_list($candidate_id);
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/candidate_certifications",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// Follow up
	function followup()
	{
		$this->load->model('candidatesprofile_model');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'title'          =>$_POST['followup_title'],
			//'status_id'      =>$_POST['status_id'],
			//'app_id'         =>$_POST['app_id'],
			'admin_id'       => $_SESSION['vendor_session'],
			'description'    =>$_POST['followup_desc'],
			'flp_date'       => date('Y-m-d h:m:s A')
			);
			
			if($this->input->post('future_followup')==1)
			{
				$data['flp_date_reminder']=$_POST['flp_date_reminder'];
				$data['flp_time_reminder']=$_POST['flp_time_reminder'];
				$data['assigned_to']      =$_POST['assigned_to'];
			}

			$query1=$this->db->insert('pms_candidate_followup',$data);
			$id=$this->db->insert_id();
			
			if($this->input->post('future_followup')==1)
			{
				// insert into tasks table
				$data=array(
					'task_title'          =>  $_POST['followup_title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'          =>  date('Y-m-d'),
					'due_date'            =>  $_POST['flp_date_reminder'],
					'task_desc'           =>  $_POST['followup_desc'],
					'admin_id'            =>  $_POST['assigned_to'],
					//'project_id'          =>  $_POST['app_id'],
					'candidate_id'        =>  $_POST['candidate_id'],
					'candidate_follow_id' => $id,
				);			
				$query_task=$this->db->insert('pms_tasks',$data);				
			}
			
			
			/*$this->data['single_list']=$this->candidatesprofile_model->select_record($id);
		
			$dataArr = $this->load->view('candidates_profile/candidatefollowup_list', $this->data,TRUE);
			echo $dataArr;
			exit();
			
				$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
				$row = $query->row_array();
				$subject = 'Follow-up';
				$mail_body		=	'				';
				
				$name = $row['first_name']." ".$row['last_name'];
				$email = $row['username'];
				$this->load->library('email');
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('info@abeservices.biz',$name);
				$this->email->to($email);
				$this->email->subject($subject);
				$this->email->message($mail_body);
				if($this->email->send())
				{
					
					return 1;
				}
				else
				{
					return 0;
				}*/
			redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
		}	
		
	}
	
	
	// Create New Note
	function notes(){
		
	$data=array(
	'candidate_id'   =>$_POST['candidate_id'],
	'title'          =>$_POST['title'],
	'notes'          =>$_POST['note']
	);
	
	$this->db->insert('pms_candidate_notes',$data);
	$id=$this->db->insert_id();
	$this->load->model('candidatesprofile_model');
	$this->data['note_list']=$this->candidatesprofile_model->select_notes_record($id);
	$dataArr = $this->load->view('candidates_profile/candidatenotes_list', $this->data,TRUE);
	echo $dataArr;
	
	}

	// Create an application	
	function visa_approval(){
		$data=array(
		'candidate_id'        =>$_POST['candidate_id'],
		'campus_id'       =>$_POST['campus_id'],
		'course_id'           =>$_POST['course_id'],
		'intake_id'           =>$_POST['intake_id'],
		'app_details'         =>$_POST['app_details'],
		'process_status_id'   =>$_POST['status_id'],	
		);
		$this->db->insert('pms_candidate_applications',$data);
		 $id=$this->db->insert_id();
		$this->load->model('candidatesprofile_model');
		$this->data['aplication_list']=$this->candidatesprofile_model->select_aplication_coe($id);
		$dataArr = $this->load->view('candidates_profile/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'';
		
		$name = $row['first_name']." ".$row['last_name'];
		$email = $row['username'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@abeservices.biz',$name);
		$this->email->to('shaijotm@gmail.com');
		$this->email->subject($subject);
		$this->email->message($mail_body);
		if($this->email->send())
		{
			
			return 1;
		}
		else
		{
			return 0;
		}
	
	}
	
	// Drop Records from Follow up
	function drop(){
		 $candidate_follow_id=$_POST['candidate_follow_id'];
		
		$this->load->model('candidatesprofile_model');
		 $this->candidatesprofile_model->drop_record($candidate_follow_id);
		$dataArr = $this->load->view('candidates_profile/candidate_view');
		echo $dataArr;
	}
	
	function cvfile_drop(){
		$cvfile_id=$_POST['cvfile_id'];
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->cvfile_drop_record($cvfile_id);		          
	}

	function drop_job_item()
	{
		$job_profile_id=$this->input->post('job_profile_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_job_item($job_profile_id);
	}
	
	function deleteJobDetail($candidateId)
	{
		$job_id=$this->input->post('job_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_job_item($job_id);
		$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId,"VIEW"=>$view);
        echo json_encode($status);
	}

//DELETE EDUCATION DETAILS
	function deleteEducationDetail($candidateId)
	{
		$edu_id=$this->input->post('edu_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_edu_item($edu_id);
		$view	=	$this->educationDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId,"VIEW"=>$view);
        echo json_encode($status);
	}
	function drop_email_sms_item()
	{
		$email_sms_id=$this->input->post('email_sms_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_email_sms_item($email_sms_id);
	}

	function drop_ticket_item()
	{
		$ticket_id=$this->input->post('ticket_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_ticket_item($ticket_id);
	}
		
	function drop_edu_item(){
		$eucation_id=$this->input->post('eucation_id');
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->drop_edu_item($eucation_id);
	}	
	
	function drop_notes(){
		 $candidate_note_id=$_POST['candidate_note_id'];
		
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->note_drop_record($candidate_note_id);
		$dataArr = $this->load->view('candidates_profile/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_interviews(){
		 $interview_id=$_POST['interview_id'];
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->interview_drop_record($interview_id);
		$dataArr = $this->load->view('candidates_profile/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_aplication(){
		 $app_id=$_POST['app_id'];
		$this->load->model('candidatesprofile_model');
		$this->candidatesprofile_model->aplication_drop_record($app_id);
		$dataArr = $this->load->view('candidates_profile/candidate_view');
		echo $dataArr;
		          
	}
	
		
	function candidate_file($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='manage_file';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
	   if($this->input->post('title')!='')
	   {
   	
			 if(isset($_FILES['photo']))
			 {
					if(!$candidate_id='')
					{
						$this->load->model('candidatesprofile_model');
						$id=$this->candidatesprofile_model->insert_file($candidate_id);
						redirect('candidates_profile/candidate_file/'.$this->input->post('candidate_id'));
					}
			}
		}
		$this->data['file_list']=$this->candidatesprofile_model->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_profile/manage_files",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function csv_data_import($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);

	   if($this->input->post('title')!='')
	   {
			$items=split(',',$_POST['title']);
		
			foreach($items as $key => $val)
			{
				$data=array(		
				'city_id'=> 34,
				'zipcode'=> '',     
				'status'=> 1
				);
				
				$this->db->insert('pms_locations', $data);
				
				$id=$this->db->insert_id();
			
			echo '<pre>';
			echo '<code>';
			print_r($data);
			echo '</code>';
			echo '</pre>';
			
			$data=array(
			'location_id'=>$id,
			'location_name'=> trim($val),
			'language_id'=> '1'
			);
			
			$this->db->insert('pms_locations_description', $data);			


   			echo '<pre>';
			echo '<code>';
			print_r($data);
			echo '</code>';
			echo '</pre>';
			
			}
/*			echo '<pre>';
			echo '<code>';
			print_r($items);
			echo '</code>';
			echo '</pre>';*/

			 exit();
		}
		$this->data['file_list']=$this->candidatesprofile_model->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		
		$this->load->view("candidates_profile/csv_data_import",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function savefile()
	{
	   $candidate_id=$this->input->post('candidate_id');
	   if($this->input->post('title')!='')
	   {
		 if(isset($_FILES['photo']))
		 {
					if(!$candidate_id='')
					{
						$this->load->model('candidatesprofile_model');
						$id=$this->candidatesprofile_model->insert_file($candidate_id);
						$this->data['upload_list']=$this->candidatesprofile_model->get_one_record($id);
						$replay=$this->load->view("candidates_profile/upload_file",$this->data,TRUE);
						echo $replay;
					}
					else
					{
						redirect("candidates_profile/candidate_file");
					}
				}
			else{
				 echo "Choose file";
				}
	   }
	   else
	   {
		  echo "Enter Your Title"; 
	   }
	}

	function img_update(){
				  $candidate_id=$this->input->post('candidate_id');
	
	 if(isset($_FILES['photo'])){
						  $this->load->model('candidatesprofile_model');
						   $this->candidatesprofile_model->update_file($candidate_id);
	
							 $this->data['single_file']=$this->candidatesprofile_model->get_one_file($candidate_id);
	
								echo $this->data['single_file']['photo'];
	 }
	 else{
		 echo "Choose file"; 
		 }
	 }

	function deletefile()
	{
		  $id=$_POST['file_id'];
		if(!empty($id))
		{
			$this->db->where('file_id', $id);
			$this->db->delete('pms_candidate_files'); 
		}
	}
	
		function deletefile1()
	{
			 $id=$this->input->post('candidate_id');
		if(!empty($id))
		{
		
			          $this->load->model('candidatesprofile_model');
					   $this->candidatesprofile_model->delete_file($id);
					    $this->data['delete_file']=$this->candidatesprofile_model->delete_one_file($id);
						
                           echo $this->data['delete_file']['photo'];  //$replay=$this->load->view("candidates_profile/delete_file",$this->data,TRUE);
					         //echo $replay;
			
		}
	
	}

	function delete_cv($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink('uploads/cvs/'.$row['cv_file']);
				}
				$this->db->query("update  pms_candidate set cv_file='' where candidate_id=".$id);
			}
			redirect("candidates_profile/summary/".$id."?del_cv=1");
		}else
		{
			redirect("candidates_profile/summary/".$id);
		}
	}

	function delete_client_cv($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select client_cv_file from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/client_cvs/'.$row['client_cv_file']) && $row['client_cv_file']!='')
				{	
					unlink('uploads/client_cvs/'.$row['client_cv_file']);
				}
				$this->db->query("update  pms_candidate set client_cv_file='' where candidate_id=".$id);
			}
			redirect("candidates_profile/summary/".$id."?del_cv=1");
		}else
		{
			redirect("candidates_profile/summary/".$id);
		}
	}
	
	function candidate_delete()
	{
		$id = $this->input->get('candidate_id');
		$this->load->model('candidatesprofile_model');
		if(!empty($id))
		{
			$this->candidatesprofile_model->candidate_delete($id);
			redirect('candidates_profile/?del=1');
		}
	}

	function check_dups()
	{
		$this->db->where('username', $this->input->post('username'));
		//if($this->input->post('candidate_id') > 0)	$this->db->where('candidate_id !=', $this->input->post('candidate_id'));
		$query = $this->db->get('pms_candidate');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Username/Email already used.');
			return false;
		}
	}
	
	// Get Locations
	public function getstate()
	{
		$this->load->model('statmodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statmodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{
		$this->load->model('cittymodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->cittymodel->city_list_by_state($_POST['state_id']);
			$city	='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["city_list"] as $key=>$value)
			{
				$city.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'city_list' => $city);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

	public function getcampus()
	{
	
		$this->load->model('campusmodel');
		if(isset($_POST['univ_id']) && $_POST['univ_id']!='')
		{
			$data=array();
			$data["campus_list"] = $this->campusmodel->get_campus_list($_POST['univ_id']);
			$data = array('success' => true, 'campus_list' => $data["campus_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

// onchange get course
	public function getcourses()
	{		
		$this->load->model('coursemodel');
		if(isset($_POST['level_study']) && $_POST['level_study']!='' && isset($_POST['int_val']) && $_POST['int_val']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study'],$_POST['int_val']);			
			$course	='';
			foreach($data["course_list"] as $key=>$value)
			{
				$course.='<option value="'. $key .'">' . $value . '</option>';
			}			
			$data = array('success' => true, 'course_list' => $course);			
			//$data = array('success' => true, 'course_list' => $data["course_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
//onchange get function	
	public function getfunction()
	{		
		$this->load->model('candidatesprofile_model');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$data["function_list"] = $this->candidatesprofile_model->function_list_by_category($_POST['category_id']);
			$function	='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["function_list"] as $key=>$value)
			{
				$function.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'function_list' => $function);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

//onchange getlocation

	public function getlocation()
	{
		$this->load->model('locationmodel');
		if(isset($_POST['city_id']) && $_POST['city_id']!='')
		{
			$data=array();
			$data["location_list"] = $this->locationmodel->location_list($_POST['city_id']);
			$location	='';

			
			foreach($data["location_list"] as $key=>$value)
			{
				$location.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'location_list' => $location);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	// Assign Candidate
	public function assign_job()
	{
		$this->load->model('candidatesprofile_model');
		$candidatesArr	= $_POST['selectedArr'];
		$job_id		= $_POST['job_id'];
		
		for($i=0;$i<count($candidatesArr);$i++)
		{
			$id = $this->candidatesprofile_model->add_to_job($candidatesArr[$i],$job_id);
		}
		echo $id;
		exit;
	}
// send SMS
	public function send_sms($mobile,$first_name,$msg)
	{
			$otp=mt_rand(100000, 999999);
			$sms_text='Dear '.$first_name.', '.$msg;
			
			$sms_text=str_replace(' ','%20',$sms_text);
			$response=file_get_contents('http://sms.logicsms.in/api/sendmsg.php?user=abeservices&pass=grandstream2015&sender=ABECCH&phone='.$mobile.'&text='.$sms_text.'&priority=sdnd&stype=normal');
		  return;
	}
	
	
	// send email
	function send_email($email_array=array())
	{
				$mail_body=$this->load->view('signup/email_template', $email_array,true);
				$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/html; charset=iso-8859-1";
				$headers[] = "From: ".$email_array['from_name']." <".$email_array['email_from'].">";
				$headers[] = "Reply-To: ".$email_array['email_reply_to_name']." <".$email_array['email_reply_to'].">";
				$headers[] = "Subject: ".$email_array['subject'];
				$headers[] = "X-Mailer: PHP/".phpversion();
				//@mail($email_array['email_to'], $email_array['subject'], $mail_body, implode("\r\n", $headers));
				if(@mail($email_array['email_to'], $email_array['subject'], $mail_body, implode("\r\n", $headers)))
				{
				
					return 1;
				}
				else
				{
					return 0;}
	}
// email ends here	
	
	function change_status()
	{
		$this->load->model('candidatesprofile_model');
		$candidatesArr	= $_POST['selectedArr'];
		$cur_job_status		= $_POST['cur_job_status'];
		//$candidatesArr=array(0 => 10, 1 => 12);
		//$reg_status		= 4;
		for($i=0;$i<count($candidatesArr);$i++)
		{
				$data=array(
				'cur_job_status'=>  $cur_job_status
				);
			$this->db->where('candidate_id',$candidatesArr[$i]);
			$this->db->update('pms_candidate',$data);
		}		
		echo '1';
		exit;
	}

	function change_profile_status($id=null)
	{
		if($id=='')redirect('candidates_profile');
		if($this->input->get('reg_status')=='')redirect('candidates_profile');
		$this->db->query("update pms_candidate set reg_status=".$this->input->get('reg_status')." where candidate_id=".$id);
		redirect('candidates_profile?status=1');
	}
		
	function delete_photo($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select photo from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
				{
					unlink('uploads/photos/'.$row['photo']);
				}
				$this->db->query("update  pms_candidate set photo='' where candidate_id=".$id);
			}
			redirect("candidates_profile/summary/".$id."?del_photo=1");
		}else
		{
			redirect("candidates_profile/summary/".$id);
		}
	}

//DELETE PHOTO AJAX
	function photo_delete($candidateId)
	{
		if(!empty($candidateId))
		{
			$query = $this->db->query("select photo from pms_candidate where candidate_id=".$candidateId);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
				{
					unlink('uploads/photos/'.$row['photo']);
				}
				$this->db->query("update  pms_candidate set photo='' where candidate_id=".$candidateId);
			}
			$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        	echo json_encode($status);
		}else
		{
			$status = array("STATUS" => "0");
        	echo json_encode($status);
		}

	}

//DELETE CV AJAX
	function cv_delete($candidateId)
	{
		
		if(!empty($candidateId))
		{
			$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$candidateId);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink('uploads/cvs/'.$row['cv_file']);
				}
				$this->db->query("update  pms_candidate set cv_file='' where candidate_id=".$candidateId);
			}
			$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        	echo json_encode($status);
		}else
		{
			$status = array("STATUS" => "0");
        	echo json_encode($status);
		}
		
	}

//APPLY JOB
	function apply_job($candidateId,$jobId)
	{
		if($candidateId !='' && $jobId !='')
		{
		$this->load->model('candidatesprofile_model');
        $this->candidatesprofile_model->apply_job($candidateId,$jobId);
		}
		redirect("candidates_profile/summary/".$candidateId);
	}
	
	function editSkillCertificateDetail($candidateId)
	{ 
		$this->load->model('candidatesprofile_model');
	 	$id  = $this->candidatesprofile_model->insert_skill_details($candidateId);
		
		$id  = $this->candidatesprofile_model->insert_cert_details($candidateId);
		
		$id  = $this->candidatesprofile_model->insert_domain_details($candidateId);
		
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
//Send reset pwd link

	function resetpassword()
	{
			
		$qry	=$this->db->query('select * from pms_candidate where candidate_id='.$_POST['candidate_id']);
		$res	=	$qry->row_array();
		if(count($res)>0)
		{
			$qry1	=$this->db->query('select * from pms_password_change where candidate_id='.$_POST['candidate_id']);
			if($qry1->num_rows() > 0)
			{
				$unique_id = md5(uniqid($res["candidate_id"], true));
				$id = $_POST['candidate_id'];				
				$array=array(
					'unique_id'          => $unique_id,
					'candidate_id'       => $id,
					'status'             => 1
					);
				$this->db->where('candidate_id', $res["candidate_id"]);
				$this->db->update('pms_password_change', $array);	
			}
			else
			{
				$unique_id = md5(uniqid($res["candidate_id"], true));
				$id = $_POST['candidate_id'];				
				$array=array(
					'unique_id'          => $unique_id,
					'candidate_id'       => $id,
					'status'             => 1
					);
				
				$this->db->insert('pms_password_change', $array);	
			}
		
		
		$data =array(
		'Reset Password Link:'=>'http://recruitmenthub.net/candidate/resetpassword/?candidate_id='.$_POST['candidate_id'],
		
		);


// email to candidate
		$email_array=array(
			'email_to'               =>  $res['username'],
			'email_to_name'          =>  $res['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'Reset Password Link',
			'salutation'              =>  'Dear '.$res['first_name'].$res['last_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  '',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$status = $this->send_email($email_array);
		$response = array(
			    'data' => $status,
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	}
	
	//onchange get function by multiple	
	public function getfunction_multiple()
	{		
		$html='';
		$this->load->model('candidatesprofile_model');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$function_list = $this->candidatesprofile_model->function_list_by_category_multiple($_POST['category_id']);
			 
			$data = array('success' => true, 'function_list' => $function_list);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

//EDIT Category and functional area
	function editCategory($candidateId)
	{
		$this->load->model('candidatesprofile_model');
	 	$id  = $this->candidatesprofile_model->insert_functional($candidateId);
		redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
	}	

	
//EDIT PRIMARY AND SECONDARY SKILLS
	function editSkills($candidateId)
	{
		$this->load->model('candidatesprofile_model');
	 	$id  = $this->candidatesprofile_model->insert_skills($candidateId);
		redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
		
	}

//Add Contract Details

	function add_contract_details($candidateId){
		$this->load->model('candidatesprofile_model');
		$uid = $this->candidatesprofile_model->add_contract_detail($candidateId);
		redirect('candidates_profile/summary/'.$this->input->post('candidate_id').'?upd=1');
	}

	//print candidate Cv

	function print_cv($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		
		$this->data['page_head']= 'Profile';

		$this->load->model('candidatesprofile_model');  
	

		$this->data["personal"] = $this->candidatesprofile_model->get_single_record($id);
		$this->data['address'] = $this->candidatesprofile_model->get_address($id);
		$this->data['education'] = $this->candidatesprofile_model->education_list($id);
		$this->data['job_details'] = $this->candidatesprofile_model->get_job_details($id);
		$this->data['language_skills'] = $this->candidatesprofile_model->candidate_languages($id);
		$this->data['tech_skills'] = $this->candidatesprofile_model->candidate_skills($id);
		$this->data['certification'] = $this->candidatesprofile_model->candidate_certifications($id);
		$this->data['domain'] = $this->candidatesprofile_model->candidate_domains($id);
		$this->data['sports'] = $this->candidatesprofile_model->candidate_sports($id);
		$this->data['social'] = $this->candidatesprofile_model->candidate_social($id);
		$this->data['contract'] = $this->candidatesprofile_model->get_contract_detail($id);
		$this->data['formdata'] = $this->candidatesprofile_model->get_lang_details($id);

		$this->data["profile_list"] = $this->candidatesprofile_model->profile_list($id);
					

		//$this->load->view('include/header',$this->data);
		$this->load->view('candidates_profile/print_cv',$this->data);	
		//$this->load->view('include/footer',$this->data);
	}

	function download_cv($id=null)
	{
		$this->load->model('candidatesprofile_model');  
		$this->data["personal"] = $this->candidatesprofile_model->get_single_record($id);
		if($this->data["personal"]['cv_file']!='' && file_exists('uploads/cvs/'.$this->data["personal"]['cv_file']))
		{
			
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($this->data["personal"]['cv_file']).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('uploads/cvs/'.$this->data["personal"]['cv_file']));
			readfile('uploads/cvs/'.$this->data["personal"]['cv_file']);
			exit;
		}
		exit();
	}
		
//GET CANDIDATE EDUCATION
	function get_candidate_education()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidatesprofile_model');
		
		
		$education_details = $this->candidatesprofile_model->education_deatils($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($education_details))
		{
			
			$html1 ='<td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Education</h3></div></td>';
									
			
			$html2='<td colspan="2" align="center" valign="top" class="borderTopNone"> 
    
            			<table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
						  
						  <thead>
						  <tr>
							<th>Level of study</th>
							<th>Course</th>
							<th>Arrears</th>
							<th>Absense</th>
							<th>Repeat</th>
							<th>Year Back</th>
							<th>Percenage</th>
							<th>Action</th>
						  </tr></thead><tbody>';
						
					 foreach($education_details as $key => $val)
					 {
						 
						
						$html2.='<tr>
									<td>'.$val['level_name'].'</td>
									<td>'. $val['course_name'].'</td>
									<td>'. $val['arrears'].'</td>
									<td>'.$val['absesnse'].'</td>
									<td>'. $val['repeat'].'</td>
									<td>'. $val['year_back'].'</td>
									<td>'.  $val['mark_percentage'].'</td>
									<td><a href="javascript:;"  data-url="'.base_url().'candidates_profile/delete_candidate_edu/?id='.$val['eucation_id'].'" id="delete_candidate_edu" class="btn btn-danger btn-xs">Delete</td>
         		 				</tr>';
								
						}
						
						$html2.=' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//delete candidate education	
	function delete_candidate_edu()
	{
		
		$id     = $this->input->get('id');	
		
		$this->load->model('candidatesprofile_model');		
		
		if($this->input->get('id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_education WHERE eucation_id ="'.$id.'" ' );					
			redirect('candidates_profile/summary/'.$this->input->get('candidate_id').'?upd=1');
		}
	}
	
	
	//GET CANDIDATE PROFESSIOANL DETAILS
	function get_candidate_professional()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidatesprofile_model');
		
		
		$job_history = $this->candidatesprofile_model->job_list($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($job_history))
		{
			
			$html1 ='<td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Professional Summary</h3></div></td>';
									
			
			$html2=' <td colspan="2" align="center" valign="top" class="borderTopNone">
					<table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
						<thead>
						  <tr>
							<td>Organization</td>
							<td>Designation</td>
							<td>Resp.</td>
							<td>From</td>
							<td>To</td>
							<td>Salary</td>
							<td>Job Industry</td>
							<td>Job Category</td>
							<td>Fun. Area</td>
							<td>Action</td>
						  </tr></thead><tbody>';
						
					 foreach($job_history as $key => $val)
					 {	
					 	if($val['present_job']==1)
						{
							$date= date('Y-m-d'); 
						}
						else
						{ 
							$date=$val['to_date'];
						}
						 
						
						$html2.=' <tr>
									<td>'.$val['organization'].'</td>
									<td>'.$val['designation'].'</td>
									<td>'.$val['responsibility'].'</td>
									<td>'. $val['from_date'].'</td>
									<td>'.$date.'</td>
									<td>'.$val['monthly_salary'].'</td>
									<td>'.$val['job_cat_name'].'</td>
									<td>'.$val['job_cat_name'].'</td>
									<td>'. $val['func_area'].'</td>
                  
									<td><a href="javascript:;"  data-url="'.base_url().'candidates_profile/delete_candidate_prof/?id='.$val['job_profile_id'].'" id="delete_candidate_prof" class="btn btn-danger btn-xs">Delete</td>
         		 				</tr>';
								
						}
						
						$html2.=' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//delete candidate Professional details	
	function delete_candidate_prof()
	{
		
		$job_id     = $this->input->get('id');	
		$candidate_id     = $this->input->get('candidate_id');
		
		$this->load->model('candidatesprofile_model');		
		
		if($this->input->get('id')!='')
		{

			$result = $this->db->query('DELETE FROM pms_candidate_job_profile WHERE job_profile_id ="'.$job_id.'" ' );		
					
			$response = array(
			
				'status'=>'success',
			
			);
		}
		
		redirect('candidates_profile/summary/'.$candidate_id );
			
		
	}
	
	//GET CANDIDATE PRESENT CONTRACT
	function get_present_contract()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidatesprofile_model');
		
		
		$contract = $this->candidatesprofile_model->get_contract_detail($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($contract))
		{
			
			if($contract['present_status'] == 1)
			{
				$status = 'No Job';
			}
			else if($contract['present_status'] == 2)
			{
				$status = 'Not interested in Job Change';
			}
			else if($contract['present_status'] == 3)
			{
				$status = 'Need a change';
			}
			else if($contract['present_status'] == 4)
			{
				$status = 'Call me after 1 year';
			}
			else if($contract['present_status'] == 5)
			{
				$status = 'Call me after thsi month';
			}
			else 
			{
				$status = '';
			}
			
			$html1 ='<td colspan="2" align="center" valign="top"><br />Present Contract Details</td>';
									
			
			$html2='  <td colspan="2" align="center" valign="top">
						<table width="95%" border="1" cellspacing="3" cellpadding="3">
						
							<tr>
							<td bgcolor="#CCCCCC">Start Date</td>
							<td bgcolor="#CCCCCC">End Date</td>
							<td bgcolor="#CCCCCC">Total Months</td>
							<td bgcolor="#CCCCCC">Total Experience</td>
							<td bgcolor="#CCCCCC">Present Status</td>
							<td bgcolor="#CCCCCC">Action</td>
							</tr>';
					
						
			$html2.=' <tr>
							<td>'.$contract['start_date'].'</td>
							<td>'.$contract['end_date'].'</td>
							<td>'.$contract['total_months'].'</td>
							<td>'. $contract['total_exp'].'</td>   
							<td>'. $status.'</td>   
							<td><a href="javascript:;"  data-url="'.base_url().'candidates_profile/delete_candidate_contract/?id='.$contract['candidate_id'].'" id="delete_candidate_contract" >Delete</td>
						</tr>';
								
					
						
		    $html2.= ' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//DELETE PRESENT CONTRACT	
	function delete_candidate_contract()
	{
		$id     = $this->input->get('id');	
		$this->load->model('candidatesprofile_model');		
		if($this->input->get('id')!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_contract WHERE candidate_id ="'.$id.'" ' );				
			redirect('candidates_profile/summary/'.$this->input->get('candidate_id').'?upd=1');	
		}
	}
	
//DELETE CANDIDATE FOLLOWUP	
	function delete_candidate_followup()
	{
		$id     = $this->input->get('id');	
		$this->load->model('candidatesprofile_model');		
		if($this->input->get('id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_followup WHERE candidate_follow_id ="'.$id.'" ' );	
			redirect('candidates_profile/summary/'.$this->input->get('candidate_id').'?upd=1');	
		}
		//header('Content-type: application/json');    					
		//echo json_encode($response);
	}
	
// Manage Email 

	function manage_email($candidate_id)
	{
		
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='email_sms';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatesprofile_model');
		$this->data['detail_list'] = $this->candidatesprofile_model->detail_list($candidate_id);
		$this->data['email_sms_list']=$this->candidatesprofile_model->email_sms_list($candidate_id);
	
		if($candidate_id!='')
		{
			$data=array(
			'candidate_id'   => $candidate_id,
			'date_sent'      => date('Y-m-d'),
			'subject'        => '',
			'email_text'     => $this->input->post('email_text'),			
			'user_id'        => $_SESSION['vendor_session'],			
			);				
			$this->db->insert('pms_email_sms_history',$data);
			$id=$this->db->insert_id();
		}

		if($candidate_id!='')
		{
			$data=array(
			'candidate_id'      => $candidate_id,
			'message_date'      => date('Y-m-d'),
			'message_time'      => time(),
			'message_title'     => '',
			'message_text'      => $this->input->post('email_text'),			
			'message_status'    => 0,	
			'admin_id'          => $_SESSION['vendor_session'],		
			);
			$this->db->insert('pms_candidate_messages',$data);
			$id=$this->db->insert_id();
		}
				
			// take all related data into the arary to send email and sms
			$query = $this->db->query("SELECT a.* FROM  pms_candidate a where a.candidate_id =".$candidate_id);
			$row = $query->row_array();
			
				//Email Only
				$data =array(
				'Message'   => $this->input->post('email_text'),
				);
				
				//email to candidate
				$email_array=array(
					'email_to'               =>  $row['username'],
					'email_to_name'          =>  $row['first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  'info@Test.biz',
					'from_name'              =>  'Test Services',
					'email_reply_to'         =>  'info@Test.biz',
					'email_reply_to_name'    =>  'Test Services',
					'subject'                =>  $this->input->post('subject'),
					'salutation'              =>  'Dear '.$row['first_name'].',',
					'table_head'             =>  'Test Services',
					'text_before_table'      =>  'You have a message from Test services.',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  ' Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);
			//$status = $this->send_email($email_array);
			//redirect('jobs/?update=1'
			redirect('candidates_profile/summary/'.$candidate_id );
		
	}
	function client_cv()
	{		
		if($this->input->post('candidate_id')!='')
		{
			$candidate_id    =   $this->input->post('candidate_id');			
			if($candidate_id < 1)exit();		
			$html_profile='<iframe width="100%;" scrolling="yes" height="800px;" src="'.$this->config->item('client_cv_preview').'profile_rms?candidate_id='.md5($candidate_id).'"></iframe>';			 
			echo $html_profile;
			exit();
		}else
		{
			exit();
		}
	}
	
	function client_cv_doc()
	{
			$this->load->model('candidatesprofile_model'); 

		if($this->input->post('candidate_id')!='')
		{			
			$candidate_id    =   $this->input->post('candidate_id');
			$this->data["personal"] = $this->candidatesprofile_model->get_candidate_profile($candidate_id);
			if($this->data["personal"]['cv_file']!='' && file_exists('uploads/cvs/'.$this->data["personal"]['cv_file']))
			if($this->data["personal"]['cv_file']!='')
			{
				$out_put_str='';
 				$file_name=base_url().'uploads/cvs/'.$this->data["personal"]['cv_file'];
				  $out_put_str.='<iframe width="1100px;" scrolling="yes" height="800px;" src="https://docs.google.com/viewer?url='.urlencode($file_name).'&embedded=true"></iframe>';

				echo $out_put_str;
				exit();
			}else
			{
				echo 'Could not find client CV, please upload it.';
				exit();
			}
		}
			
	}
	
	public function get_functional_by_industry()
	{
		$this->load->model('candidatesprofile_model');
		if(isset($_POST['job_cat_id']) && $_POST['job_cat_id']!='')
		{
			$data=array();
			$data["func_list"] = $this->candidatesprofile_model->get_functional_by_industry($_POST['job_cat_id']);
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function get_designation_by_functional()
	{
		$this->load->model('candidatesprofile_model');
		if(isset($_POST['func_id']) && $_POST['func_id']!='')
		{
			$data=array();
			$data["desig_list"] = $this->candidatesprofile_model->get_designation_by_functional($_POST['func_id']);
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	function pre_screening(){
		
		$this->load->model('candidatesprofile_model');
		$this->data['candidate_id']='';		
		$this->data["jobs_list"]=array();
		
		if($this->input->post("candidate_id")!='')
		{			
			$this->data['candidate_id']=$this->input->post("candidate_id");
			$this->data['pre_screening']=$this->candidatesprofile_model->get_pre_screening($this->data['candidate_id']);
			$this->data['admin_list'] = $this->candidatesprofile_model->admin_recruiters_list();
			$this->data['company_list'] = $this->candidatesprofile_model->company_list();
			$this->data["jobs_list"] = $this->candidatesprofile_model->fill_job_list($this->data['candidate_id']);
		}		
		
		$this->data['page_head'] = 'Jobs List';	
		$this->load->view('candidates_profile/pre_screening',$this->data);			
	}
	
	
	function add_pre_screening()
	{
		if($this->input->post('pre_screen_date')!='')
	$pre_screen_date= date("Y-m-d",strtotime($this->input->post('pre_screen_date')));
		else
			$pre_screen_date='';
			
		if($this->input->post('arrival_date')!='')
	$arrival_date= date("Y-m-d",strtotime($this->input->post('arrival_date')));
		else
			$arrival_date='';
		
		$this->load->model('candidatesprofile_model');		
		if($this->input->post("candidate_id")!='')
		{
			$candidate_id=$this->input->post("candidate_id");
			$pre_screen_id=$this->input->post("pre_screen_id");
			
			
			$data =array(
			    'candidate_id'                 => $this->input->post("candidate_id"),
				'admin_id'                     => $this->input->post('admin_id'),
				'company_id'                   => $this->input->post('company_id') ,
				'pre_screen_date'              => $pre_screen_date,
				'pre_screen_time'              => $this->input->post('pre_screen_time'),
				'pre_screen_venue'             => $this->input->post('pre_screen_venue'),
				'arrival_date'                 => $arrival_date,	
				'knowledge_level'              => $this->input->post('knowledge_level'),	
				'pre_screen_feedback'          => $this->input->post('pre_screen_feedback'),	
				'feedback_status'              => $this->input->post('feedback_status'),
				 
			);
			$this->data['admin_list'] = $this->candidatesprofile_model->admin_recruiters_list();
			$this->data['company_list'] = $this->candidatesprofile_model->company_list();
			
			$data1 =array(
			    'candidate_id'                 => $this->input->post("candidate_id"),
				'payment_status'               => $this->input->post('payment_status'),
								 
			);
			$this->candidatesprofile_model->update_payment_status($data1, $this->input->post("candidate_id"));
			
			
			if($this->input->post("pre_screen_id")!='' && $this->input->post("candidate_id")!='')
				
			{
				$this->candidatesprofile_model->update_pre_screening($data, $this->input->post('pre_screen_id'), $this->input->post("candidate_id"));
				redirect('candidates_profile/');
				
			}
			else
			{
				$this->candidatesprofile_model->add_pre_screening($data);
				redirect('candidates_profile/');
			}
		 }
		
		exit();
	}	
	
}
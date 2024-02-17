<?php 
class Curjobstatus extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	
	}
	function editor($path,$width) {
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
	function index($offset = 0)
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=15;
		 }
		$rows='';
		$this->load->model('curjobstatusmodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->curjobstatusmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/curjobstatus/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = $this->data['total_rows'];
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
		
		// paging ends here
		$this->data["records"] = $this->curjobstatusmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Job Status';		
		$config['base_url'] = base_url().'index.php/curjobstatus/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('curjobstatus/list',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$data['formdata']=array(
		'cur_job_status_name'=> '',
		);
		$this->load->model('curjobstatusmodel');		
		if($this->input->post('cur_job_status_name'))
		{
			$this->form_validation->set_rules('cur_job_status_name', 'Language Name', 'required');
			$this->form_validation->set_rules('cur_job_status_name_dup', 'Language Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->curjobstatusmodel->insert_record();
				redirect('curjobstatus/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'cur_job_status_name'=>$this->input->post('cur_job_status_name'),
				);
		}
		$data['page_head']= 'Add Language Name';
		$this->load->view('include/header');
		$this->load->view('curjobstatus/add',$data);	
		$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('curjobstatusmodel');

			$data['page_head']= 'Edit Language Name';
			$this->db->where('cur_job_status', $id);
			$query=$this->db->get('pms_cur_job_status');
			$data['formdata']=$query->row_array();
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	

			$this->load->view('include/header');
			$this->load->view('curjobstatus/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Language Name';
		$this->load->model('curjobstatusmodel');
		$id=$this->input->post('cur_job_status');
		if(!empty($id))
		{
			if($this->input->post('cur_job_status_name'))
			{
				
				$this->form_validation->set_rules('cur_job_status_name', 'Language Name Name', 'required');
				$this->form_validation->set_rules('cur_job_status_name_dup', 'Language Name Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->curjobstatusmodel->update_record($id);
						redirect('curjobstatus/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'cur_job_status'=>$id,
						'cur_job_status_name'=>$this->input->post('cur_job_status_name'),
						);

						$this->load->view('include/header');
						$this->load->view('curjobstatus/edit',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('curjobstatus');
			}			
		}else
		{
			redirect('curjobstatus');
		}
	}
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id))
		{
			$this->db->where('cur_job_status', $id);
			$this->db->delete('pms_cur_job_status'); 
			redirect('curjobstatus/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('cur_job_status', $val);
					$this->db->delete('pms_cur_job_status'); 
				}
			redirect('curjobstatus/?rows='.$rows.'&del=1');
		}
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('curjobstatusmodel');
			$this->curjobstatusmodel->delete_multiple_record($id_arr);
			redirect('curjobstatus/?rows='.$rows.'&del=1');
		}
		else{
			redirect('curjobstatus');
		}
	}
	function check_dups()
	{
		$this->db->where('cur_job_status_name', $this->input->post('cur_job_status_name'));
		if($this->input->post('cur_job_status') > 0)	$this->db->where('cur_job_status !=', $this->input->post('cur_job_status'));
		$query = $this->db->get('pms_cur_job_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Language name already used.');
			return false;
		}
	}
}
?>
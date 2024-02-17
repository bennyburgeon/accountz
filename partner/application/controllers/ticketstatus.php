<?php 
class Ticketstatus extends CI_Controller {

	function Ticketstatus()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	
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
		 	 $limit=5;
		 }

		$rows='';
		$this->load->model('ticketstatusmodel');
		
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
		
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}

		$this->data['total_rows']= $this->ticketstatusmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."ticketstatus/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->ticketstatusmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
			
		$this->load->model('ticketstatusmodel');
		$this->data['page_head']= 'Manage Ticket';
		$config['base_url'] = base_url().'ticketstatus/?';
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('ticketstatus/list',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$this->data['formdata']=array(
		'ticket_status_name'=> '',
		'status'=> ''
		);
		
		$this->data['page_head']= 'Add Ticket Status';
		$this->load->model('ticketstatusmodel');
		
		if($this->input->post('ticket_status_name'))
		{
			$this->form_validation->set_rules('ticket_status_name', 'Status Name', 'required');
			$this->form_validation->set_rules('check_dups', 'Status Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->ticketstatusmodel->insert_record();
				redirect('ticketstatus/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
					'ticket_status_name'=> $this->input->post('ticket_status_name'),
					'status'=> $this->input->post('status')
				);
		}

		$this->load->view('include/header');
		
		$this->load->view('ticketstatus/add',$this->data);				
		$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Ticket Status';
			$this->db->where('ticket_status_id', $id);
			$query=$this->db->get('pms_tickets_status');
			$this->data['formdata']=$query->row_array();	
					
			$this->load->view('include/header');
			
			$this->load->view('ticketstatus/edit',$this->data);				
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{ 
		$data['page_head']= 'Edit Ticket Status';
		$id = $this->input->post('ticket_status_id');
		if(!empty($id))
		{ 
			if($this->input->post('ticket_status_name'))
			{ 
				$this->form_validation->set_rules('ticket_status_name', 'Status Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Status Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{ 
						$this->load->model('ticketstatusmodel');
						$id=$this->ticketstatusmodel->update_record($id);
						redirect('ticketstatus/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
							'ticket_status_name'=> $this->input->post('ticket_status_name'),
							'status'=> $this->input->post('status')
						);
						
						$this->db->where('ticket_status_id', $this->input->post('ticket_status_id'));
						$query=$this->db->get('pms_tickets_status');
						$data['formdata']=$query->row_array();
						
						
						$this->load->view('include/header');
						$this->load->view('ticketstatus/edit',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('ticketstatus');
			}			
		}else
		{
			redirect('ticketstatus');
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
			if($this->is_related($id)){
				redirect('ticketstatus/?rows='.$rows.'&del=2');
			}else{
				$this->db->where('ticket_status_id', $id);
				$this->db->delete('pms_tickets_status'); 
				redirect('ticketstatus/?del=1');
			}
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					if($this->is_related($val)){
						redirect('ticketstatus/?rows='.$rows.'&del=2');
						break;
					}else{
						$this->db->where('ticket_status_id', $val);
						$this->db->delete('pms_tickets_status'); 
					}
				}
			redirect('ticketstatus/?rows='.$rows.'&del=1');
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
			$this->load->model('ticketstatusmodel');
			$this->ticketstatusmodel->delete_multiple_record($id_arr);
			redirect('ticketstatus/?rows='.$rows.'&del=1');
		}
		else{
			redirect('ticketstatus');
		}
	}
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_tickets','key' => 'ticket_status_id','Module'=>'Tickets'));
		$is_related = FALSE;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}
	function check_dups()
	{
		$this->db->where('ticket_status_name', $this->input->post('ticket_status_name'));
		if($this->input->get('id') > 0)	$this->db->where('ticket_status_id !=', $this->input->get('id'));
		$query = $this->db->get('pms_tickets_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Status name already used.');
			return false;
		}
	}
	function changestat($id=null)
	{
		if($id=='')redirect('ticketstatus');
		if($this->input->get('stat')=='')redirect('ticketstatus');
		$this->db->query("update pms_tickets_status set status=".$this->input->get('stat')." where ticket_status_id=".$id);
		redirect('ticketstatus?stat=1');

	}
}
?>

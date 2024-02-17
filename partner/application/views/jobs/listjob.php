<style>
th {
	font-weight: bold;
	font-family: Verdana, Geneva, sans-serif;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">

<div class="section-wrap">
  <div class="row">
    <ul class="page-breadcrumb breadcrumb">
      <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
      <li class="active"><?php echo $page_head;?></li>
    </ul>
  </div>
  <?php if($this->input->get('ins')==1){?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert">�</button>
    <strong>Success!</strong> record added successfully. </div>
  <?php } ?>
  <?php if($this->input->get('update')==1){?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert">�</button>
    <strong>Success!</strong> record updated successfully. </div>
  <?php } ?>
  <?php if($this->input->get('del')==1){?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert">�</button>
    <strong>record deleted..</strong> </div>
  <?php } ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
        <h3><?php echo $page_head;?></h3>
      </div>
      <div class="table-tech specs">
        <div class="right-btns"> 
        
        <a style="background-color: #2980b9;" href="<?php echo base_url();?>jobs" class="attach-subs tools">Clear search filters</a> 
          <!-- 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>

-->: </div>
        <form id="searchForm" method="post" action="<?php  echo $this->config->site_url();?>jobs/">
          <table class="tool-table">
            <tbody>
              <tr>
                <td width="64"><?php echo form_dropdown('company_id', $company, $company_id,'class="form-control hori" id="company_id"  style="width: 200px;"');?></td>
                
                <td width="64"><?php echo form_dropdown('package_id', $package_list, $package_id,'class="form-control hori" id="package_id"  style="width: 200px;"');?></td>
                
                <td width="64"><input class="form-control" type="text" name="searchterm" id="searchterm" placeholder="Job Title" value="<?php echo $searchterm != '' ? $searchterm: '' ;?>"     style="width: 200px;"></td>
                
                <td width="64"><?php echo form_dropdown('job_priority', $priority_list, $job_priority,'class="form-control hori" id="job_priority"  style="width: 100px;"');?></td>
                
                <td colspan="2" width="20"><input type="radio" name="job_status" value="1" <?php if($job_status==1)echo 'checked'?>>&nbsp;&nbsp;List</td>
                <td colspan="2" width="20"><input type="radio" name="job_status" value="0"  <?php if($job_status==0)echo 'checked'?>>&nbsp;&nbsp;Unlist</td>
                <td colspan="2" width="20"><input type="radio" name="job_status" value="2"  <?php if($job_status==2)echo 'checked'?>>&nbsp;&nbsp;Private</td>
                <td width="70"><input type="submit" value="Search"></td>
              </tr>
            </tbody>
          </table>
        </form>
        <div class="sep-bar">
          <div class="page"> <?php echo $pagination; ?> </div>
          <div class="views_section">
            <div class="view-drop"> <span>View</span>
              <select class="form-control drop" id="sel_limit1">
                <option>Select</option>
                <option>5</option>
                <option>10</option>
              </select>
              <span>Records</span> </div>
            <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>jobs/multidelete?rows=<?php echo $rows;?>" >
          <table class="tool-table new">
            <thead>
              <tr role="row" class="heading">
                <th width="67"><div class="checker"><span>#<!-- <input type="checkbox" class="group-checkable" id="selectall">--></span></div></th>
                <th width="464"><a href="<?php echo $this->config->site_url()?>jobs?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>
        &rows=<?php echo $rows;?>">Job Title</a></th>
                <th width="109">Posted On</th>
                <th width="107">Expires</th>
              </tr>
            </thead>
            <tbody>
              <?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
              <tr class="odd gradeX">
                <td><div class="checker"> <span> 
                    <!-- <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['job_id']?>" > --> 
                    # </span> </div></td>
                <td><span class="views" title="Manage Job"><?php echo $result['job_title']?></span><br>
                  <?php echo $result['company_name']?> || Openings =<a href="#" class="btn btn-info btn-xs"><?php echo $result['vacancies']?></a> | Total Apps=<a href="#" class="btn btn-primary btn-xs"><?php echo $result['total_apps']?></a> <br>
                  <?php echo $result['package_name'];?></td>
                <td><?php echo ($result['job_post_date']!='0000-00-00' && $result['job_post_date']!='') ? date('d-m-Y', strtotime($result['job_post_date'])) : '';?></td>
                <td><?php echo ($result['job_expiry_date']!='0000-00-00' && $result['job_expiry_date']!='') ? date('d-m-Y', strtotime($result['job_expiry_date'])) : '';?></td>
                
                
              </tr>
              <?php
	}}else{?>
              <tr>
                <td colspan="9" align="center"> No Records Founds!! </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php echo $pagination; ?>
        </form>
        <div class="sep-bar">
          <div class="views_section">
            <div class="view-drop"> <span>View</span>
              <select class="form-control drop" id="sel_limit2">
                <option>Select</option>
                <option>5</option>
                <option>10</option>
              </select>
              <span>Records</span> </div>
            <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
</section>
</div>
<div class="modal fade" id="assignment_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15" id="assignment_history">
            <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>jobs/save_assignment" id="assignment_form" name="assignment_form">
              <input type="hidden" name="job_id" id="job_id" value="">
              <div id="data_holder">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td colspan="2"> Loading................... </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <table class="hori-form">
                <tbody>
                  <tr>
                    <td colspan="2"><span class="click-icons">
                      <input type="button" class="attach-subs" value="Add" id="save_assignment_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>jobs/save_assignment" />
                      </span></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<script>

$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#selectall').click(function(event)
	{  
		if(this.checked) 
		{ 
		$('.checkboxes').each(function() { 
		this.checked = true; 
		});
		}else{
		$('.checkboxes').each(function() { 
		this.checked = false;  
		});        
		}
	});
	
	$("#deleteall").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a data to delete.");
		return false;
		}
		if(count_checked >0) {
		if(confirm('Are You Sure?Delete Multiple Item')){
		$('#form1').submit();
		}
		}
	});
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>jobs?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>jobs?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>jobs?limit='+limits;
	});
	
});

function assign_requirement(job_id)
{
	$('#job_id').val(job_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>jobs/assign_requirement/?job_id="+job_id,
			data: $('#assignment_form').serialize(),
			method: "POST",
  			data: { job_id : job_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#data_holder').html(data);
			}
		});
    $('#assignment_modal').modal();		
}


$(document).on('click', '#save_assignment_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#assignment_modal').modal('hide');	
					alert('Job sucessfully assigned to recruiters/vendors');				
					//location.reload();
					$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

</script> 

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a> </li>
        <li class="active">Notifications </li>
      </ul>
</div>

<?php if($this->input->get('ins')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Sucess !</strong> one record added. </div>
          <?php } ?>
          <?php if($this->input->get('upd')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Sucess !</strong> record updated. </div>
          <?php } ?>
          <?php if($this->input->get('del')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Delete !</strong> record(s) deleted. </div>
          <?php }  else if($this->input->get('del')==2){ ?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Error !</strong> Cannot delete records, related records found. </div>
          <?php } ?> 

<div class="row">
<div class="col-sm-12">


<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/content/delete?rows=<?php echo $rows;?>" >


<div class="right-btns">
<a href="<?php echo base_url();?>index.php/content/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<!-- <a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a> -->
</div>
<form id="searchForm">
<table class="tool-table">
<tbody>

<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Notifications" style="
    width: 185px;
"></td>

<td>
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>

</tbody>
</table>
</form>
<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit1">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>
<table class="tool-table new">
<thead>
<tr>
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                         <th>
								 <a href="<?php echo $this->config->site_url();?>/content?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Title</a></th>
 <th>Message</th>
 <th>File</th>
<th>Actions</th> 
								
							</tr>
</thead>
<tbody>

<?php 
	if($records!=NULL)
						  {
    foreach($records as $result){ 
    ?>
    <tr>
    <td>
	<div class="checker">
    	<span>
    		<input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['content_id']?>" >
        </span>
	</div>
</td>
    <td><?php echo $result['content_title'];?></td>
	<td><?php echo substr($result['actual_text'],0,50);?></td>
	<td><?php if($result['file_name']!=''){?> <a href="<?php echo base_url();?>/uploads/content/<?php echo $result['file_name'];?>" class="views" title="File" target="_blank">Download</a><?php } ?></td>
   
   <td><!--  <a href="<?php echo base_url();?>index.php/content/edit/<?php echo $result['content_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a> -->
	<a href="<?php echo base_url();?>index.php/content/delete/<?php echo $result['content_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a></td>
    
    </tr>
    <?php }
  }else{?>
									<tr>
										<td colspan="9" align="center">
											No Records Founds!!
										</td>
									</tr>
						   <?php } ?>    </tbody>

</table>
</form>                           



<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit2">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
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
		window.location.href = '<?php echo $this->config->site_url();?>/content?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/content?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/content?limit='+limits;
	});
	
});
</script>
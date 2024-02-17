<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/interviewtype">Interview Type</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Edit Interview Type</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Edit Interview Type</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
            <form action="<?php echo $this->config->site_url();?>/interviewtype/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
<input type="hidden" name="interview_type_id" value="<?php echo $formdata['interview_type_id'];?>">

    <tr>
    <td> Interview Type</td>
    <td> <input type="text" id="interview_type" name="interview_type" value="<?php echo $formdata['interview_type'];?>" placeholder="" class="span12" />
    </td>
    </tr>
    
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/interviewtype" class="attach-subs subs">Cancel</a>
    </span>
    </td>
    </tr>
    </form>

</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
function validate()
{
	if($('#interview_type').val()=='')
	{
		alert('Please enter type name');
		$('#interview_type').focus();
		return false;
	}
	return true;
}

</script>	

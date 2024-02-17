
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-md-12">
         <div class="row">

<!-- Resume headline -->
                  <div tabindex='2' id="resume_headline" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Resume headline</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary ">Update</button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                 <hr class="m-0" />
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       6 year experienced laravel developer having addon experience in aws and angular
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Resume headline end -->

<!-- personal details -->
                  <div tabindex='2' id="personal_details" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Personal Details</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#personal_details_add" aria-controls="offcanvasEnd" >Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">First Name:</span>
                                          <span><?php echo $formdata['first_name'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Mobile:</span>
                                          <span><?php echo $formdata['mobile_prefix'].' '.$formdata['mobile'];?><?php if($formdata['mobile1']!='')echo ', '.$formdata['mobile_prefix1'].' '.$formdata['mobile1'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Username/Email :</span>
                                          <span><?php echo $formdata['username'];?>
                    <?php if($formdata['alternate_email']!='')echo '<br>'.$formdata['alternate_email'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Marital Status:</span>
                                          <span><?php if($formdata['marital_status']==1) echo 'Married'; else echo 'Single';?></span>
                                       </li>
                                       
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Nationality:</span>
                                          <span><?php echo $formdata['nationality_name'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Current Location:</span>
                                          <span><?php echo $formdata['current_location_name'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                    <li class="mb-2">
                                          <span class="fw-bold me-2">Age : </span>
                                          <span><?php echo $formdata['age'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Gender:</span>
                                          <span><?php if($formdata['gender']==1) echo 'Male'; if($formdata['gender']==0)echo 'Female';?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Registered On:</span>
                                          <span><?php echo $formdata['reg_date'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">DoB:</span>
                                          <span><?php echo $formdata['date_of_birth'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- personal details end -->
<!-- Professional Summery -->
                  <div tabindex='2' id="professional_summery" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Professional Summery</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary">Update</button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                 <hr class="m-0" />
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Driving License:</span>
                                             <span><?php if($formdata['driving_license']==1) echo 'Yes'; if($formdata['driving_license']==0)echo 'No';?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">License Issued From:</span>
                                             <span class="badge bg-label-success"><?php if($formdata['driving_license']=='0'){ echo 'Nill';}else{ echo $formdata['driving_license_country_name'];}?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Languages Known:</span>
                                             <span><?php if(!empty($candidate_languages)){
                                                    $language='';
                                                    foreach($candidate_languages as $lang)
                                                    {
                                                        $language	=	$language.$lang['lang_name'].',';
                                                    }
                                                    echo rtrim($language, ",");
                                                    ?>
                                                    
                                                    <br />
                                                <?php }else{ ?>
                                                 Not Updated.<br />
                                                <?php } ?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Current Job Status: </span>
                                             <span><?php echo $formdata['cur_job_status_name'];?> </span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Linkedin Profile Link:</span>
                                             <span>
                                             <a href="<?php echo $formdata['linkedin_url'];?>" target="_blank"><?php echo $formdata['linkedin_url'];?></a> 
                                             
                                             </span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       
                                       <li class="mb-2">
                                             <span class="fw-bold me-2">VISA Type:</span>
                                             <span><?php echo $formdata['visa_type'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Current Salary:</span>
                                             <span><?php echo  $this->config->item('currency_symbol');?><?php if(isset($job_search['current_ctc']))echo $job_search['current_ctc'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Expeced Salary:</span>
                                             <span class="badge bg-label-success"><?php echo  $this->config->item('currency_symbol');?><?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Notice Period:</span>
                                             <span><?php if(isset($job_search['notice_period'])) echo $job_search['notice_period'];?>
                    Days</span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Total Experience</span>
                                             <span><?php if(isset($job_search['total_experience'])) echo $job_search['total_experience'];?>                      Years</span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Skills:</span>
                                             <span><?php if(isset($formdata['skills'])) echo $formdata['skills'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Other Details:</span>
                                             <span><?php if(isset($formdata['fee_comments'])) echo $formdata['fee_comments'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Reason to Leave:</span>
                                             <span><?php if(isset($job_search['reason_to_leave']) && $job_search['reason_to_leave']!='')echo $job_search['reason_to_leave'];else echo 'NA';?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Professional Summery end -->
<!-- Desired Jobs -->
                  <div tabindex='2'  id="desired_jobs" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Desired Jobs</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary">Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                 
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       <span class="badge bg-label-primary me-1">IT</span>
                                       <span class="badge bg-label-primary me-1">Software Development</span>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Resume headline end -->
<!-- Employment -->
                  <div tabindex='2' id="employment" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Employment</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary">Add</button>
                           </div>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                           <?php foreach($job_history as $key => $val){?>
                                 <hr class="m-0" />
                                 <div class="col-md-6">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Designation :</span>
                                             <span><?php echo $val['desig_name'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Organization :</span>
                                             <span><?php echo $val['organization'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">From:</span><span><?php echo date('d M, Y',strtotime($val['from_date']));?></span>
                                             <span class="fw-bold me-2">To:</span><span><?php if($val['present_job']==1){echo 'Till Date'; }else{ echo date('d M, Y',strtotime($val['to_date']));}?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                         
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Industry :</span>
                                             <span><?php echo $val['job_cat_name'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Function :</span>
                                             <span><?php echo $val['func_area'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Responsibilities :</span>
                                             <span><?php echo $val['responsibility'];?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-1"> 
                                 <a ><i class="bx bx-edit-alt me-2"></i></a>
                                 </div>
                                 <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Employment end -->
<!-- Education -->
                  <div tabindex='2' id="education" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Education</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary" >Add</button>
                           </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach($education_details as $key => $val){?>
                                    <hr class="m-0" />
                                        <div class="col-md-6">
                                            <div class="info-container">
                                            <ul class="list-unstyled">
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Course :</span>
                                                    <span><?php echo $val['course_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Specialisation :</span>
                                                    <span><?php echo $val['spcl_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">University:</span>
                                                    <span><?php echo $val['univ_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Year:</span>
                                                    <span><?php echo $val['edu_year'];?></span>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="info-container">
                                            <ul class="list-unstyled">
                                                
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Level of study :</span>
                                                    <span><?php echo $val['level_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Course Type :</span>
                                                    <span><?php echo $val['course_type'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Country :</span>
                                                    <span><?php echo $val['country_name'];?></span>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-1"> 
                                        <a ><i class="bx bx-edit-alt me-2"></i></a>
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                     </div>
                  </div>
<!-- Education end-->
<!-- Skills -->
                  <div tabindex='2' id="skills" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Skills</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary">Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                 
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       <?php foreach($candidate_skill as $key => $val){?>
                                        <span class="badge bg-label-primary me-1"><?php echo $val['skill_name'];?></span>
            <?php } ?>

                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Skills end -->
<!-- Other Details -->
                  <div tabindex='2' id="other_details" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Other Details</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary">Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       <?php if(isset($formdata['fee_comments'])) echo $formdata['fee_comments'];?>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Other Details end -->
<!-- Photo & CV -->
                  <div tabindex='2' id="photo_cv" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2 head">Photo & CV</h5>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                    <div class="col-md-6">
                                       <div class="card-body">
                                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <?php if($detail_list['photo']!='' && file_exists($this->config->item('photo_upload_folder').$detail_list['photo'])){?>
                                                <img src="<?php echo $this->config->item('photo_path').$detail_list['photo'];?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                                <?php }else{ ?> 
                                                <img src="<?php echo base_url().'assets/images/no_photo.png';?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                                <?php } ?>
                                                <div class="button-wrapper">
                                                   <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                      <span class="d-none d-sm-block">Select new photo</span>
                                                      <i class="bx bx-upload d-block d-sm-none"></i>
                                                      <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                   </label>
                                                   <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                      <i class="bx bx-reset d-block d-sm-none"></i>
                                                      <span class="d-none d-sm-block">Reset</span>
                                                   </button>
                                                   <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="card-body">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="col-md-8">
                                                   <input class="form-control" type="file" id="formFile" />
                                                </div>
                                                <div class="col-md-4">
                                                <button  class="btn btn-sm btn-primary ">Update</button>
                                                </div>
                                             </div>
                                                <div class="col-md-8">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                      View Resume
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div> 
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Photo & CV end -->
         </div>
      </div>
   </div>
</div>

<div class="offcanvas offcanvas-end" style="width: 80%;" tabindex="-1" id="personal_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Update Presonal details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="card-body">
         <div class="row">
            <div class="col-md-4">
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-2">
                        <span class="fw-bold me-2">Name</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Mobile</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Alternate Mobile</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Username/Email</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Alternative E Mail ID</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">DOB</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Skills</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Gender</span>
                        <input name="default-radio-1" class="form-check-input" type="radio" value="1" id="defaultRadio1" />Married
                        <input name="default-radio-1" class="form-check-input" type="radio" value="2" id="defaultRadio1" />Single
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-4">
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-2">
                        <span class="fw-bold me-2">Current CTC</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Expected CTC</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Notice Peiord</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Total Experience </span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Other Details</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Current Job Status</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Reason to Leave</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Driving License ?</span>
                        <input name="default-radio-1" class="form-check-input" type="radio" value="1" id="defaultRadio1" />Yes
                        <input name="default-radio-1" class="form-check-input" type="radio" value="2" id="defaultRadio1" />No
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-4">
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-2">
                        <span class="fw-bold me-2">Nationality</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Country of Residence</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">State</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">City</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Visa Type</span>
                        <select class="form-control" >
                           <option>select</option>
                        </select>
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Linkedin Profile Link</span>
                        <input type="text" class="form-control"  />
                     </li>
                     <li class="mb-2">
                        <span class="fw-bold me-2">Marital Status:</span>
                        <input name="default-radio-1" class="form-check-input" type="radio" value="1" id="defaultRadio1" />Male
                        <input name="default-radio-1" class="form-check-input" type="radio" value="2" id="defaultRadio1" />Female
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <button type="button" class="btn btn-primary mb-2 d-grid w-100">Update</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
   </div>
</div>



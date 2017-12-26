@extends('adminarea.home')
@section('content')
@include('adminarea.transaction.transaction-js')

       <style type="text/css">
         /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 45px;
    font-weight: bold;
    margin-right: -10px;
    margin-top: -20px;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.margin-bottom{
      margin-bottom: 45px;
}
.scroll-datas{
  overflow-y: scroll; 
  height:300px;
  
}
.btn-size{
      width: 145px;
}

.text-height{
      height: 55px;
}

thead, tbody { display: block; }

tbody {
    height: 100px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}
#kra form table{ table-layout:fixed;}
#kra form table thead tr th{ border-bottom:none;}
#kra form table thead{ display: table-header-group; }
 #kra form table tbody {display: table-row-group;}

#kra form table tbody tr td:first-child, #kra form table thead tr th:first-child{ border-left:none;}
#kra form table tbody{ height:auto; overflow:unset;}


#pop2 form table{ table-layout:fixed;}
#pop2 form table thead tr th{ border-bottom:none;}
#pop2 form table thead{ display: table-header-group; }
#pop2 form table tbody {display: table-row-group;}
#pop2 form table tbody tr td:first-child, #kra form table thead tr th:first-child{ border-left:none;}
#pop2 form table tbody{ height:auto; overflow:unset;}

#pplan form table{ table-layout:fixed;}
#pplan form table thead tr th{ border-bottom:none;}
#pplan form table thead{ display: table-header-group; }
#pplan form table tbody {display: table-row-group;}
#pplan form table tbody tr td:first-child, #kra form table thead tr th:first-child{ border-left:none;}
#pplan form table tbody{ height:auto; overflow:unset;}

#devplan form table{ table-layout:fixed;}
#devplan form table thead tr th{ border-bottom:none;}
#devplan form table thead{ display: table-header-group; }
#devplan form table tbody {display: table-row-group;}
#devplan form table tbody tr td:first-child, #kra form table thead tr th:first-child{ border-left:none;}
#devplan form table tbody{ height:auto; overflow:unset;}

#preview form table{ table-layout:fixed;}
#preview form table thead tr th{ border-bottom:none;}
#preview form table thead{ display: table-header-group; }
#preview form table tbody {display: table-row-group;}
#preview form table tbody tr td:first-child, #kra form table thead tr th:first-child{ border-left:none;}
#preview form table tbody{ height:auto; overflow:unset;}
</style>
<script type="text/javascript">
   
   
    
    function CalculateValue(i){
     
       var z=+$("#countKraData").val();  
          var wei =+$("#weightage"+i).val();  
    var ach =+$("#achieved"+i).val(); 
    var result = wei *(ach/100);
    var orginialResult =  Math.round(result*100)/100;

    $("#changescore"+i).text(orginialResult);
     $("#score"+i).val(orginialResult);
     var totalscore = 0;
    $('.score').each(function (index, element) {
   
        totalscore = totalscore + parseFloat($(element).val());
    });
    total_score.value=parseFloat(totalscore).toFixed(2);
    }
    </script>
<?php
use App\Http\Models\Employee;  
 
use App\Http\Models\Csfmanagement;
use App\Http\Models\Employee_category;
$companyID=Input::get('companyID')?Input::get('companyID'):'';
$totalrow=Input::get('totalrow')?Input::get('totalrow'):'';
$currentrow=Input::get('currentrow')?Input::get('currentrow'):'';
$srach_company=Input::get('srach_company')?Input::get('srach_company'):'';
$startDate=Input::get('startDate')? date('m/d/Y',strtotime(Input::get('startDate'))):'';
$endDate=Input::get('endDate')? date('m/d/Y',strtotime(Input::get('endDate'))):'';
$srch_status=Input::get('srch_status')?Input::get('srch_status'):'';
$srach_code=Input::get('srach_code')?Input::get('srach_code'):'';
$searchEmployeeID=Input::get('searchEmployeeID')?Input::get('searchEmployeeID'):'';
?>


    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <h4 class="float-left">Performance Management</h4>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}/adminarea/home"><i class="fa fa-home"></i></a></li>
                    <li class="active">Performance Management</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-card recent-activites">
               
               <div class="panel-body  p-xl-3">
                         @if(Session::has('flash_message'))
                         <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>{{ Session::get('flash_message') }}!</strong> 
        </div>
                         @endif
                              
                              <div class="col-lg-12">
                               @foreach($employeeData as $empData)
                                <div class="col-sm-5" >
                                  <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>Employee :</label></div>  
            </div>
             <div class="col-sm-8">     
                                     <div class="form-group row"> {{$empData->empCode}} - {{$empData->EmpName}}</div> 
            </div>
           </div>
            
            <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>Category :</label></div>  
            </div>
             <div class="col-sm-8">     
                                     <div class="form-group row">{{$empData->empcatName}} </div>  
            </div>
            </div>

            <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>DOJ :</label></div> 
            </div>
             <div class="col-sm-8">         
                                     <div class="form-group row">{{date('d-M-Y',strtotime($empData->DateOfJoin))}} </div> 
            </div>
           </div>
                      
                                  <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>Dept. :</label> </div>  
            </div>
             <div class="col-sm-8 ">      
                                     <div class="form-group row">{{$empData->deptepartmentName}}</div>  
            </div>
             </div>
            <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>Desig. :</label></div>  
            </div>
             <div class="col-sm-8 ">      
                                     <div class="form-group row">{{$empData->designationName}}</div>  
            </div>
            </div>


                                  <div class="form-group row">  
                                    <div class="col-sm-3">      
                                     <div class="form-group row"><label>Grade :</label></div> 
            </div>
             <div class="col-sm-8">     
                                     <div class="form-group row"> {{$empData->empgradeName}}</div>  
            </div>

                                        </div>


                                </div>
                                 
                                
                                
                                <div class="col-sm-6" >
                                
            <div class="form-group row">  
                                    <div class="col-sm-4">
                                        
                                     <div class="form-group row"><label>Appraiser :</label></div> 
            </div>
             <div class="col-sm-6">
                 <?php $empAppraisor =   Employee::where('EmployeeID', '=', $empData->Appraisor)->select('EmpName')->first(); ?>      
                                     <div class="form-group row">@if(count($empAppraisor)>0) {{$empAppraisor->EmpName}}  @endif </div>  
            </div>
           </div>
            <div class="form-group row">  
                                    <div class="col-sm-4">      
                                     <div class="form-group row"><label>Reviewer :</label></div>  
            </div>
             <div class="col-sm-6">
                   <?php $empReviewer  =   Employee::where('EmployeeID', '=', $empData->Reviewer )->select('EmpName')->first(); ?>      
                                     <div class="form-group row">@if(count($empReviewer)>0) {{$empReviewer->EmpName }}  @endif </div> 
            </div>
           </div>
                                  <div class="form-group row">  
                                    <div class="col-sm-4">      
                                     <div class="form-group row"><label>Reporting To :</label></div>  
            </div>
             <div class="col-sm-6">
              <?php $empReporting  =   Employee::where('EmployeeID', '=', $empData->Reporting)->select('EmpName')->first(); ?>      
                                     <div class="form-group row">@if(count($empReporting)>0) {{$empReporting->EmpName}}  @endif </div>  
            </div>
           </div>
                                
                                <div class="form-group row">  
                                    <div class="col-sm-4">      
                                     <div class="form-group row"><label>KRA Period :</label></div>  
            </div>
             <div class="col-sm-6">
                                     <div class="form-group row"> {{$empData->kraPeriod}}</div> 
            </div>
           </div>

            <div class="form-group row"> 
                <div class="col-sm-4">      
                  <div class="form-group row"><label>Cost Center :</label></div>  
                </div>
                <div class="col-sm-6">
                  <div class="form-group row"> {{$costcenterID}}</div> 
                </div>
           </div>



                                   

                                </div>
                                 
                          
          
              
                              
                              
                             @endforeach
                             </div>
                         
                         
                         
                            
                          <?php
                              
                             
                            // use App\Http\Models\Employee_category;
                             $employeeCategory = new Employee_category;
                             $findCatID= Employee_category::where('empcatName',$empData->empcatName)->get();
                              
                             $csfManagement = new Csfmanagement;
                             $csfManagementData =   Csfmanagement::where('type',$findCatID[0]->empcatID)->get(); 
                             $countCsfManagement =count($csfManagementData);  
                              
                             
                             
                         ?>
                      
                       @foreach($employeeData as $empData)
                        <div class="form-group row">
                              <div class="hr-line-dashed"></div>  <!-- strat box footer area-->
                            </div> 
                             <div class="row">
                              <div class="form-group row">
                                  <div class="col-sm-12">
                                    <?php /*?><div class="col-sm-6">
                                      @if($empData->reportSubmit==1)KRA already submitted and is to be approved by {{$empAppraisor->EmpName}}@endif
                                    </div><?php */?>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        
                                          <div class="col-sm-6">Comments</div>
                                          <div class="col-sm-6">Awards and Achievements</div>
                                      </div>
                                        <div class="form-group">
                                          <div class="col-sm-6">
                                          <textarea  @if($empData->reportSubmit==1) readonly @endif required  class="form-control" name="comments" class=" id="comments"  onchange="PassData(this.value);"></textarea>
                                        </div>
                                          <div class="col-sm-6">
                                          <textarea  @if($empData->reportSubmit==1) readonly @endif required  class="form-control" name="comments" class=" id="awandAc"  onchange="PassData2(this.value);"></textarea>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                  </div>
                             
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                       <ul class="nav nav-tabs">
                        <li class="active"><button @if($empData->reportSubmit==1) disabled @endif class="btn btn-warning btn-size" onclick="fun_popup('kra');">KRA Review</button></li>              
                        <li><button @if($empData->reportSubmit==1) disabled @endif class="btn btn-warning btn-size" onclick="fun_popup('pop2');"><!-- <a data-toggle="tab" href="#csf"> -->CSF</button></li>
                        <li><button @if($empData->reportSubmit==1) disabled @endif class="btn btn-warning btn-size" onclick="fun_popup('pplan');"><!-- <a data-toggle="tab" href="#pplan"> -->Performance Plan</button></li>
                        <li><button @if($empData->reportSubmit==1) disabled @endif class="btn btn-warning btn-size" onclick="fun_popup('devplan');"><!-- <a data-toggle="tab" href="#devplan"> -->Development Plan</button></li>
                          
                          <li> <button class="btn btn-primary" name="Preview" onclick="fun_popup('preview');">Preview</button></li>

                    </ul>
                                    </div>
                                    <br><br>
                                     <div class="col-sm-6 col-sm-offset-10">
                                       <form action="{{url('/')}}/adminarea/transaction/submitAllReports" method="post">
                                         <input type="hidden" name="EmployeeID" value="{{$empData->EmployeeID}}">
                                         <input type="hidden" name="Appraisor" value="{{$empData->Appraisor}}">
                                         <input type="hidden" name="Reviewer" value="{{$empData->Reviewer}}">
                                         <input type="hidden" name="Category" value="{{$empData->empcatName}}">
                                         <input type="hidden" name="DateOfJoin" value="{{$empData->DateOfJoin}}">
                                         <input type="hidden" name="Reporting" value="{{$empData->Reporting}}">
                                         <input type="hidden" name="deptepartmentName" value="{{$empData->deptepartmentName}}">
                                         <input type="hidden" name="designationName" value="{{$empData->designationName}}">
                                         <input type="hidden" name="CostCenter" value="{{$costcenterID}}">
                                         <input type="hidden" name="Grade" value="{{$empData->empgradeName}}">

                                         <input type="hidden" name="kraPeriod" value="{{$empData->kraPeriod}}">

                                         <input type="hidden" name="Comments" value="" id="hidecom">
                                         <input type="hidden" name="AwardsAndAchievment" value="" id="hideAw">

                                         <input type="hidden" name="avg_achieved_rate" id="avg_achieved_rate1" min="0" max="100" value="" data-bv-field="sum_project_rate" readonly class="form-control">
                                        <button class="btn btn-primary" value="1" onclick="return confirm('Make sure to fill all the reports before submitting. Report submitted cannot be edited again. would you like to continue?');" @if($empData->reportSubmit==1) disabled @endif name="submit">Submit</button>
                                        </form>
                                       <!-- <button type="button" class="btn btn-primary" onclick="fun_back()">Back</button>
                                       <button type="button" class="btn btn-primary" onclick="fun_back()">Print</button>
                                        <input type="submit" class="btn btn-primary" name="reject" value="Reject">-->
                                        

										
                                     </div>
                             </div>
                             </div>
                         @endforeach 
                         
                           
                </div>
                <!-- <div class="card-header">
                    Reporting Informations 
                    <div class="float-right">
                        <div class="btn-group">Reporting Details</div>
                    </div>
               </div> -->
                      
                      <div class="tab-content">
                        <div id="preview" class="modal">
                          <div class="modal-content">
                            <span onclick="fun_popup_close('preview');" class="close">&times;</span>
                            <div class="modal-body" style="height: 80%">
                              <ul class="nav nav-tabs" role="tablist">
                                  <li role="presentation" class="active"><a href="#previewKRA" aria-controls="previewKRA" role="tab" data-toggle="tab">KRA</a></li>
                                  <li role="presentation"><a href="#previewCSF" aria-controls="previewCSF" role="tab" data-toggle="tab">CSF</a></li>
                                  <li role="presentation"><a href="#previewPerformance" aria-controls="previewPerformance" role="tab" data-toggle="tab">Performance Plan</a></li>
                                  <li role="presentation"><a href="#previewDevelopment" aria-controls="previewDevelopment" role="tab" data-toggle="tab">Development</a></li>
                              </ul>
                              <div class="tab-content">
                              <div  role="tabpanel" class="tab-pane active" id="previewKRA">
                                  <div style="font-size: x-large;text-align: center;margin-bottom: 10px;">KRA</div>
                                  <table cellpadding="0" cellspacing="0" border="1" class="table table-bordered table-hover scroll-data">
                                      <thead style="display: table-header-group">
                                          <tr>
                                              <th class="text-center" >KRA</th>
                                              <th class="text-center">Performance Measure</th>
                                              <th class="text-center">Weightage</th>
                                              <th class="text-center">Achieved %</th>
                                              <th class="text-center">Score</th>
                                              <th class="text-center">Appraisee Remarks</th>
                                              @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                              <th>Appraisor Remarks</th>
                                              @endif
                                          </tr>
                                      </thead>
                                      <tbody style="display: table-footer-group; height: 100%">
                                         @if(count($kraData)>0)  
                                              @foreach($kraData as $kradata)
                                              <tr>
                                                  <td>{{$kradata->kra}}</td>
                                                  <td>{{$kradata->pms}}</td>
                                                  <td class="text-right">{{$kradata->weightage}}</td>
                                                  <td>{{$kradata->achieved}}</td>
                                                  <td>{{$kradata->score}}</td>
                                                  <td>{{$kradata->remarks}}</td>
                                                  @if($empData->isRejected==1 || $empData->subempReport==1)
                                                   <td>{{$kradata->comments}}</td>
                                                  @endif
                                              </tr>
                                              @endforeach
                                        @endif
                                      </tbody>
                                  </table>
                              </div>
                              <div  role="tabpanel" class="tab-pane" id="previewCSF">
                                  <div style="font-size: x-large;text-align: center;margin-bottom: 10px;">CSF</div>
                                  <table class="table table-bordered table-hover">
                                    <thead style="display: table-header-group">
                                        <tr >
                                            <th class="text-center">CSF</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Ratings</th>
                                            <th class="text-center">Remarks</th>
                                             @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                             <th class="text-center">Comments</th>
                                             @endif
                                        </tr>
                                    </thead>
                                    <tbody style="display: table-footer-group; height: 100%">
                                            @if(count($csfData)>0) 
                                              @foreach($csfData as $csfdata)
                                                <tr>
                                                    <td>{{$csfdata->csf}}</td>
                                                    <td>{{$csfdata->factors}}</td>
                                                    <td>{{$csfdata->rating}}</td>
                                                    <td>{{$csfdata->remarks}}</td>
                                                    @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                                     <td>{{$csfdata->comments}}</td>
                                                    @endif
                                                </tr>
                                              @endforeach
                                            @endif
                                    </tbody>
                                  </table>  
                              </div>
                              <div role="tabpanel" class="tab-pane" id="previewPerformance">
                                  <div style="font-size: x-large;text-align: center;margin-bottom: 10px;">Performance Plan</div>
                                  <table class="table table-bordered table-hover">
                                    <thead style="display: table-header-group">
                                      <tr >
                                          <th class="text-center">KRA</th>
                                          <th class="text-center">Timeline</th>
                                          <th class="text-center">Measure Of Achievements</th>
                                          <th class="text-center">Weightage</th>
                                          <th class="text-center">Support Required</th>
                                          @if($empData->isRejected==1  ||  $empData->subempReport==1)
                                           <th class="text-center">Comments</th>
                                          @endif
                                      </tr>
                                    </thead>
                                    <tbody  style="display: table-footer-group; height: 100%">
                                      @if(count($pplanData)>0) 
                                        @foreach($pplanData as  $pplandata )                                              
                                          <tr>
                                              <td>{{$pplandata ->pplanKra}}</td>
                                              <td>{{$pplandata->timeline}}</td>
                                              <td>{{$pplandata->measure}}</td>
                                              <td>{{(int)$pplandata->weightage}}</td>
                                              <td>{{$pplandata->support}}</td>
                                              @if($empData->isRejected==1  ||  $empData->subempReport==1)
                                                <td>{{$pplandata->comments}}</td>
                                              @endif
                                          </tr>
                                        @endforeach
                                      @endif
                                    </tbody>  
                                  </table>
                              </div>
                              <div role="tabpanel" class="tab-pane" id="previewDevelopment">
                                  <div style="font-size: x-large;text-align: center;margin-bottom: 10px;">Development Plan</div>
                                  <table class="table table-bordered table-hover">
                                    <thead  style="display: table-header-group">
                                      <tr >
                                        <th class="text-center">Skill</th>
                                        <th class="text-center">Personality Traits</th>
                                        <th class="text-center">Description</th>
                                        @if($empData->isRejected==1  ||  $empData->subempReport==1)
                                        <th class="text-center">Comments</th>
                                        @endif
                                      </tr>
                                    </thead>
                                    <tbody style="display: table-footer-group; height: 100%">
                                      @if(count($dplanData)>0)
                                        @foreach($dplanData as  $dplandata)
                                        <tr>
                                          <td>{{$dplandata->skill}}</td>
                                          <td>{{$dplandata->behaviour}}</td>
                                          <td>{{$dplandata->description}}</td>
                                          @if($empData->isRejected==1  ||  $empData->subempReport==1)
                                          <td>{{$dplandata->comments}}</td>
                                          @endif
                                        </tr>
                                        @endforeach
                                      @endif
                                    </tbody>  
                                  </table>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
  
                            <script type="text/javascript">
                              function validateForm() {
                                  var sum_project_rate = document.forms["frmKra"]["sum_project_rate"].value;
                                  var avg_achieved_rate = document.forms["frmKra"]["avg_achieved_rate"].value;
                                  if (sum_project_rate != 100) {
                                      alert("The Weightage must be 100");
                                      return false;
                                  }
                                  
                                  if(avg_achieved_rate > 100){
                                      alert("The Achieved average must be between 0 and 100");
                                      return false;
                                  }

                              }
                        </script>
                    
                      <div class="tab-content">
                      
                         <div id="kra" class="modal">
                          <div class="modal-content">
                            <span onclick="fun_popup_close('kra');" class="close">&times;</span>
                            <div class="modal-body">
                              <form role="form" name="frmKra" id="frmKra" onsubmit="return validateForm()" onSubmit="return checkform()"   method="post" action="{{url('/')}}/adminarea/transaction/savekra" style="
    margin-bottom: 45px;">
                        <input type="hidden" name="status" value=""  />
                        <input type="hidden" value="" name="companyID" />
                        <input type="hidden" name="fieldname" value="{{ Input::get('fieldname') }}" />
                        <input type="hidden" name="order" value="{{ Input::get('order') }}" />
                        <input type="hidden" name="method" value="" />
                        <input type="hidden" name="redirects_to" value="{{Request::fullUrl()}}" />
                        <input type="hidden" id="countKraData" name="countKraData" value="{{count($kraData)?count($kraData):'1'}}">
                        <input type="hidden" id="isRejected" name="isRejected" value="{{$empData->isRejected}}">
                        <input type="hidden" name="sum_project_rate" id="sum_project_rate" min="0" max="100" value="" data-bv-field="sum_project_rate">
                                
                              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover scroll-data" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center" >
                                                KRA
                                            </th>
                                            <th class="text-center">
                                                Performance Measure
                                            </th>
                                            <th class="text-center">
                                                Weightage
                                            </th>
                                            <th class="text-center">
                                                Achieved %
                                            </th>
                                            <th class="text-center">
                                                Score
                                            </th>
                                            <th class="text-center">
                                              Appraisee Remarks
                                            </th>
                                            @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                            <th>
                                              Appraisor Remarks
                                            </th>
                                            @endif
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                          
                                      <?php $recordKraData=count($kraData);?>
                                       @if($recordKraData>0)  
                                                   <?php $i=0;?>
                                            @foreach($kraData as $kradata)
                                            
                                            <tr id='addr{{$i}}'>
                                                <td>
                                                  <textarea  @if($empData->reportSubmit==1) readonly @endif name='kra{{$i}}' required  class="form-control">{{$kradata->kra}}</textarea>
                                                </td>
                                                <td>
                                                  <textarea @if($empData->reportSubmit==1) readonly @endif  name='pms{{$i}}' required    class="form-control">{{$kradata->pms}}</textarea>
                                                </td>
                                                <td>
                                                  <input @if($empData->reportSubmit==1) readonly @endif  name='weightage{{$i}}' onPaste="return false" onBlur="fun_sum_project_rate(); CalculateValue({{$i}});"  id="weightage{{$i}}"   onkeypress="return isNumber(event)"   required value='{{$kradata->weightage}}'    class="form-control text-height weightage"></input >
                                                </td>
                                                <td>
                                                  <input @if($empData->reportSubmit==1) readonly @endif  type="text" name='achieved{{$i}}' onPaste="return false" onBlur="fun_avg_achieved(); CalculateValue({{$i}});" id="achieved{{$i}}"  onkeypress="return isNumber(event)" required value='{{$kradata->achieved}}' class="form-control text-height achieved"> 
                                               
                                               
                                                </td>
                                                <td>
                                                  <!--<input @if($empData->reportSubmit==1) readonly @endif  type="text" name='score{{$i}}' onPaste="return false" id="score{{$i}}"  onkeypress="return isNumber(event)" required value='{{$kradata->score}}'    class="form-control"> -->
                                                  <label id="changescore{{$i}}" class="text-right">{{$kradata->score}}<label>
                                                  
                                                </td>
                                                <input type="hidden" class="score" name="score{{$i}}" id="score{{$i}}" value="{{$kradata->score}}">
                                                <td> 
                                                   <textarea @if($empData->reportSubmit==1) readonly @endif   name='remarks{{$i}}'     class="form-control">{{$kradata->remarks}}</textarea>
                                                </td>
                                               @if($empData->isRejected==1 || $empData->subempReport==1)
                                                 <td>
                                                  <input type="hidden" name="comments{{$i}}" required value="{{$kradata->comments}}">
                                                   <textarea readonly required class="form-control">{{$kradata->comments}}</textarea>
                                                </td>
                                                @endif
                                                
                                            </tr>
                                            <script>CalculateValue('{{$i}}');</script>
                                            <?php $i++;?>
                                             
                                            @endforeach
                                              <tr id="addr{{$i}}"></tr>
                                      @else
                                            <tr id='addr0'>
                                                <td>
                                                  <textarea  name='kra0' required class="form-control"> </textarea>
                                                </td>
                                                <td>
                                                   <textarea  name='pms0' required  class="form-control"> </textarea>
                                                </td>
                                                <td>
                                                  <textarea  type="text" name='weightage0' onPaste="return false" id="weightage0" required  onkeypress="return isNumber(event)" style="align-content:center"  onBlur="fun_sum_project_rate(); CalculateValue(0);"  class="form-control weightage"></textarea>
                                                </td>
                                                <td>
                                                  <textarea  type="text" name='achieved0' onPaste="return false" onBlur="fun_avg_achieved(); CalculateValue(0);"   id="achieved0" required  onkeypress="return isNumber(event)"  class="form-control achieved"> </textarea >
                                                </td>
                                                <td>
                                                  <!--<input type="text" name='score0' onPaste="return false"  id="score0"  required  onkeypress="return isNumber(event)"   class="form-control"> -->
                                                  <label id="changescore0" align="center">-- <label>
                                                    
                                                </td>
                                                <input type="hidden" name="score0" id="score0" value="" class="score">
                                                <td>
                                                   <textarea  name='remarks0' class="form-control"> </textarea>
                                                </td>
                                                
                                            </tr>  
                                           <tr id="addr1"></tr>
                                          
                                        
                                      @endif
                                            
                                    </tbody>
                                    
                                    <tbody>
                                    <tr >
                                                  <th class="text-center" >
                                                      
                                                  </th>
                                                  <th class="text-center">
                                                     
                                                  </th>
                                                  <th class="text-center">
                                                      <input type="disabled" name="total_weightage" id="total_weightage" value="" data-bv-field="total_weightage" readonly class="form-control" style="border: none;border-color: transparent;">
                                                  </th>
                                                  <th class="text-center">
                                                      <input type="disabled" name="avg_achieved_rate" id="avg_achieved_rate" min="0" max="100" value="" data-bv-field="sum_project_rate" readonly class="form-control" step='0.01' style="border: none;border-color: transparent;">
                                                  </th>
                                                  <th class="text-center">
                                                      <input type="disabled" name="total_score" id="total_score" value="" data-bv-field="total_weightage" readonly class="form-control" style="border: none;border-color: transparent;">
                                                  </th>
                                                  <th class="text-center">
                                                    
                                                  </th>
                                                  @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                                  <th>
                                                    
                                                  </th>
                                                  @endif
                                              </tr>
                                    </tbody>
                                </table>
                                   
                                   
                                   @if($empData->reportSubmit==1) 
                                        <a class="btn btn-primary pull-left" disabled >Add Row</a>  
          <button name="submit" id="saveKRA"   type="submit" value="1" class="btn btn-primary pull-right" disabled>Save</button>
                                    <a id='delete_row' class="pull-right btn btn-primary" disabled>Delete Row</a>
                                   @else
                                    <a id="add_row" class="btn btn-primary pull-left" >Add Row</a>  
                                     <button name="submit" id="saveKRA"   type="submit" value="1" class="btn btn-primary pull-right" >Save</button>
                                     <a id='delete_row' class="pull-right btn btn-primary"  onclick="fun_sum_project_rate();fun_avg_achieved();" >Delete Row</a>
                                  @endif  
                            </form>
                            </div>
                        </div>
                      </div>
                         <!-- KRA ENDS -->
                         <div id="pop2" class="modal">
                          <div class="modal-content ">
                            <span onclick="fun_popup_close('pop2');" class="close">&times;</span>
                        <div id="csf" class="tab-pane scroll-data">
                        
                            
                     
                           <form role="form" name="frmCsf" id="frmCsf" onSubmit="return checkform()" id="frm_transaction_list" method="post" action="{{url('/')}}/adminarea/transaction/savecsf" style="
    margin-bottom: 45px; ">
                        <input type="hidden" name="status" value=""  />
                        <input type="hidden" value="" name="companyID" />
                        <input type="hidden" name="fieldname" value="{{ Input::get('fieldname') }}" />
                        <input type="hidden" name="order" value="{{ Input::get('order') }}" />
                        <input type="hidden" name="method" value="" />
                        <input type="hidden" name="redirects_to" value="{{Request::fullUrl()}}" />
                        <input type="hidden" id="countcsf" name="countcsf" value="{{count($csfData)?count($csfData):$countCsfManagement}}">
                                    
                        <p>RATING SCALE 
Rate each of the 10 items using the following scale and circle the number corresponding to the rating against each item. <br/>
1 - Unsatisfactory: Fails to achieve results expected; deficient in meeting minimum expectations. Improvement needed to reach competent level; requires more than expected supervision<br/>
2 - Improvement Needed: Mostly meets basic standards; never surpases expectations; improvement is necessary in many work related area<br/>
3 - Good: Meets basic standard and requirements consistently; Occationally surpasses expectations in quality and deliverance of work<br/>
4 - Very good: High quality performance on a consistent basis; supases expectations most of the times<br/>
5 - Outstanding: Achievements consistently exceed expctations; makes significant contributions well beyond job responsibilities<br/><br/></p> 
                        <table class="table table-bordered table-hover" id="tab_csf">
                                    <thead>
                                        <tr >
                                            <th class="text-center"   width="20%" >
                                                CSF
                                            </th>
                                            <th class="text-center"  width="30%">
                                                Description
                                            </th>
                                            <th class="text-center"  width="8%">
                                                Ratings
                                            </th>
                                            <th class="text-center"  width="22%">
                                              Appraisee Remarks
                                            </th>
                                             @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                             <th class="text-center"  width="20%">
                                             Appraisor Remarks
                                             </th>
                                             @endif
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $recordCsfData=count($csfData);?>
                                         
                                           @if($recordCsfData>0)    
                                                   <?php $i=0;?>
                                                    
                                             @foreach($csfData as  $csfData)
                                             
                                              <tr id='addrcsf{{$i}}'>
                                                  <td>
                                                  <textarea @if($empData->reportSubmit==1) readonly @endif   name='csf{{$i}}' required  class="form-control">{{$csfData->csf}}</textarea >
                                                  </td>
                                                  <td>
                                                   <textarea  @if($empData->reportSubmit==1) readonly @endif  name='factors{{$i}}' required     class="form-control">{{$csfData->factors}}</textarea>
                                                  </td>
                                                  <td>
                                                   <textarea  @if($empData->reportSubmit==1) readonly @endif  type="text" name='rating{{$i}}' required   class="form-control" maxlength="1" onKeyPress="return numbersonly(this, event);">{{$csfData->rating}}</textarea >
                                                  </td>
                                                  <td>
                                                   <textarea  @if($empData->reportSubmit==1) readonly @endif  name='remarks{{$i}}' class="form-control">{{$csfData->remarks}}</textarea>
                                                  </td>
                                                   @if($empData->isRejected==1 ||  $empData->subempReport==1)
                                                   <td>
                                                    <input type="hidden" name="comments{{$i}}" required value="{{$csfData->comments}}">
                                                     <textarea readonly  @if($empData->reportSubmit==1) readonly @endif   required    class="form-control">{{$csfData->comments}}</textarea>
                                                  </td>
                                                  @endif
                                                  
                                                  
                                              </tr>
                                              <?php $i++;?>
                                              @endforeach
                                                  <tr id="addrcsf{{$i}}"></tr>
                                         @else
                                            <?php $i=0;?>
                                            @if($countCsfManagement>0)
                                             
                                              @foreach($csfManagementData as $csfShowData)
                                               
                                              <tr id='addrcsf{{$i}}'>
                                                 <td>
                                                  <textarea name='csf{{$i}}' required  class="form-control">{{$csfShowData->caption}}</textarea>
                                                  </td>
                                                  <td>
                                                   <textarea name='factors{{$i}}' required     class="form-control">{{$csfShowData->details}} </textarea>
                                                  </td>
                                               
                                                  <td>
                                                   <textarea  type="text" name='rating{{$i}}' required   class="form-control"  maxlength="1" onKeyPress="return numbersonly(this, event);"></textarea>
                                                  </td>
                                                  <td>
                                                   <textarea  name='remarks{{$i}}'   class="form-control"></textarea>
                                                  </td>
                                              </tr>
                                              
                                              <?php $i++;?>
                                               @endforeach  
                                               <tr id='addrcsf{{$i}}'></tr>
                                               @else
                                               <tr id='addrcsf{{$i}}'>
                                                 <td>
                                                  <textarea name='csf{{$i}}' required  class="form-control"></textarea>
                                                  </td>
                                                  <td>
                                                   <textarea name='factors{{$i}}' required     class="form-control"></textarea>
                                                  </td>
                                               
                                                  <td>
                                                   <textarea  type="text" name='rating{{$i}}' required   class="form-control"  maxlength="1" onKeyPress="return numbersonly(this, event);"></textarea>
                                                  </td>
                                                  <td>
                                                   <textarea  name='remarks{{$i}}' class="form-control"></textarea>
                                                  </td>
                                                  <td>
                                                   <textarea name='comments{{$i}}' required class="form-control"></textarea>
                                                  </td>
                                              </tr>
                                      @endif         
                                         @endif
                                        
                                         
                                    </tbody>
                          </table>          
                        
                       
                          @if($empData->reportSubmit==1)    
                                   <!-- <a  disabled class="btn btn-primary pull-left">Add Row</a>   -->
                             <button name="submit" disabled type="submit" value="1" class="btn btn-primary pull-right" >Save</button>
                                    <!-- <a id='delete_csf' disabled class="pull-right btn btn-primary">Delete Row</a>  -->
                                @else
                                 <a id="add_csf" class="btn btn-primary pull-left">Add Row</a>
                                 <button name="submit" type="submit" value="1" class="btn btn-primary pull-right" >Save</button>
                                 <a id='delete_csf' class="pull-right btn btn-primary">Delete Row</a>
                               
                                @endif     
                       
                       
                        </form>
                           
                           
                        </div>
                      </div>
                    </div>
                         <!-- CSF ENDS -->
                         <div id="pplan" class="modal">
                          <div class="modal-content">
                            <span onclick="fun_popup_close('pplan');" class="close">&times;</span>
                       <div id="pplan" class="tab-pane scroll-data">
                          
                        @include('adminarea.transaction.transaction-pplan')
                       </div>
                     </div>
                   </div>
             
           <div id="devplan" class="modal">
                          <div class="modal-content">
                            <span onclick="fun_popup_close('devplan');" class="close">&times;</span>
          <div id="devplan" class="tab-pane scroll-data">
                         @include('adminarea.transaction.transaction-dplan')       
                        </div>
                      </div>
                    </div>
                  </div>
             <div>
               
             </div>




             <!-- Changes on 26-12-2017 -->

        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-card recent-activites">
               <div class="card-header">
                    As Appraisor 
                    <div class="float-right">
                        <div class="btn-group">Employee listing</div>
                    </div>
               </div>
               <div class="panel-body  p-xl-3">
            			 @if(Session::has('flash_message'))
                         <div class="alert alert-success fade in">
				    <a href="#" class="close" data-dismiss="alert">&times;</a>
				    <strong>{{ Session::get('flash_message') }}!</strong> 
				</div>
			 
			@endif
            	        <div class="row">
                            <label class="col-sm-2 form-control-label">Select Employee <span  >: </span></label>
                                <div class="col-sm-8">
                                  <form id="search" name="search" action="{{ url('/') }}/adminarea/transaction/getkra" method="post">
                                 
                                   @if($recordsEmployee>0)
                                    <select name="searchEmployeeID" id="searchEmployeeID" onchange="getemployee()" class="form-control">
                                     <script src="{{url('/components/js/bootstrap.min.js') }}" type="text/javascript"></script>    
                                    	<option value="">- Select  -</option>
                                    	@foreach($searchEmployeeData as $employee)
                                    	  @if($employee->reportSubmit==1) 
                                          <option value="{{$employee->EmployeeID}}" @if($searchEmployeeID==$employee->EmployeeID) selected='selected' @endif>{{$employee->EmpName}}</option>           @endif	
                                       @endforeach
                                    </select>
                                  @endif
                                  </form>
                                  <script>
                                  function getemployee()
				  {             var frmobj=window.document.search;
						frmobj.action="{{ url('/') }}/adminarea/transaction/getcsf";
						frmobj.submit();
				  }
                                  
                                  </script>
                                    
                                </div>
                         </div>	
                         @if($isSearch==1) 	
                         <br><br>
                         
                          <div class="col-lg-12">
                               @foreach($employeeData as $empData)
                              		<div class="col-sm-4" >
                              	  <div class="form-group row">	
	                                  <div class="col-sm-6">			
	                              	 	 <div class="form-group row"><label>Employee Code </label></div>	
					  </div>
					  <div class="col-xs-1"><b>:</b></div>
					   <div class="col-sm-4">			
	                              	 	 <div class="form-group row"> {{$empData->empCode}}</div>	
					  </div>
				   </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-6">			
	                              	 	 <div class="form-group row"><label>Employee Name</label></div>	
					  </div>
					  <div class="col-xs-1"><b>:</b></div>
					   <div class="col-sm-4">			
	                              	 	 <div class="form-group row">{{$empData->EmpName}}</div>	
					  </div>
				   </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-6">			
	                              	 	 <div class="form-group row"><label>Date Of Joining</label></div>	
					  </div>
					    <div class="col-xs-1"><b>:</b></div>
					   <div class="col-sm-4">					
	                              	 	 <div class="form-group row">{{date('d-M-Y',strtotime($empData->DateOfJoin))}} </div>	
					  </div>
				   </div>
				   	 				  
                              	</div>
                              	
                             
                              	<div class="col-sm-4">
                              		<div class="form-group row">	
	                                  <div class="col-sm-3">			
	                              	 	 <div class="form-group row"><label>Department</label> </div>	
					  </div>
					  <div class="col-sm-1 col-xs-offset-1"><b>:</b></div>
					   <div class="col-sm-6 ">			
	                              	 	 <div class="form-group row">{{$empData->deptepartmentName}}</div>	
					  </div>
				     </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-3">			
	                              	 	 <div class="form-group row"><label>Designation</label></div>	
					  </div>
					  <div class="col-sm-1 col-xs-offset-1"><b>:</b></div>
					   <div class="col-sm-6 ">			
	                              	 	 <div class="form-group row">{{$empData->designationName}}</div>	
					  </div>
				    </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-3">			
	                              	 	 <div class="form-group row"><label>Category</label></div>	
					  </div>
					   <div class="col-sm-1 col-xs-offset-1"><b>:</b></div>
					   <div class="col-sm-6  ">			
	                              	 	 <div class="form-group row">{{$empData->empcatName}} </div>	
					  </div>
				    </div>
                               	</div>
                              	 
                              	
                              	
                              	
                              	
                              	<div class="col-sm-4">
                              		<div class="form-group row">	
	                                  <div class="col-sm-4">			
	                              	 	 <div class="form-group row"><label>Grade</label></div>	
					  </div>
					  <div class="col-sm-1 "><b>:</b></div>
					   <div class="col-sm-6">			
	                              	 	 <div class="form-group row"> {{$empData->empgradeName}}</div>	
					  </div>
				   </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-4">
	                                 			
	                              	 	 <div class="form-group row"><label>Appraisor</label></div>	
					  </div>
					  <div class="col-sm-1 "><b>:</b></div>
					   <div class="col-sm-6">
					         <?php $empAppraisor =   Employee::where('EmployeeID', '=', $empData->Appraisor)->select('EmpName')->first(); ?>			
	                              	 	 <div class="form-group row">@if(count($empAppraisor)>0) {{ $empAppraisor->EmpName }}  @endif </div>	
					  </div>
				   </div>
				    <div class="form-group row">	
	                                  <div class="col-sm-4">			
	                              	 	 <div class="form-group row"><label>Reviewer </label></div>	
					  </div>
					  <div class="col-sm-1 "><b>:</b></div>
					   <div class="col-sm-6">
					         <?php $empReviewer  =   Employee::where('EmployeeID', '=', $empData->Reviewer )->select('EmpName')->first(); ?>			
	                              	 	 <div class="form-group row">@if(count($empReviewer)>0) {{$empReviewer->EmpName }}  @endif </div>	
					  </div>
				   </div>
                              	  <div class="form-group row">	
	                                  <div class="col-sm-4">			
	                              	 	 <div class="form-group row"><label>Reporting To </label></div>	
					  </div>
					  <div class="col-sm-1 "><b>:</b></div>
					   <div class="col-sm-6">
					   	<?php $empReporting  =   Employee::where('EmployeeID', '=', $empData->Reporting)->select('EmpName')->first(); ?>			
	                              	 	 <div class="form-group row">@if(count($empReporting)>0) {{$empReporting->EmpName}}  @endif </div>	
					  </div>
					  
					  
					  
					  
					  
				   </div>
                              	
                              	
                              	</div>
                        	
					
            	
                             	
                             	
                             @endforeach
                             </div>
                         
                         
                         
                         
                         
                         
                         
                             <?php
                              
                             
                            // use App\Http\Models\Employee_category;
                             $employeeCategory = new Employee_category;
                             $findCatID= Employee_category::where('empcatName',$empData->empcatName)->get();
                              
                             $csfManagement = new Csfmanagement;
                             $csfManagementData =   Csfmanagement::where('type',$findCatID[0]->empcatID)->get(); 
                             $countCsfManagement =count($csfManagementData);  
                              
                             
                             
                         ?>   
                         
                             @if($empData->revRejected==1)
                             <div class="row">
	                            <label class="col-sm-2 form-control-label">Reviewer's Comment <span  >: </span></label>
	                                <div class="col-sm-10">
	                                   <label>{{$empData->revComments}} </label>
	                                </div>
	                            </div>
                            @endif
                             
                             
                             <div class="form-group row">
                                    <div class="hr-line-dashed"></div>        <!-- strat box footer area-->
                            </div> 
                             <div class="row">
                                <div class="form-group row">
                                     <div class="col-sm-6 col-sm-offset-2">
                                        <form action="{{url('/')}}/adminarea/transaction/submitEmpReports" method="post">
	                                     <input type="hidden" name="submitEmployeeID" value="{{$empData->EmployeeID}}">
	                                     @if($empData->isRejected==1 || $empData->subempReport==1)
	                                      
	                                       <button name="submit"  disabled class="btn btn-primary pull-left">Reject</button> 
	                                      
	                                     
	                                     @else
	                                          <button name="submit" type="submit" value="0" class="btn btn-primary pull-left" onclick="return confirm('Are you Sure You Want To Reject Report of these employee?')">Reject</button>
	                                          
	                                     
	                                     @endif
	                                    
	                                      
	                                      @if($empData->subempReport==1)
	                                        <button name="submit"  disabled class="btn btn-primary pull-right" onclick="return confirm('KRA once submitted will not be able to submit again. Want to re-submit?')">Submit</button>  
	                                      <label class="col-sm-8 col-md-offset-6" >KRA is already been submitted</label> 
	                                     @else
	                                     <button name="submit" type="submit" value="1" class="btn btn-primary pull-right" onclick="return confirm('KRA once submitted will not be able to submit again. Want to re-submit?')"  >Submit</button>   	                                      
	                                      @endif
	                                      </form>
                                      </div>
                             </div>
                             </div>
                             @else
                             
                             @endif
                             
                             
                         
                        
                         
                         
                         
                </div>
                @if($isSearch==1)
                  
                <div class="card-header">
                    Reporting Informations 
                    <div class="float-right">
                        <div class="btn-group">Reporting Details</div>
                    </div>
               </div>
                
   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <div class="panel-body  p-xl-3">
                 		<ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" aria-expanded="true" href="#kranew">KRA</a></li>
				    <li><a data-toggle="tab" href="#csfnew">CSF</a></li>
		                    <li><a data-toggle="tab" href="#pplannew">Performance Plan</a></li>
		                    <li><a data-toggle="tab" href="#devplannew">Development Plan</a></li>
			        </ul>
<br><br>
			  <div class="tab-content">
			   <div id="kranew" class="tab-pane fade in active">
			        <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center"  width="22%" >
                                                KRA
                                            </th>
                                            <th class="text-center"  width="22%">
                                                PMS
                                            </th>
                                            <th class="text-center"  width="8%">
                                                Weightage
                                            </th>
                                            <th class="text-center"  width="8%">
                                                Achieved %
                                            </th>
                                            <th class="text-center"  width="8%">
                                                Score
                                            </th>
                                            <th class="text-center"  width="22%">
                                              Appraisee Remarks
                                            </th>
                                            <th class="text-center"  width="22%">
                                              Appraisor Remarks
                                            </th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                      <?php $recordKraData=count($kraData);?>
                                          
                                       @if($recordKraData>0)  
                                       	<?php $i=0;?>
                                            @foreach($kraData as $kradata)
                                         	 
                                            <tr id='addr{{$i}}'>
                                            	<input type="hidden" name="kraID{{$i}}" id="kraID{{$i}}" value="{{$kradata->kraID}}">
                                                <td>
                                                	<textarea readonly name='kra{{$i}}' required  class="form-control">{{$kradata->kra}}</textarea>
                                                </td>
                                                <td>
                                                 	<textarea readonly  name='pms{{$i}}' required     class="form-control">{{$kradata->pms}}</textarea>
                                                </td>
                                                <td>
                                                 	<textarea type="text" name='weightage{{$i}}' required value='{{$kradata->weightage}}'  onkeypress="return isNumber(event)  class="form-control">{{$kradata->weightage}}</textarea> 
                                                </td>
                                                <td>
                                                 	<textarea  type="text" name='achieved{{$i}}' required value='{{$kradata->achieved}}'  class="form-control">{{$kradata->achieved}} </textarea>
                                                </td>
                                                <td>
                                                	<label>{{$kradata->score}}</label>
                                                 	<!--<input readonly type="text" name='score{{$i}}'  required value='{{$kradata->score}}'    class="form-control"> -->
                                                </td>
                                                <td>
                                                	 <textarea  readonly name='remarks{{$i}}' required  class="form-control">{{$kradata->remarks}}</textarea>
                                                </td>
                                                
                                                
												@if($empData->isRejected==1 || $empData->subempReport==1)
													<td>
														<textarea readonly  name='commentskra{{$i}}' id="commentskra{{$i}}" value='{{$kradata->comments}}'  required  class="form-control"> {{$kradata->comments}}</textarea>
													</td>
												@else
													<td>
														<textarea  name='commentskra{{$i}}' id="commentskra{{$i}}" value='{{$kradata->comments}}' onBlur= "updateCommentKra({{$i}})" required  class="form-control"> {{$kradata->comments}}</textarea>
													</td>
												@endif

												</tr>
                                            
                                            <?php $i++;?>                    
                                            @endforeach
                                       @endif
                                     </tbody>  
			      </table>
			      
			    <script>
			    function updateCommentKra(id)
			    {    
			        kraID   =  $("#kraID"+id).val(); 
			    	kracmnt = $("#commentskra"+id).val();
			    	 
			    	 
			    	 
				 	$.ajax({
			            type: "POST",
			            url: '{{url('/')}}/adminarea/transaction/updateKraComments',
			            data: {kraID: kraID, kracmnt : kracmnt },
			            success: function( msg ) {
			                $("#ajaxResponse").append("<div>"+msg+"</div>");
			            }
			        });
			    	 
			    }
			    </script>
                                      
			    </div>
			  
			  
			    <div id="csfnew" class="tab-pane fade ">
			   
			         @if($reacordCsfData>0)      
			          <table class="table table-bordered table-hover" id="tab_logic">
			                <thead>
			                    <tr >
			                        <th class="text-center"  width="20%" >
			                            Csf
			                        </th>
			                        <th class="text-center"  width="35%">
			                            Critical Factors
			                        </th>
			                        <th class="text-center"  width="8%">
			                            Ratings
			                        </th>
			                        <th class="text-center"  width="15%">
			                        	Appraisee Remarks
			                        </th>
			                        <th class="text-center"  width="15%">
	                                              Appraisor Remarks
	                                        </th>
			                    </tr>
			                </thead>
			                <tbody>
			                        <?php $i=0;?>
			                     
			                	@foreach($csfData as $csfdata)
			                	
			                	<input type="hidden" name="csfid{{$i}}" id="csfid{{$i}}" value="{{$csfdata->csfID}}">
			                	<tr>
			                	<td>
                                                <textarea  name='csf{{$i}}' readonly="readonly"  class="form-control">{{$csfdata->csf}}</textarea>
                                                </td>
                                                <td>
                                                 <textarea  name='factors{{$i}}' readonly="readonly"     class="form-control">{{$csfdata->factors}}</textarea>
                                                </td>
                                                <td>
                                                 <textarea  type="text" name='rating{{$i}}' readonly="readonly" value='{{$csfdata->rating}}'    class="form-control">{{$csfdata->rating}}</textarea>
                                                </td>
                                                 
                                                <td>
                                                 <textarea  name='remarks{{$i}}' readonly required  class="form-control">{{$csfdata->remarks}}</textarea>
                                                </td>
			                	  @if($empData->isRejected==1 || $empData->subempReport==1)
                                                  <td>
                                                 
                                                	 <textarea readonly  name='commentscsf{{$i}}' id="commentscsf{{$i}}" value='{{$csfdata->comments}}'  required  class="form-control"> {{$csfdata->comments}}</textarea>
                                                </td>
						@else
						<td>
                                                 
                                                	 <textarea  name='commentscsf{{$i}}' id="commentscsf{{$i}}" value='{{$csfdata->comments}}' onBlur= "updateCommentCsf({{$i}})" required  class="form-control"> {{$csfdata->comments}}</textarea>
                                                </td>
			                	 @endif
			                	</tr>
			                	 <?php $i++;?>
			                	@endforeach
			                      @endif
			       </tbody>
			            </table>
			 </div>
			  <script>
			    function updateCommentCsf(id)
			    {    
			        csfID   =  $("#csfid"+id).val(); 
			    	csfcmnt = $("#commentscsf"+id).val();
			    	 $.ajax({
			            type: "POST",
			            url: '{{url('/')}}/adminarea/transaction/updateCsfComments',
			            data: {csfID   : csfID   , csfcmnt : csfcmnt },
			            success: function( msg ) {
			                $("#ajaxResponse").append("<div>"+msg+"</div>");
			            }
			        });
			    	 
			    }
			    </script>
			   
			<div id="pplannew" class="tab-pane fade">
    	                     <table class="table table-bordered table-hover" id="tab_pplan">
                             <thead>
                                   <tr >
                                       	    <th class="text-center"  width="30%" >KRA</th>
                                            <th class="text-center"  width="10%">Timeline</th>
                                            <th class="text-center"  width="10%">Measure Of Achievements</th>
                                            <th class="text-center"  width="10%">Weightage</th>
                                            <th class="text-center"  width="20%">Support Required</th>
                                           <th class="text-center"  width="20%">Comments</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                     <?php $recordPplanData = count($pplanData);?>
                                            <?php $i=0;?>
		                            @if($recordPplanData>0) 
		                             @foreach($pplanData as  $pplanData )
	                                                     <input type="hidden" name="pplanid{{$i}}" id="pplanid{{$i}}" value="{{$pplanData ->pplanID}}">    	                                          
		                                            <tr id='addrpplan{{$i}}'>
		                                                <td>
		                                                <textarea  readonly name='pplankra{{$i}}' required  class="form-control">{{$pplanData ->pplanKra}}</textarea>
		                                             
		                                                </td>
		                                                <td>
		                                                 <textarea readonly  name='timeline{{$i}}' required     class="form-control">{{$pplanData->timeline}}</textarea>
		                                                </td>
		                                                <td>
		                                                 <textarea readonly name='measure{{$i}}' required     class="form-control">{{$pplanData->measure}}</textarea>
		                                                </td>
		                                                <td>
		                                                 <textarea type="text" readonly name='weightage{{$i}}' required value='{{$pplanData->weightage}}'  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   class="form-control">{{$pplanData->weightage}}</textarea>
		                                                </td>
		                                                <td>
		                                                 <textarea readonly name='support{{$i}}' required  class="form-control">{{$pplanData->support}}</textarea>
		                                                </td>
		                                                 @if($empData->isRejected==1 || $empData->subempReport==1)
		                                                  <td>
		                                                 
		                                                	 <textarea readonly  name='commentspplan{{$i}}' id="commentspplan{{$i}}" value='{{$pplanData->comments}}'  required  class="form-control"> {{$pplanData->comments}}</textarea>
		                                                </td>
								@else
								<td>
		                                                 
		                                                	 <textarea  name='commentspplan{{$i}}' id="commentspplan{{$i}}" value='{{$pplanData->comments}}' onBlur= "updateCommentPplan({{$i}})" required  class="form-control"> {{$pplanData->comments}}</textarea>
		                                                </td>
					                	 @endif
		                                            </tr>
		                                            <?php $i++;?>
		                                            
		                              @endforeach
		                           
		                           @endif  
		                        </tbody>
			            </table>    
			            
			           <script>
			    function updateCommentPplan(id)
			    {    
			        pplanID   =  $("#pplanid"+id).val(); 
			    	commentspplan = $("#commentspplan"+id).val();
			    	 
			    	 $.ajax({
			            type: "POST",
			            url: '{{url('/')}}/adminarea/transaction/updatePplanComments',
			            data: {pplanID   : pplanID   , commentspplan : commentspplan },
			            success: function( msg ) {
			                $("#ajaxResponse").append("<div>"+msg+"</div>");
			            }
			        });
			    	 
			    }
			    </script>
			            
			            
			                          
                           
    			</div>
    			 
    			<div id="devplannew" class="tab-pane fade">
    	                     <table class="table table-bordered table-hover" id="tab_dplan">
                             <thead>
                                   <tr >
                                       	    <th class="text-center"  width="30%" >Skills</th>
                                            <th class="text-center"  width="20%">Behaviour</th>
                                            <th class="text-center"  width="30%">Description</th>
                                            <th class="text-center"  width="20%">Comments</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                     <?php $recordDplanData=count($dplanData);?>
                                            	 
	                                    @if($recordDplanData>0)
	                                                   <?php $i=0;?>
                                                         
		                                           @foreach($dplanData as  $dplanData)
		                                           <tr id='addrdplan{{$i}}'>
		                                                   <input type="hidden" name="dplanid{{$i}}" id="dplanid{{$i}}" value="{{$dplanData->dpanID}}"> 
		                                                <td>
		                                                <textarea readonly name='skill{{$i}}' required  class="form-control">{{$dplanData->skill}}</textarea>
		                                                </td>
		                                                <td>
		                                                 <textarea readonly name='behaviour{{$i}}' required     class="form-control">{{$dplanData->behaviour}}</textarea>                                                      </td>
		                                                <td>
		                                                 <textarea readonly name='description{{$i}}' required     class="form-control">{{$dplanData->description}}</textarea>							</td>
		                                                @if($empData->isRejected==1 || $empData->subempReport==1)
		                                                  <td>
		                                                 
		                                                	 <textarea readonly  name='commentsdplan{{$i}}' id="commentsdplan{{$i}}" value='{{$dplanData->comments}}'  required  class="form-control"> {{$dplanData->comments}}</textarea>
		                                                </td>
								@else
								<td>
		                                                 
		                                                	 <textarea  name='commentsdplan{{$i}}' id="commentsdplan{{$i}}" value='{{$dplanData->comments}}' onBlur= "updateCommentDplan({{$i}})" required  class="form-control"> {{$dplanData->comments}}</textarea>
		                                                </td>
					                	 @endif 
		                                           </tr>
		                                            <?php $i++;?>
		                                            
		                                            @endforeach
    	                     @endif  
		                        </tbody>
			            </table>  
    	                    
    	                    
    	                    
    	                     <script>
			    function updateCommentDplan(id)
			    {    
			        dplanID   =  $("#dplanid"+id).val(); 
			    	commentsdplan = $("#commentsdplan"+id).val();
			    	  
			    	 $.ajax({
			            type: "POST",
			            url: '{{url('/')}}/adminarea/transaction/updateDplanComments',
			            data: { dplanID: dplanID, commentsdplan : commentsdplan },
			            success: function( msg ) {
			                $("#ajaxResponse").append("<div>"+msg+"</div>");
			            }
			        });
			    	 
			    }
			    </script>
    	                     
                        <div>
                        
                        </div>
               <div>
               <!-- panel-body -->
@endif
            </div>
        </div>
    </div>
 
<script type="text/javascript">

       /*-----------------script for csf goes here-----*/


	 
	var i=0;
	 
        
       $("#add_csf").click(function(){
      $('#addrcsf'+i).html("<td><textarea  name='csf"+i+"' class='form-control' required></textarea></td><td><textarea  name='factors"+i+"' class='form-control' required></textarea></td><td><input type='text' name='rating"+i+"' required class='form-control'></td><td><textarea required name='remarks"+i+"' class='form-control'></textarea></td>");
$('#tab_csf').append('<tr id="addrcsf'+(i+1)+'"></tr>');
      $('#count').val(i+1);
      i++; 
  });
     $("#delete_csf").click(function(){
         if(i>1){
         $("#addrcsf"+(i-1)).html('');
         $('#count').val(i-1);
         i--;
         }
     });  



</script>

 <style>
.nav>li>a {
    position: relative;
    display: block;
    padding: 8px 5px;
</style>
        <!-- panel-body -->
    
 
 <?php $recordKraData=count($kraData);?>
 <?php $recordPplanData  = count($pplanData);?>
 <?php $recordDplanData = count($dplanData);?>
 <?php $reportSubmit = $empData->reportSubmit;?>


<script type="text/javascript">
  function PassData(val) {
    $('#hidecom').val(val);

  }
  function PassData2(val2) {
    $('#hideAw').val(val2);

  }
</script>
 <script type="text/javascript">
   // Get the modal
function fun_popup(id){
  
  var modal = document.getElementById(id);
  modal.style.display = "block";
}


// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
function fun_popup_close(id){
  var modal = document.getElementById(id);
  modal.style.display = "none";

}

// When the user clicks on the button, open the modal 
/*btn.onclick = function() {
    modal.style.display = "block";
}*/

// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks anywhere outside of the modal, close it
/*window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/
 </script>


<script type="text/javascript">
   
   
   
   /* Function  to check and allow only numbner*/
   function isNumber(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
  
         return true;
      }
      
       
     /*----------------Script ofr KRA---------*/
       
      function checkform()
      {
      
      
      if(document.frmKra.field.value == '') 
        {
        return false;
  }
  if(document.frmCsf.field.value == '') 
        {
        return false;
  }
   
  if(document.frmPlan.field.value == '')
  {
   return false;
  } 
  if(document.frmDplan.field.value == '')
  {
  return false;
  } 
  
      }
      
      
      

     $("#add_row").click(function(){
    
       var z=+$("#countKraData").val();      
    @if($empData->isRejected==1 ||  $empData->subempReport==1)                           
      $('#addr'+z).html("<td><textarea  name='kra"+z+"' class='form-control' required></textarea></td><td><textarea  name='pms"+z+"' class='form-control' required></textarea></td><td><textarea type='text' id='weightage"+z+"' name='weightage"+z+"' onPaste='return false' onkeypress='return isNumber(event)' onBlur='fun_sum_project_rate();' required class='form-control weightage'></textarea></td><td><textarea type='text' onkeypress='return isNumber(event)' onPaste='return false' required name='achieved"+z+"' id='achieved"+z+"' onBlur='fun_avg_achieved(); CalculateValue("+z+");' class='form-control achieved'></textarea></td><td><label id='changescore"+z+"' ></label></td><td><textarea  name='remarks"+z+"' class='form-control'></textarea></td><td><textarea  name='comment"+z+"' class='form-control'></textarea></td><input type='hidden' name='score"+z+"' id='score"+z+"' value='' class='score'>");
      @else
      $('#addr'+z).html("<td><textarea  name='kra"+z+"' class='form-control' required></textarea></td><td><textarea  name='pms"+z+"' class='form-control' required></textarea></td><td><textarea type='text' id='weightage"+z+"' name='weightage"+z+"' onPaste='return false' onkeypress='return isNumber(event)' onBlur='fun_sum_project_rate();' required class='form-control weightage'></textarea></td><td><textarea type='text' onkeypress='return isNumber(event)' onPaste='return false' required name='achieved"+z+"' id='achieved"+z+"' onBlur='fun_avg_achieved(); CalculateValue("+z+");'  class='form-control achieved'></textarea></td><td><label id='changescore"+z+"'></label></td><td><textarea  name='remarks"+z+"' class='form-control'></textarea></td><input type='hidden' name='score"+z+"' id='score"+z+"' value='' class='score'>");
      @endif
 
      $('#tab_logic').append('<tr id="addr'+(z+1)+'"></tr>');
        var num = +$("#countKraData").val() + 1;
  $("#countKraData").val(num);
       
  });
  
    $("#delete_row").click(function(){
        var z=+$("#countKraData").val(); 
        var reportSubmit = {{$reportSubmit }};
        
      
         if(reportSubmit==0){
          
             $("#addr"+(z-1)).html('');
           $('#countKraData').val(z-1);
           z--;
           }
         else
         {
          alert('Sorry You Cannot Delete The Records');  
         }
     });


     /*-----------------script for csf goes here-----*/

       $("#add_csf").click(function(){
      var y=+$("#countcsf").val(); 
      @if($empData->isRejected==1 ||  $empData->subempReport==1)
      $('#addrcsf'+y).html("<td><textarea  name='csf"+y+"' class='form-control' required></textarea></td><td><textarea  name='factors"+y+"' class='form-control' required></textarea></td><td><textarea type='text' name='rating"+y+"'  maxlength='1' onKeyPress='return numbersonly(this, event);' required class='form-control'></textarea></td><td><textarea  name='remarks"+y+"' class='form-control'></textarea></td><td><textarea  name='comment"+y+"' class='form-control'></textarea></td>");
      @else
      $('#addrcsf'+y).html("<td><textarea  name='csf"+y+"' class='form-control' required></textarea></td><td><textarea  name='factors"+y+"' class='form-control' required></textarea></td><td><textarea type='text' name='rating"+y+"'  maxlength='1' onKeyPress='return numbersonly(this, event);' required class='form-control'></textarea></td><td><textarea  name='remarks"+y+"' class='form-control'></textarea></td>");
      @endif
      

$('#tab_csf').append('<tr id="addrcsf'+(y+1)+'"></tr>');
      var n = +$("#countcsf").val() + 1;
      
  $("#countcsf").val(n);
      
  });
     $("#delete_csf").click(function(){
       var y=+$("#countcsf").val();
       var reportSubmit = {{$reportSubmit }};
        if(reportSubmit==0){
         $("#addrcsf"+(y-1)).html('');
         $('#countcsf').val(y-1);
         y--;
          
         }
         else
         {
        alert('Sorry You Cannot Delete The Records');
         }
     });
 

  
    /*------------------Script for pplan---- */
 
  
     var b = +$("#pplancount").val(); 
     $("#add_pplan").click(function(){
     @if($empData->isRejected==1 ||  $empData->subempReport==1)
     $('#addrpplan'+b).html("<td><textarea  name='pplankra"+b+"' class='form-control' required></textarea></td><td><textarea  name='timeline"+b+"' class='form-control' required></textarea></td><td><textarea  name='measure"+b+"' class='form-control' required></textarea></td><td><textarea type='text' onkeypress='return isNumber(event)'  name='weightage"+b+"' required class='form-control'></textarea></td><td><textarea required name='support"+b+"' class='form-control'></textarea></td><td><textarea required name='comment"+b+"' class='form-control'></textarea></td>");
      @else
      $('#addrpplan'+b).html("<td><textarea  name='pplankra"+b+"' class='form-control' required></textarea></td><td><textarea  name='timeline"+b+"' class='form-control' required></textarea></td><td><textarea  name='measure"+b+"' class='form-control' required></textarea></td><td><textarea type='text' onkeypress='return isNumber(event)'  name='weightage"+b+"' required class='form-control'></textarea></td><td><textarea required name='support"+b+"' class='form-control'></textarea></td>");
      @endif
      
      $('#tab_pplan').append('<tr id="addrpplan'+(b+1)+'"></tr>');
       var c = +$("#pplancount").val() + 1;
         $("#pplancount").val(c);
      b++; 
  });
  $("#delete_pplan").click(function(){
      var b = +$("#pplancount").val(); 
                       
          var reportSubmit = {{$reportSubmit }};
        if(reportSubmit==0){
         $("#addrpplan"+(b-1)).html('');
         $('#pplancount').val(b-1);
         b--;
          
         }
         else
         {
        alert('Sorry You Cannot Delete The Records');
         }
     });
  
  
 /*------------------Script for dplan----*/
  
  var f = +$("#dplancount").val(); 
     $("#add_dplan").click(function(){
     @if($empData->isRejected==1 ||  $empData->subempReport==1)
     $('#addrdplan'+f).html("<td><textarea  name='skill"+f+"' class='form-control' required></textarea></td><td><textarea  name='behaviour"+f+"' class='form-control' required></textarea></td><td><textarea  name='description"+f+"' class='form-control' required></textarea></td><td><textarea  name='comment"+f+"' class='form-control' required></textarea></td>");
      @else
      $('#addrdplan'+f).html("<td><textarea  name='skill"+f+"' class='form-control' required></textarea></td><td><textarea  name='behaviour"+f+"' class='form-control' required></textarea></td><td><textarea  name='description"+f+"' class='form-control' required></textarea></td>");
      @endif
      
      $('#tab_dplan').append('<tr id="addrdplan'+(f+1)+'"></tr>');
       var c = +$("#dplancount").val() + 1;
         $("#dplancount").val(c);
      f++; 
  });
  
     $("#delete_dplan").click(function(){
      var f = +$("#dplancount").val(); 
  
    
  
       var reportSubmit = {{$reportSubmit }};
        if(reportSubmit==0){
        $("#addrdplan"+(f-1)).html('');
         $('#dplancount').val(f-1);
         f--;
          
         }
         else
         {
         alert('Sorry You Cannot Delete The Records');
         }
     });
  
  
  

</script>
<script type="text/javascript">
  / Numbers Only / 
 function numbersonly(myfield, e, dec) {
  
 var key;
 var keychar;

 if (window.event)
   key = window.event.keyCode;
 else if (e)
   key = e.which;
 else
   return true;
 keychar = String.fromCharCode(key);

 // control keys

 if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
   return true;

 // numbers
 else if ((("12345").indexOf(keychar) > -1))
   return true;

 // decimal point jump
 else if (dec && (keychar == ".")) {
   myfield.form.elements[dec].focus();
   alert('You cannot enter ratings greater than 5');
   return false;
 } else{
  alert('You cannot enter ratings greater than 5');
   return false;
 }
}

function fun_sum_project_rate() {
  setTimeout(function(){ 
    var total = 0;
    $('.weightage').each(function (index, element) {
   
        total = total + parseFloat($(element).val());
    });
    sum_project_rate.value=total;
    total_weightage.value=total;
  }, 100);
}
function fun_avg_achieved() {
  setTimeout(function(){ 
    var total = 0;
    $('.achieved').each(function (index, element) {
   
        total = total + parseFloat($(element).val());
    });
    var numItems = $('.achieved').length;
    var avg_achieved=total/numItems;
    avg_achieved_rate.value=parseFloat(avg_achieved).toFixed(2);
    avg_achieved_rate1.value=parseFloat(avg_achieved).toFixed(2);
  }, 100);
}
fun_sum_project_rate();
fun_avg_achieved();
</script>

 <style>
.nav>li>a {
    position: relative;
    display: block;
    padding: 8px 5px;
</style>
@include('adminarea.include.jsdatatable')
@endsection


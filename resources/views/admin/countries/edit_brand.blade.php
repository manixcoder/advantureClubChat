<style type="text/css">
   .colerclass{
      color: #317eeb;
   }
   .menustyle{
      margin: 10px;
   }
</style>
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Edit Brand</h4>
            <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">Edit Brand</li>
            </ol>
         </div>
      </div>
      <form  action="{{ URL::to('add-brand')}}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
         <div class="row" id="example-basic">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="m-b-30">
                              <button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i>  Go Back </button>
                           </div>
                        </div>
                     </div>
                     <div class="row" style="text-align: center;">
                        <div class="col-md-12">
                           <div class="form-group"> 
                              <img src="http://localhost/imark_admin/public/brand_image/{{ $editdata->image }}" alt="Product image" width="100" height="100">
                              <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <input type="hidden" name="ids" id="ids" value="{{ $editdata->id ?? '' }}">
                        <div class="col-md-6">
                           <div class="form-group">  
                              <label class="control-label">Brand name : <font color="red">*</font></label>
                              <input  type="text" id="brand_name" name="brand_name" class="form-control" required="" value="{{ $editdata->brand_name ?? '' }}" aria-required="true" placeholder="" autocomplete="off"> 
                           </div>
                        </div>
                        @if($editdata->brand_name == 1)
                        <div class="col-md-6">
                           <div class="form-group">
                              <p class="control-label"><b>Status : </b> <font color="red">*</font></p>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="active" value="0" name="status" checked="">
                                 <label for="inlineRadio1"> Active </label>
                              </div>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="inactive" value="1" name="status">
                                 <label for="inlineRadio1"> Inactive </label>
                              </div>
                           </div>
                        </div>
                        @else
                           <div class="col-md-6">
                           <div class="form-group">
                              <p class="control-label"><b>Status : </b> <font color="red">*</font></p>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="active" value="0" name="status">
                                 <label for="inlineRadio1"> Active </label>
                              </div>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="inactive" value="1" name="status" checked="">
                                 <label for="inlineRadio1"> Inactive </label>
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>                       
                                                                                 
                  <div class="modal-footer">
                     <button type="submit" id="submitbtn" class="btn btn-primary">Update</button>
                  </div>
               </div><!-- End card-body -->
            </div> <!-- End card -->
         </form><!-- Form End -->
      </div><!-- container -->
   </div>

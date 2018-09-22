@extends('layouts.admin.app')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">  
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height: 530px">
          <div class="x_title">
            <h2><i class="fa fa-lock"></i> Change Password</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form method="POST" action="" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}
              <div class="item form-group" style="text-align: center">
                <label class="col-md-11 col-sm-12 col-xs-12" for="name"><u>PLEASE NOTE:</u> ALL FIELDS MARKED <span class="star">( * )</span> ARE COMPULSORY.
                </label>    <br/>&nbsp;                   
              </div>
              <div class="item form-group">
                <label class="col-md-3 col-sm-2 col-xs-12" for="name">Old Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                 <input id="oldpassword" type="password" class="form-control col-md-7 col-xs-12" name="oldpassword" placeholder=" Old Password" required>

                 @if ($errors->has('oldpassword'))
                 <span class="help-block">
                  <strong>{{ $errors->first('oldpassword') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="item form-group">
              <label class="col-md-3 col-sm-2 col-xs-12" for="name">New Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
               <input id="newpassword" type="password" class="form-control col-md-7 col-xs-12" name="newpassword" placeholder=" New Password" required>

               @if ($errors->has('newpassword'))
               <span class="help-block">
                <strong>{{ $errors->first('newpassword') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="item form-group">
            <label class="col-md-3 col-sm-2 col-xs-12" for="designation">Password Confirmation <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
              <input id="confirmpassword" type="password" class="form-control col-md-7 col-xs-12" name="confirmpassword" placeholder=" Password_Confirmation" required>
              @if ($errors->has('confirmpassword'))
              <span class="help-block">
                {{ $errors->first('confirmpassword') }}
              </span>
              @endif
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="reset" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</button>
              <button id="send" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- /page content -->

@endsection





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
            <h2><i class="fa fa-hotel"></i> View Video Information</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-6 col-sm-10 col-xs-12">
             
              <video src="{{$video->url}}" width="300px" height="200px" controls></video>
              <a class="btn btn-xs btn-primary" href="{{ route('confirm.video', $video->id)}}" title="Confirm Video">Confrim
                                      </a>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->

@endsection





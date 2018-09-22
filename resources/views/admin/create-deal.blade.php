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
            <h2><i class="fa fa-tags"></i> Add New Deal</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form method="GET" name="form" action="{{route("create.deal")}}" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}

              <div class="item form-group">
                <label class="col-md-3 col-sm-2 col-xs-12" for="name">Select Location </label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                  <select name="hotel" id="location" class="form-control col-md-7 col-xs-12" required >
                    @isset($hotels)
                    <option value="">Select Hotel</option>
                      @foreach( $hotels as $hotel)
                      <option value="{{ $hotel->id}}">{{ title_case( $hotel->name ) .' ,'. title_case($hotel->location) .' ,'. title_case($hotel->country  )}}</option>
                        
                      @endforeach
                      @endisset
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
							<div class="form-group">
							  <div class="col-md-6 col-md-offset-3">
								<button type="reset" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</button>
								<button id="send" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
							  </div>
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
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
</script>

@endsection





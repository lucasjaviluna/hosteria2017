@extends('layouts.admin2')

@section('content')
<div class="col-md-10 col-md-offset-2">
  <div class="panel panel-primary">
      <div class="panel-heading">
          Create Promotions
      </div>
      <div class="panel-body">
        <!-- <button class="btn btn-success btn-xs" id="newPromotion">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva promoción
        </button> -->
        {!! Form::open(['route'=> 'promotion.create', 'method' => 'POST', 'id' => 'my-promotion' , 'class' => 'form-horizontal', 'role' => 'form']) !!}
          <div class="form-group">
            <label for="type" class="col-md-1 control-label">Type</label>
            <div class="col-md-4">
              <select name="type" class="form-control" id="type">
                <option>Custom</option>
                <option>List</option>
              </select>
            </div>
          </div>
          <div class="form-group">
              <label for="title" class="col-md-1 control-label">Title</label>
              <div class="col-md-4">
                <input id="title" type="text" class="form-control" name="title" required autofocus>
              </div>
          </div>
          <div class="form-group">
              <label for="subtitle" class="col-md-1 control-label">Subtitle</label>
              <div class="col-md-4">
                <input id="subtitle" type="text" class="form-control" name="subtitle" required autofocus>
              </div>
          </div>
          <div class="form-group">
              <label for="info" class="col-md-1 control-label">Text</label>
              <div class="col-md-4">
                <textarea id="info" type="text" class="form-control" name="info" required autofocus rows="8" cols="80"></textarea>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-4">
                  <button type="submit" class="btn btn-success" id="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving promotion">
                    <span class="glyphicon glyphicon-floppy-save"></span> Save Promotion
                  </button>
              </div>
          </div>
        {!! Form::close() !!}
      </div>
  </div>

  <div class="panel panel-primary">
      <div class="panel-heading">
          Promotions
          <button class="btn btn-success btn-xs" id="refreshPromotion"
            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Refreshing promotions">
            <span class="glyphicon glyphicon-refresh"></span> Refresh
          </button>
      </div>
      <div class="panel-body" id="sortable">
        @include('admin.promotionList')
      </div>
  </div>
</div>
@endsection

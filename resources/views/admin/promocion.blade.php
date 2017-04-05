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
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="row">
                <label for="type" class="col-md-3 control-label">Type</label>
                <div class="col-md-8">
                  <select name="type" class="form-control" id="type">
                    <option value="custom" selected="true">Custom</option>
                    <option value="list">List</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label for="title" class="col-md-3 control-label">Title</label>
                <div class="col-md-8">
                  <input id="title" type="text" class="form-control" name="title" required autofocus>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label for="subtitle" class="col-md-3 control-label">Subtitle</label>
                <div class="col-md-8">
                  <input id="subtitle" type="text" class="form-control" name="subtitle" required autofocus>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <div class="row">
                <label for="info" class="col-md-1 control-label">Text</label>
                <div class="col-md-10">
                  <textarea id="info" type="text" class="form-control" name="info" required autofocus rows="8" cols="80"></textarea>
                  <label id="infoMessage" class="label label-warning" style="display: none;"> Ingresar los item de la lista separados por un Enter </label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-8 col-md-offset-2">
            <!-- <div class="form-group"> -->
              <button type="submit" class="btn btn-success" id="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving promotion">
                <span class="glyphicon glyphicon-floppy-save"></span> Save Promotion
              </button>
            <!-- </div> -->
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
@section('scripts')
    {!! Html::script('js/admin/promotion.js'); !!}
@endsection

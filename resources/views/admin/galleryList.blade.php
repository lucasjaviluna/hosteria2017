@foreach ($images as $image)
 <div class="col-lg-2 col-md-3 col-xs-6 thumb" data-id="{{$image['id']}}">
   <div class="thumbnail">
     <a href="#">
         <img class="img-responsive" style="width:120px; height:90px;" src="/images/icon_size/{{$image['filename']}}" alt="">
     </a>
     <a href="#" onclick="visibleImage(event, {{$image['id']}});">
        <span class="badge" id="{{ $image['visible'] == 1 ? 'badgeVisibleYes' : 'badgeVisibleNo' }}" data-id="{{$image['id']}}">
          Visible <span class="glyphicon {{ $image['visible'] == 1 ? 'glyphicon-thumbs-up' : 'glyphicon-thumbs-down' }}" aria-hidden="true"></span>
        </span>
     </a>
     <a href="#" onclick="removeImage(event, {{$image['id']}});">
        <span class="badge" id="badgeRemove">
          Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </span>
     </a>
   </div>
 </div>
@endforeach

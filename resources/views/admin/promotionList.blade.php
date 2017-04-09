@foreach ($promotions as $promotion)
 <div class="col-lg-2 col-md-3 col-xs-6 thumb" data-id="{{$promotion['id']}}">
   <div class="thumbnail">
     <a href="#">
         <img class="img-responsive" style="width:120px; height:90px;" src="/promotions/icon_size/{{$promotion['title']}}" alt="">
     </a>
     <a href="#" onclick="visibleImage(event, {{$promotion['id']}});">
        <span class="badge" id="{{ $promotion['visible'] == 1 ? 'badgeVisibleYes' : 'badgeVisibleNo' }}" data-id="{{$promotion['id']}}">
          Visible <span class="glyphicon {{ $promotion['visible'] == 1 ? 'glyphicon-thumbs-up' : 'glyphicon-thumbs-down' }}" aria-hidden="true"></span>
        </span>
     </a>
     <a href="#" onclick="removeImage(event, {{$promotion['id']}});">
        <span class="badge" id="badgeRemove">
          Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </span>
     </a>
   </div>
 </div>
@endforeach

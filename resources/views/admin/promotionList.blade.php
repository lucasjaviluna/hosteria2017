@foreach ($promotions as $promotion)
  <div class="col-lg-5 col-md-3 col-xs-6 w3_agileits_services_grid hvr-overline-from-center promo" data-id="{{$promotion['id']}}">
    <div class="w3_agileits_services_grid_agile">
      @if (isset($promotion['image']))
        <div class="w3_agileits_services_grid_1">
          <img src="/images/promotion/icon_size/{{$promotion['image']}}" alt="Promotion image">
        </div>
      @endif
      <h3>{{$promotion['title']}}</h3>
      @if ($promotion['type'] == 'custom')
        @foreach($promotion['info'] as $item)
          <p>{!!$item!!}</p>
        @endforeach
      @else
        @foreach($promotion['info'] as $item)
          {{-- <span class="glyphicon glyphicon-start" aria-hidden="true">
            {{$item}}
          </span> --}}
          {{-- <li class="fa fa-star fa-lg">{{$item}}</li> --}}
          <li class="itemPromotion"> <span class="glyphicon glyphicon-chevron-right"></span> {!!$item!!}</li> 
{{--         <li> 			<i class="fa-li fa fa-check-square"></i> {!!$item!!}</li> --}}

        @endforeach
      @endif

      @if ($promotion['important'])
        <span class="note">{!!$promotion['important']!!}</span>
      @endif
    </div>

    <a href="#" onclick="visiblePromotion(event, {{$promotion['id']}});">
       <span class="badge" id="{{ $promotion['visible'] == 1 ? 'badgeVisibleYes' : 'badgeVisibleNo' }}" data-id="{{$promotion['id']}}">
         Visible <span class="glyphicon {{ $promotion['visible'] == 1 ? 'glyphicon-thumbs-up' : 'glyphicon-thumbs-down' }}" aria-hidden="true"></span>
       </span>
    </a>
    <a href="#" onclick="removePromotion(event, {{$promotion['id']}});">
       <span class="badge" id="badgeRemove">
         Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
       </span>
    </a>
    <br>
  </div>
@endforeach

$.ajaxSetup({
  headers: {
      //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      'X-CSRF-Token': $('input[name="_token"]').val()
  }
});

var selectType = $("#type");
selectType.on("change", function(e){
    var $this = $(this);
    var type = $this.val();
    if (type === 'custom') {
        $('#infoMessage').hide();
    } else {
        $('#infoMessage').show();
    }
});

//Actions on promotion
function removePromotion(event, promotionId) {
    console.log('Borrar promocion ', promotionId);
    event.preventDefault();
    bootbox.confirm({
        message: "Está seguro de eliminar ésta promoción?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
            if (result) {
                $.ajax({
                    type: "POST",
                    url: 'removePromotion',
                    data: {id: promotionId},
                    success: function(data) {
                        console.log(data);
                        if (data.code == 200) {
                            if (data.promotionDeleted == true) {
                                $("div.promo[data-id="+promotionId+"]").hide();
                            }
                        }
                    },
                    error: function(error) {
                        console.log("Error al borrar", error);
                    }
                });
            }
        }
    });
}

function visiblePromotion(event, promotionId) {
    event.preventDefault();
    console.log('Visible promotion ', promotionId, event);
    $.ajax({
        type: "POST",
        url: 'visiblePromotion',
        data: {id: promotionId},
        success: function(data) {
            console.log(data);
            var spanBadge = $("span[data-id="+promotionId+"]");
            var spanGlyphicon = spanBadge.find("span").first();
            //if new visible is True, then change the id spanBadge and Glyphicon-thumb (up/down)
            if (data.promotionVisible == true) {
                spanBadge.attr("id", "badgeVisibleYes");
                spanGlyphicon.removeClass('glyphicon-thumbs-down').addClass('glyphicon-thumbs-up');
            } else {
                spanBadge.attr("id", "badgeVisibleNo");
                spanGlyphicon.removeClass('glyphicon-thumbs-up').addClass('glyphicon-thumbs-down');
            }
        },
        error: function(error) {
            console.log("Error al cambiar estado Visible", error);
        }
    });
}

//Ordena las imagenes
$("#sortable").sortable({
  update: function( event, ui ) {
    console.log('update',ui);
    //$(".sortable").sortable("refreshPositions");
    var promotions = $('div.promo');
    var ids = $.map(promotions, function(el) {
       return $(el).data('id');
    });

    console.log(ids);

    $.ajax({
        type: "POST",
        url: 'sortPromotions',
        data: {ids: ids},
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            console.log("Error al reordenar images", error);
        }
    });
  }
});

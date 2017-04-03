var imageCounter = 0;
Dropzone.options.myDropzone = {
    autoProcessQueue: false,
    uploadMultiple: true,
    maxFilezise: 1,
    maxFiles: 14,

    parallelUploads: 100,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 5MB',

    init: function() {
        //var submitBtn = document.querySelector("#submit");
        var submitBtn = $("#submit");
        var dropzoneMessage = document.querySelector("#dropzoneMessage");
        myDropzone = this;

        submitBtn.on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();

            var $this = $(this);
            $this.button('loading');
        });

        submitBtn.on("finishUpload", function(e) {
          var $this = $(this);
          $this.button('reset');
        });

        this.on("addedfile", function(file) {
            //alert("file uploaded");
            console.log('addedFile', file, myDropzone.files.length);
            imageCounter++;
            this.checkQueueFiles();
        });

        this.on("removedfile", function(file) {
            //alert("file uploaded");
            console.log('removedFile', file, myDropzone.files.length);
            imageCounter--;
            this.checkQueueFiles();
        });

        this.on("queuecomplete", function() {
            console.log('queuecomplete');
            submitBtn.trigger('finishUpload');
            toastr.success("Upload finished!!");
            this.checkQueueFiles();
            $("#refreshGallery").trigger('click');
        });

        this.on("complete", function(file) {
            console.log('complete', file);
            myDropzone.removeFile(file);
            this.checkQueueFiles();
        });

        this.on("success",
            myDropzone.processQueue.bind(myDropzone)
        );

        this.on("maxfilesexceeded", function(file){
            //alert("No more files please!");
            //myDropzone.removeFile(file);
        });

        this.checkQueueFiles = function () {
          if (myDropzone.files.length === 0) {
            //submitBtn.style.display = 'none';
            submitBtn.hide();
            dropzoneMessage.style.display = 'block';
          } else {
            //submitBtn.style.display = 'block';
            submitBtn.show();
            dropzoneMessage.style.display = 'none';
          }

          $("#photoCounter").text( "(" + imageCounter + ")");
        }

        this.checkQueueFiles();
    },
    error: function(file, response) {
        console.log('error', response);
        // if($.type(response) === "string")
        //     var message = response; //dropzone sends it's own error messages in string
        // else
        //     var message = response.message;
        // file.previewElement.classList.add("dz-error");
        // _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        // _results = [];
        // for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        //     node = _ref[_i];
        //     _results.push(node.textContent = message);
        // }
        // return _results;
    },
    success: function(file,done) {
        //photo_counter++;
        // $("#photoCounter").text( "(" + imageCounter + ")");
        // console.log('Done!', file, done, myDropzone.files.length);
    }
};

$.ajaxSetup({
  headers: {
      //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      'X-CSRF-Token': $('input[name="_token"]').val()
  }
});

var refreshBtn = $("#refreshGallery");
refreshBtn.on("click", function(e){
    e.preventDefault();
    e.stopPropagation();

    var $this = $(this);
    $this.button('loading');
    $('#sortable').load('galeria', function(){
        toastr.success("Gallery updated!");
        $this.button('reset');
    });
});

//Actions on images
function removeImage(event, imageId) {
    console.log('Borrar imagen ', imageId);
    event.preventDefault();
    bootbox.confirm({
        message: "Está seguro de eliminar ésta imagen de la galería?",
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
                    url: 'removeImage',
                    data: {id: imageId},
                    success: function(data) {
                        console.log(data);
                        if (data.code == 200) {
                            if (data.imageDeleted == true) {
                                $("div.thumb[data-id="+imageId+"]").hide();
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

function visibleImage(event, imageId) {
    event.preventDefault();
    console.log('Visible imagen ', imageId, event);
    $.ajax({
        type: "POST",
        url: 'visibleImage',
        data: {id: imageId},
        success: function(data) {
            console.log(data);
            var spanBadge = $("span[data-id="+imageId+"]");
            var spanGlyphicon = spanBadge.find("span").first();
            //if new visible is True, then change the id spanBadge and Glyphicon-thumb (up/down)
            if (data.imageVisible == true) {
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

//$("#sortable").sortable();
$("#sortable").sortable({
  update: function( event, ui ) {
    console.log('update',ui);
    //$(".sortable").sortable("refreshPositions");
    var thumbnails = $('div.thumb');
    var ids = $.map(thumbnails, function(el) {
       return $(el).data('id');
    });

    console.log(ids);

    $.ajax({
        type: "POST",
        url: 'sortImages',
        data: {ids: ids},
        success: function(data) {
            console.log(data);
            // var spanBadge = $("span[data-id="+imageId+"]");
            // var spanGlyphicon = spanBadge.find("span").first();
            // //if new visible is True, then change the id spanBadge and Glyphicon-thumb (up/down)
            // if (data.imageVisible == true) {
            //     spanBadge.attr("id", "badgeVisibleYes");
            //     spanGlyphicon.removeClass('glyphicon-thumbs-down').addClass('glyphicon-thumbs-up');
            // } else {
            //     spanBadge.attr("id", "badgeVisibleNo");
            //     spanGlyphicon.removeClass('glyphicon-thumbs-up').addClass('glyphicon-thumbs-down');
            // }
        },
        error: function(error) {
            console.log("Error al reordenar images", error);
        }
    });
  }
  // ,
  // change: function( event, ui ) {
  //     console.log('change', ui);
  // }
});

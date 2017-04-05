var selectType = $("#type");
selectType.on("change", function(e){
    var $this = $(this);
    //$this.button('loading');
    console.log($this.val());
    // $('#sortable').load('galeria', function(){
    //     toastr.success("Gallery updated!");
    //     $this.button('reset');
    // });
});

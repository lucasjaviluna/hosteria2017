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

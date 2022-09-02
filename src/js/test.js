function get_param(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return false;
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


$(document).on('click','.favorite_btn',function(e){
    e.stopPropagation();
    console.log("aaaa")
    var $this = $(this),
        post_id = get_param('procode');
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        dataType: 'json',
        data: { post_id: 2}
    }).done(function(data){
        // location.reload();
    }).fail(function() {
      location.reload();
    });
  });
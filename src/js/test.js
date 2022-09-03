function get_param(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return false;
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function () {
$(document).on('submit', '.favorite_count',function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        dataType: 'json',
        data: { post_id: 2}
    }).done(function(data){
        $(".fa-couch").toggleClass("benchOn");
    }).fail(function() {
        $(".bench").toggleClass("benchOn");
    });
  });
})
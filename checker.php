var myVar = setInterval(myTimer, 1000);

function myTimer() {

var settings = {
  "url": "system/check.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  
};


$.ajax(settings).done(function (response) {

  var response = JSON.parse(response);
console.log(response);
$("#hu_wn_replies").text(response.hu_wn_replies.length+" ");
$("#hu_w_replies").text(response.hu_w_replies.length+" ");


if(response.fnl_m!=undefined){

  $("#nm_count").text(response.fnl_m.length);
  $("#nm_notification").text(response.fnl_m.length+"");

  for(var i=0; i<response.fnl_m.length; i++){

$("#nm_list").append('<a href="#" class="dropdown-item"><i class="fas fa-envelope mr-2"></i> '+response.fnl_m[i].member+' just joined '+response.fnl_m[i].team_name+'<span class="float-right text-muted text-sm">3 mins</span></a><div class="dropdown-divider"></div>');
  }

}




});


}
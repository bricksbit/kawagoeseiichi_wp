function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


$('.tab-list li').click(function() {
  var index = $('.tab-list li').index(this);
  $('.tab-list li').removeClass('active');
  $(this).addClass('active');
  $('.p-cat--content .tab-content').removeClass('open').eq(index).addClass('open');
});
//# sourceMappingURL=map/app.js.map
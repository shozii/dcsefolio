$('document').ready(function(){

        $(".image-container").mouseover(function () {
      $(this).attr('src', $(this).data("hover"));
    }).mouseout(function () {
      $(this).attr('src', $(this).data("src"));
    });
})
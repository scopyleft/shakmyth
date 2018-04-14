$(document).ready(function(){
  $("#myth_page_myth_id").change( function() {
     $("#myth_page_myth_category").after("<img src=\"/media/ajax_loader.gif\" id=\"ajax-loader\" />");
     $.post("/admin/myth_page/ajaxMythCategory", { myth_id: $(this).val() },
    function(data){
      $("#myth_page_myth_category").html(data);
      $("#ajax-loader").remove();
    });
  });
});
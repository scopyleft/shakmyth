$(document).ready(function(){
  $("#myth_page_myth_id").change( function() {
     $("#myth_page_myth_category").after("<img src=\"/media/ajax_loader.gif\" id=\"ajax-loader\" />");
     $.post("/admin/myth_page/ajaxMythCategory", { myth_id: $(this).val() },
    function(data){
      $("#myth_page_myth_category").html(data);
      $("#ajax-loader").remove();
    });
  });
  
  tinymce_full = { theme: "advanced", plugins: "table,paste,save,nonbreaking",
          theme_advanced_toolbar_location: 'top',theme_advanced_toolbar_align : 'left',
          theme_advanced_buttons1: "bold,italic,underline,separator,undo,redo,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,formatselect,fontselect,fontsizeselect,,forecolor,backcolor", 
          theme_advanced_buttons2: "pastetext,pasteword,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,cleanup,removeformat,charmap,hr,nonbreaking", 
          theme_advanced_buttons3_add : "tablecontrols", 
          language: "en", mode: "exact", relative_urls: false,
          valid_elements: "*[*]", 
          height: "350px", width: "500px" }
  
  tinymce_minimal = {
      body_id:        'content',
      content_css:    '',
      theme:          'advanced',
      plugins:        'fullscreen,advlink,table,template',
      theme_advanced_toolbar_location: 'top',
      theme_advanced_toolbar_align : 'left',
      theme_advanced_resizing:    true,
      theme_advanced_buttons1:    'bold,italic,image',
      theme_advanced_buttons2:    '',
      theme_advanced_buttons3:    '',
      convert_urls:   false,
      theme_advanced_blockformats : 'p,h1,h2,h3,blockquote',
      //file_browser_callback: 'sfMediaBrowserWindowManager.tinymceCallback',
      entity_encoding : 'raw',
      template_templates : []
  };

  $('#news_summary').tinymce(tinymce_minimal);
  $('#news_content').tinymce(tinymce_full);
  $('#sf_guard_user_Profile_biography').tinymce(tinymce_full);
  $('#page_content').tinymce(tinymce_full);
  $('#myth_page_content').tinymce(tinymce_full);
});

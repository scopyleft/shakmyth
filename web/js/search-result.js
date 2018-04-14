$(function(){
    var kws = $('#search_keywords').val().split(' ');
    
    function highlight_search() {
        $(kws).each(function(i, kw){
            kw = $.trim(kw);
            if(!kw) return;
            $('#content').highlight(kw);
            return;
        });
    }
    
    if(kws.length) {
       highlight_search();
    }
});
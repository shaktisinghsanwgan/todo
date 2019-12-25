jQuery(document).ready(function( $ ) {
    function get_request(){
        var data = {
            action: 'add_car_auto',
        };
        jQuery.get(
            automation_script.ajaxurl,
            data,
            function(dataUrl){
            }
        );
    }
    setInterval(get_request, 10000);
});

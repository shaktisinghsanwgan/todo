$(document).ready(function() {
    $(document).on('click','.itemVal',function(e) {
    e.preventDefault();
    var val=$(this).attr('item-val');
    var valHtml=$(this).html();
    $("#searchBy").attr('search-val',val.trim());
    $("#searchBy").html(valHtml.trim());
});
$("#showSearch").on('click',function(){
    $("#todoHeader").addClass('hidden');
    $("#searchDiv").removeClass('hidden');
    $("#searchDiv").show('slow');
});
$("#showTodo").on('click',function(){
    $("#searchDiv").addClass('hidden');
    $("#todoHeader").removeClass('hidden');
    $("#todoHeader").show('slow');
});
});

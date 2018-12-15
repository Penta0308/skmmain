function listparse(b) {
	var str = jQuery(b).find("a[href]").each(function(){
		var a = $(this).attr("href");
		if(a.substring(0, 1) == "?" || a.substring(0, 1) == "/" || a == "folder.txt") return;
		console.log(a);
		$.ajax({
        type:"GET",
        url:"http://skmttd.tk/xml/" + a,
        dataType : "xml",
        success: function(textdata){
			console.log(textdata);
			parsexmls(textdata, a);
        },
        error: function(xhr, status, error) {
            alert(error);
        }  
    });
	});
}
$(function() {
	$.ajax({
        type:"GET",
        url:"http://skmttd.tk/xml/",
        dataType : "html",
        success: function(textdata){
			$(".folders").after(textdata);
			listparse(textdata);
        },
        error: function(xhr, status, error) {
            alert(error);
        }  
    });
	
	$.ajax({
        type:"GET",
        url:"getcmd.php",
        dataType : "xml",
        success: function(textdata){
			$("#loading").remove();
            console.log(textdata);
//			parsexmls(textdata);
        },
        error: function(xhr, status, error) {
            alert(error);
        }  
    });
	
});
function parsexmls(xml, tstamp) {
    $(xml).find("openttd").each(function(){
		$(this).find("result[cmd=\"server_info\"]").each(function() {
			if($("#sname").text()=="") $("#sname").append( $(this).text());
		});
		$(this).find("result[cmd=\"companies\"]").each(function(){
			var theDate = new Date(tstamp * 1000);
			$("#companies").append("<li>" + theDate.toGMTString() + $(this).text() + "</li>\n");
		});
	});
}
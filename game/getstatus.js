var arr = [];
var abuf = null;

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
//				console.log(textdata);
				abuf = [];
				parsexmls(textdata, a.replace(/[^0-9\.]+/g, ""));
				arr.push(abuf);
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
		var theDate = new Date(tstamp * 1000);
		abuf[0] = theDate.toGMTString();
		abuf[1] = 0;
		$(this).find("result[cmd=\"companies\"]").each(function(a, b){
			abuf[1]++;
			abuf.push(jQuery(b).text());
			//$("#companies").append("<li>" + theDate.toGMTString() + jQuery(b).text() + "</li>\n");
		});
	});
	console.log(abuf);
	arr.push(abuf);
}
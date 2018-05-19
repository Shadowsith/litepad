// sidebar handling
$("#openSidebar").click(function() {
    $("#sidebar").width(250);
});

$("#closeSidebar").click(function() {
    $("#sidebar").width(0);
});

// markdown handling
$("#noteMarkup").click(function() {
    $("#editText").hide();
    var text = $("#notePad").val();  
    var converter = new showdown.Converter();
    $("#markdownText").html(converter.makeHtml(text));
    $("#markdownText").show();
    $("#noteMarkup").hide();
    $("#noteEditor").show();
});

// back to texteditor
$("#noteEditor").click(function() {
    $("#editText").show();
    $("#noteEditor").hide();
    $("#noteMarkup").show();
    $("#markdownText").hide();
    $("#markdownText").html("");
});

// ajax
var path = 'src/php/ajax.php';

/*
$("#noteOpen").click(function() {
    $("#noteList").append('<a href="#">Test</a><br>')
});
*/

$("#noteOpen").click(function() {
    var title = $("#title").val();
    $.ajax({    url: path,
                type: 'get',
                data: {"noteGetName": title, "noteOpen": "1"},
                success: function(response) {
                    //$("notePad").val(""); 
                    //$("#notePad").val(response);  
                    $("#notList").append(response[0]);  
                }
    });
});

$("#noteSave").click(function() {
    var title = $("#title").val();
    var text = $("#notePad").val();
    $.ajax({    url: path,
                type: 'post',
                data: {"notePostName": title, "noteSave": "1", "noteText": text},
                success: function(response) {
                    if (response != "\n") {
                        alert(response); 
                    }
                }
    });
});

$("#noteDelete").click(function() {
    var title = $("#title").val();
    $.ajax({    url: path,
                type: 'post',
                data: {'notePostName': title, 'noteDelete': '1'},  
                success: function(response) {
                    if (response != "\n") {
                        alert(response); 
                    }
                }
    });
});


$("#notePrint").click(function() {
    $.ajax({    url: path,
                type: 'get',
                data: "notePrint",
                success: function(response) {
                    alert(response); 
                }
    });
});







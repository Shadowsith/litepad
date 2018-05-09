// sidebar handling
$("#appbar").click(function() {
    $("#myS").width(250);
});

$("#closeappbar").click(function() {
    $("#myS").width(0);
});

// ajax

var path = 'src/php/ajax.php';

$("#noteOpen").click(function() {
    $.ajax({    url: path,
                type: 'get',
                data: "noteOpen", 
                success: function(response) {
                    $("#notePad").val(response);  
                }
    });
});

$("#noteSave").click(function() {
    var title = $("#title").val();
    var text = $("#notePad").val();
    $.ajax({    url: path,
                type: 'post',
                data: {"noteName": title, "noteSave": "1", "noteText": text},
                success: function(response) {
                    alert(response);  
                }

    });
});

$("#noteDelete").click(function() {
    $.ajax({    url: path,
                type: 'post',
                data: "noteDelete", 
                success: function(response) {
                    alert(response); 
                }
    });
});








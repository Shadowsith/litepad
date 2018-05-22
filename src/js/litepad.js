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

// ui handling ------------------------

$("#noteAdd").click(function() {
    $("#sidebar").width(0);
    $('#notePad').attr('readonly', true); 
    $('#notePad').addClass('input-disabled'); 
    $("#noteAddForm").fadeIn(); 
});

$("#noteAddCloseBtn").click(function() {
    $("#noteAddForm").fadeOut(); 
    $('#notePad').attr('readonly', false); 
    $('#notePad').addClass('input-enabled'); 
});


// close file chooser if it is opened
$("#noteListCloseBtn").click(function() {
    noteListClose(); 
}); 

// ajax ------------------------------------------
var path = 'src/php/ajax.php';

/*
$("#noteOpen").click(function() {
    $("#noteList").append('<a href="#">Test</a><br>')
});
*/

//TODO write a proofment if the file already exisits (protect to be overwritten)
$("#noteAddCreateBtn").click(function() {
    var title = $("#noteAddInput").val(); 
    var text = ""; 
    if ( title != "" ) {
        $.ajax({    url: path,
                    type: 'post',
                    data: {"notePostName": title, "noteSave": "1", "noteText": text},
                    success: function(response) {
                        if (response != "\n") {
                            alert(response); 
                        }
                    }
        });
        $("#noteAddForm").fadeOut(); 
        $("#title").html(title); 
        $('#notePad').attr('readonly', false); 
        $('#notePad').addClass('input-enabled'); 
    } else {
        alert("Please enter a valid name for your note"); 
    }
});


$("#noteOpen").click(function() {
    var title = $("#title").html();
    $.ajax({    url: path,
                type: 'get',
                data: {"noteGetName": title, "noteOpen": "1"},
                success: function(response) {
                    var re = String(response).split(";"); 
                    for(var i = 0; i < re.length; i++) {
                        $("#noteList").append(re[i]);
                    }
                    $('#notePad').attr('readonly', true); 
                    $('#notePad').addClass('input-disabled'); 
                    $("#sidebar").width(0);
                    $("#noteList").fadeIn(); 
                }
    });
});

/*$(".noteLoad").on("click", ".noteLoad", function() {
    alert("test"); 
});*/ 

$("#noteList").delegate("a.noteLoad", "click", function() {
    var title = $(this).html();
    $("#title").html(title); 
    $.ajax({    url: path,
                type: 'get',
                data: {"noteGetName": title, "noteLoad": "1"},
                success: function(response) {
                    $("#notePad").val(response);
                    noteListClose(); 
                }
    });
});

$("#noteSave").click(function() {
    var title = $("#title").html();
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
    var title = $("#title").html();
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


// functions 

function noteListClose() {
    $("#noteList").fadeOut(); 
    $("#noteList").children(".noteLoad").remove(); 
    $("#noteList").children("br").remove();
    $('#notePad').attr('readonly', false); 
    $('#notePad').addClass('input-enabled'); 
}





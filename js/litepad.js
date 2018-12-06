$(document).ready(function() {
    var ui = new LitepadUI();
    ui.registerHandler();
});

class LitepadUI {
    constructor() {
        this.modals = new ModalHandler();
        this.editor = new Editor();
        this.sidebar = new Sidebar();
        this.converter = new showdown.Converter();
        this.file = "#file";
        this.btnSave = "#btnSave";
        this.btnParse = "#btnParse";
        this.btnEdit = "#btnEdit";
        this.content = "#content";
        this.parsedCtnt = "#parsed";
        this.ajax = "php/ajax.php";
    }

    saveNote() {
        if($(this.file).html() == "") {
            $.announce.danger("The filename is empty");
            return;
        }

        $.ajax({    
            url: this.ajax,
            type: "POST",
            data: { 
                "notePostName": $(this.file).html(), 
                "noteSave": "1", 
                "noteText": this.editor.mde.value()
            },
            dataType: "text",
            success: function(response) {
                if (response != "\n") {
                    $.announce.success(response);
                }
            },
            error: function(xhr, status, error) {
                $.announce.danger(error);
            }
        });

    }

    parseMarkdown() {
        var text = this.editor.mde.value();
        var html = this.converter.makeHtml(text);
        $(this.parsedCtnt).html(html);
        $(this.content).hide();
        $(this.parsedCtnt).show();
    }

    showEditor() {
        $(this.content).show();
        $(this.parsedCtnt).hide();
    }

    registerHandler() {
        var self = this;
        this.modals.registerModalHandler();
        this.editor.registerEditorHandler();

        $(this.btnSave).click(function() {
            self.saveNote();
        });

        $(this.btnParse).click(function() {
            self.parseMarkdown();
        })

        $(this.btnEdit).click(function() {
            self.showEditor();
        })
    }
}

class ModalHandler {
    constructor() {
        this.mAdd = "#modalAdd";
        this.mOpen = "#modalOpen";
        this.mMove = "#modalMove";
        this.mDelete = "#modalDelete";
        this.mSettings = "#modalSettings"

        this.inAdd = "#inModalAdd";
        this.btnAdd = "#btnModalAdd";
        //this.anchorOpen = $(".");
        this.ulOpen = "#ulNoteOpen";
        this.btnDelete = "#btnModalDelete";
        this.btnSettigns = "#btnModalSettings";
    }

    addNote() {
        if($(this.inAdd).val() != "") {


            $(this.inAdd).val("");
        } else {
            $.announce.warning("Please enter a name for your new note");
        }
    }

    deleteNote() {

    }

    registerModalHandler() {
        var self = this;

        $(this.btnAdd).click(function() {
            self.addNote();
        });
    }
}

class Sidebar {

}

class Editor {
    constructor() {
        this.elem = "#editor";
        this.mde = this.createEditor();
    }

    createEditor() {
        var simpleMde = new SimpleMDE({element: $(this.elem)[0]});
        return simpleMde;
    }

    registerEditorHandler() {

    }
}

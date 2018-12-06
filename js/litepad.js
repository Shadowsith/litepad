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
        this.ajax = new AjaxHandler();
        this.file = "#file";
        this.btnSave = "#btnSave";
        this.btnParse = "#btnParse";
        this.btnEdit = "#btnEdit";
        this.content = "#content";
        this.parsedCtnt = "#parsed";
    }

    addNote() {
        if($(this.modals.inAdd).val() == "") {
            $.announce.warning("Please enter a name for your new note");
            return;
        }
        this.ajax.add($(this.modals.inAdd).val()); 
        $(this.file).html($(this.modals.inAdd).val());
        $(this.modals.inAdd).val("");
    }

    saveNote() {
        if($(this.file).html() == "") {
            $.announce.danger("The filename is empty");
            return;
        }
        this.ajax.write($(this.file).html(), this.editor.mde.value());
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

        $(this.modals.btnAdd).click(function() {
            self.addNote();
        });
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

    deleteNote() {

    }

    registerModalHandler() {
        var self = this;

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


class AjaxHandler {
    constructor() {
        this.backend = "php/ajax.php";
    }

    add(name) {
        $.ajax({    
            url: this.backend,
            type: "POST",
            data: { 
                "notePostName": name, 
                "noteAdd": "1"
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

    write(name, text) {
        $.ajax({    
            url: this.backend,
            type: "POST",
            data: { 
                "notePostName": name, 
                "noteSave": "1", 
                "noteText": text
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
}

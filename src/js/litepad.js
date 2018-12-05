$(document).ready(function() {
    var ui = new LitepadUI();
    ui.registerHandler();
});

class LitepadUI {
    constructor() {
        this.modals = new ModalHandler();
        this.editor = new Editor();
        this.sidebar = new Sidebar();
        this.btnSave = "#btnSave";
        this.ajax = "php/ajax.php";
    }

    saveNote() {
        alert("hi");
    }

    registerHandler() {
        var self = this;
        this.modals.registerModalHandler();
        this.editor.registerEditorHandler();

        $(this.btnSave).click(function() {
            self.saveNote();
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
        this.ace = "#editor";
        this.btns = "#btnGrpEdit";
        this.btnUndo = "#btnUndo";
        this.btnRedo = "#btnRedo";
        this.btnBold = "#btnBold";
        this.btnItalic = "#btnItalic";
        this.btnUline = "#btnUline";
        this.btnStrike = "#btnStrike";
        this.btnUlist = "#btnUlist";
        this.btnOlist = "#btnOlist";

        //this.createEditor();
    }

    createEditor() {
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");
        editor.getSession().setValue('bla abc');
    }

    registerEditorHandler() {

    }
}

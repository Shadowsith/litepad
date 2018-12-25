$(document).ready(function() {
    var i18n = new I18n("en");
});

class I18n {
    constructor(lang) {
        this.lang = lang;
        this.json = "";
        this.select(lang);

        // sidebar
        this.lblSideAdd = "#s_add";
        this.lblSideRename = "#s_rename";
        this.lblSideOpen = "#s_open";
        this.lblSideSave = "#s_save";
        this.lblSideParse = "#s_parse";
        this.lblSideEditor = "#s_editor";
        this.lblSidePrint = "#s_print";
        this.lblSideDelete = "#s_delete";
        this.lblSideSettings = "#s_settings";
        this.lblSideInfo = "#s_info";

        // main menu (for title desc)
        this.uFileName = "#file";
        this.btnAdd = "#btnAdd";
        this.btnOpen = "#btnOpen";
        this.btnSave = "#btnSave";
        this.btnParse = "#btnParse";
        this.btnEdit = "#btnEdit";
        this.btnDelete = "#btnDelete";
        this.btnPrint = "#btnPrint";
        this.btnSettings = "#btnSettings";
        this.btnInfo = "#btnInfo";

        // modals title 
        this.lblModalAdd = "#lblAdd";
        this.lblModalSave = "#lblSave";
        this.lblModalRename = "#lblRename";
        this.lblModalDelete = "#lblDelete";
        this.lblModalSettings = "#lblSettings";
        this.lblModalInfo = "#lblInfo";

        // modals lables


        // modal btns
        this.btnModalClose = ".btnModalClose";
        this.btnModalAdd = "#btnModalAdd";
        this.btnModalRename = "#btnModalRename";
        this.btnModalDelete = "#btnModalDelete";
    }

    select(lang) {
        switch(lang) {
            case "en":
                this.getJSON(`js/i18n/${lang}.json`)
                    .then((data) => this.translate(data));
                break;

            case "de":
                this.getJSON(`js/i18n/${lang}.json`);

            default:
                this.getJSON(`js/i18n/en.json`);
                break;
        }
    }

    async getJSON(file) {
        const result = await $.getJSON(file, function(data){});
        return result; 
    }

    getSettings() {
    }

    translate(data) {
        this.translateSidebar(data);
        this.translateMainBtnDesc(data);
        // modals

        // modal btns
        $(this.btnModalClose).html(data.modals.btn.close);
    }

    translateSidebar(data) {
        $(this.lblSideAdd).html(data.sidebar.add);
        $(this.lblSideRename).html(data.sidebar.rename);
        $(this.lblSideOpen).html(data.sidebar.open);
        $(this.lblSideSave).html(data.sidebar.save);
        $(this.lblSideParse).html(data.sidebar.parse);
        $(this.lblSideEditor).html(data.sidebar.editor);
        $(this.lblSidePrint).html(data.sidebar.print);
        $(this.lblSideDelete).html(data.sidebar.delete);
        $(this.lblSideSettings).html(data.sidebar.settings);
        $(this.lblSideInfo).html(data.sidebar.info);
    }

    translateMainBtnDesc(data) {
        $(this.uFileName).attr('title', data.btn.rename);
        $(this.btnAdd).attr('title', data.btn.add);
        $(this.btnOpen).attr('title', data.btn.open);
        $(this.btnSave).attr('title', data.btn.save);
        $(this.btnParse).attr('title', data.btn.parse);
        $(this.btnEdit).attr('title', data.btn.edit);
        $(this.btnDelete).attr('title', data.btn.delete);
        $(this.btnPrint).attr('title', data.btn.print);
        $(this.btnSettings).attr('title', data.btn.settings);
        $(this.btnInfo).attr('title', data.btn.info);
    }

    translateModalTitle(data) {

    }

    translateModalItems(data) {
        // 

        // buttons
    }

}

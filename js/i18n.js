$(document).ready(function() {
    var i18n = new I18n();
    i18n.select("de");
});

class I18n {
    constructor() {
        this.lang = this.getSettings();
        this.avblLang = this.getSupportedLang();

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
        this.h5ModalAdd = "#h5ModalAdd";
        this.h5ModalOpen = "#h5ModalOpen";
        this.h5ModalRename = "#h5ModalRename";
        this.h5ModalDelete = "#h5ModalDelete";
        this.h5ModalSettings = "#h5ModalSettings";
        this.h5ModalInfo = "#h5ModalInfo";

        // modals lables
        this.lblModalAdd = "#lblModalAdd";
        this.lblModalRename = "#lblModalRename";
        this.lblModalOpen = "#lblModalOpen";
        this.lblModalDelete = "#lblModalDelete";
        this.lblCookies = "#lblCookies";
        this.lblMaxNotes = "#lblMaxNotes";
        this.lblPdfPrint = "#lblPdfPrint";
        this.lblLang = "#lblLang";
        this.lblDeveloper = "#lblDeveloper";
        this.lblContact = "#lblContact";
        this.lblDevYear = "#lblDevYear";
        this.lblLicense = "#lblLicense";
        this.lblSourceCode = "#lblSourceCode";

        // modal btns
        this.btnModalClose = ".btnModalClose";
        this.btnModalAdd = "#btnModalAdd";
        this.btnModalRename = "#btnModalRename";
        this.btnModalDelete = "#btnModalDelete";
        this.btnModalSave = "#btnModalSave";
    }

    // TODO read xml
    getSettings() {
        return "de";
    }

    getSupportedLang() {
        let arr = [
            "en", 
            "de"
        ];
        return arr;
    }

    select(lang) {
        for(let i in this.avblLang) {
            if(this.avblLang[i] === lang) {
                this.getJSON(`i18n/${lang}.json`)
                    .then((data) => this.translate(data));
                return;
            }
        }
        this.getJSON(`i18n/en.json`)
            .then((data) => this.translate(data));
    }

    async getJSON(file) {
        const result = await $.getJSON(file, function(data){});
        return result; 
    }

    translate(data) {
        this.translateSidebar(data);
        this.translateMainBtnDesc(data);
        this.translateModalTitle(data);
        this.translateModalItems(data);
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
        $(this.uFileName).html(data.nav.file);
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
        $(this.h5ModalAdd).html(data.modals.headline.add);
        $(this.h5ModalOpen).html(data.modals.headline.open);
        $(this.h5ModalDelete).html(data.modals.headline.delete);
        $(this.h5ModalInfo).html(data.modals.headline.info);
        $(this.h5ModalRename).html(data.modals.headline.rename);
        $(this.h5ModalSettings).html(data.modals.headline.settings);
    }

    translateModalItems(data) {
        // lables
        $(this.lblModalAdd).html(data.modals.desc.add);
        $(this.lblModalRename).html(data.modals.desc.rename);
        $(this.lblModalOpen).html(data.modals.desc.open);
        $(this.lblModalDelete).html(data.modals.desc.delete);

        $(this.lblCookies).html(data.modals.settings.cookies);
        $(this.lblMaxNotes).html(data.modals.settings.notes);
        $(this.lblPdfPrint).html(data.modals.settings.pdfprint);
        $(this.lblLang).html(data.modals.settings.lang);
        $(this.lblDeveloper).html(data.modals.info.dev);
        $(this.lblContact).html(data.modals.info.contact);
        $(this.lblDevYear).html(data.modals.info.year);
        $(this.lblLicense).html(data.modals.info.license);
        $(this.lblSourceCode).html(data.modals.info.source);

        // buttons
        $(this.btnModalClose).html(data.modals.btn.close);
        $(this.btnModalAdd).html(data.modals.btn.add);
        $(this.btnModalRename).html(data.modals.btn.rename);
        $(this.btnModalDelete).html(data.modals.btn.delete);
        $(this.btnModalSave).html(data.modals.btn.save);
    }

}

class AjaxHandler {
    constructor() {
        this.backend = "php/ajax.php";
        this.MsgEnum = this.getMsgEnum();
        Object.freeze(this.MsgEnum);
    }

    getMsgEnum() {
        var enumeration = {
            "Error":0,
            "Max_files":0,
            "File_not_found":1,
            "File_not_saved":2,
            "File_not_renamed":3,
            "File_not_readable":4,
            "Success":1, 
            "File_saved":0,
            "File_deleted":1,
            "File_pdf":2,
            "File_renamed":3,
            "File_added":4,
        }
        return enumeration;
    }
    
    async get(_dataType, _data, error_msg) {

        const result = await $.ajax({    
            url: this.backend,
            type: "GET",
            dataType: _dataType,
            data: _data,
            error: function(xhr, status, error) {
                if(error != "") {
                    $.announce.danger(error);
                } else {
                    $.announce.danger(error_msg);
                }
            }
        });
        return result;
    }

    post(dataType, data, error_msg, handleRes = "") {
        this.sendPost(dataType, data, error_msg, handleRes = "")
            .then((data) => this.receiveMsg(data));
    }

    async sendPost(_dataType, _data, error_msg, handleRes = "") {
        const result = await $.ajax({    
            url: this.backend,
            type: "POST",
            dataType: _dataType,
            data: _data,
            error: function(xhr, status, error) {
                if(error != "") {
                    $.announce.danger(error);
                } else {
                    $.announce.danger(error_msg);
                }
            }
        });
        return result;
    }

    receiveMsg(response) {
        let MsgEnum = this.MsgEnum;
        let tr = gMsg;
        switch(Number(response[1])) {
            case MsgEnum.Error:
                switch(Number(response[2])) {
                    case MsgEnum.Max_files:
                        $.announce.danger(tr.error.max_files);
                        break;

                    case MsgEnum.File_not_found:
                        $.announce.danger(tr.error.file_not_found);
                        break;

                    case MsgEnum.File_not_saved:
                        $.announce.danger(tr.error.file_not_saved);
                        break;

                    case MsgEnum.File_not_renamed:
                        $.announce.danger(tr.error.file_not_renamed);
                        break;

                    default: break;

                }
                break;

            case MsgEnum.Success:
                switch(Number(response[2])) {

                    case MsgEnum.File_saved:
                        $.announce.success(tr.success.file_saved);
                        break;

                    case MsgEnum.File_deleted:
                        $.announce.success(tr.success.file_deleted);
                        break;

                    case MsgEnum.File_pdf:
                        $.announce.success(tr.success.file_pdf);
                        break;

                    case MsgEnum.File_renamed:
                        $.announce.success(tr.success.file_renamed);
                        break;

                    case MsgEnum.File_added:
                        $.announce.success(tr.success.file_added);
                        break;

                    default: break;
                }
                break;

            default: break;
        }
    }
}


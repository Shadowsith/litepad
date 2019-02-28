$(document).ready(function() {
    const r = new LoginHandler();
    r.registerEventHandlers();
});

class LoginHandler {
    constructor() {
        this.inUser = "#username";
        this.inPw = "#password";
        this.btnLogin = "#btnLogin";
        this.backend = 'php/ajax.php';

        this.user = '';
        this.pw = '';
    }

    isEmptyOrSpaces(str){
        return str === null || str.match(/^ *$/) !== null;
    }

    isFormInputValid() {
        if(this.isEmptyOrSpaces($(this.inUser).val())) {
            $.announce.danger('username is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.inPw).val())) {
            $.announce.danger('password is empty');
            return false;
        }
        this.user = $(this.inUser).val();
        this.pw = $(this.inPw).val();
        return true;
    }

    sendToBackend(user, pw) {
        const data = {
            'event': 'login',
            'user': user,
            'pw': pw
        };

        console.log(data);
        const self = this;

        $.ajax({    
            url: this.backend,
            type: "POST",
            dataType: 'text',
            data: data,
            success: function(ret) {
                console.log(ret);
                if(ret.includes('true')) {
                    $.announce.success('Logged in');
                    self.clearInput();
                } else {
                    $.announce.danger(ret + 'Error: Login failed');
                }
            },
            error: function(xhr, status, error) {
                if(error != "") {
                    $.announce.danger(error);
                } else {
                    $.announce.danger(error);
                }
            }
        });
    }

    clearInput() {
        $(this.inUser).val('');
        $(this.inPW).val('');
    }

    registerEventHandlers() {
        let self = this;

        $(this.btnLogin).click(function() {
            if(self.isFormInputValid()) {
                self.sendToBackend(self.user, self.pw);
            }
        });
    }
}

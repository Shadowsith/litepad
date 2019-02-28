$(document).ready(function() {
    const r = new RegistrationHandler();
    r.registerEventHandlers();
});

class RegistrationHandler {
    constructor() {
        this.inUser = "#username";
        this.inEmail = "#email";
        this.inPw = "#password";
        this.inPw2 = "#password2";
        this.btnRegister = "#btnRegister";
        this.backend = 'php/ajax.php';

        this.user = '';
        this.email = '';
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
        if(this.isEmptyOrSpaces($(this.inEmail).val())) {
            $.announce.danger('email is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.inPw).val())) {
            $.announce.danger('password is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.inPw2).val())) {
            $.announce.danger('password verification is empty');
            return false;
        }
        if($(this.inPw).val() !== $(this.inPw2).val()) {
            $.announce.danger('The passwords do not match');
            return false;
        }
        this.user = $(this.inUser).val();
        this.email = $(this.inEmail).val();
        this.pw = $(this.inPw).val();
        return true;
    }

    sendToBackend(user, email, pw) {
        const data = {
            'user': user,
            'email': email,
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
                    $.announce.success('User created');
                    self.clearInput();
                } else if (ret.includes('user')) {
                    $.announce.danger('Error: Username already exists');
                } else {
                    $.announce.danger('Error: User was not created');
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
        $(this.inPw2).val('');
        $(this.inEmail).val('');
    }

    registerEventHandlers() {
        let self = this;

        $(this.btnRegister).click(function() {
            if(self.isFormInputValid()) {
                self.sendToBackend(self.user, self.email, self.pw);
            }
        });
    }
}

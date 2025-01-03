$(document).ready(function () {
    document.getElementById('toggle-password').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var icon = this.querySelector('span');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-lock');
            icon.classList.add('fa-unlock');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-unlock');
            icon.classList.add('fa-lock');
        }
    });


    $(function () {
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })

})



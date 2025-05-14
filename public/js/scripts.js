/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    //
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
$(document).ready(function () {
    $('form').on('submit', function (e) {
        var $form = $(this);

        // Verifique se o formulário já foi submetido
        if ($form.data('submitted') === true) {
            e.preventDefault(); // Impede o envio novamente
            return;
        }

        // Marque o formulário como já submetido
        $form.data('submitted', true);

        // Desativa todos os botões de submit (opcional)
        $form.find(':submit').attr('disabled', 'disabled');
    });
});

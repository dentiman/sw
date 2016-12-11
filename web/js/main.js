(function ($) {

    $.alert = function(data) {
        $.notify({
            message: data.message
        },{
            type: data.type,
            delay: 3000
        });
    };


    $(document).ready(function () {
        $('input[type=checkbox]').flatelements();

        $('.dropdown-content').click(function (event) {
            event.stopPropagation();
        });

        $('a[data-toggle="global-modal"]').click(function (event) {

            event.preventDefault();

            $.ajax({
                method: "GET",
                url: this.href,
                success: function (data) {

                    $('#globalModal .modal-content').html(data);
                    $('#globalModal').modal('show');
                }
            });
        });

    });

    // Handling the modal confirmation message.
    $(document).on('submit', 'form[data-confirmation]', function (event) {
        var $form = $(this),
            $confirm = $('#confirmationModal');

        if ($confirm.data('result') !== 'yes') {
            //cancel submit event
            event.preventDefault();

            $confirm
                .off('click', '#btnYes')
                .on('click', '#btnYes', function () {
                    $confirm.data('result', 'yes');
                    $form.find('input[type="submit"]').attr('disabled', 'disabled');
                    $form.submit();
                })
                .modal('show');
        }
    });


    $(document).on('submit', 'form[ajax-container]', function (event) {

        event.preventDefault();
        var $form = $(this);

        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : $form.serialize(),
            success: function(html) {
                // Replace current position field ...
              $($form.attr('ajax-container')).html(html);
                // Position field now displays the appropriate positions.
            }
        });
    });


    $(document).on('click', 'a[ajax-container]', function (event) {

        event.preventDefault();
        var $a = $(this);
        $.ajax({
            url : $a.attr('href'),
            type: 'POST',
            success: function(html) {
                $($a.attr('ajax-container')).html(html);
            }
        });
    });


})(window.jQuery);


/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

$(function() {
    $(document).on('click', '.showModalButton', function() {
        var modal = $('#modal');
        var btnDismissModal = '<div class="right"></div><button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '    <span aria-hidden="true">&times;</span>' +
            '</button></div>';

        if ( $(modal).data('bs.modal').isShown ) {
            $(modal).find('#modal-content-details')
                .load($(this).attr('data-url-submission'));

            $(modal).find('#modal-content-error').css('height', '0px');
            $(modal).find('#modal-content-error').css('background-color', 'transparent');
            $(modal).find('#modal-content-error').html('');
            $(modal).find('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>' + btnDismissModal);
        } else {
            var url = $(this).attr('data-url-submission');  // get URL from button or link
            $(modal).find('#modal-content-error').css('height', '0px');
            $(modal).find('#modal-content-error').css('background-color', 'transparent');
            $(modal).find('#modal-content-error').html('');

            // Load content from specified link
            $(modal).find('#modal-content-details').load(url, function( response, status, xhr ) {
                if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    //$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
                    console.log(msg + xhr.status + " " + xhr.statusText );
                    alert(msg + xhr.status + " " + xhr.statusText );
                }
            });

            $(modal).find('#modalHeader').html( '<h4>' + $(this).attr('title') + '</h4>' + btnDismissModal);
            modal.modal('show');  // open modal
        }
    });

    $(document).on("beforeSubmit", "#id-item-form", function() {
        var form = $(this);
        if (form.find('.has-error').length) {
            return false;
        }
        if (validateAndSubmitFormAsAjax(form)) {
            //submitFormAsAjax(form);
        }
        return false;
    });

    $("#btnModalSave").click(function(event) {
        event.preventDefault();
        var form = $('#id-item-form');
        if (form.find('.has-error').length) {
            return false;  // with errors, do not submit form by any means
        }
        if (validateAndSubmitFormAsAjax(form)) {
            // submitFormAsAjax(form);
        }
        return false; // stop default form submission
    });

    //--------------------------------------------------------------------------
    // Form validation as AJAX
    //--------------------------------------------------------------------------
    // Call to this function is typically required because opening a Yii2 form
    // in a Bootstrap modal does not validate properly the first time the web page is
    // loaded.  This validation provides errors to display, as a workaround.
    //--------------------------------------------------------------------------
    // Requires 'validationUrl' in ActiveForm (see '/views/my-model/_form.php'). Eg:
    // <?php
    //    $form = \yii\widgets\ActiveForm::begin([
    //       'id'     => 'id-form-item',
    //       'action' => (Yii::$app->request->isAjax ?
    //           ($model->isNewRecord ? ['ajax-create'] : ['ajax-update', 'id' => $model->id]) :
    //           ($model->isNewRecord ? ['create']      : ['update',      'id' => $model->id])
    //       ),
    //       'enableClientValidation' => true,    // no AJAX required
    //       'enableAjaxValidation'   => true,    // server-side validation required
    //       'validationUrl'          => \yii\helpers\Url::toRoute('ajax-validate'),  // AJAX validation URL
    //       'validateOnBlur'         => false,   // on field losing focus
    //       //'validateOnChange'     => false,   // on field change
    //       //'validateOnType '      => false,   // on user typing
    //       'validateOnSubmit'       => true,    // on form submission
    //    ]);
    //    //...
    // ?>
    //--------------------------------------------------------------------------
    function validateAndSubmitFormAsAjax(form)  {
        var yiiForm = $(form).data('yiiActiveForm');

        if (form.attr('action') == yiiForm.settings.validationUrl) {
            submitFormAsAjax(form);
        } else {
            var validationErrors = '## Errors ##';
            $.ajax({
                url      : yiiForm.settings.validationUrl,
                type     : 'post',
                dataType : 'json',
                data     : form.serializeArray(),
            })
                .done(function(response) {
                    if (Array.isArray(response) && (response.length == 0)) {
                        validationErrors = '';
                        submitFormAsAjax(form);
                    } else {
                        validationErrors = '';  // clear errors
                        for (var field in response['data']['model']) {
                            // console.log(field + " = " + response['data']['model'][field]);
                            validationErrors += "<li>"+ response['data']['model'][field] + "</li>\n";
                        }
                        if (validationErrors.length > 0) {
                            var errorBox = form.find('.error-summary');
                            $(errorBox).css('display', '');  // make it visible (remove 'display: none')
                            $(errorBox).html('<p>Please fix the following errors:</p><ul>' + validationErrors + '</ul>');
                        }
                    }
                    return (validationErrors.length <= 0);
                })
                .fail(function(response) {
                    console.log("validateAndSubmitFormAsAjax(): Error:");
                    console.log(response);
                    console.log("\n");
                });
        }
    }

    //--------------------------------------------------------------------------
    // Form submission as AJAX
    //--------------------------------------------------------------------------
    function submitFormAsAjax(form) {
        //---------------------------------------
        // Submit form as AJAX (if no errors)
        //---------------------------------------
        $.ajax({
            url      : form.attr('action'),
            type     : 'post',
            dataType : 'json',
            data     : form.serializeArray(),
        })
            .done(function(response) {
                if ((typeof response.data !== "undefined") && (response.data.success == true)) {
                  // Load changes to view with Pjax container 'id-index-items'
                    $.pjax.reload({container: '#id-index-items'});

                    // Reset UI
                    $('#modal').modal('hide');  // close modal
                    $(".modal-backdrop.in").hide();     // hide modal background that likes to linger after AJAX submission

                    // Clear the form
                    form.yiiActiveForm('resetForm');    // Clear the form with the validation messages
                    form[0].reset();                    // Remove the values from the form inputs
                } else {
                    console.log("submitFormAsAjax(): Error validation and saving record");
                    if (typeof response.data !== "undefined") {
                        console.log('submitFormAsAjax(): Response data: ' + response.data);
                    } else {
                        console.log('submitFormAsAjax(): Response raw: ' + response);
                    }
                }
                console.log("submitFormAsAjax(): Done");
            })
            .fail(function(response) {
                console.log("submitFormAsAjax(): Error:");
                console.log(response);
            });
    }
});

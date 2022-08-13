@extends('layouts.app')

@push('jsH')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.openpay.mx/openpay.v1.min.js"></script>
    <script type='text/javascript' src="https://js.openpay.mx/openpay-data.v1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            OpenPay.setId('mw8sd5gk20bjdtoxk6yf');
            OpenPay.setApiKey('pk_8aaeb398404c42ddab1d2036ce6f6f0a');
            OpenPay.setSandboxMode(true);
            //Se genera el id de dispositivo
            var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

            $('#pay-button').on('click', function(event) {
                event.preventDefault();
                $("#pay-button").prop("disabled", true);
                OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
            });
            var sucess_callbak = function(response) {
                var token_id = response.data.id;
                $('#token_id').val(token_id);
                $('#payment-form').submit();
            };
            var error_callbak = function(response) {
                var desc = response.data.description != undefined ? response.data.description : response
                    .message;
                console.log(desc);
                var error_message;
                var error_code = response.status;
                if (desc ==
                    'card_number is required, holder_name is required, expiration_year expiration_month is required' ||
                    desc ==
                    'holder_name is required, card_number is required, expiration_year expiration_month is required' ||
                    desc ==
                    'holder_name is required, expiration_year expiration_month is required' ||
                    desc == 'The CVV2 security code is required' ||
                    desc == 'holder_name is required' ||
                    desc == 'card_number is required, card_number is required' ||
                    desc == 'expiration_year expiration_month is required') {
                    error_message = 'Por favor, introduzca los valores de la tarjeta'
                } else if (desc ==
                    'expiration_month 00 is invalid, valid expirations months are 01 to 12') {
                    error_message = 'Por favor, introduzca un mes de expiración valido'
                } else if (desc == 'card_number length is invalid') {
                    error_message = 'El largo del número de tarjeta es incorrecto';
                } else if (desc == 'cvv2 length must be 3 digits' || desc == 'cvv2 length must be 4 digits' ||
                    desc == 'cvv2 must contain only digits') {
                    error_message ='Por favor, proporciona correctamente el código de seguridad de la tarjeta.';
                } else if (desc == 'The card number verification digit is invalid') {
                    error_message =
                        'Por favor, proporciona correctamente el número de tarjeta.';
                } else if (desc == 'The expiration date has already passed') {
                    error_message =
                        'Por favor, proporciona de forma correcta la fecha de vencimiento de la tarjeta mes/año.';
                } else if (desc == 'card_number must contain only digits') {
                    error_message = 'Por favor, proporciona de forma correcta el número de la tarjeta.';
                } else if(desc == 'The expiration date has expired'){
                    error_message = 'La tarjeta esta expirada. Por favor, verifique la fecha de expiración';
                }else {
                    error_message = 'Ocurrió un error, vuelva a intentarlo';
                }
                Swal.fire(
                    "Oh no!",
                    "Ha ocurrido un problema\n" + error_message,
                    "error"
                );
                $("#pay-button").prop("disabled", false);
            };
        });
    </script>
@endpush

@section('content')
    <carrito-component />
@endsection

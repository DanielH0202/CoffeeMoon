<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Openpay\Data\Openpay;
use Openpay\Data\OpenpayApiAuthError;
use Openpay\Data\OpenpayApiConnectionError;
use Openpay\Data\OpenpayApiError;
use Openpay\Data\OpenpayApiRequestError;
use Openpay\Data\OpenpayApiTransactionError;

class pagosController extends Controller
{
    public function vista(){
        return view('pages.pagos');
    }

    public function procesarPago(Request $request){

        $idPedido = $_POST['pedido'];
        $total = $_POST['total'];

        $pedido = new pedidosController();
        $pedido->editarEstado($idPedido, 'Pagado');

        $nuevoPago = new Pagos();
        $nuevoPago->idPedido = $idPedido;
        $nuevoPago->montoTotal = $total;

        $nuevoPago->save();

        return redirect()->to('/home')->withCookie('pago','Pago exitoso',1);

        /*try{
            
            $openpay = Openpay::getInstance('mw8sd5gk20bjdtoxk6yf', 'sk_f0a2fe6da39a43b6ba79ddb770c5958b','MX');
            Openpay::setProductionMode(false);

            //Información del cliente
            $customer = array(
                'name' => Auth::user()->name,
                'last_name' => '',
                'phone_number' => '',
                'email' => Auth::user()->email
            );

            $chargeData = array(
                'method' => 'card',
                'source_id' => $_POST['token_id'],
                'send_email' => false,
                'currency' => 'MXN',
                'amount' => $_POST['total'], //Monto a pagar
                'description' => 'Pago del pedido ' . $_POST['pedido'], //Descripción del pago
                'use_card_points' => false,
                'device_sesion_id' => $_POST['deviceIdHiddenFieldName'],
                'customer' => $customer
            );

            //Resultado del pago
            $charge = $openpay->charges->create($chargeData);

        } catch (OpenpayApiTransactionError $e) {
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                  ' [error code: ' . $e->getErrorCode() . 
                  ', error category: ' . $e->getCategory() . 
                  ', HTTP code: '. $e->getHttpCode() . 
                  ', request ID: ' . $e->getRequestId() . ']', 0);
        
        } catch (OpenpayApiRequestError $e) {
            error_log('ERROR on the request: ' . $e->getMessage(), 0);
        
        } catch (OpenpayApiConnectionError $e) {
            error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
        
        } catch (OpenpayApiAuthError $e) {
            error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            
        } catch (OpenpayApiError $e) {
            error_log('ERROR on the API: ' . $e->getMessage(), 0);
            
        } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
        }*/
    }
}

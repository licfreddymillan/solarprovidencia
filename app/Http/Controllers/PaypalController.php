<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
 
use PayPal\Rest\ApiContext; use PayPal\Auth\OAuthTokenCredential; use PayPal\Api\Amount;
use PayPal\Api\Details; use PayPal\Api\Item; use PayPal\Api\ItemList; use PayPal\Api\Payer;
use PayPal\Api\Payment; use PayPal\Api\RedirectUrls; use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution; use PayPal\Api\Transaction;
use App\Models\Purchase;
use Auth; use DB; use Carbon\Carbon; use Mail;


class PaypalController extends Controller
{
	private $_api_context;
 
	public function __construct(){
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
    
    public function payment(Request $request){
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 
		$items = array();
		$currency = 'USD';
		$amount = $request->amount;
  		
  		if (isset($request->course_id)){
  			$descripcion = 'Compra de Curso '.$request->description;
  			$request->session()->put('content_type', 'curso');
  			$request->session()->put('course_id', $request->course_id);
  		}else{
  			$descripcion = 'Compra de Evento '.$request->description;
  			$request->session()->put('content_type', 'evento');
  			$request->session()->put('event_id', $request->event_id);
  		}

 		$item = new Item();
 		$item->setName('Pago en Solar Providencia')
					->setCurrency($currency)
					->setDescription($descripcion)
					->setQuantity(1)
					->setPrice($amount);

		$items[] = $item;
 		$subtotal = $amount;
		$total = $amount;

		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal);
 
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App Store');
 	
 		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('process-paypal-checkout'))
				->setCancelUrl(\URL::route('process-paypal-checkout'));
		
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
 
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
 
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');
	}

	public function process_payment(Request $request){
		$payment_id = $request->get('paymentId');
		\Session::forget('paypal_payment_id');
 
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');

		if ($request->session()->get('content_type') == 'curso'){
			$curso = $request->session()->get('course_id');
			$datosCurso = DB::table('courses')
						->select('slug', 'price')
						->where('id', '=', $curso)
						->first();
		}else{
			$evento = $request->session()->get('event_id');
			$datosEvento = DB::table('events')
							->select('slug', 'price')
							->where('id', '=', $evento)
							->first();
		}
		
 
		if (empty($payerId) || empty($token)) {
			if ($request->session()->get('content_type') == 'curso'){
				return redirect('courses/show/'.$datosCurso->slug.'/'.$curso)->with('msj-erroneo', 'Hubo un problema al intentar pagar con Paypal');
			}else{
				return redirect('events/show/'.$datosEvento->slug.'/'.$evento)->with('msj-erroneo', 'Hubo un problema al intentar pagar con Paypal');
			}
		}
 
		$payment = Payment::get($payment_id, $this->_api_context);
		
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
 
		$result = $payment->execute($execution, $this->_api_context);
 		
		if ($result->getState() == 'approved') {
			if ($request->session()->get('content_type') == 'curso'){
				Auth::user()->courses()->attach($curso, ['start_date' => date('Y-m-d')]);

				$compra = new Purchase();
				$compra->user_id = Auth::user()->id;
				$compra->course_id = $curso;
				$compra->amount = $datosCurso->price;
				$compra->payment_method = 'Paypal';
				$compra->payment_id = $payment_id;
				$compra->date = date('Y-m-d');
				$compra->status = 1;
				$compra->save();

				return redirect('user/course-resume/'.$datosCurso->slug.'/'.$curso)->with('msj-exitoso', '¡Felicidades! Has comprado el curso con éxito. ¡Disfrútalo!');
			}else{
				Auth::user()->events()->attach($evento);

				$compra = new Purchase();
				$compra->user_id = Auth::user()->id;
				$compra->event_id = $evento;
				$compra->amount = $datosEvento->price;
				$compra->payment_method = 'Paypal';
				$compra->payment_id = $payment_id;
				$compra->date = date('Y-m-d');
				$compra->status = 1;
				$compra->save();

				return redirect('user/event-resume/'.$datosEvento->slug.'/'.$evento)->with('msj-exitoso', '¡Felicidades! Has comprado el evento con éxito. ¡Disfrútalo!');
			}
		}

		if ($request->session()->get('content_type') == 'curso'){
			return redirect('courses/show/'.$datosCurso->slug.'/'.$curso)->with('msj-erroneo', 'Hubo un problema. Su compra no ha podido ser procesada.');
		}else{
			return redirect('events/show/'.$datosEvento->slug.'/'.$evento)->with('msj-erroneo', 'Hubo un problema. Su compra no ha podido ser procesada.');
		}
	}
}

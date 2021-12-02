<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Transfer;
use App\Models\Purchase;
use DB;
use Auth;
use Mail;

class TransferController extends Controller
{
    //*** Historial ***//
    function index(){
        $transferencias = Transfer::where('status', '>', 0)
                            ->orderBy('id', 'DESC')
                            ->get();

        return view('admin.transfersRecord')->with(compact('transferencias'));
    }

    //*** Transferencias Pendientes ***//
    function pending_transfers(){
        $transferencias = Transfer::where('status', '=', 0)
                            ->orderBy('id', 'DESC')
                            ->get();

        return view('admin.pendingTransfers')->with(compact('transferencias'));
    }

    public function store(Request $request)
    {
        $transferencia = new Transfer($request->all());
        $transferencia->user_id = Auth::user()->id;
        $transferencia->status = 0;
        $transferencia->save();

        if ($request->hasFile('support_image')) {
            $file = $request->file('support_image');
            $name = $transferencia->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/transfers', $name);
            $transferencia->support_image = $name;
            $transferencia->save();

            $data['adjunto'] = $name;
        }

        $data['transferencia'] = $transferencia; 
        $data['comprador'] = Auth::user();
        Mail::send('emails.newTransfer',['data' => $data], function($msg) use ($data){
            $msg->to('damianchavez@solarprovidencia.com');
            $msg->subject('Nuevo Reporte de Transferencia');
        });

        if (isset($request->course_id)){
            return redirect('user/my-courses')->with('msj-exitoso', 'Su registro de transferencia ha sido registrado con éxito. En un lapso de 48 horas le daremos respuesta a su solicitud.');
        }else{
            return redirect('user/my-events')->with('msj-exitoso', 'Su registro de transferencia ha sido registrado con éxito. En un lapso de 48 horas le daremos respuesta a su solicitud.');
        }
        
    }

    public function change_status($id, $status){
        $transferencia = Transfer::find($id);
        $transferencia->status = $status;
        $transferencia->save();

        if ($status == 1){
            if (!is_null($transferencia->course_id)){
                DB::table('courses_users')
                    ->insert(['user_id' => $transferencia->user_id, 'course_id' => $transferencia->course_id, 'progress' => 0, 'start_date' => date('Y-m-d')]);

                $compra = new Purchase();
                $compra->user_id = $transferencia->user_id;
                $compra->course_id = $transferencia->course_id;
                $compra->amount = $transferencia->amount;
                $compra->payment_method = 'Transferencia Bancaria';
                $compra->payment_id = 'TRANSF#'.$transferencia->id;
                $compra->date = date('Y-m-d');
                $compra->status = 1;
                $compra->save();
            }else{
                DB::table('events_users')
                    ->insert(['user_id' => $transferencia->user_id, 'event_id' => $transferencia->event_id]);

                $compra = new Purchase();
                $compra->user_id = $transferencia->user_id;
                $compra->event_id = $transferencia->event_id;
                $compra->amount = $transferencia->amount;
                $compra->payment_method = 'Transferencia Bancaria';
                $compra->payment_id = 'TRANSF#'.$transferencia->id;
                $compra->date = date('Y-m-d');
                $compra->status = 1;
                $compra->save();
            }

            $data['transferencia'] = $transferencia;
            Mail::send('emails.processTransfer',['data' => $data], function($msg) use ($data){
                $msg->to($data['transferencia']->user->email);
                $msg->subject('Su transferencia fue aprobada');
            });
           return redirect('admin/transfers/pending')->with('approve-msj', '1'); 
        }else{

            $data['transferencia'] = $transferencia;
            Mail::send('emails.processTransfer',['data' => $data], function($msg) use ($data){
                $msg->to($data['transferencia']->user->email);
                $msg->subject('Su transferencia fue denegada');
            });
            return redirect('admin/transfers/pending')->with('deny-msj', '1');
       }
    }

    //*** Historial ***//
    function purchases(){
        $compras = Purchase::orderBy('id', 'DESC')
                            ->get();

        return view('admin.purchasesRecord')->with(compact('compras'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Event; use App\Models\Transfer;
use App\Models\News;
use DB;
use Auth;
use Mail;

class EventController extends Controller
{
    function index(){
        if ((Auth::guest()) || (Auth::user()->rol == 2)) {
            $eventos = Event::where('status', '>', 0)->orderBy('date', 'DESC')->get();

            foreach ($eventos as $evento){
                $evento->mes = $this->getMonth(date('m', strtotime($evento->date)));
            }

            return view('user.events')->with(compact('eventos'));
        } else {
            $eventos = Event::withCount('users')
                        ->orderBy('date', 'DESC')
                        ->get();
                        
            return view('admin.events')->with(compact('eventos'));
        }
    }

    public function store(Request $request){
        $evento = new Event($request->all());
        $evento->slug = Str::slug($evento->title);
        $evento->status = 1;
        $evento->save();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = $evento->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/events', $name);
            $evento->cover = $name;
            $evento->save();
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $name = $evento->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/videos/events', $name);
            $evento->video = $name;
            $evento->save();
        }

        return redirect('admin/events')->with('store-msj', '1');
    }

    public function show($slug, $id){
        $transferenciaPendiente = NULL;
        if ( (!Auth::guest()) && (Auth::user()->rol == 2) ){ 
            $agregado = Auth::user()->events()->where('event_id', '=', $id)->count();

            if ($agregado == 1){
               return redirect('user/event-resume/'.$slug.'/'.$id);
            } 

            $transferenciaPendiente = DB::table('bank_transfers')
                                        ->where('user_id', '=', Auth::user()->id)
                                        ->where('event_id', '=', $id)
                                        ->where('status', '=', 0)
                                        ->first();
        }
        
        $evento = Event::where('id', '=', $id)
                    ->withCount('users')
                    ->first();

        $evento->mes = $this->getMonth(date('m', strtotime($evento->date)));

        $otrosEventos = Event::where('status', '>', 0)
                            ->where('id', '<>', $id)
                            ->orderBy('id', 'DESC')
                            ->take(5)
                            ->get();

        return view('user.showEvent')->with(compact('evento', 'otrosEventos', 'transferenciaPendiente'));
    }

    public function update(Request $request){
        $evento = Event::find($request->event_id);
        $evento->fill($request->all());
        $evento->slug = Str::slug($evento->title);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = $evento->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/events', $name);
            $evento->cover = $name;
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $name = $evento->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/videos/events', $name);
            $evento->video = $name;
        }

        $evento->save();

        return redirect('admin/events')->with('update-msj', '1');
    }

    public function destroy($id){
        Event::destroy($id);

        return redirect('admin/events')->with('delete-msj', '1');
    }

    public function getMonth($month){
        switch ($month) {
            case 1:
                $mes = 'Enero';
            break;
            case 2:
                $mes = 'Febrero';
            break;
            case 3:
                $mes = 'Marzo';
            break;
            case 4:
                $mes = 'Abril';
            break;
            case 5:
                $mes = 'Mayo';
            break;
            case 6:
                $mes = 'Junio';
            break;
            case 7:
                $mes = 'Julio';
            break;
            case 8:
                $mes = 'Agosto';
            break;
            case 9:
                $mes = 'Septiembre';
            break;
            case 10:
                $mes = 'Octubre';
            break;
            case 11:
                $mes = 'Noviembre';
            break;
            case 12:
                $mes = 'Diciembre';
            break;
        }

        return $mes;
    }

    public function search(Request $request){
        $eventos = Event::where('title', 'LIKE', '%' . $request->get('busqueda') . '%')
                    ->where('status', '>', 0)
                    ->orderBy('title', 'ASC')
                    ->get();

        foreach ($eventos as $evento){
            $evento->mes = $this->getMonth(date('m', strtotime($evento->date)));
        }

        return view('user.events')->with(compact('eventos'));
    }

    public function my_events(){
        $eventos = Auth::user()->events;

        $eventosPendientes = Transfer::with('event')
                                ->where('event_id', '<>', NULL)
                                ->where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 0)
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('user.myEvents')->with(compact('eventos', 'eventosPendientes'));
    }

    public function resume($slug, $id){
        $evento = Event::find($id);

        $noticias = News::where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        $countdown_limit = NULL;
        if ($evento->live == 1){
            if ($evento->status == 2){
                $countdown_limit = 0;
            }else{
                //$fecha = $evento->date."T".$evento->time;
                //$countdown_limit = date('M j\, Y H:i:s', strtotime($fecha));
                $countdown_limit = 1;
            }
        }

        return view('user.resumeEvent')->with(compact('evento', 'noticias', 'countdown_limit'));
    }

    public function show_video($slug, $id){
        $evento = Event::find($id);

        return view('user.showEventVideo')->with(compact('evento'));
    }

    public function subscribers($id){
        $evento = Event::withCount('purchases')
                            ->where('id', '=', $id)
                            ->first();

        return view('admin.subscribers')->with(compact('evento'));
    }

    public function send_mail(Request $request){
        $evento = Event::with('users')
                            ->where('id', '=', $request->event_id)
                            ->first();

        $data = [];
        $data['adjunto'] = NULL;
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path() . '/uploads/files/events', $name);
            $data['adjunto'] = $name;
        }

        $data['content'] = $request->description;
        $data['title'] = $request->title;

        foreach ($evento->users as $suscriptor){
            $usuario = DB::table('users')
                        ->select('email')
                        ->where('id', '=', $suscriptor->pivot->user_id)
                        ->first();

            $data['correo'] = $usuario->email; 
            Mail::send('emails.eventSubscription',['data' => $data], function($msg) use ($data){
                $msg->to($data['correo']);
                $msg->subject($data['title']);
                if (!is_null($data['adjunto'])){
                    $msg->attach('https://www.solarprovidencia.com/uploads/files/events/'.$data['adjunto']);
                }
            });
        } 

        return redirect('admin/events/subscribers/'.$request->event_id)->with('mail-msj', '1');
    }
}

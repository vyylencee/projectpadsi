<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventAttendies;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_api_context;

    public function __construct()
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }


    public function index()
    {
        $data['events'] = Event::orderBy('id','asc')->paginate(5);
        return view('events.index', $data);
    }

     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_reservasi' => 'required',
            'ruangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_akhir' => 'required',
            'kontak' => 'required',
            'tipe_reservasi' => 'required',
            'status' => 'required',
        ]);

        $event = new Event;
        $event->tanggal_reservasi = $request->tanggal_reservasi;
        $event->ruangan = $request->ruangan;
        $event->waktu_mulai = Carbon::parse($request->waktu_mulai)->format('H:i');
        $event->waktu_akhir = Carbon::parse($request->waktu_akhir)->format('H:i');
        $event->kontak = $request->kontak;
        $event->tipe_reservasi = $request->tipe_reservasi;
        $event->status = $request->status;
        $event->save();
        return redirect()->route('events.index')
                        ->with('success','Event has been created successfully.');
    }


     
        public function search(Request $request)
    {
        $search = $request->get('search');

        $events = \App\Models\Event::query()
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('events.table', compact('events'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_reservasi' => 'required',
            'ruangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_akhir' => 'required',
            'kontak' => 'required',
            'tipe_reservasi' => 'required',
            'status' => 'required',
        ]);
        
        $event = Event::find($id);
        $event->tanggal_reservasi = $request->tanggal_reservasi;
        $event->ruangan = $request->ruangan;
        $event->waktu_mulai = Carbon::parse($request->waktu_mulai)->format('H:i');
        $event->waktu_akhir = Carbon::parse($request->waktu_akhir)->format('H:i');
        $event->kontak = $request->kontak;
        $event->tipe_reservasi = $request->tipe_reservasi;
        $event->status = $request->status;
        $event->save();
    
        return redirect()->route('events.index')
                        ->with('success','Event updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
                        ->with('success','Event has been deleted successfully');
    }
    // Event Show
    public function event()
    {
        $data['events'] = Event::orderBy('id','desc')->where('status','1')->paginate(6);
        return view('event', $data);
    }

    public function uploadCsv(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('file');
    $rows = array_map('str_getcsv', file($file));

    foreach ($rows as $row) {
        $id = $row[0];

        DB::table('events')
            ->where('id', $id)
            ->update(['status' => 0]);
    }

    return response()->json([
        'message' => 'File berhasil diproses!',
    ]);
}

    public function report()
    {
        return $this->hasOne(Report::class, 'id_reservasi', 'id');
    }

    protected static function booted()
    {
        static::updated(function ($event) {
            if (
                $event->wasChanged('status') &&
                $event->status === 'Completed' &&  // pastikan huruf besar sesuai
                $event->report()->doesntExist()
            ) {
                // Pastikan reservation_id ada
                if (!$event->reservation_id) {
                    Log::warning("Event ID {$event->id} tidak punya reservation_id");
                    return;
                }

                Report::create([
                    'reservation_id'     => $event->reservation_id,
                    'id_order'           => $event->id_order,
                    'tanggal_reservasi'  => $event->tanggal,
                    'ruangan'            => $event->ruangan,
                    'waktu_mulai'        => $event->waktu_mulai,
                    'waktu_akhir'        => $event->waktu_akhir,
                    'tipe_reservasi'     => $event->tipe_reservasi ?? 'private',
                    'status'             => 'Completed',
                    'payment_status'     => $event->payment_status,
                ]);

                Log::info("Report otomatis dibuat untuk event #{$event->id}");
            }
        });
    }
}
<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail\LateInovice;
use App\Mail\OrderCreated;
use App\Mail\OrderPaid;
use App\Order;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;
use Swift_TransportException;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.orders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);
        $cities = City::all();

        return view('admin.order')
            ->with([
                'order'    => $order,
                'training' => $training,
                'city'     => $city,
                'cities'   => $cities,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);

        $sent = '';

        if (isset($request->state)) {
            $state = (int)$request->state;
            $old_state = $order->state;

            switch ($state) {
                case 0:
                    $mail = new OrderCreated($order, $city, $training, $old_state == 3);

                    break;
                case 1:
                    $this->generatePdf($order, $training, $city);

                    $mail = new OrderPaid($order, $city, $training);

                    $mail->attach(base_path() . '/files/' . $order->id, ['as' => 'faktura.pdf']);
                    break;
            }

            if (isset($mail)) {
                $sent = ' Email byl odeslán.';
                try {
                    Mail::to($order->email)->send($mail);
                } catch (Swift_TransportException $ex) {
                }
            }

            $order->state = $state;
        }

        if (isset($request->training_id)) {
            $order->training_id = $request->training_id;
        }

        $order->save();

        return redirect()
            ->route('orders.show', [ 'order' => $order->id ])
            ->with('status', 'Objednávka byla upravena.' . $sent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function inovices() {
        $orders = Order::where('state', '=', 1)->get();
        //$orders = Order::where('id', '=', 493)->get();
        $count = 0;

        foreach ($orders as $order) {
            $count++;

            echo $order->email;
            echo "\n";

            $filename = base_path() . '/files/' . $order->id;

            $training = Training::findOrFail($order->training_id);
            $city = City::findOrFail($training->city_id);

            if (!file_exists($filename)) {
                $this->generatePdf($order, $training, $city);
                echo "generated {$order->id}\n\n";
            }

            try {
                $mail = new LateInovice();
                $mail->attach($filename, ['as' => 'faktura.pdf']);
                Mail::to($order->email)->send($mail);
            } catch (Swift_TransportException $ex) {
            }
        }

        return $count;
    }

    public function inovice(Request $request, $id) {
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);

        return $this->generatePdf($order, $training, $city)->Output();
    }

    private function generatePdf(Order $order, Training $training, City $city): Mpdf {
        $name = $order->parent ?: $order->name;
        $account = $city->name == 'Jihlava' ? '2001483613/2010' : '2901483600/2010';

        $vystaveni = $order->created_at->format('j.n.Y');
        $splatnost = clone $order->created_at;
        $splatnost->add(new \DateInterval('P7D'));
        $splatnost = $splatnost->format('j.n.Y');

        $mpdf = new Mpdf([
            'margin_left'   => 21,
            'margin_right'  => 21,
            'margin_top'    => 62,
            'margin_bottom' => 30,
            'margin_header' => 15,
            'margin_footer' => 15,
            'default_font' => 'helvetica'
        ]);

        $mpdf->SetHTMLHeader('<div class="header-spacer"> </div><div class="header">URBAN SENSE ACADEMY</div>');
        $mpdf->SetHTMLFooter('<div class="footer">Urban Sense z.s.</div>');
        $mpdf->WriteHTML('
            <style>
              .header {
                color: #367da2;
                border-top: 4px solid #367da2;
                font-weight: bold;
                font-size: 17px;
              }
              .header-spacer {
                height: 25px;
              }
              
              .footer {
                text-align: right;
                border-top: 2px solid #367da2;
                padding-top: 8px;
                font-size: 14px;
              }
              
              .faktura-header {
                font-weight: normal;
                font-size: 24px;
              }
              .blue {
                color:  #367da2
              }
              .do-header {
                 color: #385d70;
                 font-style: italic;
              }
              .do-text {
                color: #385d70;
                font-weight: bold;
              }
              .do-spacer {
                height: 25px;
              }
              
              td {
                vertical-align: top;
              }
              th {
                text-align: left;
              }
              
              .sumtable {
                border-collapse: collapse;
              }
              
              .sumtable th {
                background: #367da2;
                color: white;
                padding: 5px;
              }
              .sumtable td {
                 border: 1px dotted #919191;
                 padding: 5px;
              }
              .sumtable .sum td {
                border-top: 1px solid black;
                border-bottom: 1px solid black;
              }
              
              .dph {
                text-align: right;
              }
             
            </style>
        ');
        $mpdf->WriteHTML("


        
<table style='width: 100%'>
<tbody>
      <tr >
        <td style='width: 28%'>
          <h2 class='faktura-header'>FAKTURA</h2>
          č. <span class='blue'>{$order->id}</span>
        </td>
        <td>
            <div class='do-header'>Odběratel:</div>
            <div class='do-text'>
             {$name} <br>
                &nbsp;<br>
                &nbsp;
            </div>
            <br><br>
        </td>
    </tr>
    <tr>
      <td valign='top'>
        <div class='do-header'>Dodavatel:</div>
        <div class='do-text'>
            Urban sense <br>
            U Dvora 4 <br>
            586 01 Jihlava <br>
            IČ: 227542211
        </div>
        
      </td>
      <td>
        
          <table style='width: 100%; margin: 0; padding: 0'>
                <tr>
                  <td style='width: 40%'>Číslo účtu:</td>
                  <td>{$account}</td>
                </tr>
                <tr>
                  <td>Název Banky</td>
                  <td>FIO banka</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Variabilní symbol</td>
                  <td>{$order->id}</td>
                </tr>
                <tr>
                  <td>Datum vystavení</td>
                  <td>{$vystaveni}</td>
                </tr>
                <tr>
                  <td>Datum splatnosti</td>
                  <td>{$splatnost}</td>
                </tr>
                <tr>
                  <td>Typ platby</td>
                  <td>Převodem na účet</td>
                </tr>
          </table>
          
          <br><br>
          
          <table class='sumtable'>
            <tr>
              <th>Popis</th>
              <th>Množství</th>
              <th>Cena/ks</th>
              <th>Cena</th>
            </tr>
            <tr>
              <td>Půlroční poplatek za kroužek parkouru ve městě {$city->name} ({$training->season})</td>
              <td>1</td>
              <td>Kč {$order->price}</td>
              <td>Kč {$order->price}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr class='sum'>
              <td></td>
              <td></td>
              <td>Celkem</td>
              <td>Kč {$order->price}</td>
            </tr>
          </table>
          
          <br><br>
        
          <table style='width: 100%'><tr><td align='right'>Nejsme pláci DPH.</td></tr></table>
      </td>
    </tr>
</tbody>        
</table>  
          
        ");

        $mpdf->Output(base_path() . '/files/' . $order->id, 'F');

        return $mpdf;
    }
}

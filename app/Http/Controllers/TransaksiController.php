<?php

namespace App\Http\Controllers;

use App\Models\{Customer, Product, TransaksiHeader,TransaksiDetail,Produk};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    private function generateNoInv() {
        $prefix = "INV";
        $dateCode = Carbon::now()->format("ym");
        $last = TransaksiHeader::whereRaw("DATE_FORMAT(created_at,'%y%m') = ?", [$dateCode])
                    ->orderBy('id','desc')->first();
        $urut = $last ? (intval(substr($last->no_inv, -4)) + 1) : 1;
        return $prefix . "/" . $dateCode . "/" . str_pad($urut,4,"0",STR_PAD_LEFT);
    }

    public function index() {
        $transaksi = TransaksiHeader::all();
        $data = TransaksiHeader::with('details')->get();
        return view('transactions.index', compact('data', 'transaksi'));
    }

    public function create() {
        $produk = Product::all();
        $customers = Customer::all();
        return view('transactions.create', compact('produk', 'customers'));
    }

    public function show($id){
        $transaksi = TransaksiHeader::with(['customer', 'details.product'])
            ->findOrFail($id);

        $transaksi->details = $transaksi->details->sortBy('kode_produk');

        return view('transactions.show', compact('transaksi'));
    }

    public function destroy($id){
        $transaksi = TransaksiHeader::findOrFail($id);
        $transaksi->details()->delete();
        $transaksi->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function store(Request $request){
        try {
            DB::transaction(function() use ($request) {

                $customer = Customer::find($request->customer_id);

                $no_inv = $this->generateNoInv();

                $header = TransaksiHeader::create([
                    'no_inv' => $no_inv,
                    'kode_customer' => $customer->kode_customer,
                    'nama_customer' => $customer->nama_customer,
                    'alamat_customer' => $customer->alamat,
                    'tgl_inv' => now(),
                    'total' => 0,
                ]);

                $total = 0;
                foreach ($request->details as $d) {
                    $produk = Product::where('kode_produk', $d['kode_produk'])->first();
                    if (!$produk) continue;

                    if ($d['qty'] > $produk->stok) {
                        throw new \Exception("Qty melebihi stok untuk produk ".$produk->nama_produk);
                    }

                    $produk->stok -= $d['qty'];
                    $produk->save();

                    $harga = $d['harga'] ?? $produk->harga;
                    $harga_net = $harga;
                    $harga_net -= $harga_net * ($d['disc1']/100);
                    $harga_net -= $harga_net * ($d['disc2']/100);
                    $harga_net -= $harga_net * ($d['disc3']/100);

                    $jumlah = $harga_net * $d['qty'];

                    TransaksiDetail::create([
                        'no_inv' => $no_inv,
                        'kode_produk' => $produk->kode_produk,
                        'nama_produk' => $produk->nama_produk,
                        'qty' => $d['qty'],
                        'harga' => $harga,
                        'disc1' => $d['disc1'],
                        'disc2' => $d['disc2'],
                        'disc3' => $d['disc3'],
                        'harga_net' => $harga_net,
                        'jumlah' => $jumlah,
                    ]);

                    $total += $jumlah;
                }

                $header->update(['total' => $total]);
            });

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

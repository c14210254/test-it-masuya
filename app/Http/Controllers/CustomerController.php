<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create(){
        return view('customers.create');
    }

    public function store(Request $request){
        $request->validate([
            'kode_customer' => [
                'required',
                'unique:customers,kode_customer',
                'regex:/^[a-zA-Z0-9]+$/',
            ],
            'nama_customer' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
        ], [
            'kode_customer.required' => 'Kode customer wajib diisi.',
            'kode_customer.unique' => 'Kode customer sudah ada, silakan gunakan kode lain.',
            'kode_customer.regex' => 'Kode customer hanya boleh berisi huruf dan angka (tanpa spasi atau simbol).',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan');
    }

    public function edit(Customer $customer){
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer){
        $request->validate([
            'kode_customer' => 'required|unique:customers,kode_customer,' . $customer->id,
            'nama_customer' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui');
    }

    public function destroy(Customer $customer){
        if ($customer->transactionDetails()->count() > 0) {
            return redirect()->route('customers.index')
                ->with('error', 'Customer tidak bisa dihapus karena sudah ada transaksi!');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus');
    }


    public function getJson($id){
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

}

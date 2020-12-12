<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\ValidateCpfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Couchbase\basicDecoderV1;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $this->validator($request);

        $files = $request->file('file');
        $destination = public_path('assets/uploads/nf');
        $filename = date('YmdHis').'.'.$files->getClientOriginalExtension();

        $cpf = new ValidateCpfService();
        if (!$cpf->validate($request->input('cpf'))) {
            return back()->withErrors(['cpf inválido']);
        }

        Invoice::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'cpf' => $this->onlyNumbers($request->input('cpf')),
            'cep' => $this->onlyNumbers($request->input('cep')),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'number' => $request->input('number'),
            'neighborhood' => $request->input('neighborhood'),
            'complement' => $request->input('complement'),
            'invoice' => $filename,
            'validated' => 0,
            'users_id' => Auth::id()
        ]);

        $files->move($destination, $filename);

        return View('public.success');
    }

    public function validateInvoice(string $uuid)
    {
        $invoice = Invoice::findByUuid($uuid);
        DB::beginTransaction();
        try {

            $invoice->update([
                'validated' => '1'
            ]);

            DB::commit();
            return redirect()->route('admin.invoices.home')->with(['message' => 'Nota Fiscal validade com sucesso']);

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->route('admin.invoices.home')->with(['error' => true, 'message' => 'Falha na tentativa de validar nota fiscal, tente novamente']);

        }
    }

    public function destroy(string $uuid)
    {
        $invoice = Invoice::findByUuid($uuid);
        try {

            $invoice->delete();

            return redirect()->route('admin.invoices.home')->with(['message' => 'Nota Fiscal excluída com sucesso']);

        } catch (\Exception $err) {

            return redirect()->route('admin.invoices.home')->with(['error' => true, 'message' => 'Falha na tentativa de excluir nota fiscal, tente novamente']);

        }

    }

    private function validator(Request $request)
    {
        return $request->validate([
            'file' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'cpf' => ['required', 'string'],
            'cep' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'neighborhood' => ['required', 'string'],
            'terms' => ['required']
        ]);
    }
}

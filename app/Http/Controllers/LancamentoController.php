<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Categoria;
use App\Models\Lancamento;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $competencia = $request->input('competencia', now()->format('m/Y'));
            $situacao = $request->input('situacao');

            $consulta = Lancamento::with(['categoria', 'tipoCategoria'])
                ->where('competencia', $competencia)
                ->orderBy('data_vencimento');

            $lancamentos = $consulta->get()->filter(function (Lancamento $lancamento) use ($situacao) {
                return !$situacao || $lancamento->situacao === $situacao;
            });

            $resumo = [
                'receitas' => $lancamentos->where('tipo', 'receita')->sum('valor'),
                'despesas' => $lancamentos->where('tipo', 'despesa')->sum('valor'),
                'pago' => $lancamentos->sum('valor_pago'),
                'pendente' => $lancamentos->sum(fn (Lancamento $lancamento) => max(0, (float) $lancamento->valor - (float) ($lancamento->valor_pago ?? 0))),
            ];
            $resumo['saldo'] = $resumo['receitas'] - $resumo['despesas'];
            $competencias = Lancamento::query()->select('competencia')->distinct()->pluck('competencia');

            return view('lancamento.index', compact('lancamentos', 'competencia', 'situacao', 'resumo', 'competencias'));

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categorias = Categoria::get();
            return view('lancamento.form', compact('categorias'));

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LancamentoRequest $request)
    {
        try {
            Lancamento::create($this->dadosDoLancamento($request));

            Alert::toast('Lancamento cadastrado com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $categorias = Categoria::get();
            return view('lancamento.form', compact('lancamento', 'categorias'));

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LancamentoRequest $request, $id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $lancamento->update($this->dadosDoLancamento($request));

            Alert::toast('Lancamento atualizado com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $lancamento->delete();

            Alert::toast('Lancamento excluído com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    private function dadosDoLancamento(LancamentoRequest $request): array
    {
        $dados = $request->validated();
        $categoria = Categoria::with('tipoCategoria')->findOrFail($dados['categoria_id']);
        $descricaoTipo = strtolower($categoria->tipoCategoria->descricao);

        $dados['tipo_categoria_id'] = $categoria->tipo_categoria_id;
        $dados['tipo'] = match ($descricaoTipo) {
            'receita' => 'receita',
            'investimento' => 'investimento',
            default => 'despesa',
        };
        $dados['is_receber'] = $dados['tipo'] === 'receita';
        $dados['is_pago'] = $dados['valor_pago'] !== null && (float) $dados['valor_pago'] >= (float) $dados['valor'];

        return $dados;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Categoria;
use App\Models\Lancamento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LancamentoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $competencia = $request->input('competencia', now()->format('m/Y'));
            $situacao = $request->input('situacao');
            $lancamentos = Lancamento::with(['categoria', 'tipoCategoria'])
                ->where('competencia', $competencia)
                ->orderBy('data_vencimento')
                ->get()
                ->filter(fn (Lancamento $lancamento) => !$situacao || $lancamento->situacao === $situacao);

            $resumo = [
                'receitas' => $lancamentos->where('tipo', 'receita')->sum('valor'),
                'despesas' => $lancamentos->where('tipo', 'despesa')->sum('valor'),
                'pago' => $lancamentos->sum('valor_pago'),
                'pendente' => $lancamentos->sum(fn (Lancamento $lancamento) => max(0, (float) $lancamento->valor - (float) ($lancamento->valor_pago ?? 0))),
            ];
            $resumo['saldo'] = $resumo['receitas'] - $resumo['despesas'];
            $competencias = Lancamento::query()->select('competencia')->distinct()->pluck('competencia');

            return view('lancamento.index', compact('lancamentos', 'competencia', 'situacao', 'resumo', 'competencias'));
        } catch (\Exception $ex) {
            Alert::toast('Erro ao carregar os lançamentos.', 'error');
            return redirect()->back();
        }
    }

    public function create()
    {
        try {
            $categorias = Categoria::get();
            return view('lancamento.form', compact('categorias'));
        } catch (\Exception $ex) {
            Alert::toast('Erro ao carregar o formulário.', 'error');
            return redirect()->back();
        }
    }

    public function store(LancamentoRequest $request)
    {
        try {
            Lancamento::create($this->dadosDoLancamento($request));
            Alert::toast('Lançamento cadastrado com sucesso!', 'success');
            return redirect()->route('lancamento.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao cadastrar o lançamento.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            return view('lancamento.form', [
                'lancamento' => Lancamento::findOrFail($id),
                'categorias' => Categoria::get(),
            ]);
        } catch (\Exception $ex) {
            Alert::toast('Lançamento não encontrado.', 'error');
            return redirect()->back();
        }
    }

    public function update(LancamentoRequest $request, $id)
    {
        try {
            Lancamento::findOrFail($id)->update($this->dadosDoLancamento($request));
            Alert::toast('Lançamento atualizado com sucesso!', 'success');
            return redirect()->route('lancamento.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao atualizar o lançamento.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Lancamento::findOrFail($id)->delete();
            Alert::toast('Lançamento excluído com sucesso!', 'success');
            return redirect()->route('lancamento.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao excluir o lançamento.', 'error');
            return redirect()->back();
        }
    }

    public function gerarProximaCompetencia($id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);

            if (!$lancamento->is_fixo) {
                Alert::toast('Apenas lançamentos fixos podem ser recorrentes.', 'error');
                return redirect()->back();
            }

            $proximaCompetencia = Carbon::createFromFormat('m/Y', $lancamento->competencia)->addMonth();
            $jaExiste = Lancamento::query()
                ->where('competencia', $proximaCompetencia->format('m/Y'))
                ->where('descricao', $lancamento->descricao)
                ->where('categoria_id', $lancamento->categoria_id)
                ->exists();

            if ($jaExiste) {
                Alert::toast('Esse lançamento já existe na próxima competência.', 'info');
                return redirect()->route('lancamento.index', ['competencia' => $proximaCompetencia->format('m/Y')]);
            }

            $novoLancamento = $lancamento->replicate([
                'competencia', 'data_vencimento', 'valor_pago', 'is_pago', 'data_pagamento', 'created_at', 'updated_at',
            ]);
            $novoLancamento->competencia = $proximaCompetencia->format('m/Y');
            $novoLancamento->data_vencimento = $proximaCompetencia->copy()->day(min(
                $lancamento->data_vencimento->day,
                $proximaCompetencia->daysInMonth
            ));
            $novoLancamento->valor_pago = null;
            $novoLancamento->is_pago = false;
            $novoLancamento->data_pagamento = null;
            $novoLancamento->save();

            Alert::toast('Próxima competência gerada com sucesso!', 'success');
            return redirect()->route('lancamento.index', ['competencia' => $novoLancamento->competencia]);
        } catch (\Exception $ex) {
            Alert::toast('Erro ao gerar a próxima competência.', 'error');
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

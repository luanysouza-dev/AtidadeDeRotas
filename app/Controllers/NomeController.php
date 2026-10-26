<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Requests\AdicionarNomeRequest;
use Haki\Http\Response;
use Haki\Http\Request;


final class NomeController
{
    private string $arquivo;

    public function __construct()
    {
        $this->arquivo = __DIR__ . "/../Dados/Registros.json";
    }

    public function carregarDados(): array
    {
        if (!file_exists($this->arquivo)) {
            return [];
        }

        $conteudo = file_get_contents($this->arquivo);

        if (!$conteudo) {
            return [];
        }

        $lista = json_decode($conteudo, true);

        return $lista;
    }
    public function verDados(Response $res): Response
    {
        $dados = $this->carregarDados();

        if (count($dados) > 0) {
            return $res->json([
                'status' => true,
                'lista' => $dados
            ]);
        } else {
            return $res->json([
                'status' => false,
                'lista' => 'lista vazia...'
            ]);
        }
    }
    public function adicionarNome(Response $res, AdicionarNomeRequest $req): Response
    {
        $nome = $req->validated();
        $dados = $this->carregarDados();
        if (!$nome) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Nome invalido'
            ]);
        }
        $dados[] = $nome;
        $json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($this->arquivo, $json);

        return $res->json([
            'status' => true,
            'mensagem' => 'Nome salvo com sucesso!!!!',
            'nome' => $nome,
        ]);
    }
}

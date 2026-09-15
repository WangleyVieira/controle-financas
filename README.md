# Controle de Finanças

Aplicação web em Laravel para registrar e acompanhar as finanças do casal. O sistema centraliza lançamentos, vencimentos, pagamentos e histórico por competência, sem separar as despesas por responsável.

## Funcionalidades

- autenticação, logout e proteção das áreas internas;
- cadastro, edição, consulta e exclusão de lançamentos;
- lançamentos de receitas e despesas;
- valor previsto, valor pago, situação e data de pagamento;
- data de vencimento, descrição, observações e link de pagamento;
- categorias de lançamentos;
- despesas fixas, parceladas e geração da próxima competência;
- listagem de todas as competências, com filtro pela competência escolhida;
- resumo dos valores previstos, pagos e pendentes.

## Requisitos

- PHP 8.2 ou superior;
- Composer;
- Laravel 12;
- PostgreSQL.

## Instalação

```bash
git clone <url-do-repositorio>
cd controle-financas
composer install
```

No Windows, copie o arquivo de ambiente com:

```powershell
Copy-Item .env.example .env
```

Em Linux/macOS, use `cp .env.example .env`. Depois, configure no `.env` o banco de dados escolhido e execute:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

Para desenvolvimento, é possível iniciar o servidor e o Vite juntos:

```bash
composer run dev
```

Ou iniciar somente a aplicação:

```bash
php artisan serve
```

Acesse `http://127.0.0.1:8000` no navegador.

## Banco de dados

O `.env.example` está preparado para SQLite. Para PostgreSQL, altere `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` no `.env` antes de executar as migrations.

O comando `php artisan migrate --seed` cria as tabelas e o usuário inicial definido em `database/seeders/UserSeeder.php`. Altere esse seeder e as credenciais antes de usar o sistema em um ambiente compartilhado.

> Atenção: `php artisan migrate:fresh --seed` apaga todas as tabelas e deve ser usado somente em desenvolvimento.

## Fluxo de uso

1. Entre no sistema com um usuário cadastrado.
2. Cadastre as categorias em **Configurações > Categorias**.
3. Acesse **Lançamentos** e informe a competência no formato utilizado pelo projeto, a descrição, a categoria, o vencimento e o valor previsto.
4. Ao pagar, registre o valor pago, a data de pagamento e marque o lançamento como pago.
5. Na listagem, deixe o filtro vazio para consultar todo o histórico ou selecione uma competência para restringir os resultados.



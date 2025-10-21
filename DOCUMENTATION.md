# 📘 Aplicação To-Do - Laravel 12 + Tailwind CSS

## Visão Geral

Aplicação web para gestão de tarefas com foco em modularidade, responsividade e clareza de código.

## Tecnologias

-   Laravel 12
-   Jetstream com Livewire
-   Tailwind CSS
-   MySQL
-   Vue (planeado para migração futura)

## Estrutura Modular

-   Models: representação de dados
-   Controllers: fluxo de requisições
-   Livewire: componentes dinâmicos
-   Services: lógica de negócio
-   Requests: validação
-   Views: separadas por funcionalidade
-   JS: modularizado por contexto

## Funcionalidades

-   Criar, listar, editar, concluir e excluir tarefas
-   Filtros por estado, prioridade e vencimento
-   Design responsivo e acessível

## Ambiente de Desenvolvimento

-   Herd para PHP, MySQL e DNS local
-   `https://todo-app.test`
-   `npm run dev` para compilar assets com Vite

## Testing

-   Framework: Pest
-   Localização dos testes: `tests/Feature` e `tests/Unit`
-   Exemplo: `it('creates a task', ...)`

## Plano de Migração para Vue

-   Após formação, instalar Inertia.js
-   Migrar views Blade para componentes Vue
-   Reaproveitar lógica JS modular
-   Atualizar documentação e changelog

## Documentação

-   Este ficheiro
-   `README.md` com instruções de instalação
-   `docs/changelog.md` com registo de alterações

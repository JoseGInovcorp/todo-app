# 📝 Changelog — To‑Do App (Estágio)

Registo das alterações feitas durante o desenvolvimento deste projeto de estágio.

---

## [0.11.0] — 2025-10-27

### 🌙 Melhorias no Dark Mode

**O que fiz:**

-   Corrigi os problemas de legibilidade no modo escuro
-   Agora todos os títulos ficam bem visíveis (eram difíceis de ver antes)
-   Os campos de formulário têm sempre fundo branco e texto preto, mesmo em dark mode
-   Eliminei o "flash branco" que aparecia ao navegar entre páginas

**Ficheiros alterados:**

-   `tasks/index.blade.php` - página principal com lista de tarefas
-   `tasks/create.blade.php` - formulário para criar tarefas
-   `tasks/show.blade.php` - página de detalhes de uma tarefa
-   `tasks/edit.blade.php` - formulário para editar tarefas

**O que aprendi:**

-   Como usar classes `dark:` do Tailwind CSS
-   Que `wire:navigate` pode causar problemas visuais
-   Importância de testar em ambos os modos (claro e escuro)

---

## [0.10.0] — 2025-10-27

### 🌙 Sistema Dark/Light Mode (primeira versão)

**O que implementei:**

-   Botão para alternar entre modo claro e escuro
-   O tema fica guardado no browser (não se perde ao fechar)
-   Detecta automaticamente se preferes modo escuro no sistema
-   Ícones mudam: lua para escuro, sol para claro

**Ficheiros criados:**

-   `theme.js` - código JavaScript para gerir o tema
-   Botões de toggle na navbar e sidebar

**Problemas encontrados:**

-   Alguns formulários ficavam difíceis de ler em modo escuro
-   Flash branco ao navegar (resolvi mais tarde na v0.11.0)

**O que aprendi:**

-   Como usar localStorage no browser
-   Event listeners em JavaScript
-   Básicos de classes `dark:` do Tailwind

---

## [0.9.1] — 2025-10-27

### 🎨 Organização dos Layouts

**O que corrigi:**

-   Fiz o logótipo "✅ To-Do App" aparecer sempre, mesmo para visitantes
-   Utilizadores logados veem a sidebar moderna
-   Visitantes veem uma navbar mais simples
-   Tudo fica consistente visualmente

**O que aprendi:**

-   Como fazer layouts condicionais (diferentes para logados vs visitantes)
-   Importância de ter fallbacks para diferentes tipos de utilizadores

---

## [0.9.0] — 2025-10-27

### 🗂️ Correção da Lógica de Tarefas

**Problema que resolvi:**

-   As tarefas apareciam em categorias erradas (uma tarefa podia estar "Pendente" E "Em Atraso")
-   Os contadores na sidebar não batiam certo

**O que fiz:**

-   Criei regras claras: "Pendentes" são só as que não estão atrasadas
-   "Em Atraso" são só as que já passaram da data limite
-   Agora Pendentes + Em Atraso + Concluídas = Total (matemática certa!)

**Ficheiros alterados:**

-   `Task.php` - modelo com novas funções `pendingNotOverdue()` e `is_overdue`
-   `TaskController.php` - filtros corrigidos

**O que aprendi:**

-   Como criar "scopes" no Laravel (queries reutilizáveis)
-   Importância de testar a lógica com dados reais
-   Diferença entre `isPast()` e comparação de datas por string

---

## [0.8.0] — 2025-10-27

### 🧭 Sidebar Personalizada

**O que criei:**

-   Sidebar só para esta aplicação (não genérica)
-   Navegação diferente para utilizadores logados vs visitantes
-   Contadores com cores: pendentes (amarelo), concluídas (verde), atrasadas (vermelho)
-   Links inteligentes: logo vai para dashboard se logado, senão vai para home

**Estrutura da navegação:**

-   **Se logado**: Dashboard, Todas as Tarefas, Nova Tarefa, filtros rápidos
-   **Se visitante**: Página Inicial, Registar, Iniciar Sessão

**O que aprendi:**

-   Como usar `@auth` e `@else` no Blade
-   Criar badges com contadores dinâmicos
-   Lógica condicional na interface

---

## [0.7.0] — 2025-10-26

### 📚 Documentação

**O que fiz:**

-   Escrevi documentação completa do projeto
-   Criei resumo para apresentar no estágio
-   Planeei próximas funcionalidades

**Status nesta altura:**

-   Projeto funcionava 100%
-   Interface bonita e responsiva
-   Pronto para mostrar aos orientadores

---

## [0.6.0] — 2025-10-26

### 🔐 Sistema de Login

**Grande mudança - cada utilizador vê só as suas tarefas:**

-   Instalei Jetstream para autenticação
-   Liguei tarefas aos utilizadores (cada tarefa tem um "dono")
-   Criei regras: só podes ver/editar as tuas próprias tarefas

**Ficheiros criados:**

-   `TaskPolicy.php` - regras de quem pode fazer o quê
-   Migration para adicionar `user_id` às tarefas

**O que aprendi:**

-   Relacionamentos no Laravel (`hasMany`, `belongsTo`)
-   Policies e autorização
-   Como proteger dados de diferentes utilizadores

---

## [0.5.0] — 2025-10-26

### 🔍 Filtros e Interface Bonita

**Funcionalidades novas:**

-   Filtros por estado (pendente/concluída), prioridade, data
-   Pesquisa por título
-   Botão para marcar como concluída rapidamente
-   Duplicar tarefas existentes
-   Páginas divididas (paginação)

**Design:**

-   Redesenhei todas as páginas com Tailwind CSS
-   Fica bonito e funciona bem no telemóvel
-   Breadcrumbs para navegação
-   Mensagens quando não há tarefas

**O que aprendi:**

-   Scopes no Laravel (queries reutilizáveis)
-   Accessors (formatação automática de dados)
-   Design responsivo com Tailwind

---

## [0.4.0] — 2025-10-22

### ✅ CRUD Completo e Funcional

**Marco importante:** Primeira versão completamente funcional!

-   Criar, ver, editar, apagar tarefas - tudo a funcionar
-   Testes automáticos a passar todos
-   Layout base bem organizado
-   Sidebar que funciona para todos os utilizadores

**O que aprendi até aqui:**

-   Como fazer um CRUD completo em Laravel
-   Testes automáticos com Pest
-   Organização de layouts e componentes

---

## [0.3.0] — 2025-10-22

### 🏗️ CRUD das Tarefas

**O que implementei:**

-   Controller para gerir todas as operações (criar, ver, editar, apagar)
-   Rotas `/tasks` para aceder às páginas
-   4 páginas: lista, criar nova, editar, ver detalhes
-   Formulário reutilizável para criar e editar

**Problemas que resolvi:**

-   Erro "View not found" - criei as páginas em falta
-   Erro de layout - organizei melhor os ficheiros
-   Problemas nos testes - adicionei autenticação fake

**O que aprendi:**

-   Estrutura MVC (Model-View-Controller)
-   Como criar rotas no Laravel
-   Templates Blade para as páginas
-   Como resolver erros passo a passo

---

## [0.2.0] — 2025-10-22

### 📊 Modelo de Tarefas

**O que criei:**

-   Modelo `Task` para representar uma tarefa
-   Tabela na base de dados com campos: título, descrição, data limite, prioridade, se está concluída
-   Factory para criar tarefas de teste automaticamente
-   Primeiros testes para validar que tudo funciona

**O que aprendi:**

-   Como criar models e migrations no Laravel
-   Factories para dados de teste
-   Testes básicos com Pest
-   Relacionamento entre código e base de dados

---

## [0.1.0] — 2025-10-22

### 🚀 Início do Projeto

**O que instalei e configurei:**

-   Laravel 12 (versão mais recente na altura)
-   Jetstream para autenticação (com Livewire)
-   Tailwind CSS para o design
-   Ambiente local com Herd

**Primeiros ficheiros:**

-   `README.md` - descrição do projeto
-   `DOCUMENTATION.md` - documentação técnica
-   Este `changelog.md` - para registar as mudanças

**O que aprendi:**

-   Setup inicial de um projeto Laravel
-   Diferença entre Livewire e Inertia
-   Configuração de ambiente de desenvolvimento

---

## [Roadmap - Próximas Versões]

### [1.0.0] — Vue.js + Inertia (Planeada)

-   Instalação do Inertia.js
-   Migração de componentes Blade para Vue 3
-   Interatividade melhorada (AJAX, real-time updates)
-   Aproveitamento da formação em Vue já realizada

### [1.1.0] — Testes Automatizados (Planeada)

-   Testes unitários com Pest
-   Testes de funcionalidade para CRUD completo
-   Cobertura de testes para autorização
-   CI/CD pipeline básico

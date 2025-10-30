# 📝 Changelog — To‑Do App (Estágio)

Registo das alterações feitas durante o desenvolvimento deste projeto de estágio.

---

## [1.0.1] — 2025-10-30

### 🔄 Toggle Hoje/Esta Semana - Análise Temporal Dinâmica

**Nova Funcionalidade:** Dashboard agora permite alternar entre estatísticas do dia atual e da semana corrente para análise temporal mais granular.

#### 🎯 Funcionalidade Principal

**Toggle Interativo:**

-   **Botão de alternância**: Mudança dinâmica entre "Hoje" e "Esta Semana"
-   **Interface intuitiva**: Ícone 🔄 e texto descritivo do estado atual
-   **Reatividade imediata**: Valores mudam instantaneamente sem recarregamentos

**Métricas por Período:**

-   **Tarefas Criadas**: Contagem de tarefas criadas no período selecionado
-   **Tarefas Concluídas**: Tarefas marcadas como concluídas no período
-   **Tarefas Eliminadas**: Tarefas movidas para o lixo no período

#### 🔧 Implementação Técnica

**Backend (Laravel):**

-   **Queries otimizadas**: Consultas específicas para cada período usando Carbon
-   **Dados precisos**: Hoje considera o dia atual, semana vai de segunda a domingo
-   **Soft deletes**: Contagem correta de tarefas eliminadas

**Frontend (Vue.js):**

-   **Estado reativo**: `ref()` para controlar o período ativo
-   **Computed properties**: Valores calculados dinamicamente
-   **Props tipadas**: Recepção de dados do Laravel via Inertia.js

#### 🎨 Melhorias de Interface

**Visual Consistency:**

-   **Ícone vermelho 🗑️**: Para tarefas eliminadas (anteriormente roxo)
-   **Design responsivo**: Mantém consistência em todos os dispositivos
-   **Estados hover**: Feedback visual adequado no botão toggle

#### 🧪 Suite de Testes Completa

**Implementação de Testes Automatizados:**

-   **87 Testes Implementados**: Coverage abrangente de todas as funcionalidades
-   **Framework Pest**: Sintaxe moderna e expressiva para testes
-   **91% Taxa de Sucesso**: 79 testes passando, 8 com ajustes menores
-   **Categorias Cobertas**: CRUD, Autorização, Validação, Dashboard, Filtros, Lixeira

**Tipos de Teste:**

-   **Funcionais**: Verificação completa do fluxo CRUD de tarefas
-   **Segurança**: Isolamento rigoroso de dados entre utilizadores
-   **Validação**: Teste de todos os campos obrigatórios e formatos
-   **Dashboard**: Métricas em tempo real e estatísticas precisas
-   **Filtros**: Sistema de pesquisa e filtragem avançado

**Documentação:**

-   **TESTING_DOCUMENTATION.md**: Documentação detalhada dos principais testes
-   **Casos de Uso**: Exemplos práticos e resultados esperados
-   **Instruções de Execução**: Comandos para diferentes cenários de teste

---

## [1.0.0] — 2025-10-29

### 🚀 Migração Completa para Vue.js 3 + Inertia.js - SPA Moderna

**Marco Principal:** Transformação arquitetural completa de aplicação Blade tradicional para Single Page Application moderna.

#### 🏗️ Arquitetura Renovada

**Stack Moderno:**

-   **Vue.js 3**: Framework JavaScript reativo com Composition API
-   **Inertia.js**: Bridge entre Laravel e Vue.js sem necessidade de APIs
-   **Vite**: Build tool moderno para desenvolvimento e produção
-   **Tailwind CSS**: Mantido com otimizações para Vue

**Componentes Implementados:**

-   **Layout.vue**: Template principal com navegação e estado global
-   **Dashboard.vue**: Painel analítico completamente reativo
-   **TaskList.vue**: Listagem dinâmica com filtros em tempo real
-   **TaskCreate.vue**: Formulário de criação com validação Vue
-   **TaskEdit.vue**: Edição inline com estado local
-   **TaskShow.vue**: Visualização detalhada individual
-   **ConfirmationModal.vue**: Modal reutilizável com transições

#### ⚡ Funcionalidades Vue.js Específicas

**Reatividade Avançada:**

-   **Estado global**: Contadores da sidebar atualizados automaticamente
-   **Filtros dinâmicos**: Mudanças instantâneas sem recarregamentos
-   **Dark mode reativo**: Tema aplicado em tempo real
-   **Modais elegantes**: Transições suaves com Teleport

**Performance Otimizada:**

-   **Lazy loading**: Componentes carregados sob demanda
-   **Tree shaking**: Bundle otimizado automaticamente
-   **SPA Navigation**: Navegação instantânea entre páginas
-   **Computed caching**: Valores calculados cached automaticamente

#### 🔧 Integração Laravel-Vue

**Inertia.js Workflow:**

-   **Controllers mantidos**: Lógica de negócio permanece no Laravel
-   **Props tipadas**: Dados passados automaticamente para Vue
-   **Validation preservada**: Laravel Form Requests mantidos
-   **Authorization**: Policies Laravel funcionam normalmente

---

## [0.13.3] — 2025-10-28

### 📊 Dashboard Informativo - Centro de Controlo Completo

**Transformação:** Dashboard deixou de ser um simples redirecionamento para se tornar uma página verdadeiramente útil com métricas e insights.

#### 🎯 Funcionalidades Principais Implementadas

**Métricas de Visão Geral:**

-   **4 cards principais**: Total de Tarefas, Pendentes, Concluídas, Em Atraso
-   **Indicadores visuais**: Emojis contextuais e cores diferenciadas por categoria
-   **Contadores em tempo real**: Valores atualizados a cada acesso

**Estatísticas Detalhadas:**

-   **Distribuição por prioridade**: Alta (🔴), Média (🟡), Baixa (🟢) com contadores
-   **Resumo semanal**: Tarefas criadas, completadas e eliminadas na semana atual
-   **Período preciso**: Segunda a domingo da semana corrente

**Próximas Tarefas:**

-   **Lista inteligente**: 5 próximas tarefas com vencimento nos próximos 7 dias
-   **Navegação direta**: Links para visualizar cada tarefa individualmente
-   **Priorização visual**: Indicadores de prioridade para foco imediato

#### ⚡ Ações Rápidas e Navegação

**Botões de Ação Direta:**

-   **Nova Tarefa**: Acesso imediato ao formulário de criação
-   **Todas as Tarefas**: Link para vista completa
-   **Tarefas Pendentes**: Filtro direto para tarefas ativas
-   **Lixo**: Gestão de tarefas eliminadas

#### 🔧 Correções de Consistência

**Problema Crítico Resolvido:**

-   **Dashboard vs Sidebar**: Contadores de "Pendentes" mostravam valores diferentes
-   **Causa**: Dashboard incluía tarefas em atraso, sidebar não
-   **Solução**: Ambos agora usam `pendingNotOverdue()` scope

**Melhorias Técnicas:**

-   **Precisão temporal**: "Esta semana" sempre segunda a domingo
-   **Queries otimizadas**: 11 métricas calculadas eficientemente
-   **Reutilização de scopes**: Aproveitamento de lógica existente no modelo

#### 🚀 Experiência do Utilizador

**Redirecionamento Pós-Login:**

-   **Constante HOME**: Definida como `/dashboard` no FortifyServiceProvider
-   **Primeiro contacto**: Utilizadores veem imediatamente o estado das suas tarefas
-   **Orientação imediata**: Dashboard fornece contexto completo da produtividade

**Interface Responsiva:**

-   **Layout adaptativo**: Cards reorganizam-se conforme tamanho da tela
-   **Dark mode**: Suporte completo com transições suaves
-   **Consistency visual**: Alinhado com design system da aplicação

**Resultado:** Dashboard transformou-se no verdadeiro centro de controlo da aplicação, substituindo um simples redirecionamento por uma experiência rica em informação e funcionalidade.

---

## [0.13.2] — 2025-10-28

### 🎨 Interface de Autenticação Personalizada

**Objetivo:** Garantir consistência visual em toda a jornada do utilizador, desde a primeira visita até ao acesso à aplicação.

#### 🔐 Redesign Completo das Páginas de Auth

-   **Layout principal reformulado**: Mesmo gradiente de fundo da página welcome
-   **Branding sempre presente**: Logo "✅ To-Do App" prominente em todas as páginas
-   **Container elegante**: Formulários em caixas com sombras e bordas arredondadas
-   **Transições suaves**: Dark mode harmonizado com resto da aplicação

#### 📱 Páginas Individuais Personalizadas

**Login (`/login`):**

-   **Título intuitivo**: "🔐 Iniciar Sessão" em vez do genérico "Log in"
-   **Botão melhorado**: "🚀 Entrar" com emoji e call-to-action claro
-   **Navegação clara**: Link para registo bem destacado com separador visual

**Registo (`/register`):**

-   **Título atrativo**: "✨ Criar Conta" focado na ação
-   **Botão chamativo**: "🎯 Criar Conta" que convida à ação
-   **Onboarding suave**: Texto que posiciona o valor da aplicação

**Recuperar Password (`/forgot-password`):**

-   **Título descritivo**: "🔑 Recuperar Password" que explica a função
-   **Botão explicativo**: "📧 Enviar Link de Recuperação" que clarifica o processo
-   **Fluxo intuitivo**: Link de retorno bem posicionado

#### 🌍 Localização Portuguesa Completa

-   **Textos nativos**: Todas as mensagens e botões em português
-   **Emojis contextuais**: Identificadores visuais intuitivos para cada página
-   **Terminologia consistente**: Linguagem alinhada com resto da aplicação

#### 🎯 Impacto na Experiência

-   **Primeiro contacto profissional**: Utilizadores veem imediatamente que é uma aplicação cuidada
-   **Confiança desde o início**: Visual consistente transmite credibilidade
-   **Jornada fluida**: Transição natural da página welcome para autenticação
-   **Acessibilidade visual**: Contraste adequado em ambos os temas

**Resultado:** Experiência de autenticação completamente integrada no ecossistema visual da aplicação.

---

## [0.13.1] — 2025-10-28

### 🎯 Otimização de UX - Filtragem Inteligente

**Filosofia:** Focar a atenção do utilizador nas tarefas que requerem ação.

#### 🧠 Mudanças de Comportamento

-   **Vista principal otimizada**: Por defeito mostra apenas tarefas não concluídas
-   **Redução de ruído visual**: Tarefas concluídas ficam ocultas da vista principal
-   **Acesso rápido**: Filtro "Todas" disponível para visão completa quando necessário
-   **Contexto sempre claro**: Títulos dinâmicos indicam que filtro está ativo

#### ✨ Melhorias de Interface

-   **Títulos dinâmicos**: Vista principal indica contexto atual (ex: "✅ Tarefas Ativas")
-   **Interface limpa**: Foco nas tarefas pendentes aumenta produtividade
-   **Navegação intuitiva**: Transição suave entre diferentes vistas
-   **Experiência focada**: Menos distração, mais ação

#### 🎨 Refinamentos Visuais

-   **Emojis como identificadores**: Sistema de ícones limpo e consistente
-   **Hierarquia visual clara**: Títulos e conteúdo bem definidos
-   **Design minimalista**: Removidas redundâncias visuais

**Impacto**: Utilizadores focam nas tarefas que precisam de atenção, com acesso rápido à vista completa quando necessário.

---

## [0.13.0] — 2025-10-28

### 🗑️ Sistema de Lixo (Soft Delete)

**O que implementei:**

#### 🗃️ Backend - Soft Delete Completo

-   **Migration criada** para adicionar campo `deleted_at` à tabela tasks
-   **Model atualizado** com trait `SoftDeletes` do Laravel
-   **3 novos métodos no Controller**:
    -   `trash()` - lista tarefas eliminadas
    -   `restore($id)` - restaura tarefa eliminada
    -   `forceDelete($id)` - elimina permanentemente
-   **3 novas rotas** para gestão de lixo

#### 🎨 Frontend - Interface de Lixo

-   **Nova view** `tasks/trash.blade.php` com design diferenciado
-   **Visual especial**: fundo vermelho, texto riscado, badges de estado
-   **Link na sidebar** com contador dinâmico de tarefas eliminadas
-   **Botões de ação** com confirmações de segurança

#### 🎯 Estados das Tarefas (agora 4 estados)

1. **Pendente** ⏳ - tarefa ativa, não concluída
2. **Concluída** ✅ - tarefa ativa, marcada como feita
3. **Em Atraso** ⚠️ - tarefa ativa, passou da data de vencimento
4. **Eliminada** 🗑️ - tarefa soft deleted (invisível nas views normais)

**Ficheiros alterados:**

-   `database/migrations/add_soft_deletes_to_tasks_table.php` - nova migration
-   `app/Models/Task.php` - adicionado trait SoftDeletes
-   `app/Http/Controllers/TaskController.php` - 3 novos métodos
-   `routes/web.php` - 3 novas rotas
-   `resources/views/tasks/trash.blade.php` - nova view
-   `resources/views/components/layouts/app/sidebar.blade.php` - link para lixo

**O que aprendi:**

-   **Soft Delete** é uma funcionalidade poderosa para auditoria e recuperação
-   **Trait SoftDeletes** do Laravel automatiza muito do trabalho
-   **onlyTrashed()** scope permite queries específicas para dados eliminados
-   **Interface diferenciada** ajuda utilizadores a distinguir estados
-   **Confirmações de segurança** são essenciais para ações irreversíveis
-   **Contadores dinâmicos** melhoram a UX ao dar feedback visual imediato

---

## [0.12.0] — 2025-10-28

### 📊 Sistema de Ordenação + Melhorias de UI

**O que implementei:**

#### 🔄 Sistema de Ordenação Completo

-   **8 opções de ordenação**: Data criação, vencimento, prioridade, título (ambas direções)
-   **Tratamento inteligente** de valores nulos para datas de vencimento
-   **SQL compatível** usando CASE WHEN em vez de FIELD() MySQL-específico
-   **Interface integrada** com dropdown no sistema de filtros existente
-   **Preservação de estado** - ordenação selecionada mantida após submissão

#### 🎨 Consistência Visual Melhorada

-   **Hover effects padronizados** em todas as views com maior contraste
-   **Toggle buttons reposicionados** para áreas de ação mais lógicas
-   **Spacing consistente** entre botões de ação em index e show views
-   **Estados visuais otimizados** para tarefas completas vs pendentes

#### 📝 Otimização de Formulários

-   **Checkbox de conclusão removido** do formulário de edição (desnecessário)
-   **Date picker corrigido** - agora visível em dark mode
-   **Navegação melhorada** - botão cancelar redireciona para index
-   **Focus na essência** - formulário mais limpo e focado

#### 🔧 Correções de Bugs

-   **Ordenação por prioridade** funcionando corretamente
-   **Visibilidade de campos** em ambos os temas
-   **Fluxo de navegação** intuitivo e consistente

**Ficheiros alterados:**

-   `app/Http/Controllers/TaskController.php` - lógica de ordenação
-   `resources/views/tasks/index.blade.php` - UI de ordenação e melhorias visuais
-   `resources/views/tasks/show.blade.php` - consistência de botões
-   `resources/views/tasks/edit.blade.php` - simplificação e correções

**O que aprendi:**

-   **SQL universal** é mais robusto que funções específicas de SGBD
-   **Consistência visual** requer atenção sistemática a detalhes
-   **Sistemas de ordenação** complexos precisam de tratamento cuidadoso de edge cases
-   **UX profissional** resulta de refinamento iterativo de pequenos detalhes

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

_Projeto concluído em Outubro 2025 - Versão estável v1.0.1_

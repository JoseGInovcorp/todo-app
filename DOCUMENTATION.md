# � To-Do App - Documentação Completa

## 🎯 Visão Geral

Uma aplicação moderna de gestão de tarefas desenvolvida com **Laravel 12** e **Vue.js 3**, utilizando **Inertia.js** para uma experiência SPA (Single Page Application) fluida.

**Evolução do Projeto:** Iniciado como uma aplicação Blade tradicional durante o estágio, evoluiu para uma SPA moderna com Vue.js, mantendo toda a robustez do Laravel no backend.

---

## � Stack Tecnológico

### Backend

-   **Laravel 12** - Framework PHP moderno
-   **Laravel Sanctum** - Autenticação API
-   **Laravel Fortify** - Sistema de autenticação
-   **Inertia.js** - Bridge entre Laravel e Vue.js
-   **MySQL** - Base de dados relacional

### Frontend

-   **Vue.js 3** - Framework JavaScript reativo
-   **Composition API** - API moderna do Vue.js
-   **Tailwind CSS** - Framework CSS utility-first
-   **Heroicons** - Biblioteca de ícones SVG
-   **Vite** - Build tool e development server

### Ferramentas

-   **Composer** - Gestor de dependências PHP
-   **NPM** - Gestor de pacotes JavaScript
-   **Pest** - Framework de testes

---

## ⚡ Funcionalidades Principais

### 🎯 Gestão de Tarefas

-   **Criar Tarefas** - Título, descrição, data de vencimento e prioridade
-   **Editar Tarefas** - Modificação completa de todos os campos
-   **Eliminar Tarefas** - Sistema de soft delete com lixeira
-   **Marcar Como Concluída** - Toggle rápido do estado
-   **Duplicar Tarefas** - Criação rápida baseada em tarefa existente
-   **Visualização Detalhada** - Página individual para cada tarefa

### 📊 Dashboard Analítico

-   **Contadores em Tempo Real** - Total, pendentes, concluídas, atrasadas
-   **Métricas por Prioridade** - Distribuição visual por cores
-   **Toggle Hoje/Esta Semana** - Alternância entre estatísticas diárias e semanais
-   **Contagens Detalhadas** - Tarefas criadas, concluídas e eliminadas por período
-   **Próximas Tarefas** - Lista das 5 tarefas mais urgentes
-   **Progresso Visual** - Percentagem de conclusão geral

### 🔍 Sistema de Filtros Avançado

-   **Por Estado** - Pendentes, concluídas, atrasadas
-   **Por Prioridade** - Alta, média, baixa
-   **Pesquisa Textual** - Busca por título e descrição
-   **Contadores na Sidebar** - Números atualizados em tempo real

### 🎨 Interface Moderna

-   **Modo Escuro/Claro** - Alternância baseada na preferência do utilizador
-   **Design Responsivo** - Adaptação automática para desktop/mobile
-   **Modais Elegantes** - Confirmações com transições suaves
-   **Feedback Visual** - Mensagens de sucesso/erro em tempo real
-   **SPA Experience** - Navegação fluida sem recarregamentos

### 🔐 Autenticação e Segurança

-   **Sistema Completo de Utilizadores** - Registo, login, recuperação de senha
-   **Isolamento de Dados** - Cada utilizador vê apenas as suas tarefas
-   **Autorização Granular** - Políticas de acesso por operação
-   **Sessions Seguras** - Gestão automática de sessões

### � Migração para Vue.js 3 + Inertia.js (v1.0.0):

-   **Arquitetura Moderna**: Transição completa de Blade para Vue.js 3 SPA
-   **Inertia.js Bridge**: Mantém Laravel backend com experiência SPA no frontend
-   **Composition API**: Uso da API moderna do Vue.js para melhor reatividade
-   **Componentes Reutilizáveis**: Modularização da interface em componentes Vue
-   **Estado Reativo**: Atualizações em tempo real sem recarregamentos de página
-   **Performance Melhorada**: Navegação instantânea entre páginas

### 🎨 Sistema de Modais Modernos:

-   **ConfirmationModal Component**: Modal reutilizável para todas as confirmações
-   **Transições Elegantes**: Animações suaves de entrada e saída
-   **Estados Visuais**: Diferentes tipos (warning, danger, info) com cores apropriadas
-   **Feedback de Processamento**: Spinners e estados de loading durante ações
-   **Acessibilidade**: Suporte para tecla ESC e foco adequado
-   **Teleport to Body**: Renderização correta independente da posição no DOM

### 🔧 Sistema de Lixeira Avançado:

-   **Soft Delete Inteligente**: Preservação de dados com possibilidade de recuperação
-   **Interface Dedicada**: Página específica para gestão de itens eliminados
-   **Duplas Confirmações**: Modais específicos para restaurar e eliminar permanentemente
-   **Contadores Sincronizados**: Números atualizados em tempo real na sidebar
-   **Histórico de Ações**: Rastreamento completo de operações de eliminação/restauração

### 📊 Dashboard Analítico Completo:

-   **Métricas em Tempo Real**: 4 contadores principais sempre atualizados
-   **Análise por Prioridade**: Distribuição visual com códigos de cores
-   **Toggle Hoje/Esta Semana**: Alternância dinâmica entre estatísticas diárias e semanais
-   **Contagens Detalhadas**: Tarefas criadas, concluídas e eliminadas por período
-   **Período Flexível**: Visualização de hoje (dia atual) ou esta semana (segunda a domingo)
-   **Próximas Tarefas**: Preview das 5 tarefas mais urgentes
-   **Ações Rápidas**: Links diretos para funcionalidades principais
-   **Progresso Visual**: Indicadores gráficos de conclusão

### 🎯 Sistema de Filtros Unificado:

-   **Sidebar Inteligente**: Filtros com contadores em tempo real
-   **Estados Múltiplos**: Pendentes, concluídas, atrasadas, lixeira
-   **Pesquisa Integrada**: Busca textual combinada com filtros
-   **URL Parameters**: Filtros refletidos na URL para bookmarking
-   **Persistência de Estado**: Mantém filtros durante navegação

---

## 🌙 Dark Mode

Uma das coisas que mais gostei de implementar foi o sistema de modo escuro/claro.

### O que faz:

-   Botão para alternar entre modo claro e escuro
-   Guarda a tua preferência (não se perde quando fechas o browser)
-   Detecta automaticamente se preferes modo escuro no teu sistema
-   Todos os formulários ficam sempre legíveis, mesmo em modo escuro

### Problemas que resolvi:

-   **Flash branco** ao navegar entre páginas (era irritante!)
-   **Títulos pouco visíveis** em modo escuro
-   **Texto dos formulários** difícil de ler

### O que aprendi:

-   Como usar classes `dark:` do Tailwind CSS
-   LocalStorage no browser para guardar preferências
-   Que detalhes pequenos fazem grande diferença na experiência

## 🎨 Melhorias de Interface (v0.12.0)

### Consistência Visual:

-   **Botões padronizados** em todas as páginas
-   **Hover effects melhorados** - mais contraste e visibilidade
-   **Posicionamento inteligente** - botões de ação em locais lógicos
-   **Espaçamento consistente** entre elementos

### Formulários Otimizados:

-   **Campos desnecessários removidos** - foco no essencial
-   **Date picker corrigido** - agora visível em dark mode
-   **Navegação melhorada** - botões cancelar funcionam corretamente
-   **Validação visual** mantida em ambos os temas

## 🗑️ Sistema de Soft Delete - Preservação e recuperação de dados

### O que faz:

-   **Preserva tarefas eliminadas** na base de dados em vez de as apagar definitivamente
-   **Interface separada** para gerir tarefas no "lixo"
-   **Permite restaurar** tarefas eliminadas por engano
-   **Eliminação permanente** quando tenho certeza que não preciso mais
-   **Auditoria completa** - histórico de todas as eliminações

### Como implementei:

-   **Migration**: Adicionei campo `deleted_at timestamp` à tabela tasks
-   **Model**: Implementei o trait `SoftDeletes` do Laravel
-   **Controller**: 3 métodos novos (trash, restore, forceDelete)
-   **Rotas**: 3 rotas RESTful para gestão do lixo
-   **View**: Interface dedicada com visual diferenciado

### Problemas técnicos que resolvi:

-   **Separação de dados**: Como distinguir tarefas ativas das eliminadas → Trait SoftDeletes
-   **Contadores dinâmicos**: Como contar tarefas no lixo → Scope `onlyTrashed()`
-   **Segurança**: Como prevenir eliminação acidental → Modal de confirmação
-   **Performance**: Como não impactar queries normais → Soft deletes automáticos

## 🎯 Sistema de Filtragem Inteligente - UX otimizada

### Filosofia da implementação:

-   **Foco no essencial**: Vista principal mostra apenas tarefas que requerem ação
-   **Redução de ruído visual**: Tarefas concluídas ficam ocultas por defeito
-   **Acesso rápido**: Filtro "Todas" disponível quando preciso de visão completa
-   **Contexto claro**: Títulos dinâmicos indicam sempre que filtro está ativo

### Impacto na experiência:

-   **Produtividade**: Utilizador foca nas tarefas pendentes
-   **Menos distração**: Interface limpa sem tarefas já concluídas
-   **Flexibilidade**: Acesso rápido a diferentes vistas conforme necessidade
-   **Clareza**: Sempre sei que vista estou a consultar

---

## 🏗️ Como está organizado o código

```
app/
├── Models/
│   └── Task.php              # Modelo da tarefa
├── Http/
│   ├── Controllers/
│   │   └── TaskController.php # Lógica principal das tarefas + ordenação + soft delete
│   └── Policies/
│       └── TaskPolicy.php     # Regras de quem pode ver/editar o quê
├── Providers/
│   └── AppServiceProvider.php # Configurações da app

resources/
├── views/
│   └── tasks/
│       ├── index.blade.php    # Lista de tarefas
│       ├── create.blade.php   # Criar nova tarefa
│       ├── show.blade.php     # Ver detalhes
│       ├── edit.blade.php     # Editar tarefa
│       └── trash.blade.php    # Lixo (tarefas eliminadas)
└── js/
    └── theme.js               # JavaScript do dark mode

database/
├── migrations/                # Estrutura da base de dados
└── factories/                 # Dados de teste
```

---

## 🗄️ Base de Dados

### Tabela `tasks`:

-   `id` - identificador único
-   `title` - título da tarefa (obrigatório)
-   `description` - descrição opcional
-   `due_date` - data limite (opcional)
-   `priority` - prioridade: alta, média, baixa
-   `is_completed` - se está concluída ou não
-   `user_id` - a quem pertence a tarefa
-   `deleted_at` - timestamp de soft delete (null = ativa, preenchido = eliminada)
-   `created_at` / `updated_at` - datas de criação e atualização

### Tabela `users`:

-   Vem do Jetstream (sistema de autenticação)
-   Guarda nome, email, password, etc.

---

## 🧪 Testes que criei

Aprendi a fazer testes automáticos com Pest para garantir que tudo funciona:

### Testes principais:

-   ✅ Criar uma tarefa nova
-   ✅ Editar uma tarefa existente
-   ✅ Marcar como concluída
-   ✅ Apagar uma tarefa
-   ✅ Filtros funcionam correctamente
-   ✅ Só vejo as minhas próprias tarefas

### O que aprendi sobre testes:

-   Como simular um utilizador logado
-   Testar requests HTTP (GET, POST, PUT, DELETE)
-   Verificar se a base de dados é atualizada corretamente
-   Importância de testar cenários de erro

---

## 📈 Como o projeto evoluiu

### Fases do desenvolvimento:

**1. Início (v0.1.0)**

-   Instalei Laravel e configurei ambiente
-   Primeiros ficheiros e documentação

**2. Modelo de dados (v0.2.0)**

-   Criei o modelo `Task` e a migration
-   Primeiros testes básicos

**3. CRUD básico (v0.3.0 - v0.4.0)**

-   Controllers, rotas e páginas
-   Funcionalidades de criar, ver, editar, apagar
-   Resolvi muitos erros de principiante!

**4. Interface apelativa (v0.5.0)**

-   Redesenhei tudo com Tailwind CSS
-   Filtros e pesquisa
-   Design responsivo

**5. Sistema de login (v0.6.0)**

-   Cada utilizador vê só as suas tarefas
-   Políticas de segurança

**6. Melhorias visuais (v0.7.0 - v0.11.0)**

-   Sidebar personalizada
-   Sistema de dark mode
-   Correções de usabilidade

**7. Sistema de Soft Delete (v0.13.0)**

-   Implementação de soft deletes para preservação de dados
-   Interface de lixo para gestão de tarefas eliminadas
-   Sistema de restauração e eliminação permanente

**8. Otimização de UX (v0.13.1)**

-   Filtragem inteligente com foco em tarefas ativas
-   Títulos dinâmicos para contexto das vistas
-   Interface limpa centrada na produtividade

---

## 🏗️ Arquitetura Técnica

### Padrão SPA com Inertia.js

```
┌─────────────────┐    Inertia.js    ┌─────────────────┐
│   Vue.js 3      │ ◄─────────────── │   Laravel 12    │
│   (Frontend)    │                  │   (Backend)     │
│                 │                  │                 │
│ • Components    │                  │ • Controllers   │
│ • Reactive Data │                  │ • Models        │
│ • Router        │                  │ • Policies      │
└─────────────────┘                  └─────────────────┘
                                              │
                                    ┌─────────────────┐
                                    │     MySQL       │
                                    │  (Database)     │
                                    └─────────────────┘
```

### Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/
│   │   └── TaskController.php      # CRUD + Dashboard + Lixeira
│   ├── Middleware/
│   │   └── HandleInertiaRequests.php # Dados globais Inertia
│   └── Policies/
│       └── TaskPolicy.php          # Autorização granular
├── Models/
│   ├── Task.php                    # Modelo com scopes e accessors
│   └── User.php                    # Modelo de utilizador
└── Providers/                      # Service providers

resources/js/
├── Components/
│   ├── ConfirmationModal.vue       # Modal reutilizável
│   └── Pagination.vue              # Paginação
├── Layouts/
│   └── Layout.vue                  # Layout principal
├── Pages/
│   ├── Dashboard.vue               # Painel de métricas
│   ├── TaskList.vue                # Lista de tarefas
│   ├── TaskShow.vue                # Visualização detalhada
│   ├── TaskCreate.vue              # Criação de tarefa
│   ├── TaskEdit.vue                # Edição de tarefa
│   └── TaskTrash.vue               # Gestão da lixeira
└── app.js                          # Bootstrap da aplicação
```

### Componentes Vue.js Principais

#### 🎯 TaskController (Backend)

```php
// CRUD Básico
index()          // Lista com filtros e ordenação
store()          // Criar nova tarefa
show()           // Visualizar tarefa específica
update()         // Atualizar tarefa
destroy()        // Soft delete

// Funcionalidades Avançadas
toggleComplete()  // Toggle estado de conclusão
dashboard()      // Métricas para painel principal
trash()          // Listar tarefas eliminadas
restore()        // Restaurar da lixeira
forceDelete()    // Eliminação permanente
```

#### 🧩 ConfirmationModal.vue

```vue
// Props Principais show: Boolean // Controla visibilidade type: String //
warning, danger, info title: String // Título do modal message: String //
Mensagem de confirmação processing: Boolean // Estado de loading // Features -
Transições suaves com Vue Transition - Teleport para renderização no body -
Suporte a tecla ESC para fechar - Estados visuais baseados no tipo - Callbacks
para confirm/cancel
```

#### 📊 Dashboard.vue

```vue
// Dados Recebidos totalTasks: Number // Total de tarefas pendingTasks: Number
// Tarefas pendentes completedTasks: Number // Tarefas concluídas overdueTasks:
Number // Tarefas atrasadas upcomingTasks: Array // Próximas 5 tarefas //
Funcionalidades - 4 cards de métricas principais - Estatísticas por prioridade -
Análise semanal comparativa - Ações rápidas para navegação - Indicadores visuais
de progresso
```

### Sistema de Filtros Unificado

#### URL Parameters

```
/tasks?filter=pending      // Tarefas pendentes
/tasks?filter=completed    // Tarefas concluídas
/tasks?filter=overdue      // Tarefas atrasadas
/tasks?search=termo        // Busca textual
/tasks?priority=alta       // Por prioridade
```

#### Contadores em Tempo Real

```javascript
// HandleInertiaRequests.php
'taskCounters' => [
    'pending' => $user->tasks()->pendingNotOverdue()->count(),
    'completed' => $user->tasks()->completed()->count(),
    'overdue' => $user->tasks()->overdue()->count(),
    'trash' => $user->tasks()->onlyTrashed()->count(),
]
```

---

## 🔧 Instalação e Configuração

### Pré-requisitos

-   PHP 8.2+
-   Composer
-   Node.js 16+ e NPM
-   MySQL

### Setup Rápido

```bash
# 1. Clonar repositório
git clone [repo-url]
cd todo-app

# 2. Instalar dependências
composer install
npm install

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 4. Base de dados
php artisan migrate

# 5. Compilar assets
npm run build

# 6. Iniciar servidor
php artisan serve
```

---

## 🚀 Competências Desenvolvidas

### Stack Moderno Dominado

-   **Laravel 12**: Framework PHP com Inertia.js
-   **Vue.js 3**: Composition API e componentes reativos
-   **Tailwind CSS**: Design system utility-first
-   **Inertia.js**: Bridge para SPAs sem API complexa
-   **MySQL**: Base de dados relacional otimizada

### Arquitetura e Padrões

-   **MVC Pattern**: Separação clara de responsabilidades
-   **Component-Based Architecture**: Reutilização e modularidade
-   **SPA Development**: Experiência fluida sem recarregamentos
-   **State Management**: Estado reativo e partilhado
-   **Authorization Policies**: Segurança granular

### UX/UI Design

-   **Responsive Design**: Adaptação automática a dispositivos
-   **Dark Mode Implementation**: Tema dinâmico com persistência
-   **Modal Systems**: Confirmações elegantes com transições
-   **Real-time Feedback**: Contadores e estados atualizados
-   **Accessibility**: Suporte a keyboard e screen readers

### Boas Práticas

-   **Soft Delete Strategy**: Preservação de dados com auditoria
-   **Error Handling**: Gestão robusta de erros e validações
-   **Performance Optimization**: Queries eficientes e caching
-   **Code Organization**: Estrutura modular e maintível
-   **Documentation**: Documentação técnica completa

---

_Documentação técnica completa - To-Do App v1.0.1_  
_Desenvolvido com Laravel 12 + Vue.js 3 + Inertia.js_  
_Outubro 2025_

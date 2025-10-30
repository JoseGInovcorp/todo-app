# ✅ To-Do App - Modern Task Management

Aplicação moderna de gestão de tarefas desenvolvida com **Laravel 12**, **Vue.js 3** e **Inertia.js**.  
Projeto que evoluiu de uma aplicação Blade tradicional para uma SPA moderna, implementando as melhores práticas de desenvolvimento web.

---

## 🎯 Estado do Projeto

**Versão Atual:** `1.0.1` - **SPA Moderna com Vue.js 3** ✅

## 🚀 Stack Tecnológico

-   **Backend**: Laravel 12 + Inertia.js + Laravel Sanctum
-   **Frontend**: Vue.js 3 + Composition API + Tailwind CSS
-   **Database**: MySQL com soft deletes
-   **Build**: Vite + NPM
-   **Icons**: Heroicons

## ⚡ Funcionalidades Principais

### � Gestão Completa de Tarefas

-   ✅ **CRUD Completo** - Criar, visualizar, editar, eliminar
-   🔄 **Toggle de Estados** - Marcar como concluída/pendente
-   🗑️ **Sistema de Lixeira** - Soft delete com possibilidade de recuperação
-   📋 **Duplicação de Tarefas** - Criação rápida baseada em tarefa existente
-   🎯 **Sistema de Prioridades** - Alta, média, baixa com códigos visuais

### 📊 Dashboard Analítico

-   📈 **Métricas em Tempo Real** - Total, pendentes, concluídas, atrasadas
-   � **Toggle Hoje/Esta Semana** - Alternância entre estatísticas diárias e semanais
-   📊 **Contagens Detalhadas** - Tarefas criadas, concluídas e eliminadas por período
-   🎯 **Próximas Tarefas** - Preview das 5 mais urgentes
-   🚀 **Ações Rápidas** - Links diretos para funcionalidades principais

### � Sistema de Filtros Inteligente

-   🎛️ **Filtros Dinâmicos** - Por estado, prioridade, data de vencimento
-   🔍 **Pesquisa Textual** - Busca por título e descrição
-   📊 **Contadores em Tempo Real** - Números atualizados na sidebar
-   🎯 **Vista Focada** - Interface otimizada para produtividade

### 🎨 Interface Moderna

-   🌙 **Modo Escuro/Claro** - Alternância com persistência de preferência
-   📱 **Design Responsivo** - Funciona perfeitamente em todos os dispositivos
-   ✨ **Modais Elegantes** - Confirmações com transições suaves
-   🎭 **Feedback Visual** - Estados de loading e mensagens em tempo real

### 🎨 Otimizações Visuais (Cronológica)

#### **v0.11.0 - Dark Mode Foundation**

-   **Títulos bem contrastados** no dark mode para máxima legibilidade
-   **Campos de formulário sempre legíveis** - texto preto sobre fundo branco
-   **Estados hover otimizados** para ambos os temas com maior contraste
-   **Acessibilidade melhorada** com contrastes adequados

#### **v0.12.0 - Interface Consistency**

-   **Consistência visual** entre todas as páginas e componentes
-   **Botões padronizados** - posicionamento e espaçamento consistente
-   **Formulários otimizados** - campos desnecessários removidos, foco na essência

#### **v0.13.0+ - Advanced UX**

-   **🗑️ Interface de lixo (v0.13.0)** - gestão visual de tarefas eliminadas com ações de restauração
-   **🎯 UX otimizada (v0.13.1)** - vista principal focada em tarefas ativas, títulos dinâmicos com contexto
-   **🔐 Páginas de autenticação redesenhadas (v0.13.2)** - login, registo e recuperação com visual consistente
-   **📊 Dashboard completo (v0.13.3)** - métricas de produtividade, contadores consistentes e redirecionamento pós-login

### 🚀 Tecnologias

-   [Laravel 12](https://laravel.com/) - Framework PHP moderno
-   [Jetstream (Livewire)](https://jetstream.laravel.com/) - Autenticação e UI
-   [Flux UI](https://fluxui.dev/) - Componentes modernos para sidebar
-   [Tailwind CSS](https://tailwindcss.com/) - Framework CSS utilitário
-   [MySQL](https://www.mysql.com/) - Base de dados relacional
-   [Herd](https://herd.laravel.com/) - Ambiente de desenvolvimento local
-   [Pest](https://pestphp.com/) - Framework de testes (preparado)

---

## 🚀 Como Usar

### Pré-requisitos

-   [Herd](https://herd.laravel.com/) instalado e configurado
-   PHP 8.2+
-   Composer
-   Node.js e npm

### Instalação Rápida

1. **Clone o repositório**

    ```bash
    git clone <url-do-repositorio>
    cd todo-app
    ```

2. **Instale as dependências**

    ```bash
    composer install
    npm install
    ```

3. **Configure o ambiente**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure a base de dados no .env**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=todo_app
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Execute as migrations**

    ```bash
    php artisan migrate
    ```

6. **Compile os assets**

    ```bash
    npm run build
    ```

7. **Acesse a aplicação**
    - URL: `https://todo-app.test` (via Herd)
    - Ou: `php artisan serve` para servidor local

### Primeiros Passos

1. **Registo de conta** através da página inicial
2. **Autenticação** com credenciais criadas
3. **Verificação do branding** - logo "✅ To-Do App" visível em todos os estados
4. **Exploração da sidebar** - navegação adaptativa baseada no estado de autenticação
5. **🌙 Teste do sistema de temas** - alternância entre dark/light mode
6. **Criação da primeira tarefa** através do botão "Nova Tarefa"
7. **Utilização dos filtros** integrados na sidebar para organização
8. **Observação dos contadores** dinâmicos de estatísticas
9. **Utilização do toggle** para alteração de estado das tarefas
10. **Navegação entre páginas** - persistência automática do tema seleccionado

---

## 📁 Estrutura do Projeto

```text
app/
├── Models/
│   ├── Task.php              # Model principal com scopes e accessors
│   └── User.php              # User model com relacionamento
├── Http/
│   ├── Controllers/
│   │   └── TaskController.php # Controller CRUD com filtros
│   └── Policies/
│       └── TaskPolicy.php    # Autorização de tarefas
├── database/
│   ├── migrations/           # Estrutura da base de dados
│   └── factories/           # Factories para testes
resources/
├── views/
│   ├── components/
│   │   └── layouts/
│   │       └── app/
│   │           └── sidebar.blade.php # Sidebar personalizada com navegação inteligente
│   └── tasks/               # Views das tarefas (index, create, edit, show)
├── js/
│   ├── theme.js            # Gestão completa de dark/light mode
│   ├── app.js              # Aplicação principal
│   └── bootstrap.js        # Configurações globais
└── css/                     # Estilos Tailwind
docs/
├── changelog.md             # Registo de alterações
└── dark-mode-guide.md      # Guia do modo escuro
```

---

## 🎨 Screenshots & Funcionalidades

### 📋 Listagem de Tarefas

-   **Filtros dinâmicos** por estado, prioridade e data
-   **Pesquisa** por título de tarefa
-   **Paginação** automática
-   **Sistema de ordenação avançado** - 8 opções: data, vencimento, prioridade, título (v0.12.0)
-   **Estados visuais** para tarefas em atraso

### ✨ Criação de Tarefas

-   **Formulário intuitivo** com validação em tempo real
-   **Campos obrigatórios** e opcionais claramente marcados
-   **Prioridades visuais** com códigos de cores
-   **Datas de vencimento** com validação

### 👁️ Visualização Detalhada

-   **Informações completas** da tarefa
-   **Ações rápidas** (editar, duplicar, eliminar)
-   **Alertas contextuais** para tarefas em atraso
-   **Breadcrumbs** para navegação

### 📊 Sistema de Ordenação (v0.12.0)

-   **8 opções de organização** integradas com filtros existentes:
    -   📅 **Por criação**: Mais recentes ↔ Mais antigas
    -   ⏰ **Por vencimento**: Próximo ↔ Distante
    -   ⭐ **Por prioridade**: Alta→Baixa ↔ Baixa→Alta
    -   🔤 **Por título**: A→Z ↔ Z→A
-   **Estado preservado** após aplicação de filtros
-   **Tratamento inteligente** de valores NULL (datas de vencimento)
-   **SQL otimizado** para compatibilidade universal

### 🗑️ Sistema de Lixo (v0.13.0)

-   **Soft Delete implementado**: Tarefas "eliminadas" preservadas na base de dados
-   **4 estados de tarefa**: Pendente, Concluída, Em Atraso, **Eliminada** (invisível)
-   **Interface de lixo** com visual diferenciado (fundo vermelho, texto riscado)
-   **3 ações disponíveis**:
    -   🗑️ **Eliminar** (soft delete) - move para o lixo
    -   ♻️ **Restaurar** - volta do lixo para ativo
    -   💀 **Eliminar permanentemente** - remove definitivamente da BD
-   **Contador dinâmico** na sidebar mostrando quantidade de tarefas no lixo
-   **Segurança mantida** - cada utilizador vê apenas suas tarefas eliminadas
-   **Auditoria completa** - histórico de eliminações preservado

### 🧭 Sidebar Inteligente (v0.8.0-0.9.1)

-   **Navegação condicional** baseada no estado de autenticação
-   **Brand personalizado** com emoji ✅ e nome "Todo-App"
-   **Branding consistente** - logo visível em todos os estados de autenticação (v0.9.1)
-   **Layout adaptativo** - Flux UI para autenticados, navbar tradicional para visitantes
-   **Contadores dinâmicos** de tarefas pendentes, concluídas e em atraso
-   **Filtros rápidos** com aplicação automática de parâmetros
-   **Menu contextual** - diferentes opções para autenticados vs visitantes
-   **Links inteligentes** - logo redireciona para dashboard ou home
-   **Lógica otimizada** - separação clara entre pendentes e em atraso (v0.9.0)

#### Para utilizadores autenticados:

-   Dashboard com visão geral
-   Gestão completa de tarefas
-   Filtros rápidos com badges coloridos
-   Perfil de utilizador integrado

#### Para visitantes:

-   Página inicial
-   Links para registo e login
-   Interface limpa sem funcionalidades irrelevantes

### 🌙 Sistema Dark/Light Mode

-   **Toggle acessível** em navbar (visitantes) e sidebar (autenticados)
-   **Persistência automática** - tema lembrado entre sessões
-   **Detecção de preferência** - respeita configuração do sistema se não definido
-   **Prevenção de flash** - tema aplicado antes do carregamento da página
-   **Navegação SPA compatível** - funciona com `wire:navigate` do Livewire
-   **Ícones dinâmicos** - lua (dark) e sol (light) que alteram conforme tema
-   **Todas as páginas otimizadas** - formulários, cards, textos com contraste adequado
-   **Transições suaves** - animações de 200ms entre temas

### 🔐 Segurança

-   **Autenticação obrigatória** para todas as funcionalidades
-   **Isolamento de dados** por utilizador
-   **Autorização granular** via Policies
-   **Validação robusta** de todos os inputs
-   **Navegação segura** com verificações de autenticação

---

## ✅ **Projeto Concluído - v1.0.1**

**Estado:** Versão estável final lançada em Outubro 2025

### 🎯 **Funcionalidades Implementadas:**

#### ✅ **Arquitetura Moderna**

-   Laravel 12 + Vue.js 3 + Inertia.js SPA
-   87 testes automatizados com Pest (91% taxa de sucesso)
-   Autenticação segura com isolamento de dados

#### ✅ **Interface Avançada**

-   Sistema Dark/Light Mode com persistência
-   Dashboard com toggle "Hoje/Esta Semana"
-   Filtros dinâmicos e pesquisa em tempo real
-   Design responsivo com Tailwind CSS

#### ✅ **Gestão Completa de Tarefas**

-   CRUD completo com soft deletes
-   Sistema de prioridades (Alta/Média/Baixa)
-   Detecção automática de tarefas em atraso
-   Sidebar com contadores dinâmicos

---

## 📚 Documentação

-   **[DOCUMENTATION.md](DOCUMENTATION.md)** - Documentação técnica completa do projeto
-   **[TESTING_DOCUMENTATION.md](TESTING_DOCUMENTATION.md)** - Suite completa de testes automatizados com Pest
-   **[Changelog](docs/changelog.md)** - Histórico cronológico de desenvolvimento e versões
-   **[VUE_IMPLEMENTATION.md](VUE_IMPLEMENTATION.md)** - Guia técnico da migração para Vue.js 3 + Inertia.js

### Componentes da Documentação

-   **📋 Arquitectura**: Estrutura MVC completa com componentes Vue.js integrados
-   **🎨 UI/UX**: Sistema de design e implementação avançada de temas
-   **🧪 Testes**: Suite completa com 87 testes automatizados (91% passing)
-   **🔧 Configuração**: Setup do ambiente local e considerações de deployment
-   **📊 Metodologia**: Processo de desenvolvimento e controlo de versões

---

**Desenvolvido por José Gonçalves para InovCorp - Outubro 2025**

# ✅ To-Do App (Laravel 12 + Tailwind CSS + Jetstream)

Aplicação web completa para gestão de tarefas pessoais, desenvolvida em **Laravel 12** com **Tailwind CSS** e **Jetstream**.  
Projecto desenvolvido durante período de estágio, implementando boas práticas de desenvolvimento, documentação técnica e controlo de versões.

---

## 🎯 Estado do Projeto

**Versão Actual:** `0.11.0` - **Projecto Completo e Operacional** ✅

### ✅ Funcionalidades Implementadas

-   **CRUD Completo de Tarefas** - Criar, listar, editar, eliminar
-   **Sistema de Filtros Avançado** - Por estado, prioridade, data, pesquisa
-   **Autenticação Multi-Utilizador** - Cada utilizador vê apenas as suas tarefas
-   **Interface Moderna e Responsiva** - Design profissional com Tailwind CSS
-   **🌙 Dark/Light Mode Otimizado** - Sistema completo com legibilidade maximizada
-   **Branding Consistente** - Logo visível em todos os estados de autenticação
-   **Autorização Granular** - Controlo de acesso via Policies
-   **Sidebar Personalizada** - Navegação inteligente com contadores dinâmicos
-   **Funcionalidades Extra** - Duplicação de tarefas, paginação, ordenação

### 🎨 Otimizações Visuais (v0.11.0)

-   **Títulos bem contrastados** no dark mode para máxima legibilidade
-   **Campos de formulário sempre legíveis** - texto preto sobre fundo branco
-   **Consistência visual** entre todas as páginas e componentes
-   **Estados hover otimizados** para ambos os temas
-   **Acessibilidade melhorada** com contrastes adequados

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
└── README.md               # Este ficheiro
```

---

## 🎨 Screenshots & Funcionalidades

### 📋 Listagem de Tarefas

-   **Filtros dinâmicos** por estado, prioridade e data
-   **Pesquisa** por título de tarefa
-   **Paginação** automática
-   **Ordenação** por data de criação ou vencimento
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

## 🗓️ Roadmap de Desenvolvimento

### ✅ **v0.10.0 - Dark/Light Mode Sistema** ✅ **LANÇADO**

-   Sistema completo de alternância de temas
-   Persistência automática e prevenção de flash
-   Compatibilidade total com navegação SPA
-   Formulários e interface otimizados

### ✅ **v0.8.0 - Sidebar Personalizada** (Concluído)

-   Navegação inteligente baseada em autenticação
-   Contadores dinâmicos de tarefas
-   Brand personalizado Todo-App
-   Filtros rápidos integrados

### ✅ **v0.9.0 - Lógica de Tarefas Otimizada** (Concluído)

-   Separação clara entre pendentes e em atraso
-   Filtros exclusivos sem sobreposição
-   UX melhorada para categorização de tarefas
-   Scopes otimizados e código mais limpo

### 🔄 **v0.9.1 - Consistência Visual** ✅ **LANÇADO**

-   Branding unificado em todos os estados de autenticação
-   Layout inteligente condicional
-   Experiência visual profissional

### 🔄 **v1.0.0 - Vue.js + Inertia** (Planeado)

-   Migração para Vue 3 com Inertia.js
-   Interactividade avançada
-   Actualizações em tempo real

### 🔄 **v1.1.0 - Testes Automatizados** (Planeado)

-   Suite completa de testes com Pest
-   Cobertura de código automatizada
-   Pipeline CI/CD

---

## 📚 Documentação

-   **[DOCUMENTATION.md](DOCUMENTATION.md)** - Documentação técnica adaptada para contexto de estágio
-   **[Changelog](docs/changelog.md)** - Histórico cronológico de desenvolvimento e versões
-   **[Dark Mode Guide](docs/dark-mode-guide.md)** - Guia de implementação do sistema de temas
-   **[Development Summary](DEVELOPMENT_SUMMARY.md)** - Resumo do percurso de desenvolvimento para estágio

### Componentes da Documentação

-   **📋 Arquitectura**: Estrutura MVC completa com componentes integrados
-   **🎨 UI/UX**: Sistema de design e implementação avançada de temas
-   **🔧 Configuração**: Setup do ambiente local e considerações de deployment
-   **📊 Metodologia**: Processo de desenvolvimento e controlo de versões

---

**Desenvolvido por José Gonçalves para InovCorp - Outubro 2025**

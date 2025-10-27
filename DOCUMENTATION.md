# 📚 Documentação do Projeto — To‑Do App (Estágio)

## 🎯 O que é este projeto?

Uma aplicação web para gerir tarefas pessoais, que desenvolvi durante o meu estágio para aprender Laravel e desenvolvimento web moderno.

**O objetivo:** Criar uma app simples mas completa onde possa criar, editar, marcar como concluídas e organizar as minhas tarefas diárias.

---

## 🛠️ Tecnologias que aprendi a usar

-   **Laravel 12** - Framework PHP (era a versão mais recente quando comecei)
-   **Tailwind CSS** - Para fazer a interface bonita e responsiva
-   **MySQL** - Base de dados para guardar as tarefas
-   **Herd** - Ambiente local para desenvolver
-   **Pest** - Para fazer testes automáticos
-   **Blade** - Templates do Laravel para as páginas

---

## ✨ O que a aplicação faz

### Funcionalidades principais:

-   **Criar tarefas** com título, descrição, data limite e prioridade
-   **Ver lista de todas as tarefas** com filtros (pendentes, concluídas, atrasadas)
-   **Pesquisar** tarefas pelo título
-   **Editar** tarefas existentes
-   **Marcar como concluída** com um clique
-   **Apagar** tarefas que já não preciso
-   **Funciona no telemóvel** - interface responsiva

### Sistema de utilizadores:

-   Cada pessoa vê apenas as suas próprias tarefas
-   Login seguro (não podes ver tarefas de outros)
-   Registo de novas contas

---

## 🌙 Dark Mode - O que mais me orgulho

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

---

## 🏗️ Como está organizado o código

```
app/
├── Models/
│   └── Task.php              # Modelo da tarefa
├── Http/
│   ├── Controllers/
│   │   └── TaskController.php # Lógica principal das tarefas
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
│       └── edit.blade.php     # Editar tarefa
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

---

## 🚀 Competências desenvolvidas

### Competências técnicas:

-   **Laravel**: MVC, migrations, relationships, policies
-   **PHP**: sintaxe, orientação a objectos, namespaces
-   **Frontend**: HTML, CSS, JavaScript, Tailwind
-   **Base de dados**: MySQL, queries, relacionamentos
-   **Git**: controlo de versões, branches, commits
-   **Testes**: como escrever testes automáticos

### Competências pessoais:

-   **Resolução de problemas**: debuggar erros passo a passo
-   **Documentação**: importância de registar o que faço
-   **Planeamento**: dividir funcionalidades grandes em pequenas
-   **Persistência**: não desistir quando algo não funciona
-   **Atenção ao detalhe**: pequenos detalhes fazem diferença

---

_Documentação criada durante o estágio de desenvolvimento web - 2025_

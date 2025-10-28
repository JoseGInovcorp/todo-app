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

### 📊 Sistema de Ordenação (v0.12.0):

-   **8 formas diferentes** de organizar as tarefas:
    -   Por data de criação (mais recentes primeiro ou mais antigas)
    -   Por data de vencimento (próximas ou distantes)
    -   Por prioridade (alta→baixa ou baixa→alta)
    -   Por título alfabético (A→Z ou Z→A)
-   **Mantém a escolha** depois de aplicar filtros
-   **Funciona com tudo** - pesquisa, filtros, paginação

### 🗑️ Sistema de Lixo com Soft Delete (v0.13.0):

-   **4 estados para as tarefas**: Pendente, Concluída, Em Atraso, **Eliminada**
-   **Soft Delete**: Tarefas "eliminadas" ficam guardadas na base de dados para auditoria
-   **Interface de lixo dedicada** onde posso ver e gerir tarefas eliminadas
-   **3 ações principais**:
    -   **Eliminar** - move a tarefa para o lixo (soft delete)
    -   **Restaurar** - traz a tarefa de volta do lixo
    -   **Eliminar permanentemente** - apaga definitivamente da base de dados
-   **Contador na sidebar** - mostra quantas tarefas estão no lixo em tempo real

### 🎯 Filtragem Inteligente de Vistas (v0.13.1):

-   **Vista principal otimizada**: Por defeito mostra apenas tarefas ativas (não concluídas)
-   **Filtragem automática**: Tarefas concluídas ficam ocultas para reduzir ruído visual
-   **Vista "Todas"**: Opção para ver todas as tarefas quando necessário
-   **Contexto dinâmico**: Títulos das vistas adaptam-se ao filtro ativo
-   **Experiência focada**: Interface limpa centrada nas tarefas que requerem atenção

### 🎨 Interface de Autenticação Personalizada (v0.13.2):

-   **Branding consistente**: Logo "✅ To-Do App" visível em todas as páginas de auth
-   **Visual harmonizado**: Mesmo gradiente de fundo da página principal
-   **Páginas redesenhadas**: Login, registo e recuperação de password
-   **Elementos portugueses**: Títulos e textos 100% em português com emojis intuitivos
-   **Design profissional**: Containers com sombras, bordas arredondadas e transições suaves
-   **Dark mode integrado**: Suporte completo para modo escuro em todas as páginas de auth

### 📊 Dashboard Informativo (v0.13.3):

-   **Centro de controlo**: Página principal com visão geral completa da produtividade
-   **4 métricas principais**: Total, Pendentes, Concluídas, Em Atraso com contadores visuais
-   **Estatísticas detalhadas**: Distribuição por prioridade e resumo semanal
-   **Próximas tarefas**: Lista das 5 próximas tarefas com vencimento nos próximos 7 dias
-   **Ações rápidas**: Botões diretos para Nova Tarefa, Todas, Pendentes e Lixo
-   **Redirecionamento inteligente**: Utilizadores são direcionados para o dashboard após login
-   **Contagens consistentes**: Mesma lógica de contadores em todo o projeto (sidebar + dashboard)

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

### O que aprendi:

-   **Consistência** é fundamental para aplicações profissionais
-   **Pequenos detalhes** fazem grande diferença na experiência do utilizador
-   **Teste sistemático** em ambos os temas é essencial

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

### O que mais me orgulho:

-   **Decisões de UX fundamentadas** - priorizei o workflow real do utilizador
-   **Implementação elegante** - mudança simples com grande impacto
-   **Flexibilidade mantida** - não perdi funcionalidade, apenas otimizei
-   **Atenção ao detalhe** - títulos dinâmicos dão contexto constante

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

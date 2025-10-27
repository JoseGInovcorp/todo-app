# 📝 O Meu Percurso de Desenvolvimento - To‑Do App

## 🎓 Reflexões do Meu Estágio

**O que construí**: Uma aplicação completa de gestão de tarefas  
**Quando**: Outubro 2025  
**Tecnologia principal**: Laravel 12
**Ambiente**: Herd
**Base de dados**: MySQL

---

## ✨ O que consegui implementar

### 🎯 Funcionalidades principais que desenvolvi:

-   **CRUD completo**: Criar, ver, editar, apagar tarefas
-   **Sistema de autenticação**: Cada utilizador acede apenas às suas tarefas
-   **Controlo de acesso**: Autorização adequada entre utilizadores
-   **Interface responsiva**: Tailwind CSS com design adaptativo
-   **Relações na base de dados**: Associação correcta utilizador-tarefas
-   **Branding personalizado**: Identidade visual "✅ To-Do App" consistente
-   **🌙 Dark mode**: Sistema completo de alternância de temas

### 🚀 Funcionalidades avançadas implementadas:

-   **Sistema de filtros**: Por estado, prioridade e data de vencimento
-   **Toggle de estado**: Alternância rápida entre pendente/concluída
-   **Sistema de prioridades**: Alta (🔴), Média (🟡), Baixa (🟢)
-   **Deteção automática de atrasos**: Identificação visual de tarefas vencidas
-   **🎨 Dark mode persistente**: Tema guardado localmente com prevenção de flash
-   **Pesquisa instantânea**: Filtragem em tempo real durante digitação
-   **Paginação eficiente**: Gestão otimizada de grandes volumes de dados

---

## 🛠️ Como Implementei Tudo (A Parte Técnica)

### O que aprendi no Backend:

#### 1. **Controller das Tarefas** - Centro da lógica da aplicação

```php
// Funcionalidades implementadas:
- Queries dinâmicas para sistema de filtros
- Middleware de protecção de rotas
- Sistema de pesquisa funcional
- Paginação optimizada
- Toggle de estado para tarefas
```

**Aprendizagem:** Controllers centralizam a lógica de negócio da aplicação.

#### 2. **Modelo Task** - Estrutura de dados inteligente

```php
// Funcionalidades implementadas:
- Scopes: pending(), completed(), overdue() para filtragem reutilizável
- Accessors: formatação automática de cores e datas
- Relacionamentos: associação adequada utilizador-tarefa
- Atribuição automática de user_id
```

**Aprendizagem:** Models do Eloquent permitem lógica de negócio avançada além do simples armazenamento.

#### 3. **Sistema de Autenticação** - Segurança robusta

```php
// Componentes implementados:
- Jetstream/Fortify para autenticação completa
- TaskPolicy com regras de autorização específicas
- Filtros automáticos por utilizador
- Protecção de rotas com middleware
```

**Aprendizagem:** Laravel fornece ferramentas robustas para implementação segura de autenticação e autorização.

#### 4. **Navegação Inteligente** - Interface adaptativa

```php
// Funcionalidades desenvolvidas:
- Navegação condicional baseada em estado de autenticação (@auth / @else)
- Branding consistente com logo "✅ Todo-App"
- Contadores dinâmicos de tarefas por categoria
- Links contextuais baseados no tipo de utilizador
- Filtros de acesso rápido
```

**Aprendizagem:** Interface adaptativa melhora significativamente a experiência do utilizador.

#### 5. **Lógica de Categorização** - Resolução de conflitos de estado

```php
// Problema identificado:
- Tarefas classificadas simultaneamente como "Pendente" e "Em Atraso"
- Inconsistência nos contadores de estatísticas

// Solução implementada:
- pendingNotOverdue(): exclusão de tarefas vencidas do estado pendente
- overdue(): identificação específica de tarefas vencidas
- Agora: Pendentes + Atrasadas + Concluídas = Total ✅
```

**Aprendizagem:** Lógica de negócio requer validação com dados reais para garantir consistência.

#### 6. **🌙 Dark Mode** - Implementação avançada de temas

```javascript
// Componentes desenvolvidos:
- Classe ThemeManager para gestão centralizada
- Scripts de carregamento prioritário (prevenção de flash)
- Persistência via localStorage
- Detecção de preferências do sistema
- Compatibilidade com Livewire navigation

// Funcionalidades implementadas:
- Toggle visual com ícones adaptativos
- Transições suaves entre temas
- Prevenção de flash branco durante carregamento
- Formulários optimizados para ambos os modos
```

**Aprendizagem:** JavaScript modular e gestão de estado são essenciais para funcionalidades avançadas.

### Desenvolvimento Frontend:

#### 1. **Design com Tailwind CSS** - Framework utility-first

-   **Navegação personalizada**: Branding "✅ To-Do App" consistente
-   **Design responsivo**: Abordagem mobile-first
-   **🎨 Interface adaptativa**: Suporte completo para dark mode
-   **Sistema de badges**: Codificação visual de estados e prioridades
-   **Página de boas-vindas**: Interface para utilizadores não autenticados
-   **Navegação condicional**: Adaptação baseada no estado de autenticação

**Aprendizagem:** Tailwind CSS oferece desenvolvimento mais eficiente que CSS tradicional.

#### 2. **Experiência do Utilizador** - Optimização de usabilidade

-   **Filtragem instantânea**: Resposta imediata às acções do utilizador
-   **Codificação visual intuitiva**: Verde = concluída, Vermelho = urgente/atrasada
-   **Layout baseado em cards**: Interface moderna e organizada
-   **HTML semântico**: Compatibilidade com tecnologias assistivas
-   **Contadores dinâmicos**: Actualização automática de estatísticas
-   **Navegação contextual**: Diferentes opções baseadas no tipo de utilizador
-   **Branding unificado**: Consistência visual em todos os estados

**Aprendizagem:** UX eficaz combina estética com funcionalidade intuitiva.

### Arquitectura da Base de Dados:

#### 1. **Como organizei os dados** (MySQL)

```sql
-- As tabelas que criei:
tasks (id, title, description, status, priority, due_date, user_id)
users (Jetstream já fez por mim)

-- Como se ligam:
User hasMany Tasks (um user pode ter várias tasks)
Task belongsTo User (cada task pertence a um user específico)
```

**Aprendizagem:** Eloquent ORM simplifica significativamente a gestão de relacionamentos comparado com SQL nativo.

#### 2. **Para manter tudo organizado e seguro**

-   **Foreign keys**: Para não haver tasks "órfãs"
-   **Indexes**: Para pesquisas rápidas por user, status, etc.
-   **Validação**: Para garantir integridade dos dados
-   **Segurança**: Cada user só vê as suas próprias tasks

**O que aprendi:** Base de dados bem estruturada poupa muito trabalho depois!

---

## 🔧 Os Desafios que Enfrentei (e como os resolvi!)

### Os problemas grandes que tive que resolver:

1. **Página em branco misteriosa** - O projeto não carregava nada!

    - **Como resolvi**: O problema estava no APP_URL do ficheiro .env
    - **Ferramentas que usei**: Herd link, herd secure, php artisan cache:clear
    - **O que aprendi**: Sempre verificar a configuração primeiro!

2. **Interface padrão do Laravel era feia** - Parecia genérica demais

    - **Como resolvi**: Redesenhei tudo com o meu próprio branding "✅ To-Do App"
    - **O que fiz**: Layouts novos, navegação personalizada, página de boas-vindas

3. **Segurança dos dados** - Como garantir que cada user só vê as suas tasks?

    - **Como resolvi**: Sistema completo de autorização
    - **O que implementei**: Policies, middleware, verificações em todo o lado

4. **Branding inconsistente** - Logo apenas visível após autenticação

    - **O problema**: Visitantes não viam o nome "✅ To-Do App"
    - **Como resolvi**: Sistema duplo de layouts com branding sempre visível
    - **O que fiz**: Layout Flux para logados + navbar normal para visitantes

5. **🌙 Dark Mode - O grande desafio técnico!** - O mais complicado de todos
    - **Problema 1**: Texto branco em fundos brancos (invisível!)
    - **Problema 2**: Tema resetava quando mudavas de página
    - **Como resolvi**: Classe ThemeManager em JavaScript para gerir tudo
    - **Truque técnico**: Event listeners para Livewire (`livewire:navigated`)
    - **Detalhe importante**: Scripts inline para aplicar tema antes de carregar

### Como trabalhei (a minha metodologia):

-   **Passo a passo**: Uma funcionalidade de cada vez (não tudo ao mesmo tempo!)
-   **Testei tudo manualmente**: Com dados reais, não só "olá mundo"
-   **Código limpo**: Comentários e nomes que fazem sentido
-   **User experience primeiro**: Se não é intuitivo, está mal feito

**Aprendizagem:** Desenvolvimento incremental com foco na qualidade produz melhores resultados que implementação superficial de múltiplas funcionalidades.

---

## 📊 Resultado Final do Projecto

### ✅ **Funcionalidades implementadas com sucesso:**

-   **CRUD completo**: Criar, visualizar, editar e eliminar tarefas
-   **Sistema de utilizadores**: Autenticação com isolamento adequado de dados
-   **Sistema de filtros**: Por status, prioridade e data com pesquisa instantânea
-   **Interface profissional**: Design responsivo e acessível
-   🌙 **Dark/Light Mode**: Sistema completo de alternância de temas

### 🌐 **Ambiente de desenvolvimento:**

-   **URL local**: http://todo-app.test (SSL configurado)
-   **Estado**: Totalmente operacional para demonstração
-   **Performance**: Optimizada com paginação e queries eficientes
-   **Segurança**: Isolamento adequado entre utilizadores
-   **Visual**: Logo "✅ To-Do App" sempre visível
-   **Experiência**: Navegação intuitiva que se adapta ao utilizador
-   **🎨 Dark Mode**: Muda automaticamente e lembra-se da escolha!

### 📁 **Como organizei tudo (estrutura dos ficheiros):**

```
todo-app/
├── app/
│   ├── Http/Controllers/TaskController.php (todas as operações CRUD)
│   ├── Models/Task.php (o "cérebro" das tasks)
│   ├── Policies/TaskPolicy.php (segurança e permissões)
├── resources/views/
│   ├── layouts/app.blade.php (template principal personalizado)
│   ├── welcome.blade.php (página inicial com branding)
│   ├── tasks/ (todas as páginas das tasks)
├── database/migrations/ (estrutura da base de dados)
├── docs/ (toda a documentação que escrevi)
```

---

## 🎓 O que aprendi mesmo (competências que desenvolvi):

### No lado técnico:

-   **Laravel**: Controllers, Models, relacionamentos, scopes - como funciona por dentro
-   **Base de dados**: Como desenhar tabelas, relacionamentos, migrações que fazem sentido
-   **Autenticação**: Jetstream/Fortify, políticas de segurança - nada de users a ver coisas que não devem
-   **Frontend moderno**: Tailwind CSS, responsivo, UX que funciona em mobile
-   **🌙 JavaScript avançado**: Gestão de temas, localStorage, event listeners - dark mode foi um desafio!
-   **Lógica de negócio**: Como organizar filtros, pesquisas, prioridades
-   **Debugging**: Identificação e resolução de problemas técnicos complexos
-   **🔧 SPAs**: Como fazer funcionar com Livewire e wire:navigate

### No lado pessoal/profissional:

-   **Planeamento**: Como dividir um projeto grande em pedaços pequenos
-   **Código limpo**: Escrever código que eu e outros conseguem perceber mais tarde
-   **Design thinking**: Pensar no utilizador primeiro, não só na tecnologia
-   **Documentação**: Escrever explicações que fazem sentido
-   **Problem-solving**: Quando está quebrado, como encontrar e resolver
-   **Paciência**: Nem tudo funciona à primeira (especialmente dark mode!)

---

## 💼 Para mostrar no estágio:

### **Aspectos demonstráveis:**

1. **Aplicação funcional**: http://todo-app.test - totalmente operacional
2. **Design profissional**: Interface responsiva com branding personalizado
3. **Segurança robusta**: Sistema de autenticação com isolamento de dados
4. **Funcionalidades avançadas**: Filtros instantâneos, pesquisa e gestão de prioridades
5. **Qualidade de código**: Estrutura Laravel bem organizada e documentada

### **Componentes técnicos principais:**

-   **Laravel 12**: Framework moderno e actualizado
-   **Autenticação Jetstream**: Sistema completo de gestão de utilizadores
-   **Arquitectura de base de dados**: Estrutura escalável e eficiente
-   **UI/UX optimizada**: Interface intuitiva e acessível
-   **Documentação técnica**: Cobertura completa do desenvolvimento

---

## 📈 Roadmap de Desenvolvimento Futuro

### **Fase 1 - Integração Vue.js** (Planeada v0.8.0)

-   Implementação do Inertia.js
-   Migração de componentes Vue 3
-   Interatividade melhorada

### **Fase 2 - Suite de Testes** (Planeada v0.9.0)

-   **Testes automatizados** com Pest (framework mais moderno)
-   **Cobertura de testes** para garantir funcionalidade adequada
-   **Pipeline CI/CD** para deployment automático

---

**Contexto do projecto**: Desenvolvimento durante período de estágio  
**Metodologia aplicada**: Aprendizagem prática com foco na qualidade técnica

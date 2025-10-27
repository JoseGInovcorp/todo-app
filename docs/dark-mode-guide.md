# 🌙 Guia do Dark Mode - Como Implementei

Este documento explica como criei o sistema de modo escuro/claro no To‑Do App durante o meu estágio.

## 🎯 O que consegui implementar

Um sistema completo de alternância de temas que inclui:

-   **Botão para alternar** entre claro e escuro
-   **Guarda a preferência** no browser
-   **Sem flash branco** ao navegar entre páginas
-   **Todos os textos legíveis** em ambos os modos

### O grande desafio que resolvi:

Fazer com que **todos os formulários ficassem sempre legíveis**, mesmo em modo escuro!

---

## 🛠️ Como Implementei (Parte Técnica)

### 1. JavaScript para gerir o tema (`resources/js/theme.js`)

Criei uma classe `ThemeManager` que faz toda a gestão:

```javascript
class ThemeManager {
    // Detecta se preferes modo escuro no sistema
    // Guarda a tua escolha no localStorage
    // Troca os ícones automaticamente
}
```

**Os métodos principais que criei:**

-   `initTheme()` - Detecta que tema usar quando abres a app
-   `setTheme(theme)` - Aplica o tema e guarda no browser
-   `toggleTheme()` - Alterna entre escuro/claro com um clique
-   `updateToggleIcon(theme)` - Muda o ícone (lua/sol)

### 2. Como eliminei o "flash branco"

**O problema:** Quando mudava de página, aparecia um flash branco.

**A solução:** Código JavaScript que executa ANTES da página carregar:

```javascript
// Este código roda imediatamente, antes de mostrar qualquer coisa
(function () {
    const savedTheme = localStorage.getItem("theme");
    // Aplica modo escuro antes de aparecer qualquer conteúdo
})();
```

### 3. Classes CSS com Tailwind

**Descobri** que o Tailwind tem classes especiais `dark:` que só funcionam em modo escuro!

**O padrão que criei e uso em todo o lado:**

```html
<!-- Títulos principais -->
class="text-gray-900 dark:text-white"

<!-- Formulários (o truque mais importante!) -->
class="dark:bg-white dark:text-gray-900"

<!-- Informações secundárias -->
class="text-gray-600 dark:text-gray-300"

<!-- Containers/cards -->
class="bg-white dark:bg-gray-700"
```

---

## 🎨 Como Apliquei em Cada Tipo de Elemento

### Títulos e Headers

```html
<h1 class="text-gray-900 dark:text-white">Título Principal</h1>
<p class="text-gray-600 dark:text-gray-300">Subtítulo</p>
```

**Por que escolhi estas cores:** Máximo contraste em ambos os modos!

### Formulários (A Parte Mais Importante!)

```html
<!-- Container do formulário -->
<div class="bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600">
    <!-- Campos de input (o truque genial!) -->
    <input
        class="dark:bg-white dark:text-gray-900 border-gray-300 dark:border-gray-500"
    />

    <!-- Labels -->
    <label class="text-gray-700 dark:text-gray-200"></label>
</div>
```

### Cards/Containers

```html
<div
    class="bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600"
></div>
```

### Botões

```html
<!-- Secundário -->
<button
    class="bg-white dark:bg-gray-600 text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700"
>
    <!-- Primário (mantém estilo) -->
    <button class="bg-indigo-600 text-white hover:bg-indigo-700"></button>
</button>
```

---

## 🎯 As Regras Que Criei Para Tudo Ficar em harmonia

### A Minha Estratégia de Cores

1. **Títulos Principais**: Sempre bem contrastados

    - **Modo claro:** `text-gray-900` (quase preto)
    - **Modo escuro:** `text-white` (branco puro)

2. **Campos de Formulário**:

    - **Sempre fundo branco + texto preto** em ambos os modos
    - A classe : `dark:bg-white dark:text-gray-900`

3. **Informações Secundárias**: Subtis mas visíveis

    - **Modo claro:** `text-gray-600`
    - **Modo escuro:** `text-gray-300`

4. **Efeitos Hover**: Feedback visual consistente
    - Cada modo tem as suas cores apropriadas
    - Rings de focus sempre visíveis

### Páginas Que Otimizei (Todas!)

**📋 Lista de Tarefas (`tasks/index.blade.php`):**

-   ✅ Títulos bem visíveis em modo escuro
-   ✅ Formulário de filtros com campos sempre legíveis
-   ✅ Cards das tarefas com cores apropriadas
-   ✅ Metadados (datas, prioridades) bem contrastados

**✨ Criar Tarefa (`tasks/create.blade.php`):**

-   ✅ Breadcrumbs (navegação) adaptados
-   ✅ **Todos** os campos de formulário legíveis
-   ✅ Seção de dicas com fundo azul suave
-   ✅ Botões com efeitos hover bonitos

**👁️ Ver Detalhes (`tasks/show.blade.php`):**

-   ✅ Headers e navegação otimizados
-   ✅ Cards de informação consistentes
-   ✅ Alertas com cores apropriadas

**✏️ Editar Tarefa (`tasks/edit.blade.php`):**

-   ✅ Formulário completo otimizado
-   ✅ Campos especiais (checkboxes, selects) funcionais

---

## Event Listeners e Navegação

### Livewire SPA Compatibility

```javascript
// Inicial
document.addEventListener("DOMContentLoaded", maintainTheme);

// Navegação SPA
document.addEventListener("livewire:navigated", maintainTheme);

// Mudança de visibilidade
document.addEventListener("visibilitychange", () => {
    if (!document.hidden) maintainTheme();
});
```

### Função maintainTheme()

```javascript
function maintainTheme() {
    const theme =
        localStorage.getItem("theme") ||
        (window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light");

    // Aplica classe sem interferir com outras classes
    if (theme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }

    // Atualiza ícones com delay
    if (window.themeManager) {
        setTimeout(() => window.themeManager.updateToggleIcon(theme), 50);
    }
}
```

---

## Estrutura de Ficheiros

```
resources/
├── js/
│   ├── theme.js           # ThemeManager class
│   └── app.js             # Import theme.js
├── views/
│   ├── partials/
│   │   └── head.blade.php # Scripts anti-flash
│   ├── components/layouts/
│   │   ├── app.blade.php  # Layout guests
│   │   └── app/
│   │       └── sidebar.blade.php # Layout autenticado + toggle
│   └── tasks/
│       ├── index.blade.php   # Listagem otimizada
│       └── create.blade.php  # Criação otimizada
└── css/
    └── app.css           # Tailwind + custom variants
```

---

## Testing e Debugging

### Verificações Essenciais

1. **Persistência**: Tema mantém-se após reload/navegação
2. **Ícones**: Botão toggle reflete estado correto
3. **Legibilidade**: Todos textos visíveis em ambos modos
4. **Formulários**: Campos sempre com texto legível
5. **Transições**: Mudanças suaves sem flash

### Comandos de Build

```bash
# Desenvolvimento
npm run dev

# Produção
npm run build

# Watch mode
npm run watch
```

---

## Manutenção e Extensibilidade

### Adição de Novas Views

1. Aplicar classes dark: em todos elementos
2. Seguir padrão de cores estabelecido
3. Testar legibilidade em ambos modos
4. Verificar formulários com fundo branco

### Padrões Estabelecidos

```html
<!-- Template base para novos componentes -->
<div class="bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600">
    <h1 class="text-gray-900 dark:text-white">Título</h1>
    <p class="text-gray-600 dark:text-gray-300">Subtítulo</p>

    <input
        class="dark:bg-white dark:text-gray-900 border-gray-300 dark:border-gray-500"
    />
    <label class="text-gray-700 dark:text-gray-200">Label</label>

    <span class="text-gray-500 dark:text-gray-400">Info secundária</span>
</div>
```

---

## Performance

-   **Zero flash**: Tema aplicado antes de renderização
-   **localStorage**: Acesso rápido à preferência
-   **Event listeners**: Otimizados para SPA navigation
-   **CSS**: Classes Tailwind compiladas estaticamente
-   **JavaScript**: Classe ThemeManager leve e eficiente

---

_Versão 0.11.0 - Outubro 2025_

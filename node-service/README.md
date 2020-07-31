# stock-middleware

## Observações da aplicação

As informações de conexão e do usuário serão encapsuladas no token de request de usuário, para que todas as requests saibam como filtrar as informações por default, o dado vai estar em "req.user".

## Estrututa de pastas: 

### Database - Módulo responsável por gerencias as conexões com bancos de dados
```
Service - Módulo responsável por implementar a sintaxe da API filemaker
connector.js - Singleton que armazena e compartilha as conexões dinâmicamente com a aplicação
```

### Filters - Módulo para limpeza e tratamento de dados

### Routes - Módulo responsável pela gestão da interface web de comunicação externa

```
    admin - Inteface para os serviços do admin
    meu_futuro - Interface para os serviços do Meu Futuro
    router.js - Serviço que faz o carregamento modular das interfaces
```

### Rules - Módulo responsável por organizar e inteceptar as conexões chamando validadores de autenticação ou de regras específicas

### Test - Módulo para carregamento de testes dos serviço internos do middleware

### Utils - Módulo que contém funções e serviços que podem ser úteis a toda aplicação

```
index.js - Arquivo principal do carregamento do serviço
```

## Quick start

1. Clonar repositório

2. Instalar dependências locais dentro da pasta clonada:
```
    npm i
```

3. Configurar as variáveis de ambiente a partir do `./config/.env.example`

4. Rodar projeto
    
```
    npm run dev
```

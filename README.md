# Laravel API Starter

Este repositório é um ponto de partida para o desenvolvimento de APIs utilizando Laravel 11.9. Ele inclui uma estrutura básica com autenticação via Sanctum, gerenciamento de repositórios com L5-Repositories, e uma camada de permissionamento já implementada.

A instalação foi pensada para usuários de docker, porem é perfeitamente possível rodar localmente.

## Requisitos

- Docker Compose

## Instalação

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/antoniosouza977/starter-api-laravel
    cd starter-api-laravel
    ```


2. **Copie o arquivo de exemplo `.env` :**

    ```bash
    cp .env.example .env
    ```
   
3. **Suba os containers do projeto:**

    ```bash
    docker compose up -d 
    ```

4. **Configure as variáveis de ambiente:**

    ```bash
   // Remova/Comente essas chaves caso queira usar sqlite
    DB_CONNECTION=mysql
    DB_HOST=mariadb
    DB_PORT=3306
    DB_DATABASE=starter_api_laravel
    DB_USERNAME=root
    DB_PASSWORD="Psswd#123"
    ```

## Estrutura do Projeto

- **Autenticação:** Implementada utilizando [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum) para autenticação de APIs sem estado (stateless).
- **Repositórios:** O projeto utiliza [L5-Repositories](https://github.com/andersao/l5-repository) para organizar a lógica de acesso a dados em Repositories.
- **Permissionamento:** Uma camada de permissionamento própria foi implementada baseada em roles e rotas restritas.


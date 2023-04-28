# Inventory Control

## Pré Requisitos
Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas: Git, Node.js, PHP e MySQL.

## Instalação
```bash
git clone git@github.com:ermesonqueiroz/inventory-control.git
cd inventory control
npm i
mv .env.example .env
php artisan serve
```
em outro terminal você precisa executar o seguinte comando:
```bash
npm run dev
```
em mais um outro terminal você precisa executar o comando:
```bash
php artisan schedule:work
```

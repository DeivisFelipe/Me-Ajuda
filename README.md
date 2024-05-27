<p align="center">
    <img src="./public/logo_MeAjuda.png" width="400" alt="Logo MeAjuda">
</p>

## Sobre

O projeto MeAjuda tem como objetivo conectar pessoas que precisam de ajuda com aquelas que estão dispostas a ajudar. Os usuários podem publicar anúncios solicitando ajuda em diversas áreas, como móveis, serviços, alimentação e dinheiro. Da mesma forma, eles podem oferecer algo que desejam doar ou fornecer como forma de assistência.

## Como rodar

Primeiro é preciso instalar as bibliotecas do Laravel

```
> composer install
```

Depois é preciso instalar as bibliotecas do Node

```
> npm install
```

Faça a copia do arquivo `.env.example` e salve como `.env`

É preciso depois gerar a chave do sistema

```
> php artisan key:generate
```

Também é necessário criar as tabelas e aceitar para criar o banco de dados

```
> php artisan migrate
```

E por última é necessário executar o seguinte comando

```
> npm run dev
```

## Licença

O projeto MeAjuda é de uso livre, podendo ser utilizado para qualquer finalidade.

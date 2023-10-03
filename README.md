## Objetivo: Bando Digital Simplificado

`As regras abaixo são fornecidas por terceiros.` `

Temos 2 tipos de usuários, os comuns e lojistas, ambos têm carteira com dinheiro e realizam transferências entre eles. Vamos nos atentar **somente** ao fluxo de transferência entre dois usuários.

Requisitos:
- Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail. :heavy_check_mark:
- Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários. :heavy_check_mark:
- Lojistas **só recebem** transferências, não enviam dinheiro para ninguém. :heavy_check_mark:
- Validar se o usuário tem saldo antes da transferência. :heavy_check_mark:
- Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo, use este mock para simular (https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6). :heavy_check_mark:
  - Como o mocky já estava fora eu simulei uma "autorização externa".
- A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia. :heavy_check_mark:
- No recebimento de pagamento, o usuário ou lojista precisa receber notificação (envio de email, sms) enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável. Use este mock para simular o envio (http://o4d9z.mocklab.io/notify).
- Este serviço deve ser RESTFul. :heavy_check_mark:

### Payload

Faça uma **proposta** :heart: de payload, se preferir, temos uma exemplo aqui:

POST /transaction

```json
{
    "value" : 100.00,
    "payer" : 4,
    "payee" : 15
}
```

---

## Metodologias

Os Models, Controllers e artefatos disponibilizados pelo Laravel permaneceram nos seus respectivos diretórios padrão. 
O projeto é RestFull, respondendo somente em JSON, e a resposta foi configurada via middleware para garantir consistência no formato.

### Domains
Tudo que envolve regra de negócio não relacionada ao laravel está separado por `Domain`:
```
.
├── Domain
│   ├── Actions
│   ├── Exceptions
│   └── Resources

```

### Actions

Cada `Action` resolve uma única regra de negócio. Os nomes são cuidadosamente descritos de acordo com suas responsabilidades para facilitar a rastreabilidade e manutenção do código. Além disso, são acompanhadas por testes unitários, que podem ser encontrados em `tests/Unit`, para garantir seu funcionamento adequado.

Para alimentar as `Actions`, estou utilizando requests validadas como Data Transfer Objects (DTOs), uma vez que já possuímos o 
controle necessário para o projeto. Considerei que seria excessivo criar classes separadas para os DTOs.

### Exceptions

Nada fora do comum aqui. Esta seção abriga apenas as exceções utilizadas nas `Actions` dentro do domínio.

### Resources

Aqui estão as respostas para a API, proporcionando controle total sobre as respostas de cada domínio. Elas podem ser encadeadas conforme necessário.


---

## Tecnologias utilizadas

- Laravel 10x
- Docker
- Postgres 15x

## Paulo Cezario - RTE Rodonaves shipping for WooCommerce
Contributors: phscezario  
Donate link: [PicPay](https://picpay.me/phscezario)  
Tags: shipping, delivery, woocommerce, rte rodonaves  
Requires at least: 4.0  
Tested up to: 5.5  
Stable tag: 0.0.1  
Requires PHP: 7.1  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integração entre the RTE Rodonaves and WooCommerce

### Descrição
Utilize cálculo de frete RTE Rodonaves no WooCommerce.

[RTE Rodonaves](https://rte.com.br/) é uma transportadora brasileira.

Este plugin foi desenvolvido sem nenhum incentivo da RTE Rodonaves. O desenvolvedor deste plugin não possui vínculo com esta empresa. Este plugin foi desenvolvido com base na API de integração da RTE Rodonaves.

### Funcionalidades do plugin

Este plugin adiciona sistema de frete na página de carrinho da sua loja WooCommerce, e também adiciona simulador de frete na pagina de produto.

### Instalação

- Envie os arquivos do plugin para a pasta wp-content/plugins, ou instale usando o instalador de plugins do WordPress.
- Ative o plugin.

### Compatibilidade

Requer WooCommerce 3.0 ou posterior para funcionar.

### Dúvidas?

Você pode esclarecer suas dúvidas usando:

- Utilizando o nosso [fórum no Github](https://github.com/paulocezario/woocommence-rte-rodonaves-shipping).

### Requerimentos: =

- [cURL](https://www.php.net/manual/pt_BR/book.curl.php) ativado no PHP (costuma vir ativado por padrão na maioria das hospedagens com PHP).

### Configurações dos produtos

É necessário configurar o **peso** e **dimensões** de todos os seus produtos, para que a cotação de frete funcione corretamente.
É possível configurar com produtos do tipo **simples** ou **variável** e não *virtuais* (produtos virtuais são ignorados na hora de cotar o frete).  

### Dúvidas frequentes

#### O que eu preciso para usar este plugin ?

Você precisa ter cadastro junto a RTE Rodonaves e preencher corretamente as informações no plugin.

#### Este plugin faz cotação direta com o sistema da RTE Rodonaves?

Não, no momento ele faz cotações e retorna os valores, para confirmar seu frete é preciso entrar em contato com a RTE Rodonaves e confirmar.

### Error comuns

Aqui uma lista de erros mais comuns:

- Faltando CEP de origem nos métodos configurados.
- CEP de origem inválido.
- Produtos cadastrados sem peso e dimensões
- Peso e dimensões cadastrados de forma incorreta (por exemplo configurando como 1000kg, pensando que seria 1000g, então verifique as configurações de medidas em `WooCommerce > Configurações > Produtos`).

E não se esqueça de verificar o erro ativando a opção de **Log de depuração** nas configurações de cada método de entrega. Imediatamente após ativar o log, basta tentar cotar o frete novamente, fazendo assim o log ser gerado. Você pode acessar todos os logs indo em "WooCommerce" > "Status do sistema" > "Logs".

Algumas vezes a API da RTE Rodonaves por ficar indisponível, assim ela pode retornar erro ou apenas não executar o cálculo.

### Screenshots

1. Pagina de configuração do plugin.
![](https://i.imgur.com/2wbZVJ1.png)


2. Exemplo na página de produto.
![](https://i.imgur.com/ZHfpnK1.png)


3. Exemplo na página de carrinho.
![](https://i.imgur.com/fxqOKZg.png)
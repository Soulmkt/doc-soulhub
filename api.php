<?php
// Carregamento da classe de conexão
require_once('virtusApi.php');

$products = [
    [
        'entity_id' => '3277',                          // Id do produto (campo inteiro, Obrigatório)
        'sku' => '002433',                              /* Stock Keeping Unit, em português Unidade de Manutenção de Estoque está ligado à logística de armazém
                                                         * e designa os diferentes itens do estoque, estando normalmente associado a um código identificador.
                                                         * (campo alfanumérico, Obrigatório)
                                                         */

        'qty' => '10',                                  // Quantidade do item em estoque (campo inteiro)
        'is_in_stock' => '1',                           // Flag para indicar que o produto esta em estoque  (campo inteiro, 1 ou 0)
        'codigo_barras' => '7891010030889',             // Codigo de barras do produto (campo inteiro, Obrigatório)
        'price' => '7.90',                              // Preço do produto (campo currency, Obrigatório)
        'special_price' => '5.90',                      // Preço promocional do produto (campo currency)
        'special_from_date' => '2019-03-30',            // Data de inicio da promoção (campo de data Y-m-d)
        'special_to_date' => '2019-04-10',              // Data de término da promoção (campo de data Y-m-d)
        'status' => '1',                                // Status do produto (campo inteiro, Obrigatório - 1 = Ativo e 2 = Inativo )
    ],
    [
        'entity_id' => '15935',
        'sku' => '020764',
        'qty' => '2',
        'is_in_stock' => '1',
        'codigo_barras' => '7898158690517',
        'price' => '25.89',
        'special_price' => '',
        'special_from_date' => '2017-04-10 00:00:00',
        'special_to_date' => '',
        'status' => '2',
    ],
    [
        'entity_id' => '18276',
        'sku' => '023041',
        'qty' => '1',
        'is_in_stock' => '1',
        'codigo_barras' => '7898942324390',
        'price' => '177.80',
        'special_price' => '',
        'special_from_date' => '2017-03-04 00:00:00',
        'special_to_date' => '',
        'status' => '1',
    ]
];

$param = [
    'vendor_id' => 'XXX',                         // Identificador do Vendedor (campo fixo)
    'integration' => 'MagentoMarketplace',      // Identificador da integração a ser utilizada  (campo fixo)
    'action' => 'loadManager',                  // Ação que irá ser executada
    'package' => $products                      // Pacote de produtos a ser processado
];

// Credenciais de acesso da Integração
$consumer_key = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$consumer_secret = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$oauth_token = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$oauth_token_secret = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';


$integracao = new virtusApi($consumer_key,$consumer_secret,$oauth_token,$oauth_token_secret);
$response = $integracao->exec('product', $param);

if (!empty($response)) {
    echo "<br>Marketplace Response: <pre>Package end " . print_r($response,1) . '</pre>';
} else {
    echo "Fatal Error in Integration. Response is empty: " . print_r($integracao->lastResponse,1);
}

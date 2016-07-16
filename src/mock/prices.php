<?php
return [
    'PUT /v2/prices?sku=1131270&currency=USD&price=55' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:ItemPriceResponse xmlns:ns2="http://walmart.com/">
   <ns2:mart>WALMART_US</ns2:mart>
   <ns2:sku>VEX1437_9507240_9507247</ns2:sku>
   <ns2:currency>USD</ns2:currency>
   <ns2:amount>10.000</ns2:amount>
   <ns2:message>Thank you. Your price has been updated. Please allow up to five minutes for this change to be reflected on the site.</ns2:message>
</ns2:ItemPriceResponse>'
    ],
    
];
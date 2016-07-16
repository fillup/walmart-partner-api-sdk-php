<?php
return [
    'GET /v2/inventory?sku=86678GHGHGKL' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:inventory xmlns:ns2="http://walmart.com/">
   <ns2:sku>86678GHGHGKL</ns2:sku>
   <ns2:quantity>
      <ns2:unit>EACH</ns2:unit>
      <ns2:amount>23</ns2:amount>
   </ns2:quantity>
   <ns2:fulfillmentLagTime>4</ns2:fulfillmentLagTime>
</ns2:inventory>'
    ],

    'PUT /v2/inventory?sku=NO11140_7022363' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:inventory xmlns:ns2="http://walmart.com/">
   <ns2:sku>86678GHGHGKL</ns2:sku>
   <ns2:quantity>
      <ns2:unit>EACH</ns2:unit>
      <ns2:amount>23</ns2:amount>
   </ns2:quantity>
   <ns2:fulfillmentLagTime>4</ns2:fulfillmentLagTime>
</ns2:inventory>'
    ],

];
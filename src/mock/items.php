<?php
return [
    'GET /v2/items?limit=5' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:MPItemViews xmlns:ns2="http://walmart.com/">
    <ns2:MPItemView>
        <ns2:mart>WALMART_US</ns2:mart>
        <ns2:sku>379third908</ns2:sku>
        <ns2:gtin>00313159099947</ns2:gtin>
        <ns2:productName>Carex Soft Grip Folding Cane - Black Walking Cane</ns2:productName>
        <ns2:productType>Walking Canes</ns2:productType>
        <ns2:price>
            <ns2:currency>USD</ns2:currency>
            <ns2:amount>13.27</ns2:amount>
        </ns2:price>
        <ns2:publishedStatus>IN_PROGRESS</ns2:publishedStatus>
    </ns2:MPItemView>
    <ns2:MPItemView>
        <ns2:mart>WALMART_US</ns2:mart>
        <ns2:sku>prodtest1571</ns2:sku>
        <ns2:upc>889296686590</ns2:upc>
        <ns2:gtin>00889296686590</ns2:gtin>
        <ns2:productName>REFURBISHED: HP 250 G3 15.6&amp;quot;Notebook, Intel 4th Gen i3, 4GB RAM, 500GB HDD, Win 8.1, M5G69UT#ABA</ns2:productName>
        <ns2:productType>RAM Memory</ns2:productType>
        <ns2:price>
            <ns2:currency>USD</ns2:currency>
            <ns2:amount>329.99</ns2:amount>
        </ns2:price>
        <ns2:publishedStatus>PUBLISHED</ns2:publishedStatus>
    </ns2:MPItemView>
</ns2:MPItemViews>',
    ],
    'GET /v2/items/NO11140_7022363' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:MPItemViews xmlns:ns2="http://walmart.com/">
   <ns2:MPItemView>
      <ns2:mart>WALMART_US</ns2:mart>
      <ns2:sku>NO11140_7022363</ns2:sku>
      <ns2:gtin>00313159099947</ns2:gtin>
      <ns2:productName>Carex Soft Grip Folding Cane - Black Walking Cane</ns2:productName>
      <ns2:productType>Walking Canes</ns2:productType>
      <ns2:price>
         <ns2:currency>USD</ns2:currency>
         <ns2:amount>13.27</ns2:amount>
      </ns2:price>
      <ns2:publishedStatus>IN_PROGRESS</ns2:publishedStatus>
   </ns2:MPItemView>
</ns2:MPItemViews>',
    ],
    'DELETE /v2/items/NO11140_7022363' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:ItemRetireResponse xmlns:ns2="http://walmart.com/">
   <ns2:sku>NO11140_7022363</ns2:sku>
   <ns2:message>Thank you. Your item has been submitted for retirement from Walmart Catalog. Please note that it can take up to 48 hours for items to be retired from our catalog.</ns2:message>
</ns2:ItemRetireResponse>'
    ],
    

];
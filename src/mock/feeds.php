<?php
return [
    'POST /v2/feeds?feedType=item' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:FeedAcknowledgement xmlns:ns2="http://walmart.com/">
   <ns2:feedId>62a05384-37cd-4afc-95ca-c68241e6902a</ns2:feedId>
</ns2:FeedAcknowledgement>'
    ],

    'GET /v2/feeds' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:list xmlns:ns2="http://walmart.com/">
   <ns2:totalResults>204990</ns2:totalResults>
   <ns2:offset>0</ns2:offset>
   <ns2:limit>2</ns2:limit>
   <ns2:results>
      <ns2:feed>
         <ns2:feedId>ca16ba60-bf0d-4f2a-b679-6dc9b7b0ece0</ns2:feedId>
         <ns2:partnerId>-1</ns2:partnerId>
         <ns2:itemsReceived>1</ns2:itemsReceived>
         <ns2:itemsSucceeded>0</ns2:itemsSucceeded>
         <ns2:itemsFailed>1</ns2:itemsFailed>
         <ns2:itemsProcessing>0</ns2:itemsProcessing>
         <ns2:feedStatus>ERROR</ns2:feedStatus>
         <ns2:feedDate>2015-10-05T18:56:57.033Z</ns2:feedDate>
         <ns2:batchId>samssupr-1444071407399</ns2:batchId>
         <ns2:modifiedDtm>2015-10-05T18:56:57.907Z</ns2:modifiedDtm>
      </ns2:feed>
      <ns2:feed>
         <ns2:feedId>342a7da5-8661-4c1c-a902-9a01c83d9164</ns2:feedId>
         <ns2:feedSource>MP_ITEM_RETIRE</ns2:feedSource>
         <ns2:partnerId>321146</ns2:partnerId>
         <ns2:itemsReceived>1</ns2:itemsReceived>
         <ns2:itemsSucceeded>0</ns2:itemsSucceeded>
         <ns2:itemsFailed>0</ns2:itemsFailed>
         <ns2:itemsProcessing>1</ns2:itemsProcessing>
         <ns2:feedStatus>INPROGRESS</ns2:feedStatus>
         <ns2:feedDate>2015-10-05T18:56:56.376Z</ns2:feedDate>
         <ns2:modifiedDtm>2015-10-05T18:56:56.376Z</ns2:modifiedDtm>
      </ns2:feed>
   </ns2:results>
</ns2:list>',
    ],

    'GET /v2/feeds/1898c657-085c-4761-95fa-4ae515025e87?includeDetails=true' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:PartnerFeedResponse xmlns:ns2="http://walmart.com/">
   <ns2:feedId>1c349f8f-aec0-411f-8454-ead47d12946f</ns2:feedId>
   <ns2:feedStatus>PROCESSED</ns2:feedStatus>
   <ns2:ingestionErrors />
   <ns2:itemsReceived>11</ns2:itemsReceived>
   <ns2:itemsSucceeded>11</ns2:itemsSucceeded>
   <ns2:itemsFailed>0</ns2:itemsFailed>
   <ns2:itemsProcessing>0</ns2:itemsProcessing>
   <ns2:offset>0</ns2:offset>
   <ns2:limit>0</ns2:limit>
   <ns2:itemDetails>
      <ns2:itemIngestionStatus>
         <ns2:martId>0</ns2:martId>
         <ns2:sku>sku1</ns2:sku>
         <ns2:index>8</ns2:index>
         <ns2:ingestionStatus>SUCCESS</ns2:ingestionStatus>
         <ns2:ingestionErrors />
      </ns2:itemIngestionStatus>
      <ns2:itemIngestionStatus>
         <ns2:martId>0</ns2:martId>
         <ns2:sku>sku2</ns2:sku>
         <ns2:index>6</ns2:index>
         <ns2:ingestionStatus>SUCCESS</ns2:ingestionStatus>
         <ns2:ingestionErrors />
      </ns2:itemIngestionStatus>
      <ns2:itemIngestionStatus>
         <ns2:martId>0</ns2:martId>
         <ns2:sku>sku3</ns2:sku>
         <ns2:index>9</ns2:index>
         <ns2:ingestionStatus>SUCCESS</ns2:ingestionStatus>
         <ns2:ingestionErrors />
      </ns2:itemIngestionStatus>
   </ns2:itemDetails>
</ns2:PartnerFeedResponse>',
    ],

    'GET /v2/feeds/feeditems/09a3f1b2-3852-4b87-b7e4-2715b3d7a52e?includeDetails=true&limit=3' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:ItemStatusDetail xmlns:ns2="http://walmart.com/">
   <ns2:meta>
      <ns2:feedId>09a3f1b2-3852-4b87-b7e4-2715b3d7a52e</ns2:feedId>
      <ns2:feedStatus>INPROGRESS</ns2:feedStatus>
      <ns2:ingestionErrors />
      <ns2:itemsReceived>1039</ns2:itemsReceived>
      <ns2:itemsSucceeded>0</ns2:itemsSucceeded>
      <ns2:itemsFailed>1035</ns2:itemsFailed>
      <ns2:itemsProcessing>4</ns2:itemsProcessing>
      <ns2:limit>3</ns2:limit>
      <ns2:totalCount>3</ns2:totalCount>
      <ns2:nextCursor>includeDetails=true&amp;limit=3&amp;skuOffset=ENC%28Mt7xh%2BZElQ7DXaQPx5hq7UIhBQD7RbIG%29</ns2:nextCursor>
   </ns2:meta>
   <ns2:elements>
      <ns2:itemDetails>
         <ns2:itemIngestionStatus>
            <ns2:martId>0</ns2:martId>
            <ns2:sku>66380000767</ns2:sku>
            <ns2:index>3</ns2:index>
            <ns2:ingestionStatus>INPROGRESS</ns2:ingestionStatus>
            <ns2:ingestionErrors />
         </ns2:itemIngestionStatus>
         <ns2:itemIngestionStatus>
            <ns2:martId>0</ns2:martId>
            <ns2:sku>66380000768</ns2:sku>
            <ns2:index>4</ns2:index>
            <ns2:ingestionStatus>INPROGRESS</ns2:ingestionStatus>
            <ns2:ingestionErrors />
         </ns2:itemIngestionStatus>
         <ns2:itemIngestionStatus>
            <ns2:martId>0</ns2:martId>
            <ns2:sku>66380000769</ns2:sku>
            <ns2:index>5</ns2:index>
            <ns2:ingestionStatus>DATA_ERROR</ns2:ingestionStatus>
            <ns2:ingestionErrors>
               <ns2:ingestionError>
                  <ns2:type>DATA_ERROR</ns2:type>
                  <ns2:code>ERR_PDI_0003</ns2:code>
                  <ns2:description>Input XML validation failed.   The value \'6\' of element \'compositeWoodCertificationCode\' is not valid. Value \'6\' is not facet-valid with respect to enumeration \'[5, 4, 3, 2, 1]\'. It must be a value from the enumeration.</ns2:description>
               </ns2:ingestionError>
            </ns2:ingestionErrors>
         </ns2:itemIngestionStatus>
      </ns2:itemDetails>
   </ns2:elements>
</ns2:ItemStatusDetail>',
    ],

    'POST /v2/feeds?feedType=inventory' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns2:FeedAcknowledgement xmlns:ns2="http://walmart.com/">
   <ns2:feedId>62a05384-37cd-4afc-95ca-c68241e6902a</ns2:feedId>
</ns2:FeedAcknowledgement>'
    ],

    'POST /v2/feeds?feedType=price' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<ns2:FeedAcknowledgement xmlns:ns2="http://walmart.com/">
   <ns2:feedId>3cd3c0e4-7c60-450b-b66c-a8753d1ed601</ns2:feedId>
</ns2:FeedAcknowledgement>'
    ]

];
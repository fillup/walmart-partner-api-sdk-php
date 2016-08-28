<?php
return [
    'GET /v3/orders/released?limit=5&createdStartDate=2016-10-01' => [
        'status' => 404,
        'headers' => [],
        'body' => '',
    ],

    'GET /v3/orders?status=Shipped&createdStartDate=2016-10-01&limit=5' => [
        'status' => 404,
        'headers' => [],
        'body' => '',
    ],

    'GET /v3/orders/released?limit=2&createdStartDate=2016-06-01' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<ns3:list xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:meta>
        <ns3:totalCount>367</ns3:totalCount>
        <ns3:limit>10</ns3:limit>
        <ns3:nextCursor>?limit=10&amp;hasMoreElements=true&amp;soIndex=2&amp;poIndex=2&amp;sellerId=10&amp;status=Created&amp;
            createdStartDate=2016-01-01&amp;createdEndDate=2016-06-03T22:45:16.377Z
        </ns3:nextCursor>
    </ns3:meta>
    <ns3:elements>
        <ns3:order>
            <ns3:purchaseOrderId>2575263094491</ns3:purchaseOrderId>
            <ns3:customerOrderId>4091603648841</ns3:customerOrderId>
            <ns3:customerEmailId>gsingh@walmartlabs.com</ns3:customerEmailId>
            <ns3:orderDate>2016-05-18T16:53:14.000Z</ns3:orderDate>
            <ns3:shippingInfo>
                <ns3:phone>2342423234</ns3:phone>
                <ns3:estimatedDeliveryDate>2016-06-22T06:00:00.000Z</ns3:estimatedDeliveryDate>
                <ns3:estimatedShipDate>2016-06-15T06:00:00.000Z</ns3:estimatedShipDate>
                <ns3:methodCode>Standard</ns3:methodCode>
                <ns3:postalAddress>
                    <ns3:name>PGOMS Walmart</ns3:name>
                    <ns3:address1>850 Cherry Avenue</ns3:address1>
                    <ns3:address2>Floor 5</ns3:address2>
                    <ns3:city>San Bruno</ns3:city>
                    <ns3:state>CA</ns3:state>
                    <ns3:postalCode>94066</ns3:postalCode>
                    <ns3:country>USA</ns3:country>
                    <ns3:addressType>RESIDENTIAL</ns3:addressType>
                </ns3:postalAddress>
            </ns3:shippingInfo>
            <ns3:orderLines>
                <ns3:orderLine>
                    <ns3:lineNumber>4</ns3:lineNumber>
                    <ns3:item>
                        <ns3:productName>Kenmore CF1 or 2086883 Canister Secondary Filter Generic 2 Pack
                        </ns3:productName>
                        <ns3:sku>RCA-OF-444gku444</ns3:sku>
                    </ns3:item>
                    <ns3:charges>
                        <ns3:charge>
                            <ns3:chargeType>PRODUCT</ns3:chargeType>
                            <ns3:chargeName>ItemPrice</ns3:chargeName>
                            <ns3:chargeAmount>
                                <ns3:currency>USD</ns3:currency>
                                <ns3:amount>25.00</ns3:amount>
                            </ns3:chargeAmount>
                            <ns3:tax>
                                <ns3:taxName>Tax1</ns3:taxName>
                                <ns3:taxAmount>
                                    <ns3:currency>USD</ns3:currency>
                                    <ns3:amount>1.87</ns3:amount>
                                </ns3:taxAmount>
                            </ns3:tax>
                        </ns3:charge>
                    </ns3:charges>
                    <ns3:orderLineQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:orderLineQuantity>
                    <ns3:statusDate>2016-05-18T17:01:26.000Z</ns3:statusDate>
                    <ns3:orderLineStatuses>
                        <ns3:orderLineStatus>
                            <ns3:status>Created</ns3:status>
                            <ns3:statusQuantity>
                                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                                <ns3:amount>1</ns3:amount>
                            </ns3:statusQuantity>
                        </ns3:orderLineStatus>
                    </ns3:orderLineStatuses>
                </ns3:orderLine>
            </ns3:orderLines>
        </ns3:order>
        <ns3:order>
            <ns3:purchaseOrderId>2575263094492</ns3:purchaseOrderId>
            <ns3:customerOrderId>4091603648841</ns3:customerOrderId>
            <ns3:customerEmailId>gsingh@walmartlabs.com</ns3:customerEmailId>
            <ns3:orderDate>2016-05-18T16:53:14.000Z</ns3:orderDate>
            <ns3:shippingInfo>
                <ns3:phone>2342423234</ns3:phone>
                <ns3:estimatedDeliveryDate>2016-06-22T06:00:00.000Z</ns3:estimatedDeliveryDate>
                <ns3:estimatedShipDate>2016-06-15T06:00:00.000Z</ns3:estimatedShipDate>
                <ns3:methodCode>Standard</ns3:methodCode>
                <ns3:postalAddress>
                    <ns3:name>PGOMS Walmart</ns3:name>
                    <ns3:address1>850 Cherry Avenue</ns3:address1>
                    <ns3:address2>Floor 5</ns3:address2>
                    <ns3:city>San Bruno</ns3:city>
                    <ns3:state>CA</ns3:state>
                    <ns3:postalCode>94066</ns3:postalCode>
                    <ns3:country>USA</ns3:country>
                    <ns3:addressType>RESIDENTIAL</ns3:addressType>
                </ns3:postalAddress>
            </ns3:shippingInfo>
            <ns3:orderLines>
                <ns3:orderLine>
                    <ns3:lineNumber>1</ns3:lineNumber>
                    <ns3:item>
                        <ns3:productName>Kenmore CF1 or 2086883 Canister Secondary Filter Generic 2 Pack
                        </ns3:productName>
                        <ns3:sku>RCA-OF-444gku444</ns3:sku>
                    </ns3:item>
                    <ns3:charges>
                        <ns3:charge>
                            <ns3:chargeType>PRODUCT</ns3:chargeType>
                            <ns3:chargeName>ItemPrice</ns3:chargeName>
                            <ns3:chargeAmount>
                                <ns3:currency>USD</ns3:currency>
                                <ns3:amount>25.00</ns3:amount>
                            </ns3:chargeAmount>
                            <ns3:tax>
                                <ns3:taxName>Tax1</ns3:taxName>
                                <ns3:taxAmount>
                                    <ns3:currency>USD</ns3:currency>
                                    <ns3:amount>1.89</ns3:amount>
                                </ns3:taxAmount>
                            </ns3:tax>
                        </ns3:charge>
                    </ns3:charges>
                    <ns3:orderLineQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:orderLineQuantity>
                    <ns3:statusDate>2016-05-18T17:01:26.000Z</ns3:statusDate>
                    <ns3:orderLineStatuses>
                        <ns3:orderLineStatus>
                            <ns3:status>Created</ns3:status>
                            <ns3:statusQuantity>
                                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                                <ns3:amount>1</ns3:amount>
                            </ns3:statusQuantity>
                        </ns3:orderLineStatus>
                    </ns3:orderLineStatuses>
                </ns3:orderLine>
            </ns3:orderLines>
        </ns3:order>
    </ns3:elements>
</ns3:list>'
    ],

    'GET /v3/orders?createdStartDate=2016-06-01&limit=10' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<ns3:list xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:meta>
        <ns3:totalCount>367</ns3:totalCount>
        <ns3:limit>10</ns3:limit>
        <ns3:nextCursor>?limit=10&amp;hasMoreElements=true&amp;soIndex=2&amp;poIndex=2&amp;sellerId=10&amp;status=Created&amp;
            createdStartDate=2016-01-01&amp;createdEndDate=2016-06-03T22:45:16.377Z
        </ns3:nextCursor>
    </ns3:meta>
    <ns3:elements>
        <ns3:order>
            <ns3:purchaseOrderId>2575263094491</ns3:purchaseOrderId>
            <ns3:customerOrderId>4091603648841</ns3:customerOrderId>
            <ns3:customerEmailId>gsingh@walmartlabs.com</ns3:customerEmailId>
            <ns3:orderDate>2016-05-18T16:53:14.000Z</ns3:orderDate>
            <ns3:shippingInfo>
                <ns3:phone>2342423234</ns3:phone>
                <ns3:estimatedDeliveryDate>2016-06-22T06:00:00.000Z</ns3:estimatedDeliveryDate>
                <ns3:estimatedShipDate>2016-06-15T06:00:00.000Z</ns3:estimatedShipDate>
                <ns3:methodCode>Standard</ns3:methodCode>
                <ns3:postalAddress>
                    <ns3:name>PGOMS Walmart</ns3:name>
                    <ns3:address1>850 Cherry Avenue</ns3:address1>
                    <ns3:address2>Floor 5</ns3:address2>
                    <ns3:city>San Bruno</ns3:city>
                    <ns3:state>CA</ns3:state>
                    <ns3:postalCode>94066</ns3:postalCode>
                    <ns3:country>USA</ns3:country>
                    <ns3:addressType>RESIDENTIAL</ns3:addressType>
                </ns3:postalAddress>
            </ns3:shippingInfo>
            <ns3:orderLines>
                <ns3:orderLine>
                    <ns3:lineNumber>4</ns3:lineNumber>
                    <ns3:item>
                        <ns3:productName>Kenmore CF1 or 2086883 Canister Secondary Filter Generic 2 Pack
                        </ns3:productName>
                        <ns3:sku>RCA-OF-444gku444</ns3:sku>
                    </ns3:item>
                    <ns3:charges>
                        <ns3:charge>
                            <ns3:chargeType>PRODUCT</ns3:chargeType>
                            <ns3:chargeName>ItemPrice</ns3:chargeName>
                            <ns3:chargeAmount>
                                <ns3:currency>USD</ns3:currency>
                                <ns3:amount>25.00</ns3:amount>
                            </ns3:chargeAmount>
                            <ns3:tax>
                                <ns3:taxName>Tax1</ns3:taxName>
                                <ns3:taxAmount>
                                    <ns3:currency>USD</ns3:currency>
                                    <ns3:amount>1.87</ns3:amount>
                                </ns3:taxAmount>
                            </ns3:tax>
                        </ns3:charge>
                    </ns3:charges>
                    <ns3:orderLineQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:orderLineQuantity>
                    <ns3:statusDate>2016-05-18T17:01:26.000Z</ns3:statusDate>
                    <ns3:orderLineStatuses>
                        <ns3:orderLineStatus>
                            <ns3:status>Created</ns3:status>
                            <ns3:statusQuantity>
                                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                                <ns3:amount>1</ns3:amount>
                            </ns3:statusQuantity>
                        </ns3:orderLineStatus>
                    </ns3:orderLineStatuses>
                </ns3:orderLine>
            </ns3:orderLines>
        </ns3:order>
        <ns3:order>
            <ns3:purchaseOrderId>2575263094492</ns3:purchaseOrderId>
            <ns3:customerOrderId>4091603648841</ns3:customerOrderId>
            <ns3:customerEmailId>gsingh@walmartlabs.com</ns3:customerEmailId>
            <ns3:orderDate>2016-05-18T16:53:14.000Z</ns3:orderDate>
            <ns3:shippingInfo>
                <ns3:phone>2342423234</ns3:phone>
                <ns3:estimatedDeliveryDate>2016-06-22T06:00:00.000Z</ns3:estimatedDeliveryDate>
                <ns3:estimatedShipDate>2016-06-15T06:00:00.000Z</ns3:estimatedShipDate>
                <ns3:methodCode>Standard</ns3:methodCode>
                <ns3:postalAddress>
                    <ns3:name>PGOMS Walmart</ns3:name>
                    <ns3:address1>850 Cherry Avenue</ns3:address1>
                    <ns3:address2>Floor 5</ns3:address2>
                    <ns3:city>San Bruno</ns3:city>
                    <ns3:state>CA</ns3:state>
                    <ns3:postalCode>94066</ns3:postalCode>
                    <ns3:country>USA</ns3:country>
                    <ns3:addressType>RESIDENTIAL</ns3:addressType>
                </ns3:postalAddress>
            </ns3:shippingInfo>
            <ns3:orderLines>
                <ns3:orderLine>
                    <ns3:lineNumber>1</ns3:lineNumber>
                    <ns3:item>
                        <ns3:productName>Kenmore CF1 or 2086883 Canister Secondary Filter Generic 2 Pack
                        </ns3:productName>
                        <ns3:sku>RCA-OF-444gku444</ns3:sku>
                    </ns3:item>
                    <ns3:charges>
                        <ns3:charge>
                            <ns3:chargeType>PRODUCT</ns3:chargeType>
                            <ns3:chargeName>ItemPrice</ns3:chargeName>
                            <ns3:chargeAmount>
                                <ns3:currency>USD</ns3:currency>
                                <ns3:amount>25.00</ns3:amount>
                            </ns3:chargeAmount>
                            <ns3:tax>
                                <ns3:taxName>Tax1</ns3:taxName>
                                <ns3:taxAmount>
                                    <ns3:currency>USD</ns3:currency>
                                    <ns3:amount>1.89</ns3:amount>
                                </ns3:taxAmount>
                            </ns3:tax>
                        </ns3:charge>
                    </ns3:charges>
                    <ns3:orderLineQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:orderLineQuantity>
                    <ns3:statusDate>2016-05-18T17:01:26.000Z</ns3:statusDate>
                    <ns3:orderLineStatuses>
                        <ns3:orderLineStatus>
                            <ns3:status>Created</ns3:status>
                            <ns3:statusQuantity>
                                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                                <ns3:amount>1</ns3:amount>
                            </ns3:statusQuantity>
                        </ns3:orderLineStatus>
                    </ns3:orderLineStatuses>
                </ns3:orderLine>
            </ns3:orderLines>
        </ns3:order>
    </ns3:elements>
</ns3:list>'
    ],

    'GET /v3/orders/2575693098967' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<ns3:order xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:purchaseOrderId>2575693098967</ns3:purchaseOrderId>
    <ns3:customerOrderId>4021603941547</ns3:customerOrderId>
    <ns3:customerEmailId>mgr@walmartlabs.com</ns3:customerEmailId>
    <ns3:orderDate>2016-05-11T23:16:10.000Z</ns3:orderDate>
    <ns3:shippingInfo>
        <ns3:phone>6502248603</ns3:phone>
        <ns3:estimatedDeliveryDate>2016-05-20T17:00:00.000Z</ns3:estimatedDeliveryDate>
        <ns3:estimatedShipDate>2016-05-16T17:00:00.000Z</ns3:estimatedShipDate>
        <ns3:methodCode>Standard</ns3:methodCode>
        <ns3:postalAddress>
            <ns3:name>Madhukara PGOMS</ns3:name>
            <ns3:address1>860 W Cal Ave</ns3:address1>
            <ns3:address2>Seat # 860C.2.176</ns3:address2>
            <ns3:city>Sunnyvale</ns3:city>
            <ns3:state>CA</ns3:state>
            <ns3:postalCode>94086</ns3:postalCode>
            <ns3:country>USA</ns3:country>
            <ns3:addressType>RESIDENTIAL</ns3:addressType>
        </ns3:postalAddress>
    </ns3:shippingInfo>
    <ns3:orderLines>
        <ns3:orderLine>
            <ns3:lineNumber>1</ns3:lineNumber>
            <ns3:item>
                <ns3:productName>Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic</ns3:productName>
                <ns3:sku>GRMN100201</ns3:sku>
            </ns3:item>
            <ns3:charges>
                <ns3:charge>
                    <ns3:chargeType>PRODUCT</ns3:chargeType>
                    <ns3:chargeName>ItemPrice</ns3:chargeName>
                    <ns3:chargeAmount>
                        <ns3:currency>USD</ns3:currency>
                        <ns3:amount>124.98</ns3:amount>
                    </ns3:chargeAmount>
                    <ns3:tax>
                        <ns3:taxName>Tax1</ns3:taxName>
                        <ns3:taxAmount>
                            <ns3:currency>USD</ns3:currency>
                            <ns3:amount>10.94</ns3:amount>
                        </ns3:taxAmount>
                    </ns3:tax>
                </ns3:charge>
            </ns3:charges>
            <ns3:orderLineQuantity>
                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                <ns3:amount>1</ns3:amount>
            </ns3:orderLineQuantity>
            <ns3:statusDate>2016-05-11T23:43:50.000Z</ns3:statusDate>
            <ns3:orderLineStatuses>
                <ns3:orderLineStatus>
                    <ns3:status>Created</ns3:status>
                    <ns3:statusQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:statusQuantity>
                </ns3:orderLineStatus>
            </ns3:orderLineStatuses>
        </ns3:orderLine>
    </ns3:orderLines>
</ns3:order>'
    ],

    'POST /v3/orders/2575693098967/acknowledge' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8"?>
<ns3:order xmlns:ns3="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/">
   <ns3:purchaseOrderId>2575693098967</ns3:purchaseOrderId>
   <ns3:customerOrderId>5591500903533</ns3:customerOrderId>
   <ns3:customerEmailId>walsim-dev+-xvo_8j5fyi@cognitect.com</ns3:customerEmailId>
   <ns3:orderDate>2015-10-15T21:32:55.000Z</ns3:orderDate>
   <ns3:shippingInfo>
      <ns3:phone>(919) 555-1212</ns3:phone>
      <ns3:estimatedDeliveryDate>2015-10-16T06:59:59.000Z</ns3:estimatedDeliveryDate>
      <ns3:methodCode>Standard</ns3:methodCode>
      <ns3:postalAddress>
         <ns3:name>SimTest_Accept PGOMS</ns3:name>
         <ns3:address1>303 S Roxboro St.</ns3:address1>
         <ns3:address2>Suite 10</ns3:address2>
         <ns3:city>Durham</ns3:city>
         <ns3:state>NC</ns3:state>
         <ns3:postalCode>27701</ns3:postalCode>
         <ns3:country>USA</ns3:country>
         <ns3:addressType>OFFICE</ns3:addressType>
      </ns3:postalAddress>
   </ns3:shippingInfo>
   <ns3:orderLines>
      <ns3:orderLine>
         <ns3:lineNumber>1</ns3:lineNumber>
         <ns3:item>
            <ns3:productName>The Bowflex Classic C10 Heart Rate Monitor Watch</ns3:productName>
            <ns3:sku>BOW1020_6096338</ns3:sku>
         </ns3:item>
         <ns3:charges>
            <ns3:charge>
               <ns3:chargeType>PRODUCT</ns3:chargeType>
               <ns3:chargeName>ItemPrice</ns3:chargeName>
               <ns3:chargeAmount>
                  <ns3:currency>USD</ns3:currency>
                  <ns3:amount>45.00</ns3:amount>
               </ns3:chargeAmount>
               <ns3:tax>
                  <ns3:taxName>ItemPrice</ns3:taxName>
                  <ns3:taxAmount>
                     <ns3:currency>USD</ns3:currency>
                     <ns3:amount>3.38</ns3:amount>
                  </ns3:taxAmount>
               </ns3:tax>
            </ns3:charge>
            <ns3:charge>
               <ns3:chargeType>SHIPPING</ns3:chargeType>
               <ns3:chargeName>Shipping</ns3:chargeName>
               <ns3:chargeAmount>
                  <ns3:currency>USD</ns3:currency>
                  <ns3:amount>4.99</ns3:amount>
               </ns3:chargeAmount>
               <ns3:tax>
                  <ns3:taxName>Shipping</ns3:taxName>
                  <ns3:taxAmount>
                     <ns3:currency>USD</ns3:currency>
                     <ns3:amount>0.37</ns3:amount>
                  </ns3:taxAmount>
               </ns3:tax>
            </ns3:charge>
         </ns3:charges>
         <ns3:orderLineQuantity>
            <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
            <ns3:amount>1</ns3:amount>
         </ns3:orderLineQuantity>
         <ns3:statusDate>2015-10-16T14:51:02.000Z</ns3:statusDate>
         <ns3:orderLineStatuses>
            <ns3:orderLineStatus>
               <ns3:status>Acknowledged</ns3:status>
               <ns3:statusQuantity>
                  <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                  <ns3:amount>1</ns3:amount>
               </ns3:statusQuantity>
            </ns3:orderLineStatus>
         </ns3:orderLineStatuses>
      </ns3:orderLine>
   </ns3:orderLines>
</ns3:order>'
    ],

    'POST /v3/orders/2575693098947/cancel' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<ns3:order xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:purchaseOrderId>2575693098947</ns3:purchaseOrderId>
    <ns3:customerOrderId>4021603441441</ns3:customerOrderId>
    <ns3:customerEmailId>mgr@walmartlabs.com</ns3:customerEmailId>
    <ns3:orderDate>2016-05-11T22:59:03.000Z</ns3:orderDate>
    <ns3:shippingInfo>
        <ns3:phone>6502248603</ns3:phone>
        <ns3:estimatedDeliveryDate>2016-05-20T17:00:00.000Z</ns3:estimatedDeliveryDate>
        <ns3:estimatedShipDate>2016-05-16T17:00:00.000Z</ns3:estimatedShipDate>
        <ns3:methodCode>Standard</ns3:methodCode>
        <ns3:postalAddress>
            <ns3:name>Madhukara PGOMS</ns3:name>
            <ns3:address1>860 W Cal Ave</ns3:address1>
            <ns3:address2>Seat # 860C.2.176</ns3:address2>
            <ns3:city>Sunnyvale</ns3:city>
            <ns3:state>CA</ns3:state>
            <ns3:postalCode>94086</ns3:postalCode>
            <ns3:country>USA</ns3:country>
            <ns3:addressType>RESIDENTIAL</ns3:addressType>
        </ns3:postalAddress>
    </ns3:shippingInfo>
    <ns3:orderLines>
        <ns3:orderLine>
            <ns3:lineNumber>1</ns3:lineNumber>
            <ns3:item>
                <ns3:productName>Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic</ns3:productName>
                <ns3:sku>GRMN100201</ns3:sku>
            </ns3:item>
            <ns3:charges>
                <ns3:charge>
                    <ns3:chargeType>PRODUCT</ns3:chargeType>
                    <ns3:chargeName>ItemPrice</ns3:chargeName>
                    <ns3:chargeAmount>
                        <ns3:currency>USD</ns3:currency>
                        <ns3:amount>0.00</ns3:amount>
                    </ns3:chargeAmount>
                    <ns3:tax>
                        <ns3:taxName>Tax1</ns3:taxName>
                        <ns3:taxAmount>
                            <ns3:currency>USD</ns3:currency>
                            <ns3:amount>0.00</ns3:amount>
                        </ns3:taxAmount>
                    </ns3:tax>
                </ns3:charge>
            </ns3:charges>
            <ns3:orderLineQuantity>
                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                <ns3:amount>1</ns3:amount>
            </ns3:orderLineQuantity>
            <ns3:statusDate>2016-06-04T00:20:15.000Z</ns3:statusDate>
            <ns3:orderLineStatuses>
                <ns3:orderLineStatus>
                    <ns3:status>Cancelled</ns3:status>
                    <ns3:statusQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:statusQuantity>
                </ns3:orderLineStatus>
            </ns3:orderLineStatuses>
        </ns3:orderLine>
    </ns3:orderLines>
</ns3:order>'
    ],

    'POST /v3/orders/123456789/refund' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<ns3:order
        xmlns:ns2="http://walmart.com/mp/orders"
        xmlns:ns3="http://walmart.com/mp/v3/orders"
        xmlns:ns4="http://walmart.com/">
    <ns3:purchaseOrderId>2575193093772</ns3:purchaseOrderId>
    <ns3:customerOrderId>4021603841173</ns3:customerOrderId>
    <ns3:customerEmailId>mgr@walmartlabs.com</ns3:customerEmailId>
    <ns3:orderDate>2016-05-11T22:55:28.000Z</ns3:orderDate>
    <ns3:shippingInfo>
        <ns3:phone>6502248603</ns3:phone>
        <ns3:estimatedDeliveryDate>2016-05-20T17:00:00.000Z</ns3:estimatedDeliveryDate>
        <ns3:estimatedShipDate>2016-05-16T17:00:00.000Z</ns3:estimatedShipDate>
        <ns3:methodCode>Standard</ns3:methodCode>
        <ns3:postalAddress>
            <ns3:name>Madhukara PGOMS</ns3:name>
            <ns3:address1>860 W Cal Ave</ns3:address1>
            <ns3:address2>Seat # 860C.2.176</ns3:address2>
            <ns3:city>Sunnyvale</ns3:city>
            <ns3:state>CA</ns3:state>
            <ns3:postalCode>94086</ns3:postalCode>
            <ns3:country>USA</ns3:country>
            <ns3:addressType>RESIDENTIAL</ns3:addressType>
        </ns3:postalAddress>
    </ns3:shippingInfo>
    <ns3:orderLines>
        <ns3:orderLine>
            <ns3:lineNumber>2</ns3:lineNumber>
            <ns3:item>
                <ns3:productName>Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic</ns3:productName>
                <ns3:sku>GRMN100201</ns3:sku>
            </ns3:item>
            <ns3:charges>
                <ns3:charge>
                    <ns3:chargeType>PRODUCT</ns3:chargeType>
                    <ns3:chargeName>ItemPrice</ns3:chargeName>
                    <ns3:chargeAmount>
                        <ns3:currency>USD</ns3:currency>
                        <ns3:amount>124.98</ns3:amount>
                    </ns3:chargeAmount>
                    <ns3:tax>
                        <ns3:taxName>Tax1</ns3:taxName>
                        <ns3:taxAmount>
                            <ns3:currency>USD</ns3:currency>
                            <ns3:amount>10.93</ns3:amount>
                        </ns3:taxAmount>
                    </ns3:tax>
                </ns3:charge>
            </ns3:charges>
            <ns3:orderLineQuantity>
                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                <ns3:amount>1</ns3:amount>
            </ns3:orderLineQuantity>
            <ns3:statusDate>2016-06-03T23:48:00.000Z</ns3:statusDate>
            <ns3:orderLineStatuses>
                <ns3:orderLineStatus>
                    <ns3:status>Shipped</ns3:status>
                    <ns3:statusQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:statusQuantity>
                    <ns3:trackingInfo>
                        <ns3:shipDateTime>2016-06-27T05:30:15.000Z</ns3:shipDateTime>
                        <ns3:carrierName>
                            <ns3:carrier>FedEx</ns3:carrier>
                        </ns3:carrierName>
                        <ns3:methodCode>Standard</ns3:methodCode>
                        <ns3:trackingNumber>12333634122</ns3:trackingNumber>
                        <ns3:trackingURL>http://www.fedex.com</ns3:trackingURL>
                    </ns3:trackingInfo>
                </ns3:orderLineStatus>
            </ns3:orderLineStatuses>
            <ns3:refund>
                <ns3:refundCharges>
                    <ns3:refundCharge>
                        <ns3:refundReason>DamagedItem</ns3:refundReason>
                        <ns3:charge>
                            <ns3:chargeType>PRODUCT</ns3:chargeType>
                            <ns3:chargeName>Damaged</ns3:chargeName>
                            <ns3:chargeAmount>
                                <ns3:currency>USD</ns3:currency>
                                <ns3:amount>-10.02</ns3:amount>
                            </ns3:chargeAmount>
                            <ns3:tax>
                                <ns3:taxName>Product</ns3:taxName>
                                <ns3:taxAmount>
                                    <ns3:currency>USD</ns3:currency>
                                    <ns3:amount>-5.03</ns3:amount>
                                </ns3:taxAmount>
                            </ns3:tax>
                        </ns3:charge>
                    </ns3:refundCharge>
                </ns3:refundCharges>
            </ns3:refund>
        </ns3:orderLine>
    </ns3:orderLines>
</ns3:order>'
    ],

    'POST /v3/orders/2575683098510/shipping' => [
        'status' => 200,
        'headers' => [],
        'body' => '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<ns3:order xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:purchaseOrderId>2575683098510</ns3:purchaseOrderId>
    <ns3:customerOrderId>4021603841173</ns3:customerOrderId>
    <ns3:customerEmailId>mgr@walmartlabs.com</ns3:customerEmailId>
    <ns3:orderDate>2016-05-11T22:55:28.000Z</ns3:orderDate>
    <ns3:shippingInfo>
        <ns3:phone>6502248603</ns3:phone>
        <ns3:estimatedDeliveryDate>2016-05-20T17:00:00.000Z</ns3:estimatedDeliveryDate>
        <ns3:estimatedShipDate>2016-05-16T17:00:00.000Z</ns3:estimatedShipDate>
        <ns3:methodCode>Standard</ns3:methodCode>
        <ns3:postalAddress>
            <ns3:name>Madhukara PGOMS</ns3:name>
            <ns3:address1>860 W Cal Ave</ns3:address1>
            <ns3:address2>Seat # 860C.2.176</ns3:address2>
            <ns3:city>Sunnyvale</ns3:city>
            <ns3:state>CA</ns3:state>
            <ns3:postalCode>94086</ns3:postalCode>
            <ns3:country>USA</ns3:country>
            <ns3:addressType>RESIDENTIAL</ns3:addressType>
        </ns3:postalAddress>
    </ns3:shippingInfo>
    <ns3:orderLines>
        <ns3:orderLine>
            <ns3:lineNumber>2</ns3:lineNumber>
            <ns3:item>
                <ns3:productName>Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic</ns3:productName>
                <ns3:sku>GRMN100201</ns3:sku>
            </ns3:item>
            <ns3:charges>
                <ns3:charge>
                    <ns3:chargeType>PRODUCT</ns3:chargeType>
                    <ns3:chargeName>ItemPrice</ns3:chargeName>
                    <ns3:chargeAmount>
                        <ns3:currency>USD</ns3:currency>
                        <ns3:amount>124.98</ns3:amount>
                    </ns3:chargeAmount>
                    <ns3:tax>
                        <ns3:taxName>Tax1</ns3:taxName>
                        <ns3:taxAmount>
                            <ns3:currency>USD</ns3:currency>
                            <ns3:amount>10.93</ns3:amount>
                        </ns3:taxAmount>
                    </ns3:tax>
                </ns3:charge>
            </ns3:charges>
            <ns3:orderLineQuantity>
                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                <ns3:amount>1</ns3:amount>
            </ns3:orderLineQuantity>
            <ns3:statusDate>2016-06-03T23:44:41.000Z</ns3:statusDate>
            <ns3:orderLineStatuses>
                <ns3:orderLineStatus>
                    <ns3:status>Shipped</ns3:status>
                    <ns3:statusQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:statusQuantity>
                    <ns3:trackingInfo>
                        <ns3:shipDateTime>2016-06-27T05:30:15.000Z</ns3:shipDateTime>
                        <ns3:carrierName>
                            <ns3:carrier>FedEx</ns3:carrier>
                        </ns3:carrierName>
                        <ns3:methodCode>Standard</ns3:methodCode>
                        <ns3:trackingNumber>12333634122</ns3:trackingNumber>
                        <ns3:trackingURL>http://www.fedex.com</ns3:trackingURL>
                    </ns3:trackingInfo>
                </ns3:orderLineStatus>
            </ns3:orderLineStatuses>
        </ns3:orderLine>
    </ns3:orderLines>
</ns3:order>'
    ],

];
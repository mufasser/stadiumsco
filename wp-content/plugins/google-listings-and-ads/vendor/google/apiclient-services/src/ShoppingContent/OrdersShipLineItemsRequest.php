<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Service\ShoppingContent;

class OrdersShipLineItemsRequest extends \Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Collection
{
  protected $collection_key = 'shipmentInfos';
  /**
   * @var OrderShipmentLineItemShipment[]
   */
  public $lineItems;
  protected $lineItemsType = OrderShipmentLineItemShipment::class;
  protected $lineItemsDataType = 'array';
  /**
   * @var string
   */
  public $operationId;
  /**
   * @var string
   */
  public $shipmentGroupId;
  /**
   * @var OrdersCustomBatchRequestEntryShipLineItemsShipmentInfo[]
   */
  public $shipmentInfos;
  protected $shipmentInfosType = OrdersCustomBatchRequestEntryShipLineItemsShipmentInfo::class;
  protected $shipmentInfosDataType = 'array';

  /**
   * @param OrderShipmentLineItemShipment[]
   */
  public function setLineItems($lineItems)
  {
    $this->lineItems = $lineItems;
  }
  /**
   * @return OrderShipmentLineItemShipment[]
   */
  public function getLineItems()
  {
    return $this->lineItems;
  }
  /**
   * @param string
   */
  public function setOperationId($operationId)
  {
    $this->operationId = $operationId;
  }
  /**
   * @return string
   */
  public function getOperationId()
  {
    return $this->operationId;
  }
  /**
   * @param string
   */
  public function setShipmentGroupId($shipmentGroupId)
  {
    $this->shipmentGroupId = $shipmentGroupId;
  }
  /**
   * @return string
   */
  public function getShipmentGroupId()
  {
    return $this->shipmentGroupId;
  }
  /**
   * @param OrdersCustomBatchRequestEntryShipLineItemsShipmentInfo[]
   */
  public function setShipmentInfos($shipmentInfos)
  {
    $this->shipmentInfos = $shipmentInfos;
  }
  /**
   * @return OrdersCustomBatchRequestEntryShipLineItemsShipmentInfo[]
   */
  public function getShipmentInfos()
  {
    return $this->shipmentInfos;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OrdersShipLineItemsRequest::class, 'Google_Service_ShoppingContent_OrdersShipLineItemsRequest');

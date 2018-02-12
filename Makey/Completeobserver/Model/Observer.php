<?php
/**
 * Created by PhpStorm.
 * User: makeyos
 * Date: 11/02/2018
 * Time: 23:16
 */

//namespace Makey_Completeobserver_Model_Observer;


class Makey_Completeobserver_Model_Observer
{

    public function sendApi(Varien_Event_Observer $observer) {


        $order = $observer->getOrder();
        if(($order->getState() == Mage_Sales_Model_Order::STATE_COMPLETE) || ($order->getStatus() == "complete")){
            // get customer id
            $customer_id = $order->getCustomerId();

            // get customer
            $customer = Mage::getModel('customer/customer')->load($customer_id);

            Mage::log('Completed order for customer: ' . $customer . "(" . $customer_id . ")");
        }


    }

}
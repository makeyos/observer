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

            $prefix = $customer->getPrefix();
            $fullname = $customer->getName(); // Full Name
            $firstname = $customer->getFirstname(); // First Name
            $middlename = $customer->getMiddlename(); // Middle Name
            $lastname = $customer->getLastname(); // Last Name
            $suffix = $customer->getSuffix();
            $email = $customer->getEmail();

            //$email = Mage::getModel('customer/customer')->load($customer_id)->getEmail();
            //$firstName = Mage::getModel('customer/customer')->load($customer_id)->getFirstname();

            $items = $order->getAllVisibleItems();
            foreach($items as $item){
                Mage::log("Product: " . $item->getName() . " SKU: " . $item->getSku());
                // custom code to update order or any thing
            }


            /*
             * https://api.reviews.co.uk/documentation/index.html#api-Queue_Email_Invitations-Queue_Merchant_Review_Invite
             *
             *  {
                "store": "my-company",
                "apikey" :"######APIKEY######",
                "name": "Mr David Jones",
                "email": "david-jones@example.com",
                "order_id": "12345",
                "template_id": "934"
                }
             *
             *https://www.madebymagnitude.com/blog/sending-post-data-from-php/
             *
             *# Our new data
                $data = array(
                    'election' => 1,
                    'name' => 'Test'
                );
                # Create a connection
                $url = '/api/update';
                $ch = curl_init($url);
                # Form data string
                $postString = http_build_query($data, '', '&');
                # Setting our options
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                # Get the response
                $response = curl_exec($ch);
                curl_close($ch);
             *
             *
             */



            Mage::log('Completed order for customer: ' . $fullname . " - " . $email . " (" . $customer_id . ") ");



        }


    }

}
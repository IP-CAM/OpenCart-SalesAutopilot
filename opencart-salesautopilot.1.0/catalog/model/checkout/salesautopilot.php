<?php
class ModelCheckoutSalesAutopilot extends Model {
	public function getOrderInfo($order_id) {
		$order_info = false;
		$order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
		if (!empty($order_query->row)) {
			$items = array();
			$tax = 0;
		
			$product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'");
		
			foreach ($product_query->rows as $product) {
				$category_query = $this->db->query("SELECT ptc.category_id, cd.name FROM `" . DB_PREFIX . "product_to_category` ptc LEFT JOIN `" . DB_PREFIX . "category_description` cd ON ptc.category_id = cd.category_id WHERE ptc.product_id = '" . (int)$product['product_id']  . "' LIMIT 1");
			
				if(!empty($category_query->row)) {
					$category_id = $category_query->row['category_id'];
					$category_name = $category_query->row['name'];
				} else {
					$category_id = '999';
					$category_name = 'No Category';
				}
			
				$tax += $product['tax'];
			
				$items[] = array(
					'prod_id'		=> $product['product_id'],
					'prod_name'		=> $product['name'],
					'category_id'	=> $category_id,
					'category_name'	=> $category_name,
					'qty'			=> $product['quantity'],
					'tax'			=> $product['tax'],
					'prod_price'	=> round($product['price'],2)
				);
			}
			
			$order_info = array(
				'order_id'		  	=> (int)$order_id,
				'email'		  		=> $order_query->row['email'],
				'mssys_lastname'  	=> $order_query->row['lastname'],
				'mssys_firstname'  	=> $order_query->row['firstname'],
				'mssys_phone'  		=> $order_query->row['telephone'],
				'mssys_fax'  		=> $order_query->row['fax'],
				'shipping_method'	=> $order_query->row['shipping_method'],
				'payment_method'	=> $order_query->row['payment_method'],
				'currency'			=> $order_query->row['currency_code'],
				//'total'		 		=> round($order_query->row['total'],2),
				'tax'		  		=> round($tax,2),
				'netshippingcost'	=> round($this->session->data['sap_shipping'],2),
				'grossshippingcost'	=> round($this->session->data['sap_shipping'],2),
				'products'	  => $items
			);
		}
		return $order_info;
	}
}
?>
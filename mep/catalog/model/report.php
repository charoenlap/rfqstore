<?php 
class ReportModel extends db {
	public function getReport($type_bill, $date_start='', $date_end='') {
		$this->select("b.".$type_bill."_date as date, b.".$type_bill."_doc_no as doc_no, c.customer_company as company, if (b.".$type_bill."_type_vat='in', b.".$type_bill."_text_not_include_vat, b.".$type_bill."_text_discount_total) as total, b.".$type_bill."_text_vat as vat, b.".$type_bill."_total_tax as tax, b.".$type_bill."_net_total_vat as totalvat");
		$this->join('customer c', 'c.id_customer = b.id_customer', 'LEFT');
		$this->where('b.id_company', id_company());
		$this->where('c.id_company', id_company());
		if (!empty($date_start)&&!empty($date_end)) {
			$this->group_start();
			$this->where('b.'.$type_bill.'_date', $date_start, '>=');
			$this->where('b.'.$type_bill.'_date', $date_end, '<=');
			$this->group_end();	
		}
		
		$result = $this->get($type_bill.' b');
		return $result->rows;
	}

	public function totalReport($type_bill, $date_start, $date_end) {
		$this->select('sum('.$type_bill.'_net_total_vat) as total');
		$this->where('id_company', id_company());
		$this->where($type_bill.'_date', $date_start, '>=');
		$this->where($type_bill.'_date', $date_end, '<=');
		$result = $this->get($type_bill);
		return $result->row['total'];
	}
}
?>
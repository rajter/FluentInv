<?php

Class Stock extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getItemStocks($locationID = 1)
    {
        $receiptStocks = $this->getReceiptStocks($locationID);
        $issueStocks = $this->getIssueStocks($locationID);

        $transferNoteStocks = $this->getTransferNoteStocks_ToLocation($locationID);

        $a1 = array_column($receiptStocks, 'quantity', 'item_id');
        $a2 = array_column($issueStocks, 'quantity', 'item_id');
        $a3 = array_column($transferNoteStocks, 'quantity', 'item_id');
        $mapedArray = array_map(function($value){ return $value * -1; }, $a2);

        $itemStocks = $this->array_merge_numeric_values($a1, $mapedArray, $a3);

        // Kreiranje priveremene tablice
        $this->db->query("CREATE TEMPORARY TABLE IF NOT EXISTS temp_table (item_id int, quantity int);");
        foreach ($itemStocks as $item) {
            $query = "INSERT INTO temp_table VALUES(".$item->item_id.",".$item->quantity.")";
            $this->db->query($query);
        }

        // Upit na privremenu tablicu i tablicu artikli
        $this->db->select('*');
        $this->db->from('temp_table AS TMP');
        $this->db->join('items AS I', 'I.id = TMP.item_id');
        $stocks = $this->db->get();
        return $stocks->result();
    }

    function array_merge_numeric_values()
    {
    	$arrays = func_get_args();
    	$merged = array();
    	foreach ($arrays as $array)
    	{
    		foreach ($array as $key => $value)
    		{
    			if ( !isset($merged[$key]))
    			{
    				$merged[$key] = $value;
    			}
    			else
    			{
                    $merged[$key] += $value;
    			}

                $merged[$key] = (string)$merged[$key];  // pretvara natrag u string
    		}
    	}

    	return $this->array_create_array_of_objects($merged);
    }

    public function array_create_array_of_objects($array)
    {
        $objects = [];

        foreach ( $array as $key => $value ){
            $object = new StdClass();
            $object -> item_id = (string)$key;
            $object -> quantity = $value;
            array_push($objects, $object);
        }

        return $objects;
    }

    /*
    *   Kolicine pojedinih artikala u primkama - sumirano po item_id
    */
    public function getReceiptStocks($location_id)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 1);
        $this->db->where('INV.location_id', $location_id);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Kolicine pojedinih artikala u izdatnicama - sumirano po item_id
    */
    public function getIssueStocks($location_id)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 2);
        $this->db->where('INV.location_id', $location_id);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Dobivamo kolicine pojedinih artikala u medjuskladisnici
    *   koji se sele iz jedne lokacije, znaci oduzimamo kolicine od te lokacije - sumirano po item_id
    */
    public function getTransferNoteStocks_FromLocation($location_id)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 3);
        $this->db->where('INV.from_location_id', $location_id);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Dobivamo kolicine pojedinih artikala u medjuskladisnici
    *   koji se sele u jedne lokacije, znaci zbrajamo kolicine toj lokaciji - sumirano po item_id
    */
    public function getTransferNoteStocks_ToLocation($location_id)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 3);
        $this->db->where('INV.location_id', $location_id);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Vraca zbroj svih kolicina artikala ovisno o
    *   tipu transakcije i id-u skladista
    */
    public function getTotalItemCount($transaction_type, $location_id)
    {
        $this->db->select('IT.*');
        $this->db->select_sum('IT.quantity', 'total');
        $this->db->select('INV.location_id');
        $this->db->select('I.*');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->join('items AS I', 'IT.item_id = I.id');
        $this->db->where('INV.transaction_type_id', $transaction_type);
        $this->db->where('INV.location_id', $location_id);
        $this->db->group_by('IT.item_id');
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result();
    }
}
?>

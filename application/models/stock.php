<?php

Class Stock extends CI_Model
{

    private $lastDateOfStockCounting = '';

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getLastDateOfStockCounting($locationId = 1)
    {
        $this->db->select('*');
        $this->db->from('stock_takings');
        $this->db->where('locations_id', $locationId);
        $this->db->where('status', 1);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if(count($query->result())>0)
        {
            $this->lastDateOfStockCounting = $query->result()[0]->date;
        }
        else
        {
            $this->lastDateOfStockCounting = "0";
        }
    }

    public function getItemStocks($locationId = 1, $itemId = null)
    {
        $this->getLastDateOfStockCounting($locationId);

        $stockTakingCount = $this->getStockTakingCount($locationId);
        $receiptStocks = $this->getReceiptStocks($locationId, $this->lastDateOfStockCounting);
        $issueStocks = $this->getIssueStocks($locationId, $this->lastDateOfStockCounting);
        $transferNoteToLocationStocks = $this->getTransferNoteStocks_ToLocation($locationId, $this->lastDateOfStockCounting);
        $transferNoteFromLocationStocks = $this->getTransferNoteStocks_FromLocation($locationId, $this->lastDateOfStockCounting);

        // http://php.net/manual/en/function.array-column.php
        $receiptArray  = array_column($receiptStocks, 'quantity', 'item_id');
        $toLocationArray  = array_column($transferNoteToLocationStocks, 'quantity', 'item_id');
        $issueArray  = array_map(function($value){ return $value * -1; }, array_column($issueStocks, 'quantity', 'item_id'));
        $fromLocationArray  = array_map(function($value){ return $value * -1; }, array_column($transferNoteFromLocationStocks, 'quantity', 'item_id'));
        $stockTakingArray = array_column($stockTakingCount, 'quantity', 'item_id');

        $itemStocks = $this->array_merge_numeric_values($receiptArray, $issueArray, $toLocationArray, $fromLocationArray, $stockTakingArray);

        // Kreiranje priveremene tablice
        $this->db->query("CREATE TEMPORARY TABLE IF NOT EXISTS temp_table (item_id int, quantity int, locationId int);");
        foreach ($itemStocks as $item) {
            $query = "INSERT INTO temp_table VALUES(".$item->item_id.",".$item->quantity.",".$locationId.")";
            $this->db->query($query);
        }

        // Upit na privremenu tablicu i tablicu artikli
        $this->db->select('TMP.*');
        $this->db->select('I.*');
        $this->db->select('L.id AS locationId, L.name AS locationName');
        $this->db->from('temp_table AS TMP');
        $this->db->join('items AS I', 'I.id = TMP.item_id');
        $this->db->join('locations AS L', 'L.id = TMP.locationId');
        if(!is_null($itemId))
        {
            $this->db->where('TMP.item_id', $itemId);
        }
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

    //---------------------------------------------------
    //  Kolicine pojedinih artikala od zadnje inventure
    //---------------------------------------------------
    public function getStockTakingCount($locationId)
    {
        $this->db->select('*');
        $this->db->from('stock_takings');
        $this->db->where('locations_id', $locationId);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if(count($query->result())>0)
        {
            $stockTakingID = $query->result()[0]->id;

            // Tražimo id od inventurne transakcije
            $this->db->select('IT.id');
            $this->db->from('inventory_stock_takings AS IST');
            $this->db->join('stock_takings AS ST','IST.stock_takings_id=ST.id');
            $this->db->join('inventory_transactions AS IT','IST.inventory_transactions_id = IT.id');
            $this->db->where('IST.stock_takings_id', $stockTakingID);
            $this->db->where('IT.transaction_type_id', 7);
            $query = $this->db->get();
            $inv_trans_id = $query->result()[0]->id;

            // Pokupimo sve artikle sa količinama
            $this->db->select('IT.item_id');
            $this->db->select_sum('IT.quantity');
            $this->db->from('item_transaction AS IT');
            $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
            $this->db->where('INV.id', $inv_trans_id);
            $this->db->where('INV.transaction_type_id', 7);
            $this->db->where('INV.location_id', $locationId);
            $this->db->group_by('IT.item_id');
            $query = $this->db->get();

            // echo($this->db->last_query());
            return $query->result_array();
        }
        else
        {
            return array(0);
        }
    }

    /*
    *   Kolicine pojedinih artikala u primkama - sumirano po item_id
    */
    public function getReceiptStocks($location_id, $stockCountingdate)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 1);
        $this->db->where('INV.location_id', $location_id);
        $this->db->where('INV.date >', $stockCountingdate);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Kolicine pojedinih artikala u izdatnicama - sumirano po item_id
    */
    public function getIssueStocks($location_id, $stockCountingdate)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 2);
        $this->db->where('INV.location_id', $location_id);
        $this->db->where('INV.date >', $stockCountingdate);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Dobivamo kolicine pojedinih artikala u medjuskladisnici
    *   koji se sele iz jedne lokacije, znaci oduzimamo kolicine od te lokacije - sumirano po item_id
    */
    public function getTransferNoteStocks_FromLocation($location_id, $stockCountingdate)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 3);
        $this->db->where('INV.from_location_id', $location_id);
        $this->db->where('INV.date >', $stockCountingdate);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Dobivamo kolicine pojedinih artikala u medjuskladisnici
    *   koji se sele u jedne lokacije, znaci zbrajamo kolicine toj lokaciji - sumirano po item_id
    */
    public function getTransferNoteStocks_ToLocation($location_id, $stockCountingdate)
    {
        $this->db->select('IT.item_id');
        $this->db->select_sum('IT.quantity');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->where('INV.transaction_type_id', 3);
        $this->db->where('INV.location_id', $location_id);
        $this->db->where('INV.date >', $stockCountingdate);
        $this->db->group_by('IT.item_id');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result_array();
    }

    /*
    *   Vraca zbroj svih kolicina artikala ovisno o
    *   tipu transakcije i id-u skladista
    *   $transfer -> ako je TRUE gleda location_id ako je FALSE gleda from_location_id
    */
    public function getTotalItemCount($transaction_type, $location_id, $transfer=TRUE)
    {
        $this->db->select('IT.*');
        $this->db->select_sum('IT.quantity', 'total');
        $this->db->select('INV.location_id');
        $this->db->select('I.*');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->join('items AS I', 'IT.item_id = I.id');
        $this->db->where('INV.transaction_type_id', $transaction_type);
        if($transfer == TRUE)
        {
            $this->db->where('INV.location_id', $location_id);
        }
        else
        {
            $this->db->where('INV.from_location_id', $location_id);
        }
        $this->db->where('INV.date >', $this->lastDateOfStockCounting);
        $this->db->group_by('IT.item_id');
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result();
    }

    //--------------------------------------------------------
    //  Vraca zbroj kolicina artikala prema zadnjoj inventuri
    //--------------------------------------------------------
    public function getLastStockTakingItemCount($location_id)
    {
        $transaction_type = 7;

        $this->db->select('IT.*');
        $this->db->select_sum('IT.quantity', 'total');
        $this->db->select('INV.location_id');
        $this->db->select('I.*');
        $this->db->from('item_transaction AS IT');
        $this->db->join('inventory_transactions AS INV', 'INV.id = IT.inventory_transaction_id');
        $this->db->join('items AS I', 'IT.item_id = I.id');
        $this->db->where('INV.transaction_type_id', $transaction_type);
        $this->db->where('INV.location_id', $location_id);
        $this->db->where('INV.date =', $this->lastDateOfStockCounting);
        $this->db->group_by('IT.item_id');
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get();

        // echo($this->db->last_query());
        return $query->result();
    }

    // ZA HOME KONTROLER
    //----------------------------------------------
    //  Vraca sveukupni broj odredjenih transakcija
    //----------------------------------------------
    public function getTransactionCount($transType = 1, $year, $month)
    {
        $startOfMonth = $year."-".$month."-01 00:00:00";
        $endOfMonth = $year."-".($month+1)."-01 00:00:00";

        $this->db->select('COUNT(*) AS COUNT');
        $this->db->from('inventory_transactions');
        $this->db->where('transaction_type_id', $transType);
        $this->db->where('date >=', $startOfMonth);
        $this->db->where('date <', $endOfMonth);
        $query = $this->db->get();

        $result = $query->result()[0];
        $monthlyData = new stdClass;
        $monthlyData->year = $year;
        $monthlyData->month = $month;
        $monthlyData->totalTransactions = $result->COUNT;

        return $monthlyData;
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Testni kontroler za debugiranje
*/
class Test extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'testModel', 'dbQueries', 'receipt', 'issue', 'transfer', 'modelHelper', 'stocks'));
     }

    public function index()
    {
        $data = $this->testModel->getTransWithHighestNumber(1);
        echo var_dump($data);
    }

    public function testAJAX()
    {
        $items = $this->input->post('items');
        echo json_encode($items, JSON_UNESCAPED_UNICODE);
    }

    public function testQuery($id = null)
    {
        // $itemStocks = $this->stocks->getItemStocks(1);
        //
        // $this->db->query("CREATE TEMPORARY TABLE IF NOT EXISTS temp_table (item_id int, quantity int);");
        // foreach ($itemStocks as $item) {
        //     $query = "INSERT INTO temp_table VALUES(".$item->item_id.",".$item->quantity.")";
        //     $this->db->query($query);
        // }
        //
        // $this->db->select('*');
        // $this->db->from('temp_table AS TMP');
        // $this->db->join('items AS I', 'I.id = TMP.item_id');
        // var_dump($this->db->get()->result());

        // $receipts = $this->stocks->getReceiptStocks(1);
        // printf($this->db->last_query());
        // var_dump($receipts);

        // $viewData['itemStocks'] = $this->stocks->getTotalItemCunt(2, 1);
        $viewData['totalQuantity'] = $this->item->getQuantitiesByLocation(1);
        printf($this->db->last_query());
        // $receiptStocks = $this->stocks->getReceiptStocks(1);
        // var_dump($receiptStocks);
        // printf($this->db->last_query());
        var_dump($viewData);
    }

    public function testMaxId()
    {
        var_dump($this->modelHelper->returnMaxTransID(1));
    }

    public function testModel()
    {
        $receipts = $this->receipt->getAll();
        echo $this->db->last_query();
        var_dump($receipts);
    }

    public function testFaker()
    {
        $faker = Faker\Factory::create();
        $NL = "<br>";

        $address = array(
            'address' => $faker->streetAddress(),
            'city' => $faker->city(),
            'zipcode' => $faker->postcode(),
            'state' => $faker->state(),
            'country' => $faker->country(),
            'date' => $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s'),
        );

        $client = array(
            'name' => $faker->name(),
            'description' => $faker->text($maxNbChars = 200),
            'tel' => $faker->phoneNumber(),
            'fax' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'address_id' => $faker->numberBetween($min = 1, $max = 100),
            'client_type_id' => 1
        );

        $item = array(
            'name' => $faker->word(),
            'description' => $faker->text($maxNbChars = 100),
            'item_type_id' => $faker->numberBetween($min = 1, $max = 4),
            'item_status' => 1,
            'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1500),
            'code' => $faker->isbn13(),
            'image' => $faker->numberBetween($min = 1, $max = 5).'.jpg'
        );

        var_dump($client);
        var_dump($address);
        var_dump($item);
    }

    public function populateAddress()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            $address = array(
                'address' => $faker->streetAddress(),
                'city' => $faker->city(),
                'zipcode' => $faker->postcode(),
                'state' => $faker->state(),
                'country' => $faker->country(),
            );

            $this->db->insert('address', $address);
        }
    }

    public function populateClients()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            $client = array(
                'name' => $faker->name,
                'description' => $faker->text($maxNbChars = 200),
                'tel' => $faker->phoneNumber(),
                'fax' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'address_id' => $faker->numberBetween($min = 1, $max = 100),
                'client_type_id' => 1
            );

            $this->db->insert('clients', $client);
        }
    }

    public function populateItems()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 200; $i++) {
            $item = array(
                'name' => $faker->word(),
                'description' => $faker->text($maxNbChars = 100),
                'item_type_id' => $faker->numberBetween($min = 1, $max = 4),
                'item_status_id' => 1,
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1500),
                'code' => $faker->isbn13(),
                'image' => $faker->numberBetween($min = 1, $max = 5).'.jpg'
            );

            $this->db->insert('items', $item);
        }
    }

    public function populateReceipts()
    {
        $faker = Faker\Factory::create();


        for ($i=0; $i < 50; $i++) {
            $transaction_number = $this->modelHelper->returnMaxTransNumber(1);
            $transaction = array(
                'transaction_number' => $transaction_number,
                'transaction_type_id' => 1,
                'client_id' => $faker->numberBetween($min = 1, $max = 100),
                'location_id' => $faker->numberBetween($min = 1, $max = 3),
                'from_location_id' => $faker->numberBetween($min = 1, $max = 3),
                'user_id' => 1,
                'date' => $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s'),
                'footnote' => $faker->text($maxNbChars = 200)
            );

            $this->db->insert('inventory_transactions', $transaction);

            $numberOfItems = $faker->numberBetween($min = 1, $max = 10);    // number of items to insert in the transaction

            $trans_id = $this->receipt->get($transaction_number)[0]->trans_id;

            for ($j=0; $j < $numberOfItems; $j++) {
                $item = array(
                    'inventory_transaction_id' => $trans_id,
                    'transaction_type' => 1,
                    'item_id' => $faker->numberBetween($min = 1, $max = 100),
                    'quantity' => $faker->numberBetween($min = 1, $max = 50)
                );

                $this->db->insert('item_transaction', $item);

            }// for loop item transactions

        }   // for loop inventory transaction

    }

    public function populateIssues()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 50; $i++) {
            $transaction_number = $this->modelHelper->returnMaxTransNumber(2);
            $transaction = array(
                'transaction_number' => $transaction_number,
                'transaction_type_id' => 2,
                'client_id' => $faker->numberBetween($min = 1, $max = 100),
                'location_id' => $faker->numberBetween($min = 1, $max = 3),
                'from_location_id' => $faker->numberBetween($min = 1, $max = 3),
                'user_id' => 1,
                'date' => $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s'),
                'footnote' => $faker->text($maxNbChars = 200)
            );

            $this->db->insert('inventory_transactions', $transaction);

            $numberOfItems = $faker->numberBetween($min = 1, $max = 10);    // number of items to insert in the transaction

            for ($j=0; $j < $numberOfItems; $j++) {
                $trans_id = $this->issue->get($transaction_number)[0]->trans_id;
                $item = array(
                    'inventory_transaction_id' => $trans_id,
                    'transaction_type' => 2,
                    'item_id' => $faker->numberBetween($min = 1, $max = 100),
                    'quantity' => $faker->numberBetween($min = 1, $max = 50)
                );

                $this->db->insert('item_transaction', $item);

            }// for loop item transactions

        }   // for loop inventory transaction

    }

    public function populateTransferNote()
    {
        $faker = Faker\Factory::create();
        $transType = 3; // Meduskladisnica

        for ($i=0; $i < 10; $i++) {
            $transaction_number = $this->modelHelper->returnMaxTransNumber($transType);
            $transaction = array(
                'transaction_number' => $transaction_number,
                'transaction_type_id' => $transType,
                'client_id' => $faker->numberBetween($min = 1, $max = 100),
                'location_id' => $faker->numberBetween($min = 1, $max = 3),
                'from_location_id' => $faker->numberBetween($min = 1, $max = 3),
                'user_id' => 1,
                'date' => $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s'),
                'footnote' => $faker->text($maxNbChars = 200)
            );

            $this->db->insert('inventory_transactions', $transaction);

            $numberOfItems = $faker->numberBetween($min = 1, $max = 10);    // number of items to insert in the transaction

            for ($j=0; $j < $numberOfItems; $j++) {
                $trans_id = $this->transferNote->get($transaction_number)[0]->trans_id;
                $item = array(
                    'inventory_transaction_id' => $trans_id,
                    'item_id' => $faker->numberBetween($min = 1, $max = 100),
                    'quantity' => $faker->numberBetween($min = 1, $max = 50)
                );

                $this->db->insert('item_transaction', $item);

            }// for loop item transactions

        }   // for loop inventory transaction
    }

    public function eraseDocuments()
    {
        $this->db->empty_table('item_transaction');
        $this->db->empty_table('inventory_transactions');
    }


}

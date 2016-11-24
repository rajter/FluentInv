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
       $this->load->model(array('item', 'testModel', 'dbQueries', 'receipt', 'modelHelper'));
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
        $transaction_number = "16-0000002";
        $inventory_transactions_id = 1;

        $this->db->where('transaction_number', $transaction_number);
        $this->db->delete('inventory_transactions');
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


}

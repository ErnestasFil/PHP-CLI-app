<?php

require_once './src/CLI.php';
require_once './src/console/consoleStyle.php';
require_once './src/console/dataTable.php';
require_once './src/console/textTable.php';
require_once './src/console/dataImportTable.php';
require_once './src/console/dataInsertTable.php';
require_once './src/view/state.php';
require_once './src/view/baseState.php';
require_once './src/view/menuState.php';
require_once './src/view/exitState.php';
require_once './src/view/charity/viewCharityState.php';
require_once './src/view/charity/importCharityState.php';
require_once './src/view/charity/addCharityState.php';
require_once './src/view/charity/manuallyAddCharityState.php';
require_once './src/view/viewDonationState.php';
require_once './src/view/stateManager.php';
require_once './src/database/databaseManager.php';
require_once './src/model/model.php';
require_once './src/model/charity.php';
require_once './src/model/donation.php';

require_once './src/data/csvImport.php';

require_once './src/validation/validator.php';
require_once './src/validation/ruleFactory.php';
require_once './src/rule/rule.php';
require_once './src/rule/emailRule.php';
require_once './src/rule/maxRule.php';
require_once './src/rule/minRule.php';
require_once './src/rule/notEmptyRule.php';
require_once './src/rule/stringRule.php';
require_once './src/rule/uniqueRule.php';

$initialState = new MenuState();
$stateManager = new StateManager($initialState);

$dbManager = new DatabaseManager('src/database/sql.db');
$dbManager->createTables();
Model::setConnection($dbManager->getPDO());


while (true) {
    $stateManager->run();
}

// Charity::insert(['name' => 'Save the Children', 'email' => 'contact@savethechildren.org']);


// $charities = Charity::getAll();
// print_r($charities);
// echo "Charities:\n";
// foreach ($charities as $c) {
//     // print_r($c);
//     echo "{$c->id}: {$c->name} ({$c->email})\n";
// }

// Donation::insert(['donor_name' => 'Test', 'amount' => '0.50', 'charity_id' => "2", 'date_time' => date('Y-m-d H:i:s')]);
// $d = Donation::getAll();
// print_r($d);


// $donation = new Donation($dbManager->getPDO(), "John Doe", 100.0, $charities[0]['id']);
// $donation->save();


// $donations = (new Donation($dbManager->getPDO()))->getAll();
// echo "\nDonations:\n";
// foreach ($donations as $d) {
//     echo "{$d['id']}: {$d['donor_name']} donated {$d['amount']} to charity ID {$d['charity_id']} on {$d['date_time']}\n";
// }


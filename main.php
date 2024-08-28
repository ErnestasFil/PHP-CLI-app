<?php

require_once './src/CLI.php';
require_once './src/console/consoleStyle.php';
require_once './src/console/dataTable.php';
require_once './src/console/textTable.php';
require_once './src/view/state.php';
require_once './src/view/baseState.php';
require_once './src/view/menuState.php';
require_once './src/view/exitState.php';
require_once './src/view/viewCharityState.php';
require_once './src/view/addCharityState.php';
require_once './src/view/stateManager.php';
require_once './src/database/databaseManager.php';
require_once './src/model/model.php';
require_once './src/model/charity.php';
require_once './src/model/donation.php';

$initialState = new MenuState();
$stateManager = new StateManager($initialState);

$dbManager = new DatabaseManager('src/database/sql.db');
$dbManager->createTables();
Model::setConnection($dbManager->getPDO());


while (true) {
    $stateManager->run();
}
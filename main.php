<?php

require_once './src/console/consoleInput.php';
require_once './src/console/consoleStyle.php';
require_once './src/console/dataTable.php';
require_once './src/console/textTable.php';
require_once './src/console/dataImportTable.php';
require_once './src/console/dataInsertTable.php';

require_once './src/view/state.php';
require_once './src/view/baseState.php';
require_once './src/view/menuState.php';
require_once './src/view/exitState.php';
require_once './src/view/stateManager.php';
require_once './src/view/baseFormState.php';
require_once './src/view/baseSelectState.php';

require_once './src/view/charity/viewCharityState.php';
require_once './src/view/charity/importCharityState.php';
require_once './src/view/charity/addCharityState.php';
require_once './src/view/charity/manuallyAddCharityState.php';
require_once './src/view/charity/selectEditCharityState.php';
require_once './src/view/charity/editCharityState.php';
require_once './src/view/charity/selectDeleteCharityState.php';
require_once './src/view/charity/deleteCharityState.php';

require_once './src/view/donation/viewDonationState.php';
require_once './src/view/donation/addDonationState.php';
require_once './src/view/donation/importDonationState.php';
require_once './src/view/donation/selectDeleteDonationState.php';
require_once './src/view/donation/deleteDonationState.php';
require_once './src/view/donation/manuallyAddDonationState.php';
require_once './src/view/donation/selectEditDonationState.php';
require_once './src/view/donation/editDonationState.php';

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
require_once './src/rule/numRule.php';
require_once './src/rule/existRule.php';
require_once './src/rule/datetimeRule.php';

date_default_timezone_set('Europe/Vilnius');

$initialState = new MenuState();
$stateManager = new StateManager($initialState);

$dbManager = new DatabaseManager('src/database/sql.db');
$dbManager->createTables();
Model::setConnection($dbManager->getPDO());

while (true) {
    $stateManager->render();
}

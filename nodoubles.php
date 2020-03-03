<?php
defined('_JEXEC') or die('Restricted access');

if (file_exists(JPATH_ADMINISTRATOR . '/components/com_zoo/config.php')) {
    require_once(JPATH_ADMINISTRATOR . '/components/com_zoo/config.php');
} else {
    $this->app->enqueueMessage("Ошибка чтения конфига ZOO. Попробуйте переустановить приложение ZOO", 'error');
    return false;
}

$itemModel = App::getInstance('zoo')->table->item;
$items = $itemModel->getByType("produkt", "1", "1", null, "", 0, 0, false);
$itemName = [];
foreach($items as $key => $item) {
    $itemName[$item->id] = $item->name;
}

$noDoubles = array_unique($itemName);

$results = array_diff_assoc($itemName, $noDoubles);

foreach ($results as $id => $result) {
    $item = $itemModel->get($id);
    $itemModel->delete($item);

}

die();

<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use EntityTransformer\EntityTransformer;

$entity = new EntityTransformer(new \stdClass(), ['
{   
    "name": "first_not_null({wrn:wwe:mdm:entity:episode:{{episode_wweid}}:name}, {wrn:wwe:mdm:entity:episode:{{episode_wweid}}:series::name})",
    "series_name": "{wrn:wwe:mdm:entity:episode:{{episode_wweid}}:series::name}",
    "vms_asset_path": "{wrn:wwe:vms:entity:asset:{{asset_id}}:path}"
}', '
{ 
    "name": "first_not_null({wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:name}, {wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name})",
    "series_name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name}",
    "vms_asset_path": "{wrn:wwe:vms:entity:asset:58:path}"
}', '
{ 
    "name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:name}",
    "series_name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name}",
    "vms_asset_path": "{wrn:wwe:vms:entity:asset:58:path}"
}', '
{ 
    "name": "NOAM DAR learns from MASTER CESARO! - Clash with Cesaro",
    "series_name": "Clash With Cesaro",
    "vms_asset_path": "/u01/www/vms9/storage/assets/v8_thumbs/2010/02-23/8081_20100223_nxt_young_otunga.jpg"
}'
]);
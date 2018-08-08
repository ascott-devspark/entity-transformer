<?php

namespace EntityTransformer;

use EntityTransformer\EntityTransformer\TransformerFactory;

class EntityTransformer
{
    private $entity;

    private $transf;

    private $transformers;

    public function __construct($entity, $transformations = []) {
        $this->entity = $entity;
        $this->transf = $transformations;

        $this->buildTransformations();
    }

    private function buildTransformations() {
        /**
         * namespace:system:type:self_name:self_id:property_name
         * {wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:name}
         *
         * { // Episode Sample Meta Json
         *      "name": "first_not_null({wrn:wwe:mdm:entity:episode:{{episode_wweid}}:name}, {wrn:wwe:mdm:entity:episode:{{episode_wweid}}:series::name})",
         *      "series_name": "{wrn:wwe:mdm:entity:episode:{{episode_wweid}}:series::name}",
         *      "vms_asset_path": "{wrn:wwe:vms:entity:asset:{{asset_id}}:path}"
         * }
         *
         * { // First Transform
         *      "name": "first_not_null({wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:name}, {wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name})",
         *      "series_name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name}",
         *      "vms_asset_path": "{wrn:wwe:vms:entity:asset:58:path}"
         * }
         *
         * { // Second Transform
         *      "name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:name}",
         *      "series_name": "{wrn:wwe:mdm:entity:episode:65d40d32-975f-11e8-9bb6-0ec1498482d4:series::name}",
         *      "vms_asset_path": "{wrn:wwe:vms:entity:asset:58:path}"
         * }
         *
         * { // Third Transform
         *      "name": "NOAM DAR learns from MASTER CESARO! - Clash with Cesaro",
         *      "series_name": "Clash With Cesaro",
         *      "vms_asset_path": "/u01/www/vms9/storage/assets/v8_thumbs/2010/02-23/8081_20100223_nxt_young_otunga.jpg"
         * }
         */

        foreach ($this->transf as $transformation) {
            $json = json_decode($transformation, true);
            $transformers = [];

            foreach ($json as $property => $txtTransf) {
                // Use regular expresion to determinate if it is a simple or function transformer
                $re = '/(\w+\()?(\{.*\}+)\)?/im';
                preg_match_all($re, $txtTransf, $matches, PREG_SET_ORDER, 0);

                if (count($matches) > 0) {
                    // Remove first function parenthesis
                    $match = $matches[0];
                    $transKey = TransformerFactory::SIMPLE;
                    $transStr = $match[1];

                    // If capture two groups then it is a function
                    if (count($match) > 2) {
                        $transKey = substr($match[1], 0, -1);
                        $transStr = $match[2];
                    }
                    $transformers[$property] = TransformerFactory::create($transKey, $transStr);
                }
            }
            if (!empty($transformers)) {
                $this->transformers[] = $transformers;
            }
        }
        $this->dd($this->transformers);
    }

    public function setTransf($transf) {
        $this->transf = $transf;
        return $this;
    }

    public function __call($method_name, $args) {


        return call_user_func_array(array($this->foo, $method_name), $args);
    }

    private function dd() {
        $parameters = func_get_args();
        foreach ($parameters as $parameter) {
            echo print_r($parameter, true) . PHP_EOL;

        }
        die(1);
    }
}
<?php

namespace mrstroz\infakt;

use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class inFakt
 * inFakt component
 * @package mrstroz\infakt
 *
 * @author Mariusz Stróż <info@inwave.pl>
 */
class Infakt extends Component
{


    /**
     * @var string inFakt API Key
     */
    public $apiKey;

    /**
     * @var string
     */
    public $endpoint = 'https://api.infakt.pl/v3/';


    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->apiKey) {
            throw new InvalidConfigException('$apiKey not set');
        }

        if (!$this->endpoint) {
            throw new InvalidConfigException('$endpoint not set');
        }

        parent::init();
    }

    /**
     * Call inFakt function
     * @param string $call Name of API function to call
     * @param string $method Method mame (GET / POST / PUT / DELETE)
     * @param array $data
     * @return \stdClass inFakt response
     */
    public function call($call, $method, $data = [])
    {
        $json = json_encode($data);
        $result = $this->curl($this->endpoint . $call . '.json', $method, $json);
        return json_decode($result);
    }

    /**
     * Do request by CURL
     * @param string $url
     * @param string $method
     * @param array $data
     * @return mixed
     */
    private
    function curl($url, $method = 'GET', $data = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if (count($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-inFakt-ApiKey: ' . $this->apiKey
            )
        );

        return curl_exec($ch);
    }


}
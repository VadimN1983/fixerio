<?php
declare(strict_types=1);

namespace Thelema\Forex;

/**
 * Interface Fixer
 *
 * @package Thelema\Forex
 */
interface Fixer {

    public function symbols();

    public function latest(string $base = null, string $rates = null);

    public function history(string $date = null, string $base = null, string $rates = null);

    public function convert(string $from = null, string $to = null, int $amount = null);

    public function period(
        string $start_date = null,
        string $end_date = null,
        string $base = null,
        string $rates = null
    );

    public function fluctuation(
        string $start_date = null,
        string $end_date = null,
        string $base = null,
        string $rates = null
    );
};

/**
 * Class FixerIO
 *
 * @package Thelema\Forex
 */
final class FixerIO implements Fixer {

    /**
     * Singleton
     * @var null
     */
    private static $instance = null;

    public $result = null;

    /**
     * Fixer API-server
     */
    const API_SRV = 'http://data.fixer.io/api/';

    /**
     * Secret API key
     */
    const API_KEY = 'API_SECRET_KEY';

    private function __construct() {

    }

    /**
     * Simple rest HTTP-client
     *
     * @param string|null $endpoint
     * @param array       $data
     * @return mixed|null|string
     */
    private function request(string $endpoint = null, array $data = []) {

        $data['access_key'] = self::API_KEY;

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, self::API_SRV . $endpoint . '?' . http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            $this->result = curl_exec($curl);
            curl_close($curl);
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
        return $this->result;
    }

    public function latest(string $base = null, string $rates = null) {
        $data = [];
        if(isset($base) && !empty($base))
            $data['base'] = $base;

        if(isset($rates) && !empty($rates))
            $data['symbols'] = $rates;

        return json_decode($this->request('latest', $data));
    }

    public function symbols() {
        return json_decode( $this->request('symbols') );
    }

    public function history(string $date = null, string $base = null, string $rates = null) {
        $data = [];
        if(isset($base) && !empty($base))
            $data['base'] = $base;

        if(isset($rates) && !empty($rates))
            $data['symbols'] = $rates;

        return json_decode($this->request($date, $data));
    }

    public function convert(string $from = null, string $to = null, int $amount = null) {
        $data = [];
        if(isset($from) && !empty($from)) {
            $data['from'] = $from;
        } else {
            $data['from'] = 'EUR';
        }

        if(isset($to) && !empty($to)) {
            $data['to'] = $to;
        } else {
            $data['to'] = 'USD';
        }

        if(isset($amount) && !empty($amount)) {
            $data['amount'] = (int)$amount;
        } else {
            $data['amount'] = 1;
        }

        return json_decode($this->request('convert', $data));
    }

    public function period(string $start_date = null, string $end_date = null, string $base = null, string $rates = null) {

        $data = [];
        if(isset($start_date) && !empty($start_date))
            $data['start_date'] = $start_date;

        if(isset($end_date) && !empty($end_date))
            $data['end_date'] = $end_date;

        if(isset($base) && !empty($base))
            $data['base'] = $base;

        if(isset($rates) && !empty($rates))
            $data['symbols'] = $rates;

        return json_decode($this->request('timeseries', $data));
    }

    public function fluctuation(string $start_date = null, string $end_date = null, string $base = null, string $rates = null) {
        $data = [];
        if(isset($start_date) && !empty($start_date))
            $data['start_date'] = $start_date;

        if(isset($end_date) && !empty($end_date))
            $data['end_date'] = $end_date;

        if(isset($base) && !empty($base))
            $data['base'] = $base;

        if(isset($rates) && !empty($rates))
            $data['symbols'] = $rates;

        return json_decode($this->request('fluctuation', $data));
    }

    public static function getInstance(): FixerIO {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {

    }
};
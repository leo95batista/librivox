<?php

namespace App\Http\Controllers;

use App\Contracts\LibriVox;

class LibriVoxService implements LibriVox
{
    /**
     * Fields to return
     *
     * @var string[]
     */
    public $fields = ['id'];

    /**
     * Output format.
     *
     * @var string
     */
    public $format = 'json';

    /**
     * Query offset
     *
     * @var int
     */
    public $offset = 0;

    /**
     * Query limit
     *
     * @var int
     */
    public $limit = 5;

    /**
     * Return the full set of data about the project
     *
     * @var bool
     */
    public $extended = false;

    /**
     * Resource where you will search
     *
     * @var string
     */
    public $resource = 'audiobooks';

    /**
     * ILibriVox constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @inheritDoc
     *
     * @return $this|LibriVoxService
     */
    public function authors()
    {
        $this->resource = 'authors';

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @return $this|LibriVoxService
     */
    public function audiobooks()
    {
        $this->resource = 'audiobooks';

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param array $fields
     * @return $this|mixed
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param int $offset
     * @return $this|mixed
     */
    public function offset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param int $limit
     * @return $this|mixed
     */
    public function limit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param bool $extended
     * @return $this|mixed
     */
    public function extended(bool $extended)
    {
        $this->extended = $extended;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function fetch()
    {
        $curl = curl_init();

        // Here you can define the parameters that the query is going to have,
        // such as the format to return, the limits, the columns to be returned, etc.
        $params = [
            'fields' => $this->fields,
            'format' => $this->format,
            'offset' => $this->offset,
            'limit' => $this->limit,
            'extended' => $this->extended
        ];

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_URL => env('LIBRIVOX_URL') . $this->resource . '/?' . http_build_query($params)
        ]);

        // Execute the query and store the contents in `$response` variable
        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return collect($response)->collapse();
    }
}

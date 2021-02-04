<?php

namespace App\Services;

use App\Contracts\LibriVox;
use App\Models\Book;
use App\Traits\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class LibriVoxService implements LibriVox
{
    use Helpers;

    /**
     * Resource where you will search
     *
     * @var string
     */
    private static $resource = 'audiobooks';

    /**
     * Fields to return
     *
     * @var string[]
     */
    public $fields = [];

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
    public $limit = 50;

    /**
     * Return the full set of data
     *
     * @var bool
     */
    public $extended = false;

    /**
     * LibriVox constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @inheritdoc
     *
     * @return $this|LibriVoxService
     */
    public function authors()
    {
        self::$resource = 'authors';

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @return $this|LibriVoxService
     */
    public function audiobooks()
    {
        self::$resource = 'audiobooks';

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @return $this|LibriVoxService
     */
    public function audiotracks()
    {
        self::$resource = 'audiotracks';

        return $this;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     *
     * @param int $offset
     * @return $this|mixed
     */
    public function offset(int $offset = 0)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @param int $limit
     * @return $this|mixed
     */
    public function limit(int $limit = 50)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     *
     * @return Collection|mixed
     * @throws GuzzleException
     */
    public function fetch()
    {
        $client = new Client();

        // Address where the request will be made
        $address = 'https://librivox.org/api/feed/' . self::$resource;

        try {
            $request = $client->get($address, [
                'query' => http_build_query(get_object_vars($this)),
            ]);
        } catch (ClientException $exception) {
            return [];
        }

        $response = json_decode($request->getBody()->getContents(), true);

        // Here you will define the keys that will be removed from the response
        // returned by the server.
        $excludeKeys = ['id', 'reader_id'];

        return collect($this->recursiveUnset($response, $excludeKeys))->collapse();
    }

    /**
     * @inheritdoc
     *
     * @param Book|null $book
     * @return array|\SimpleXMLElement|string
     * @throws GuzzleException
     */
    public function fetchRss(Book $book = null)
    {
        $client = new Client();

        try {
            $response = $client->get($book->url_rss)->getBody()->getContents();
        } catch (ClientException $exception) {
            return [];
        }

        // Sanitize the string returned by the response.
        $response = str_replace('itunes:', '', $response);

        return simplexml_load_string($response, null, LIBXML_NOCDATA);
    }
}

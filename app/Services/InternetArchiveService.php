<?php

namespace App\Services;

use App\Contracts\InternetArchive;
use App\Models\Book;
use App\Traits\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class InternetArchiveService implements InternetArchive
{
    use Helpers;

    /**
     * Data returned by Internet Archive
     *
     * @var array
     */
    private $data = [];

    /**
     * @inheritdoc
     *
     * @return mixed
     */
    public function thumbnail()
    {
        if (is_array($this->data)) {
            if (array_key_exists('misc', $this->data)) {
                return $this->data['misc']['image'];
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     *
     * @param Book $book
     * @return $this|InternetArchiveService|array|null
     * @throws GuzzleException
     */
    public function fetchDetails(Book $book)
    {
        $client = new Client();

        try {
            $request = $client->get("https://archive.org/details/$book->internet_archive_identifier", [
                'query' => [
                    'output' => 'json'
                ],
            ]);

            $this->data = json_decode($request->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            return null;
        }

        return $this;
    }
}

<?php

namespace App\Services;

use App\Contracts\InternetArchive;
use App\Models\Book;
use App\Traits\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class InternetArchiveService implements InternetArchive
{
    use Helpers;

    /**
     * Data returned by Internet Archive
     *
     * @var Collection
     */
    public $data;

    /**
     * @inheritdoc
     *
     * @return mixed
     */
    public function thumbnail()
    {
        if ($this->data->has('misc')) {
            return $this->data['misc']->get('image');
        }

        return null;
    }

    /**
     * @inheritdoc
     *
     * @param Book $book
     * @return $this|InternetArchiveService|array
     * @throws GuzzleException
     */
    public function fetchDetails(Book $book)
    {
        $client = new Client();

        // Address where the request will be made
        $address = "https://archive.org/details/$book->internet_archive_identifier";

        try {
            $request = $client->get($address, [
                'query' => [
                    'output' => 'json'
                ],
            ]);
        } catch (ClientException $exception) {
            return [];
        }

        $this->data = $this->recursiveCollect(json_decode($request->getBody()->getContents(), true));

        return $this;
    }
}

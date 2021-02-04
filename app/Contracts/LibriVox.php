<?php

namespace App\Contracts;

use App\Models\Book;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

interface LibriVox
{
    /**
     * Search authors
     *
     * @return $this
     */
    public function authors();

    /**
     * Search audio books
     *
     * @return $this
     */
    public function audiobooks();

    /**
     * Search audio tracks
     *
     * @return $this
     */
    public function audiotracks();

    /**
     * Fields to return
     *
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields);

    /**
     * Query offset
     *
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset = 0);

    /**
     * Query limit
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit = 50);

    /**
     * Return the full set of data about the project
     *
     * @param bool $extended
     * @return $this
     */
    public function extended(bool $extended);

    /**
     * Fetch data from LibriVox
     *
     * @return Collection|mixed
     */
    public function fetch();

    /**
     * Fetch book RSS file
     *
     * @param Book|null $book
     * @return array|\SimpleXMLElement|string
     * @throws GuzzleException
     */
    public function fetchRss(Book $book);
}

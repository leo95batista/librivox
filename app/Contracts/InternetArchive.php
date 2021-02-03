<?php

namespace App\Contracts;

use App\Models\Book;
use GuzzleHttp\Exception\GuzzleException;

interface InternetArchive
{
    /**
     * Get book thumbnail
     *
     * @return mixed
     */
    public function thumbnail();

    /**
     * Fetch book details
     *
     * @param Book $book
     * @return $this|array
     * @throws GuzzleException
     */
    public function fetchDetails(Book $book);
}

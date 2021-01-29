<?php

namespace App\Contracts;

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
    public function offset(int $offset);

    /**
     * Query limit
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit);

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
     * @return \Illuminate\Support\Collection|mixed
     */
    public function fetch();
}

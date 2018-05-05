<?php

declare(strict_types=1);

namespace App\Service;

use Allegro\Allegro;

final class AllegroClient
{
    private $client;

    public function __construct(string $login, string $password, string $apiKey)
    {
        $this->client = new Allegro($apiKey);
        $this->client->login($login, $password);
    }

    /**
     * Return array of auctions
     *
     * @return array
     */
    public function getAuctions(): array
    {
        return $this->client->doGetMySellItems()->{'sellItemsList'}->{'item'};
    }
}
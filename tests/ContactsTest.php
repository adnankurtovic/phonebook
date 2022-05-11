<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ContactsTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/contacts');

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([
            '@context'          => '/api/contexts/Contact',
            '@id'               => '/api/contacts',
            '@type'             => 'hydra:Collection',
            'hydra:totalItems'  => 10,
            'hydra:view'        => [
                '@id'           => '/api/contacts?page=1',
                '@type'         => 'hydra:PartialCollectionView',
                'hydra:first'   => '/api/contacts?page=1',
                'hydra:last'    => '/api/contacts?page=2',
                'hydra:next'    => '/api/contacts?page=2',
            ]
        ]);

        $this->assertCount(5, $response->toArray()['hydra:member']);
    }


    public function testPagination(): void
    {
        $response = static::createClient()->request('GET', '/api/contacts?page=2');

        $this->assertJsonContains([
            '@context'          => '/api/contexts/Contact',
            '@id'               => '/api/contacts',
            '@type'             => 'hydra:Collection',
            'hydra:totalItems'  => 10,
            'hydra:view'        => [
                '@id'           => '/api/contacts?page=2',
                '@type'         => 'hydra:PartialCollectionView',
                'hydra:first'   => '/api/contacts?page=1',
                'hydra:last'    => '/api/contacts?page=2',
                'hydra:previous'    => '/api/contacts?page=1',
            ]
        ]);

        $this->assertCount(5, $response->toArray()['hydra:member']);
    }


    public function testCreateContact(): void
    {
        static::createClient()->request('POST', '/api/contacts', [
            'json' => [
                'FirstName'     => 'A name',
                'LastName'      => 'A surname',
                'Address'       => 'An address',
                'PhoneNumber'   => '0123456',
                'Birthday'      => '2022-05-11',
                'Email'         => 'email@example.com'
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([
            'FirstName'         => 'A name',
            'LastName'          => 'A surname',
            'Address'           => 'An address',
            'PhoneNumber'       => '0123456',
            'Birthday'          => '2022-05-11T00:00:00+00:00',
            'Email'             => 'email@example.com',                  
        ]);
    }


    public function testUpdateContact(): void
    {
        $client = static::createClient();
        
        $client->request('PUT', '/api/contacts/10', [
            'json' => [
                'FirstName'     => 'New name',
            ]
        ]);

        $this->assertResponseIsSuccessful();

        $this->assertJsonContains([
            '@id'               => '/api/contacts/10',
            'FirstName'          => 'New name',                
        ]);
    }
}
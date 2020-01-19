<?php


namespace Tests\Minecraft;

use Tests\TestCase;

class MinecraftTest extends TestCase
{

    public function testGetUidName()
    {
        $json = json_decode(file_get_contents('https://api.mojang.com/users/profiles/minecraft/numnoi?at=1579364447'), true);
        var_dump($json['name']);
        if($json['name'] === NULL){
            echo 'pak';
        }
        $unix_timestamp = now()->timestamp;
        echo $unix_timestamp;
        self::assertIsBool(true);
    }
}


//$endpoint = "http://my.domain.com/test.php";
//$client = new \GuzzleHttp\Client();
//$id = 5;
//$value = "ABC";
//
//$response = $client->request('GET', $endpoint, ['query' => [
//    'key1' => $id,
//    'key2' => $value,
//]]);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

//$statusCode = $response->getStatusCode();
//$content = $response->getBody();



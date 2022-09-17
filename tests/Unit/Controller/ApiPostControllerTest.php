<?php

namespace App\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiPostControllerTest extends WebTestCase
{
    public function testList(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/posts');

        $this->assertResponseIsSuccessful();
    }

    public function testPost(): void
    {
        $client = static::createClient();

        $crawler = $client->request('Post', '/api/post', [], [],[],$this->postWhithAuthor());

        $this->assertResponseIsSuccessful();
    }

    private function postWhithAuthor():string{
        return "{\"id\":1,\"userId\":1,\"title\":\"suntautfacererepellatprovidentoccaecatiexcepturioptioreprehenderit\",\"body\":\"quiaetsuscipit\\nsuscipitrecusandaeconsequunturexpeditaetcum\\nreprehenderitmolestiaeututquastotam\\nnostrumrerumestautemsuntremevenietarchitecto\",\"author\":{\"id\":1,\"name\":\"LeanneGraham\",\"username\":\"Bret\",\"email\":\"Sincere@april.biz\",\"phone\":\"1-770-736-8031x56442\",\"website\":\"hildegard.org\",\"address\":{\"street\":\"KulasLight\",\"suite\":\"Apt.556\",\"city\":\"Gwenborough\",\"zipcode\":\"92998-3874\",\"geo\":{\"lat\":\"-37.3159\",\"lng\":\"81.1496\"}},\"company\":{\"name\":\"Romaguera-Crona\",\"catchPhrase\":\"Multi-layeredclient-serverneural-net\",\"bs\":\"harnessreal-timee-markets\"}}}";
    }
}
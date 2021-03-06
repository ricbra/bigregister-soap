<?php
/*
* (c) Waarneembemiddeling.nl
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Wb\Test\BigRegister\SoapClient;


use Wb\BigRegister\SoapClient\Model\ListHcpApproxRequest;
use Wb\Test\SoapClientTestCase;

class ClientTest extends SoapClientTestCase
{
    public function testNumberSearch()
    {
        $client = $this->getMockSoapClient('search_number');
        $request = new ListHcpApproxRequest();
        $request->RegistrationNumber = '12345678902';
        $response = $client->ListHcpApprox3($request);

        $this->assertInstanceOf('Wb\BigRegister\SoapClient\Model\ListHcpApproxResponse3', $response);
        $this->assertInternalType('array', $response->ListHcpApprox->ListHcpApprox3);
        $this->assertCount(1, $response->ListHcpApprox->ListHcpApprox3);
        $this->assertInstanceOf(
            'Wb\BigRegister\SoapClient\Model\ArrayOfArticleRegistrationExtApp',
            $response->ListHcpApprox->ListHcpApprox3[0]->ArticleRegistration
        );
        $article = $response->ListHcpApprox->ListHcpApprox3[0]->ArticleRegistration;
        $this->assertInternalType('array', $article->ArticleRegistrationExtApp);
        $this->assertInstanceOf(
            'Wb\BigRegister\SoapClient\Model\ArticleRegistrationExtApp',
            $article->ArticleRegistrationExtApp[0]
        );
        $this->assertSame('12345678902', $article->ArticleRegistrationExtApp[0]->ArticleRegistrationNumber);
    }
} 

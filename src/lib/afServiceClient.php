<?php
/**
 * This class provides gateway to api services provided by appFlowerService project
 *
 * @todo - remove afRestWSPlugin requirement - we should use some symfony2 components
 * @author lukas
 */
class afServiceClient
{
    /**
     * @var afRESTWSClient
     */
    private $client;

    function  __construct(afRESTWSClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param type $url
     * @return afServiceClient
     */
    static function create($url, $username = null, $password = null)
    {
        if ($url == '') {
            throw new afServiceException('You must provide some URL');
        }
        $client = new afRESTWSClient();
        $client->setBaseUrl($url);
        
        if ($username && $password) {
            $client->setHttpAuthCredentials($username, $password);
        }
        
        return new afServiceClient($client);
    }

    /**
     * @return afRESTWSResponse
     */
    function CreateProject($projectName, $email, $adminPersonName)
    {
        $parameters = array(
            'payload' => json_encode(array(
                'name' => $projectName,
                'user' => array(
                    'name' => $adminPersonName,
                    'email'=> $email
                )
            ))
        );
        $request  = $this->client->createRequest($parameters, "project/create", 'POST');
        $response = $this->client->send($request, true);
        return $response;
    }
    
    /**
     * @return afRESTWSResponse
     */
    function CheckSlug($projectName)
    {
        $parameters = array(
            'payload' => json_encode(array(
                'name' => $projectName
            ))
        );
        $request  = $this->client->createRequest($parameters, "project/checkSlug", 'POST');
        $response = $this->client->send($request, true);
        return $response;
    }
}
?>
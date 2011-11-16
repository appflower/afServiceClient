<?php
/**
 * This class provides gateway to api services provided by appFlowerService project
 *
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
    static function create($url)
    {
//        $domain = sfConfig::get('app_seedcontrol_url');
//        $url = 'http://'.$domain.'/api.php';

        if ($url == '') {
            throw new Exception('You must provide some URL');
        }
        $client = new afRESTWSClient();
        $client->setBaseUrl($url);
        
//        $logger = sfContext::getInstance()->getLogger();
//        $client->setLogger($logger);

        return new self($client);
    }

    function CreateProject($slug, $email, $firstName, $lastName)
    {
        $parameters = array(
            'payload' => json_encode(array(
                'slug' => $slug,
                'name' => $slug,
                'user' => array(
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'email'      => $email
                )
            ))
        );
        $request  = $this->client->createRequest($parameters, "project/create", 'POST');
        $response = $this->client->send($request);

        if ($response->isSuccess()) {
            return $response->getMessage();
        } else {
            return false;
        }
    }

    /**
     * @return afRESTWSClient
     */
    function getClient()
    {
        return $this->client;
    }
}
?>
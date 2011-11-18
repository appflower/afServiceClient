This library provides simple PHP class that API reflects services provided by appFlowerService project (api.appflower.com)

It is borned while all places that needs it are symfony 1.x plugins.
That is why there is another requirement for afServiceClient to work.
You must have around afRestWebServicePlugin that contains base client classes.

It needs curl PHP extension

How to use it ?
require_once ...../afServiceClient.php
$client = afServiceClient::create('URL_TO_API');
$response = $client->CreateProject(....);
if ($response->isSuccess()) {
  echo ':)';
} else {
  echo ':(';
}
<?php

namespace Developtech\AgilityBundle\Api\Gateway;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Session\Session;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Entity\Repository\GithubRepository;

class GithubGateway extends JsonGateway
{
    /** @var string **/
    protected $clientId;
    /** @var string **/
    protected $clientSecret;
	/** @var string **/
	protected $redirectUri;
	/** @var string **/
	protected $accessToken;
	/** @var Session **/
	protected $session;

    /**
     * @param string $apiUrl
     * @param string $clientId
     * @param string $clientSecret
	 * @param string $redirectUri
	 * @param Session $session
     */
    public function __construct($apiUrl, $clientId, $clientSecret, $redirectUri, Session $session)
    {
        $this->client = new Client([
            'base_uri' => $apiUrl
        ]);
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
		$this->redirectUri = $redirectUri;
		$this->session = $session;
		$this->accessToken = $session->get('developtech_agility.github_access_token');
    }

    public function authorize()
    {
		$state = uniqid(true);
        $response = $this->post('https://github.com/login/oauth/authorize', [
			'client_id' => $this->clientId,
			'redirect_uri' => $this->redirectUri,
			'scope' => 'repo user',
			'state' => $state
        ]);
		$this->session->set('developtech_agility.oauth_state', $state);
        var_dump($response);die;
    }
	
	public function authenticate($code)
	{
        $response = $this->post('https://github.com/login/oauth/authorize', [
			'client_id' => $this->clientId,
			'client_secret' => $this->clientSecret,
			'code' => $code,
			'state' => $this->session->get('developtech_agility.oauth_state')
        ]);
        var_dump($response);die;
	}

    /**
     * @param GithubRepository $repository
     */
    public function createProject(GithubRepository $repository)
    {
		if ($this->accessToken === null) {
			$this->authorize();
		}
		$project = $repository->getProject();
        $response = $this->post("/repos/{$repository->getOwner()}/{$repository->getName()}/projects", [
			'name' => $project->getName(),
			'body' => $project->getDescription()
        ], [
			'Authorization' => "Token {$this->accessToken}"
		]);
		var_dump($response);die;
    }

    /**
     * @param ProjectModel $project
     */
    public function updateProject(ProjectModel $project)
    {

    }
	
	public function createRepository(GithubRepository $repository)
	{
		if ($this->accessToken === null) {
			$this->authorize();
		}
		$baseUrl = ($repository->getOwnerType() === GithubRepository::OWNER_ORGANIZATION) ? '/orgs' : '';
		
		$response = $this->post("{$baseUrl}/{$repository->getOwner()}/repos", [
			'name' => $repository->getName()
		], [
			'Authorization' => "Token {$this->accessToken}"
		]);
		var_dump($response);die;
	}
}

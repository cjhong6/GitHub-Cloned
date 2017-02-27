<?php
/**
 * Created by PhpStorm.
 * User: chengjiu
 * Date: 2/15/17
 * Time: 11:01 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class githutController extends Controller
{
    /**
     * @Route("/{username}", name="githut", defaults={"username" : "cjhong6"})
     */
    public function githutAction(Request $request, $username)
    {
        return $this->render('githut/index.html.twig',[
            'username' => $username,
            'repo_count' => 100,
            'most_stars' => 67,
            'repos' => [
                ['stargazers_count' => 46,
                        'name' => 'repository one',
                        'url' => 'google.com',
                        'description' => 'leanring one '
                ],
                ['stargazers_count' => 11,
                        'name' => 'repository two',
                        'url' => 'baidu.com',
                        'description' => 'leanring two'
                ],
                ['stargazers_count' => 22,
                        'name' => 'repository three',
                        'url' => 'yahoo.com',
                        'description' => 'leanring three'
                ],
            ]
        ]);

    }

    /**
     * @Route("/profile/{username}", name="profile")
     *
     */
    public function profilAction(Request $request, $username){
        //get the service then call the function of that class
        $profileData = $this->get('github_api')->getProfile($username);

        return $this->render('githut/profile.html.twig', $profileData);
    }
}
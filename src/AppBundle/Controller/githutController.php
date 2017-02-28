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
            'username' => $username
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

    /**
     * @Route("/repos/{username}", name="repos")
     *
     */
    public function reposAction(Request $request, $username){
        //get the service then call the function of that class
        $reposData = $this->get('github_api')->getRepos($username);

        return $this->render('githut/repos.html.twig', $reposData);
    }
}
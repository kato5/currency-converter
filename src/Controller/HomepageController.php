<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    
    /**
     * @Route("/converter/ajax", name="converter_ajax")
     */
    public function ajax(Request $request)
    {

        sleep(2);
        
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            
            $url = 'https://free.currencyconverterapi.com/api/v6/convert?q=RUB_PLN&compact=y'; 
            $result = file_get_contents($url);
            $vars = json_decode($result, true);
//            var_dump($vars);
            
            var_dump($vars['RUB_PLN']['val']);
//var_dump($request->query->get('amount'));
            $plnConvertValue = $vars['RUB_PLN']['val'] * $request->request->get('amount', 1);
            
            $jsonData = [];
                    
            var_dump($request->request->get('amount', 1));
            
            $jsonData = array(
                array(
                'name' => 'Nowak',
                'address' => 'Topolowa'),
                array(
                'name' => 'Kwiatek',
                'address' => 'Jaśminowa'),
            );            
            
           return new JsonResponse($jsonData); 
        } else { 
           return $this->render('homepage/ajax.html.twig'); 
        } 
     

//        return $this->render('homepage/index.html.twig', [
//            'num' => random_int(1, 100),
//        ]);
    }
    
}

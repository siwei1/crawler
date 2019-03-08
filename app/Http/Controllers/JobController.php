<?php

namespace App\Http\Controllers;

use App\Common\Dom;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class JobController extends Controller
{

    private $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function catchLocal()
    {
        $res = $this->client->request('get','https://www.zhipin.com/job_detail/?query=PHP&scity=101190400&industry=&position=',[
            'verify' => false
        ]);

        $res = $res->getBody()->getContents();
        file_put_contents('1.txt',$res);
    }

    public function getLocal()
    {
        $boss = file_get_contents('1.html');


        try{

            $dom = new Dom();
            $div = $dom->setParam($boss,'div','class="job-list"','<div class="page">')->row();

            $dom->setGreedy(true);
            $li = $dom->setParam($div,'li')->all();

            $salary = [];

            foreach ($li as $v)
            {
                $dom->setGreedy(true);
                $company[] = $dom->setParam($dom->setParam($v,'div','class="company-text"')->row(),'a')->row();
                $salary[] = $dom->setParam($v,'span','class="red"')->row();
            }




        }catch(\Exception $e)
        {
            var_dump($e->getMessage());
        }
    }

}

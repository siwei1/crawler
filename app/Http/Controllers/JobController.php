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
        $boss = file_get_contents('1.txt');

        Dom::getContent($boss,'class="job-list"','div');

    }

}

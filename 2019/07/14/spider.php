<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-15
 * Time: 14:02
 */

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//print_r(json_encode(Spider(), JSON_UNESCAPED_UNICODE));

var_dump(Spider());

function Spider(){
//    $url = "https://www.toutiao.com/a6713704525447823884/";

    $url = "https://movie.douban.com/subject/6850547/";

    //下载网页内容
    $client   = new Client([
        'timeout' => 10,
        'headers' => ['User-Agent' => 'Mozilla/5.0 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)',
        ],
    ]);
    $response = $client->request('GET', $url)->getBody()->getContents();

    //进行XPath页面数据抽取
    $data    = []; //结构化数据存本数组
    $crawler = new Crawler();
    $crawler->addHtmlContent($response);

//    var_dump($crawler);

    try{
//        $data['name'] = $crawler->filterXPath('//h1[contains(@class,"article-title")]')->text();

        $data['name'] = $crawler->filterXPath('//*[@id="content"]/h1/span[1]')->text();
        //电影海报
        $data['cover'] = $crawler->filterXPath('//*[@id="mainpic"]/a/img/@src')->text();
        //导演
        $data['director'] = $crawler->filterXPath('//*[@id="info"]/span[1]/span[2]')->text();
        //多个导演处理成数组
        $data['director'] = explode('/', $data['director']);
        //过滤前后空格
        $data['director'] = array_map('trim', $data['director']);

        //编剧
        $data['cover'] = $crawler->filterXPath('//*[@id="info"]/span[2]/span[2]/a')->text();
        //主演
        $data['mactor'] = $crawler->filterXPath('//*[@id="info"]/span[contains(@class,"actor")]/span[contains(@class,"attrs")]')->text();
        //多个主演处理成数组
        $data['mactor'] = explode('/', $data['mactor']);
        //过滤前后空格
        $data['mactor'] = array_map('trim', $data['mactor']);

        //上映日期
        $data['rdate'] = $crawler->filterXPath('//*[@id="info"]')->text();
        //使用正则进行抽取
        preg_match_all("/(\d{4})-(\d{2})-(\d{2})\(.*?\)/", $data['rdate'], $rdate); //2017-07-07(中国大陆) / 2017-06-14(安锡动画电影节) / 2017-06-30(美国)
        $data['rdate'] = $rdate[0];

        $data['introduction'] = trim($crawler->filterXPath('//div[contains(@class,"indent")]/span')->text());
    } catch (\Exception $e) {

    }

    return $data;
}
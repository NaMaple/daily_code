<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-16
 * Time: 10:26
 */

require './vendor/autoload.php';


use phpspider\core\phpspider;
use phpspider\core\requests;    //请求类
use phpspider\core\selector;    //选择器类
use phpspider\core\db;          //选择器类
use phpspider\core\log;         //选择器类

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '头条财经',
    'domains' => array(
        'www.toutiao.com'
    ),
    'scan_urls' => array(
        'https://www.toutiao.com/ch/investment/',
//        'https://www.toutiao.com/ch/stock_channel/',
//        'https://www.toutiao.com/ch/finance_management/',
//        'https://www.toutiao.com/ch/macro_economic/',
    ),
    'content_url_regexes' => array(
//        "https://www.toutiao.com/group/\d+"
    ),
    'list_url_regexes' => array(
//        "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
    ),
    'log_show' => true,
    //日志存放的位置
    'log_file' => './data/phpspider.log',
    'export' => array(
        'type' => 'csv',
        'file' => './data/phpspider.csv', //爬下来的数据放在data目录下，目录和文件要自己提前创建好
    ),
    'log_type' => 'error,debug,warn,error',
    //爬虫爬取网页所使用的浏览器类型.随机浏览器类型，用于破解防采集
    'user_agent' => array(
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
        "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
    ),
    'fields' => array(
//        array(
//            // 抽取内容页列表
//            'name' => "article_content",
//            'selector' => "//*[@id='single-next-link']",
//            'required' => true
//        ),
        array(
            'name' => "article_title",
//            'selector' => "//div[contains(@class,'wcommonFeed')]//ul//li[contains(@class,'item    ')]",
//            'selector' => "//div[contains(@ga_event,'article_title_click')]",
            'selector' => "//div[@class='title-box']/a",
            'required' => true,
            'repeated' => true
        ),
    ),
);
$spider = new phpspider($configs);
$spider->start();

$spider->on_extract_field = function($fieldname, $data, $page){
    var_dump($data);
};
<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-18
 * Time: 11:03
 */

require './vendor/autoload.php';

use phpspider\core\phpspider;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '糗事百科',
    'domains' => array(
        'qiushibaike.com',
        'www.qiushibaike.com'
    ),
    'scan_urls' => array(
        'http://www.qiushibaike.com/'
    ),
    'content_url_regexes' => array(
        "http://www.qiushibaike.com/article/\d+"
    ),
    'list_url_regexes' => array(
        "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
    ),
    'fields' => array(
        array(
            // 抽取内容页的文章内容
            'name' => "article_content",
            'selector' => "//*[@id='single-next-link']",
            'required' => true
        ),
        array(
            // 抽取内容页的文章作者
            'name' => "article_author",
            'selector' => "//h1[contains(@class,'article-title')]",
            'required' => true
        ),
    ),
    'log_show' => true,
    //日志存放的位置
    'log_file' => './data/index_2.log',
    'log_type' => 'error,debug,warn,error',
);
$spider = new phpspider($configs);
$spider->start();

$spider->on_extract_field = function($fieldname, $data, $page){
    var_dump($data);
};
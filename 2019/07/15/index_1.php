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

$html =<<<STR

<div class="rbox-inner"> 
    <div class="title-box" ga_event="article_title_click"> 
        <a class="link title" target="_blank" href="/group/6714530674507776526/"> 赵氏论金：19.7.17欧评黄金、原油、欧美、镑美行情解析 </a>  
    </div>  
    <div class="y-box footer"> 
        <div class="y-left">   
            <div class="y-left"> 
                <a class="lbtn media-avatar" target="_blank" ga_event="article_avatar_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/"> 
                    <img alt="" src="//p9.pstatp.com/large/6c4c000408c5494ce04d"> 
                </a>
                <a class="lbtn source" target="_blank" ga_event="article_name_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/">&nbsp;赵氏论金&nbsp;⋅</a>
                <a class="lbtn comment" target="_blank" ga_event="article_comment_click" href="/group/6714530674507776526//#comment_area">&nbsp;评论&nbsp;⋅</a>
            </div> 
            <span class="lbtn">&nbsp;1小时前</span>    
        </div>
        <div class="y-right">
            <span class="dislike" data-groupid="6714530674507776526" ga_event="article_dislike_click"> 不感兴趣 <i class="y-icon icon-dislikenewfeed"></i></span>
        </div>
    </div>
</div>
<div class="rbox-inner"> 
    <div class="title-box" ga_event="article_title_click"> 
        <a class="link title" target="_blank" href="/group/6714530674507776526/"> 赵氏论金：19.7.17欧评黄金、原油、欧美、镑美行情解析 </a>  
    </div>  
    <div class="y-box footer"> 
        <div class="y-left">   
            <div class="y-left"> 
                <a class="lbtn media-avatar" target="_blank" ga_event="article_avatar_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/"> 
                    <img alt="" src="//p9.pstatp.com/large/6c4c000408c5494ce04d"> 
                </a>
                <a class="lbtn source" target="_blank" ga_event="article_name_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/">&nbsp;赵氏论金&nbsp;⋅</a>
                <a class="lbtn comment" target="_blank" ga_event="article_comment_click" href="/group/6714530674507776526//#comment_area">&nbsp;评论&nbsp;⋅</a>
            </div> 
            <span class="lbtn">&nbsp;1小时前</span>    
        </div>
        <div class="y-right">
            <span class="dislike" data-groupid="6714530674507776526" ga_event="article_dislike_click"> 不感兴趣 <i class="y-icon icon-dislikenewfeed"></i></span>
        </div>
    </div>
</div>
<div class="rbox-inner"> 
    <div class="title-box" ga_event="article_title_click"> 
        <a class="link title" target="_blank" href="/group/6714530674507776526/"> 赵氏论金：19.7.17欧评黄金、原油、欧美、镑美行情解析 </a>  
    </div>  
    <div class="y-box footer"> 
        <div class="y-left">   
            <div class="y-left"> 
                <a class="lbtn media-avatar" target="_blank" ga_event="article_avatar_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/"> 
                    <img alt="" src="//p9.pstatp.com/large/6c4c000408c5494ce04d"> 
                </a>
                <a class="lbtn source" target="_blank" ga_event="article_name_click" href="/c/user/token/MS4wLjABAAAAZqtaUrtR4b6XSzM8xQDexysf1cFLDQM6Sj0G002Jk2s/">&nbsp;赵氏论金&nbsp;⋅</a>
                <a class="lbtn comment" target="_blank" ga_event="article_comment_click" href="/group/6714530674507776526//#comment_area">&nbsp;评论&nbsp;⋅</a>
            </div> 
            <span class="lbtn">&nbsp;1小时前</span>    
        </div>
        <div class="y-right">
            <span class="dislike" data-groupid="6714530674507776526" ga_event="article_dislike_click"> 不感兴趣 <i class="y-icon icon-dislikenewfeed"></i></span>
        </div>
    </div>
</div>
STR;

$data = selector::select($html, "//div[@class='title-box']/a");
var_dump($data);
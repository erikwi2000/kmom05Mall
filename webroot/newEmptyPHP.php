<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
    require_once("../config.php"); 
    $content = new CContent(new CDatabase($joh['database'])); 
    $view = ""; 
    $formTitle = "Skapa en post"; 
    $userInteraction = false; //Om ingen get||post metod anropas. 
    if(isset($_GET['action']) && method_exists($content,$_GET['action'])){ 
        $view = $content->{$_GET['action']}(); 
        $formTitle = "Redigera post"; 
        $userInteraction = true; 
    } 
    if(isset($_POST['publishData']) || isset($_POST['storeData'])){ 
        $view = $content->createPost($_POST); 
        $userInteraction = true; 
    } 
    if(isset($_POST['updateData'])){ 
        $view = $content->updatePost($_POST); 
        $formTitle = ""; 
        $userInteraction = true; 
    } 
    if(isset($_POST['deleteData'])){ 
        $view = $content->deletePost($_POST); 
        $formTitle = ""; 
        $userInteraction = true; 
    } 
    if(!$userInteraction){ 
        $view = $content->init(); 
    } 
    $righter = $content->viewAllPosts(); 
     
    $joh['title'] = "Skapa sida"; 
    $joh['custom_scripts'][] = "http://code.jquery.com/ui/1.10.3/jquery-ui.js"; 
    $joh['custom_scripts'][] = "js/kmom05.js"; 
    $joh['stylesheets'][] = "css/kmom05_edit.css"; 
    $joh['stylesheets'][] = "http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"; 
    $joh['main'] = "<div id='mainWrap'>\n"; 
    $joh['main'] .= "<div id='mainContent'>\n"; 
    $joh['main'] .= "<h2>" . $formTitle . "</h2>"; 
    $joh['main'] .= $view . "</div>\n"; 
    $joh['main'] .= "<div id='righter'>\n"; 
    $joh['main'] .= "<p class='sub'><a href='blog.php'>Gå till Blogg</a> 
                    <a href='page.php'>Gå till Page</a> 
                    <a href='content.php'>Skapa ny Post</a></p>\n 
                    <h2>Ditt innehåll</h2>\n"; 
    $joh['main'] .= "<div id='righter-inner'>\n". $righter . "</div>\n"; 
    $joh['main'] .= "</div>\n"; 
    $joh['main'] .= "</div>\n"; 
    require(JOH_THEMES_PATH . "render.php"); 
?>
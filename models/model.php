<?php

function open_database_con()
{

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "haha";
    $db_name = "ico";

    try {
            $link = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
        return $link;
}

function close_database_con(&$link)
{
    $link = null;
}

function getPostsGeneralPreview()
{
    $link = open_database_con();

    $sql = "SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC limit 3";
    $query = $link->prepare($sql);
    $query->execute();

    $posts = array();

    while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $result;
    }
    close_database_con($link);

    return $posts;
}

function getAllBlogPosts()
{
    $link = open_database_con();
    $sql = "SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC";
    $query = $link->prepare($sql);
    $query->execute();

    $posts = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $result;
    }
    close_database_con($link);

    return $posts;
}

function displayDiseredBlogPost($id)
{
        $link = open_database_con();

        $sql = "select * from blog_posts where id = ?";
        $query = $link->prepare($sql);
        $query->execute([$_GET['id']]);

        $blogResult = $query->fetch(PDO::FETCH_ASSOC);

        close_database_con($link);
        return $blogResult;
}

function displayAllComments()
{
    $link = open_database_con();

    $sql = "SELECT * FROM comments where blog_post_id = ? order by id desc";
    $query = $link->prepare($sql);
    $query->execute([$_GET['id']]);

    $comments = array();
    while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
        $comments[] = $result;
    }
    close_database_con($link);

    return $comments;
}

function addComment($author, $commentBody, $displayed, $blogPostId)
{
    $link = open_database_con();
    $sql = "INSERT INTO comments (author, comment_body, displayed, blog_post_id) VALUES (:author,:comment_body,:displayed,:blog_post_id)";
    $query = $link->prepare($sql);
    $query->execute(array(  'author'       => $author,
                            'comment_body' => $commentBody,
                            'displayed'    => $displayed,
                            'blog_post_id' => $blogPostId));

    header("Location:blogs.php?id=".$blogPostId);

    close_database_con($link);
}


function createBlogPost($title, $body, $published)
{
    $link = open_database_con();

    $sql = "insert into blog_posts (title, body,published) values (:title, :body, :published)";
    $query = $link->prepare($sql);
        $query->execute(array('title' => $title,
                              'body' => $body,
                              'published' => $published));
        $_SESSION['messages'] = [
        'blogPosted' => 'Blog post send successfully',
        'postAnotherBlog' => 'You can post another one!'
        ];
        header("Location:admin.php");
        close_database_con($link);
}


function dataview()
{
    $result= '';
    $link = open_database_con();
    $sql = "SELECT * FROM blog_posts ORDER BY id DESC";

    $query = $link->prepare($sql);
    $query->execute();

    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        $result .=

        '<tr>
                <td>'.htmlspecialchars($row['id']).'</td>
                <td>'.htmlspecialchars($row['title']).'</td>
                <td>'.htmlspecialchars($row['body']).'</td>
                <td>'.htmlspecialchars($row['published']).'</td>
                <td><a href="edit.php?id='.$row['id'].'"class="button button2">Edit</a></td>
                <td><a class="button button3" href="delete.php?id='.$row['id'].'">Delete</a></td>
                </tr>';
    }
    close_database_con($link);
    return $result;
}

function paging($records_per_page)
{
    $link = open_database_con();
    $sql = "SELECT * FROM blog_posts ORDER BY id DESC";

    $query = $link->prepare($sql);
    $query->execute();

    $starting_position=0;
    if (isset($_GET["page_no"])) {
         $starting_position=((int)$_GET["page_no"]-1)*$records_per_page;
    }
    $query2=$sql." limit $starting_position,$records_per_page";
    close_database_con($link);

    return $query2;
}

function paginglink($query, $records_per_page)
{
    $html = '';
    $self = $_SERVER['PHP_SELF'];

    $link = open_database_con();
    $sql = "SELECT * FROM blog_posts ORDER BY id DESC";

    $query = $link->prepare($sql);
    $query->execute();

    $total_no_of_records = $query->rowCount();

    if ($total_no_of_records > 0) {
        $html .=
        '<tr><td colspan="10">';
        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
        $current_page=1;
        if (isset($_GET["page_no"])) {
            $current_page=$_GET["page_no"];
        }
        if ($current_page!=1) {
            $previous =$current_page-1;
            $html .= "<a href='".$self."?page_no=1'>First</a>&nbsp;&nbsp;";
            $html .= "<a href='".$self."?page_no=".$previous."'>Previous</a>&nbsp;&nbsp;";
        }
        for ($i=1; $i<=$total_no_of_pages; $i++) {
            if ($i==$current_page) {
                $html .= "<strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
            } else {
                $html .= "<a href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
            }
        }
        if ($current_page!=$total_no_of_pages) {
            $next=$current_page+1;
            $html .= "<a href='".$self."?page_no=".$next."'>Next</a>&nbsp;&nbsp;";
            $html .= "<a href='".$self."?page_no=".$total_no_of_pages."'>Last</a>&nbsp;&nbsp;";
        }
        $html .='</td></tr>';
        close_database_con($link);
    } return $html;
}

function login($username)
{
    $link = open_database_con();
    $sql = "SELECT * FROM admin WHERE username = ?";
    $query = $link->prepare($sql);
    $result = $query->execute([$_POST['username']]);
    $user = $query->fetchAll(PDO::FETCH_OBJ);
    if (isset($user[0]) && password_verify($_POST['password'], $user[0]->password) && empty($_SESSION      ['login_user'])) {
        $_SESSION['login_user'] = $username;
        $_SESSION['messages'] = ['login' => 'Welcome MF , you entered the Blog'];
        header('location:blogposts.php');
    } else {
        $_SESSION['messages'] = ['<p>'.'Wrong Username or Password'.'</p>'];
        if (!empty($_SESSION['messages']) && !isset($errorMessage)) {
            echo $_SESSION['messages'][0];
        }
    }   unset($_SESSION['messages'][0]);
}

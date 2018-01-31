<?php
include('../inc/header_admin.php');
$currentPage= 'comment_list';



$records_per_page=10;

include('templates/comment_list.tpl.html');
    $link = open_database_con();
    $sql = "SELECT * FROM comments ORDER BY id DESC";
    $query = $link->prepare($sql);
    $query->execute();

    if($query->rowCount()>0)
    {
        $html = '';
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo

            '<table>
            <tr>
            <th width="5%">'.htmlspecialchars($row['id']).'</th>
            <th width="10%">'.htmlspecialchars($row['author']).'</th>
            <th>'.htmlspecialchars($row['comment_body']).'</th>
            <th width="10%">'.htmlspecialchars($row['created']).'</th>
            <th width="5%">'.htmlspecialchars($row['displayed']).'</th>
            <th width="5%">'.htmlspecialchars($row['blog_post_id']).'</th>
            <th width="5%"><a href="edit.php?id='.$row['id'].'"class="button button2">Edit</a></th>
            <th width="5%"><a class="button button3" href="delete.php?id='.$row['id'].'">Delete</a></th>
            </tr>
            </table>';


        }

    }
    else
    {
        echo  '<tr>
        <td>Nothing here...</td>
        </tr>';
    }




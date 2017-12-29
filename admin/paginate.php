<?php

class paginate
{
 private $db;

 function __construct($DB_con)
 {
     $this->db = $DB_con;
 }

 public function dataview($query)
 {
     $stmt = $this->db->prepare($query);
     $stmt->execute();

     if($stmt->rowCount()>0)
     {
            $html = '';

            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $html .=

                '<tr>
                <td>'.htmlspecialchars($row['id']).'</td>
                <td>'.htmlspecialchars($row['title']).'</td>
                <td>'.htmlspecialchars($row['body']).'</td>
                <td>'.htmlspecialchars($row['published']).'</td>
                <td><a href="edit.php?id='.$row['id'].'"class="button button2">Edit</a></td>
                <td><a class="button button3" href="delete.php?id='.$row['id'].'">Delete</a></td>
                </tr>';


            }
     }
     else
     {
         $html = '<tr>
            <td>Nothing here...</td>
            </tr>';
    }

    return $html;
}

public function paging($query,$records_per_page)
{
    $starting_position=0;
    if(isset($_GET["page_no"]))
    {
         $starting_position=((int)$_GET["page_no"]-1)*$records_per_page;
    }
    $query2=$query." limit $starting_position,$records_per_page";
    return $query2;
}

public function paginglink($query,$records_per_page)
{
    $html = '';
    $self = $_SERVER['PHP_SELF'];

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    $total_no_of_records = $stmt->rowCount();

    if($total_no_of_records > 0)
    {
        $html .=
        '<tr><td colspan="10">';
        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
        $current_page=1;
        if(isset($_GET["page_no"]))
        {
           $current_page=$_GET["page_no"];
        }
        if($current_page!=1)
        {
           $previous =$current_page-1;
           $html .= "<a href='".$self."?page_no=1'>First</a>&nbsp;&nbsp;";
           $html .= "<a href='".$self."?page_no=".$previous."'>Previous</a>&nbsp;&nbsp;";
        }
        for($i=1;$i<=$total_no_of_pages;$i++)
        {
        if($i==$current_page)
        {
            $html .= "<strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
        }
        else
        {
            $html .= "<a href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
        }
}
if($current_page!=$total_no_of_pages)
{
    $next=$current_page+1;
    $html .= "<a href='".$self."?page_no=".$next."'>Next</a>&nbsp;&nbsp;";
    $html .= "<a href='".$self."?page_no=".$total_no_of_pages."'>Last</a>&nbsp;&nbsp;";
}
$html .='</td></tr>';
} return $html;
}
}

<?php
include 'db_connect.php';

$output = '';
$video_id = '';
sleep(1);

$last_comment_id = $_POST['last_comment_id'];
$post_id = $_POST['post_id'];
$hidden = $_POST['hidden'];

$sql = "SELECT comments.comment_id, users.nick,comments.date,comments.content 
                            FROM comments 
                            JOIN users ON comments.user_id=users.user_id 
                            JOIN posts ON comments.post_id=posts.post_ID 
                            WHERE posts.post_ID=" . $post_id . " AND comment_id > " . $last_comment_id . " ORDER BY comment_id ASC LIMIT 5";
$result = mysqli_query($db, $sql);

if ($result != false) {

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $comment_id = $row["comment_id"];
            $output .= '  
               <tbody>  
                   <tr style="background-color: black">  
                        <td>
                        <p style="color: red">' . $row['nick'] . '</p>
                        </td> 
                        <td style="text-align: right; color: #727272">
                            <button class="' . $hidden . '">Odstranit</button>
                            <i>' . $row['date'] . '</i>
                        </td>
                   </tr>
                   <tr>
                        <td colspan="2">
                            ' . $row['content'] . '
                        </td>
                   </tr>
               </tbody>';
        }
        $output .= '  
               <tbody>
                   <tr id="remove_row">  
                        <td>
                            <button type="button" name="btn_more" data-vid="' . $comment_id . '" id="btn_more" class="btn btn-primary">Viac</button>
                        </td>  
                   </tr>
               </tbody>  
     ';
        echo $output;
    }
}


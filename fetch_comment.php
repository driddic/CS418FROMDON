<?php
//fetch_comment.php
include 'testconn.php';
session_start();
$sessid=$_SESSION['userid'];
$sessname=$_SESSION['username'];
$group = $_POST['groupajax'];


//
///
/// Pagination Code starts
///
//
//
$results_per_page = 10;

$page = '';
$output = '';
// determine which page number visitor is currently on

if (isset($_POST["page"])) {
  $page = $_POST["page"];
} else {
  $page = 1;
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page

//query will also be used for all queries
$sqlone="SELECT * FROM tbl_comment
WHERE parent_comment_id = '0' and grpid = '$group'
ORDER BY comment_id DESC LIMIT ".$this_page_first_result.",".$results_per_page."";
$result = mysqli_query($conn, $sqlone);
$output = '';
$page_query = "SELECT * FROM tbl_comment WHERE grpid = '$group' ORDER BY comment_id DESC";
$page_result = mysqli_query($conn, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$results_per_page);

for($i=1; $i<=$total_pages; $i++)
{
  $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'">'.$i.'</span>';
}

///
/// Pagination Code just ended
///

///
///Starting to get the messages from the tbl_comment table in database
///

while ($row = mysqli_fetch_assoc($result)) {
        $fubb = $row['uid'];//will be used later for "only visible to user"
        $photo = "SELECT * FROM profileimage WHERE userid = '$fubb' ";
        $pic = mysqli_query($conn, $photo);
        $duc=mysqli_fetch_assoc($pic);

        //coach bots photo


//if the message begins with a slash then only make it visible
//lets first grab the slash using md_substr
    $fact = $row['message'];
    $getSlash = mb_substr($fact,0,1,"UTF-8");

    if ($getSlash == "/"){
      //we want these types of messages to only
      // become visible to the user who posted it

      if ($sessid == $fubb) {
      // show the output of the different commands

      //establish the string everything
      $spaceOut = explode(" ",$fact);

      //if archive is called run query and display the command
      if ($spaceOut[0] == "archive" || $spaceOut[0] == "/archive") {
        if ($sessid == '9') { //only the admin can archive

          //sql query to set to archive
          $grpnum = $row["grpid"];
          $sqljones = "UPDATE groups set archive = 1 where grpid = '$grpnum' ";
          $jonesrun = mysqli_query($conn,$sqljones);

          //redirect to homepage
          header("Location: homepage.php");
          exit();

          //no point of this just here...
          $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "assets/bot.png">
              By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-footer" align="right">
              </div>
             </div>
             ';


        }else {//warning to the user for trying this command

        $output .= '
           <div class="panel panel-default">
            <div class="panel-heading">
            <img class= "avatar" src = "assets/bot.png">
            By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
            <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
            <div class="panel-body"><p>Only the administrator can do that! </p></div>
            <div class="panel-footer" align="right">
            </div>
           </div>
           ';
         }
      }

      if ($spaceOut[0] == "msg" || $spaceOut[0] == "/msg" ) {
        // now read for the user
        // need to validate if the user is the infact an user
        // run query to check
        $userCheck = $spaceOut[1];
        $userQ = "SELECT * FROM users WHERE uname = '$userCheck' ";
        $userMatch = mysqli_query($conn,$userQ);
        //time for the $query
        $clamthis =  mysqli_fetch_assoc($userMatch);
        //$grpnum = $row["grpid"];
        $calm = $clamthis["userid"];
        $calmName = $clamthis["uname"];

        if (mysqli_num_rows($userMatch) > 0) {
          $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "assets/bot.png">
              By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body">'.$row["message"].'</div>
              <div class="panel-body" align = center>
              <form action ="messages.php" method= "post">
                      <input type = "hidden" name= "searchedname" id = "searchedname" value = "'.$calmName.'">
                      <input type = "hidden" name= "searchedid" id = "searchedid" value = "'.$calm.'">
                      <input type = "Submit" name = "submit" value= "Message">
                    </form></div>
              <div class="panel-body"><p>"Ill tell em the message, once you send it"</p></div>
              <div class="panel-footer" align="right">
              </div>
             </div>
             ';
        }else {
          // telling the user to use a name that exist
          $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "assets/bot.png">
              By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body">'.$row["message"].'</div>
              <div class="panel-body"><p>"Is that a new guy? User is not found"</p></div>
              <div class="panel-footer" align="right">
              </div>
             </div>
             ';
        }
      }
      if ($spaceOut[0] == "invite" || $spaceOut[0] == "/invite") {

        // time to invite
        // now read for the user
        // need to validate if the user is the infact an user
        // run query to check
        $userCheck = $spaceOut[1];
        $userQ = "SELECT * FROM users WHERE uname = '$userCheck' ";
        $userMatch =mysqli_query($conn,$userQ);
        if (mysqli_num_rows($userMatch) > 0) {

          //time for the $query
          $calmthis =  mysqli_fetch_assoc($userMatch);
          $grpnum = $row["grpid"];
          $calm = $calmthis["userid"];

          $query = "INSERT INTO membership (grpid, userid, uname, active)
                    VALUES ('$grpnum','$calm','$userCheck', 1)";
          mysqli_query($conn,$query);
          // echo $query;
          //executing the user command
          $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "assets/bot.png">
              By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body"><p>"inviting '.$userCheck.'"</p></div>
              <div class="panel-footer" align="right"></div>
             </div>
             ';

        }
        else {
          // telling the user to use a name that exist
          $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "assets/bot.png">
              By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body">'.$row["message"].'</div>
              <div class="panel-body"><p>"User is not found"</p></div>
              <div class="panel-footer" align="right">
              </div>
             </div>
             ';
        }
      }
      if ($spaceOut[0] == "who" || $spaceOut[0] == "/who") {
        // now we want the list of group members
        // run the query
        $grpnum = $row["grpid"];
        $grproll = "SELECT uname From membership where grpid = '$grpnum' ";
        $list = mysqli_query($conn,$grproll);
        $file = "assets/messages/newnamelist".rand(100,999).".txt";
        $f = fopen($file, 'w');
        while ($roll = mysqli_fetch_array($list)) {
          // write to file and display in message
          $names = $roll["uname"];
          $nameroll = "$names\n";
          fwrite($f, $nameroll);
        }
        $output .= '
           <div class="panel panel-default">
            <div class="panel-heading">
            <img class= "avatar" src = "assets/bot.png">
            By <b>Coach Bot</b> on <i>'.$row["date"].'</i></div>
            <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
            <div class="panel-body"><pre>'.file_get_contents($file).'</pre></div>
            <div class="panel-footer" align="right"></div>
           </div>
           ';
      }
      }
      }
      else {
        // if there is no "\"
        // we don't want any other users seeing the bot commands


        //if there is no photo
       if (empty($row['image'])) {
          if ($row['code'] == '1') {  //if there is code
            if ($sessid == '9') { //admin ability delete post

              $output .= '
               <div class="panel panel-default">
                <div class="panel-heading">
                <img class= "avatar" src = "'.$duc["locate"].'">
                By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
                <div class="panel-body"></div>
                <div class="panel-body" align = "justify"><pre><code>'.htmlspecialchars($row["message"]).'</code></pre></div>
                <div class="panel-footer" align="right">
                <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
                 <form action = "add_vote.php" method = "post">
                 <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
                 <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
                 '.$row["voteup"].'
                <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
                <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
              '.$row["votedown"].'
                </form>
                <form action= "setting.php" method = "post">
                <button type = "submit" name="delete" value="'.$row["comment_id"].'">Delete</button>
                </form>
                </div>
               </div>
               ';
            } else { // no admin delete

             $output .= '
              <div class="panel panel-default">
               <div class="panel-heading">
               <img class= "avatar" src = "'.$duc["locate"].'">
               By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
               <div class="panel-body"></div>
               <div class="panel-body" align = "justify"><pre><code>'.htmlspecialchars($row["message"]).'</code></pre></div>
               <div class="panel-footer" align="right">
               <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
                <form action = "add_vote.php" method = "post">
                <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
                <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
                '.$row["voteup"].'
               <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
               <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
             '.$row["votedown"].'
               </form>
               </div>
              </div>
              ';
                }
              }else{              //if there is no code in post

                       if ($sessid == '9') { //admin ability delete post

                         $output .= '
                          <div class="panel panel-default">
                           <div class="panel-heading">
                           <img class= "avatar" src = "'.$duc["locate"].'">
                           By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
                           <div class="panel-body"></div>
                           <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
                           <div class="panel-footer" align="right">
                           <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
                            <form action = "add_vote.php" method = "post">
                            <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
                            <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
                            '.$row["voteup"].'
                           <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
                           <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                         '.$row["votedown"].'
                           </form>
                           <form action= "setting.php" method = "post">
                           <button type = "submit" name="delete" value="'.$row["comment_id"].'">Delete</button>
                           </form>
                           </div>
                          </div>
                          ';
                       }else {
                         //no admin
                      $output .= '
                      <div class="panel panel-default">
                       <div class="panel-heading">
                       <img class= "avatar" src = "'.$duc["locate"].'">
                       By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
                       <div class="panel-body"></div>
                       <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
                       <div class="panel-footer" align="right">
                       <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
                        <form action = "add_vote.php" method = "post">
                        <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
                        <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
                        '.$row["voteup"].'
                       <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
                       <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                     '.$row["votedown"].'
                       </form>
                       </div>
                      </div>
                      ';
                             }
                  }
        }else {//if there is a photo
          if ($sessid == '9') { //admin ability delete post

            if (pathinfo($row["image"],PATHINFO_EXTENSION) == txt) {   //if the file is a text file
              $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "'.$duc["locate"].'">
              By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body"><img src = "'.$row["image"].'" height="150" width="225"></div>
              <div class="panel-body"><pre>'.file_get_contents($row["image"]).'</pre></div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-footer" align="right">
                <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
               <form action = "add_vote.php" method = "post">
               <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
               <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
               '.$row["voteup"].'
              <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
              <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                '.$row["votedown"].'
              </form>
              <form action= "setting.php" method = "post">
              <button type = "submit" name="delete" value="'.$row["comment_id"].'">Delete</button>
              </form>
              </div>
             </div>
             ';
            }
            else{//if the file is not a text file just display the photo

              $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "'.$duc["locate"].'">
              By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body"><img src = "'.$row["image"].'" height="150" width="225"></div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-footer" align="right">
              <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
               <form action = "add_vote.php" method = "post">
               <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
               <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
               '.$row["voteup"].'
              <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
              <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                '.$row["votedown"].'
              </form>
              <form action= "setting.php" method = "post">
              <button type = "submit" name="delete" value="'.$row["comment_id"].'">Delete</button>
              </form>
              </div>
             </div>
             ';
            }
          }else{ //no admin delete
            if (pathinfo($row["image"],PATHINFO_EXTENSION) == 'txt') { //if the file is a text file
              $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "'.$duc["locate"].'">
              By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body"><pre>'.file_get_contents($row["image"]).'</pre></div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-footer" align="right">
              <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
               <form action = "add_vote.php" method = "post">
               <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
               <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
               '.$row["voteup"].'
              <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
              <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                '.$row["votedown"].'
              </form>

              </div>
             </div>
             ';
            }
            else{//if the file is not a text file just display photo

              $output .= '
             <div class="panel panel-default">
              <div class="panel-heading">
              <img class= "avatar" src = "'.$duc["locate"].'">
              By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
              <div class="panel-body"><img src = "'.$row["image"].'" height="150" width="225"></div>
              <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
              <div class="panel-footer" align="right">
              <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
               <form action = "add_vote.php" method = "post">
               <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
               <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
               '.$row["voteup"].'
              <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
              <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
                '.$row["votedown"].'
              </form>

              </div>
             </div>
             ';
            }
          }


       $output .= get_reply_comment($conn,$row["comment_id"]);

      }
    }
    }

      echo $output;



  function get_reply_comment($conn, $parent_id = 0, $marginleft = 0){
    $sessid=$_SESSION['userid'];
    $sessname=$_SESSION['username'];
    $group = $_POST['groupajax'];
  $query = " SELECT * FROM tbl_comment
              WHERE parent_comment_id = '$parent_id'
              and grpid= '$group' ";
   $output = '';
   $sabbathsec = mysqli_query($conn, $query);
   $count= mysqli_num_rows($sabbathsec);
   $marginleft = $marginleft + 48;
   if($count > 0) {

     while ($row = mysqli_fetch_assoc($sabbathsec)) {
       $fubb = $row['uid'];
         $photo = "SELECT * FROM profileimage WHERE userid = '$fubb' ";
         $pic = mysqli_query($conn, $photo);
         $duc=mysqli_fetch_assoc($pic);
        if ($sessid == '9') {
          $output .= '
          <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
           <div class="panel-heading">
           <img class= "avatar" src = "'.$duc["locate"].'">
           By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
           <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
           <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
           <form action = "add_vote.php" method = "post">
           <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
           <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
           '.$row["voteup"].'
          <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
          <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
        '.$row["votedown"].'
          </form>
          </form>
          <form action= "setting.php" method = "post">
          <button type = "submit" name="delete" value="'.$row["comment_id"].'" >Delete</button>
          </form>
          </div>
          ';
          $output .= get_reply_comment($conn, $row["comment_id"], $marginleft);
        }else{
     $output .= '
     <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
      <div class="panel-heading">
      <img class= "avatar" src = "'.$duc["locate"].'">
      By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
      <div class="panel-body">'.htmlspecialchars($row["message"]).'</div>
      <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
      <form action = "add_vote.php" method = "post">
      <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
      <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
      '.$row["voteup"].'
     <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
     <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
   '.$row["votedown"].'
     </form>
     </div>
     ';
     $output .= get_reply_comment($conn, $row["comment_id"], $marginleft);
   }
    }
   }
   return $output;
  }


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
function cwRating(id,type,target){
  $.ajax({
      type:'POST',
      url:'add_vote.php',
      data:'id='+id+'&type='+type,
      success:function(msg){
          if(msg == 'err'){
              alert('Some problem occured, please try again.');
          }else{
              $('#'+target).html(msg);
          }
      }
  });
}
</script>

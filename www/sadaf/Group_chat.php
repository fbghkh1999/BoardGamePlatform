<?php
include "header.inc.php";
HTMLBegin();
if (isset($_POST['submit'])){

    $mysql = pdodb::getInstance();

    $un= $_SESSION["PersonID"];
    $m = mysqli_real_escape_string(
        $mysql, $_REQUEST['msg']);
    date_default_timezone_set('Asia/Tehran');
    $ts=date('y-m-d h:ia');


    $sql = "INSERT INTO sadf.chats (userID, msg, dt) 
        VALUES ('$un', '$m', '$ts')";
    if(mysqli_query($mysql, $sql)){
        ;
    } else{
        echo "ERROR: Message not sent!!!";
    }

    mysqli_close($mysql);
}
?>
<html>
<head>
    <style>
        *{
            box-sizing:border-box;
        }
        body{
            background-color:#abd9e9;
            font-family:Arial;
        }
        #container{
            width:500px;
            height:700px;
            background:white;
            margin:0 auto;
            font-size:0;
            border-radius:5px;
            overflow:hidden;
        }
        main{
            width:500px;
            height:700px;
            display:inline-block;
            font-size:15px;
            vertical-align:top;
        }
        main header{
            height:100px;
            padding:30px 20px 30px 40px;
            background-color:#622569;
        }
        main header > *{
            display:inline-block;
            vertical-align:top;
        }
        main header img:first-child{
            width:24px;
            margin-top:8px;
        }
        main header img:last-child{
            width:24px;
            margin-top:8px;
        }
        main header div{
            margin-left:90px;
            margin-right:90px;
        }
        main header h2{
            font-size:25px;
            margin-top:5px;
            text-align:center;
            color:#FFFFFF;
        }
        main .inner_div{
            padding-left:0;
            margin:0;
            list-style-type:none;
            position:relative;
            overflow:auto;
            height:500px;
            background-image:url(https://media.geeksforgeeks.org/wp-content/cdn-uploads/20200911064223/bg.jpg);
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            position: relative;
            border-top:2px solid #fff;
            border-bottom:2px solid #fff;
        }
        main .triangle{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 8px 8px 8px;
            border-color: transparent transparent
            #58b666 transparent;
            margin-left:20px;
            clear:both;
        }
        main .message{
            padding:10px;
            color:#000;
            margin-left:15px;
            background-color:#58b666;
            line-height:20px;
            max-width:90%;
            display:inline-block;
            text-align:left;
            border-radius:5px;
            clear:both;
        }
        main .triangle1{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 8px 8px 8px;
            border-color: transparent
            transparent #6fbced transparent;
            margin-right:20px;
            float:right;
            clear:both;
        }
        main .message1{
            padding:10px;
            color:#000;
            margin-right:15px;
            background-color:#6fbced;
            line-height:20px;
            max-width:90%;
            display:inline-block;
            text-align:left;
            border-radius:5px;
            float:right;
            clear:both;
        }

        main footer{
            height:150px;
            padding:20px 30px 10px 20px;
            background-color:#622569;
        }
        main footer .input1{
            resize:none;
            border:100%;
            display:block;
            width:120%;
            height:55px;
            border-radius:3px;
            padding:20px;
            font-size:13px;
            margin-bottom:13px;
        }
        main footer textarea{
            resize:none;
            border:100%;
            display:block;
            width:140%;
            height:55px;
            border-radius:3px;
            padding:20px;
            font-size:13px;
            margin-bottom:13px;
            margin-left:20px;
        }
        main footer .input2{
            resize:none;
            border:100%;
            display:block;
            width:40%;
            height:55px;
            border-radius:3px;
            padding:20px;
            font-size:13px;
            margin-bottom:13px;
            margin-left:100px;
            color:white;
            text-align:center;
            background-color:black;
            border: 2px solid white;
        }
        }
        main footer textarea::placeholder{
            color:#ddd;
        }

    </style>
<body onload="show_func()">
<div id="container">
    <main>
        <header>
            <img src="www/sadaf/images/ico_star.png" alt="">
            <div>
                <h2>GROUP CHAT</h2>
            </div>
            <img src="www/sadaf/images/ico_star.png" alt="">
        </header>

        <script>
            function show_func(){

                var element = document.getElementById("chathist");
                element.scrollTop = element.scrollHeight;

            }
        </script>

        <form id="myform" action="Group_chat.php" method="POST" >
            <div class="inner_div" id="chathist">
                <?php
                $mysql = pdodb::getInstance();

                $query = "SELECT * FROM chats";
                $run = $mysql->query($query);
                $i=0;

                while($row = $run->fetch_array()) :
                    if($i==0){
                        $i=5;
                        $first=$row;
                        ?>
                        <div id="triangle1" class="triangle1"></div>
                        <div id="message1" class="message1">
 <span style="color:white;float:right;">
 <?php echo $row['msg']; ?></span> <br/>
                            <div>
   <span style="color:black;float:left;
   font-size:5px;clear:both;">
    <?php echo $row['userID']; ?>,
        <?php echo $row['dt']; ?>
   </span>
                            </div>
                        </div>
                        <br/><br/>
                        <?php
                    }
                    else
                    {
                        if($row['userID']!=$first['userID'])
                        {
                            ?>
                            <div id="triangle" class="triangle"></div>
                            <div id="message" class="message">
 <span style="color:white;float:left;">
   <?php echo $row['msg']; ?>
 </span> <br/>
                                <div>
  <span style="color:black;float:right;
          font-size:5px;clear:both;">
  <?php echo $row['userID']; ?>,
        <?php echo $row['dt']; ?>
 </span>
                                </div>
                            </div>
                            <br/><br/>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div id="triangle1" class="triangle1"></div>
                            <div id="message1" class="message1">
 <span style="color:white;float:right;">
  <?php echo $row['msg']; ?>
 </span> <br/>
                                <div>
 <span style="color:black;float:left;
         font-size:5px;clear:both;">
 <?php echo $row['userID']; ?>,
      <?php echo $row['dt']; ?>
 </span>
                                </div>
                            </div>
                            <br/><br/>
                            <?php
                        }
                    }
                endwhile;
                ?>
            </div>
            <footer>
                <table>
                    <tr>
                        <th>
                            <input  class="input1" type="text"
                                    id="uname" name="uname"
                                    placeholder="From">
                        </th>
                        <th>
            <textarea id="msg" name="msg"
                      rows='3' cols='50'
                      placeholder="Type your message">
            </textarea></th>
                        <th>
                            <input class="input2" type="submit"
                                   id="submit" name="submit" value="send">
                        </th>
                    </tr>
                </table>
            </footer>
        </form>
    </main>
</div>

</body>
</html>
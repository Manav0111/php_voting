<?php
    session_start();
    if(!isset($_SESSION['userdata']))
    {
        header("location: ../index.html");
    }
    $userdata=$_SESSION['userdata'];
    $groupsdata=$_SESSION['groupsdata'];
    if($_SESSION['userdata']['status']==0)
    {
     $status='<b style="color:red">Not Voted</b>';

    }
    else
    {
        $status='<b style="color:green">Voted</b>';
    }
?>
 

<html>
    <head>
        <title>Polling Booth- Dashboard</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <style>
        #backbtn{
            padding: 10px 20px;
            font-size:15px;
            background-color:steelblue;
            color:white;
            border-radius:5px;
            float:left;
            margin:10px;
        }


        #logoutbtn{
            padding: 10px 20px;
            font-size:15px;
            background-color:steelblue;
            color:white;
            border-radius:5px;
            float:right;
            margin:10px;

        }


        #profile{
            background-color:cornflowerblue;
            width:30%;
            padding: 20px;
            float:left;
            color:white;
        }

        #Group{
            background-color:cornflowerblue;
            width:60%;
            padding: 20px;
            float: right;
            color:white;
        }

        #votebtn{
            padding: 8px 16px;
            font-size:15px;
            background-color:#3498db;
            color:white;
            border-radius:5px;

        }

        #voted{
            padding: 8px 16px;
            font-size:15px;
            background-color:green;
            color:white;
            border-radius:5px;

        }

            #mainpanel{
                padding: 10px;
            }

            #heading{
                color:white;
            }


    </style>
    <body>

        <center>
        <div id="mainSection">
            <a href="../index.html"><button id="backbtn">Back</button></a>
            <a href="../api/logout.php"><button id="logoutbtn">Logout</button></a>
            <h1  id="heading">Polling Booth System</h1>

        </div>
        </center>
        <hr>


        <div id="mainpanel">

            
            <div id="profile">
                <center><img src="../uploads/<?php echo $userdata['photo'] ?>" width="100" height="100"></center><br><br>
                <b>Name:</b><?php echo $userdata['name']?> <br><br>
                <b>Mobile:</b><?php echo $userdata['mobile']?> <br><br>
                <b>Address:</b><?php echo $userdata['address']?> <br><br>
                <b>Status:</b><?php echo  $status?> <br><br>
                
            </div>

        
        
            <div id="Group">
                <?php
                if($_SESSION['groupsdata'])
                {
                    
                    for($i=0; $i<count($groupsdata); $i++)
                    {
                        ?>
                        <div>
                            <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">  
                            <b>Group Name:</b><?php echo $groupsdata[$i]['name']?> <br><br>
                        <b>Votes:</b><?php echo $groupsdata[$i]['votes']?> <br><br>
                        <form action="../api/vote.php"  method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>" >
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>" >
                            <?php
                            if($_SESSION['userdata']['status']==0){
                                ?>
                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                <?php

                            }
                            else
                            {
                                ?>
                                <button disabled type="button"  name="votebtn" value="Vote" id="voted">Voted</button>
                                <?php

                            }                            


                            ?>
                            </form>
                        </div>
                        <hr>
                        <?php
                    }
                }
                else
                {

                }
                
                
                ?>

            </div>
        </div>
    </body>
</html>